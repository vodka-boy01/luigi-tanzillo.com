<?php
/**
 * questa classe gestisce le operazioni sui progetti nel database.
 */
class Project {
    private $connection;


    /**
     * @param mysqli $db connessione al database.
     */
    public function __construct($db) {
        $this->connection = $db;
    }

    /**
     * aggiunge un nuovo progetto e le sue immagini al database.
     * @param string $titolo titolo del progetto.
     * @param string $descrizione_breve breve descrizione.
     * @param string $descrizione_completa descrizione dettagliata.
     * @param int $stato stato del progetto (1=attivo, 0=inattivo).
     * @param array $uploaded_image_details dettagli delle immagini caricate (nome e percorso).
     * @param string $titolo_footer titolo per il footer.
     * @param string $descrizione_link_1 descrizione del link 1.
     * @param string $link_1 link 1.
     * @param string $descrizione_link_2 descrizione del link 2.
     * @param string $link_2 link 2.
     * @param array $raggruppamento array contenente gli ID dei ruoli.
     * @return bool|string true se ha successo, "duplicate_title" se il titolo esiste già, false per altri errori.
     */
    public function addProject($titolo, $descrizione_breve, $descrizione_completa, $stato, $uploaded_image_details = [], $titolo_footer, $raggruppamento = [], $descrizione_link_1, $link_1, $descrizione_link_2, $link_2) {
        // avvio transazione
        $this->connection->begin_transaction();

        try {
            //query per l'inserimento del progetto
            $query_project = "INSERT INTO progetti (titolo, descrizione_breve, descrizione_completa, stato, titolo_footer, descrizione_link_1, link_1, descrizione_link_2, link_2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"; // Aggiunto un placeholder '?' per titolo_footer

            $resSet_project = $this->connection->prepare($query_project);

            $resSet_project->bind_param("sssisssss", $titolo, $descrizione_breve, $descrizione_completa, $stato, $titolo_footer, $descrizione_link_1, $link_1, $descrizione_link_2, $link_2); 

            if(!$resSet_project->execute()) {
                // titolo duplicato codice 1062
                if($this->connection->errno == 1062) {
                    throw new Exception("il titolo del progetto esiste già.", 1062);

                } else {
                    throw new Exception("errore durante l'inserimento del progetto: " . $resSet_project->error);

                }
            }

            $project_id = $this->connection->insert_id;
            $resSet_project->close();

            //inserisce le immagini
            if(!empty($uploaded_image_details)) {
                $query_image = "INSERT INTO immagini_progetti (progetto_id, nome_file, percorso_file) VALUES (?, ?, ?)";
                $resSet_image = $this->connection->prepare($query_image);

                if($resSet_image === false) {
                    throw new Exception("errore nella preparazione della query delle immagini: " . $this->connection->error);
                }

                foreach($uploaded_image_details as $image) {
                    $image_name = $image['name'];
                    $relative_web_path = $image['path'];

                    $resSet_image->bind_param("iss", $project_id, $image_name, $relative_web_path);
                    if(!$resSet_image->execute()){
                        throw new Exception("errore durante l'inserimento dell'immagine '" . htmlspecialchars($image_name) . "': " . $resSet_image->error);
                    }
                }
                $resSet_image->close();
            }

            if(!empty($raggruppamento)) {
                //query inserimento ruoli al progetto
                $query_project_role = "INSERT INTO progetti_ruoli (progetto_id, ruolo_id) VALUES (?, ?)";
                $resSet_project_role = $this->connection->prepare($query_project_role);

                if($resSet_project_role === false){
                    throw new Exception("errore nella preparazione della query per i ruoli del progetto: " . $this->connection->error);
                }

                foreach ($raggruppamento as $ruolo_id) {
                    //casting
                    $ruolo_id = (int) $ruolo_id;
                    $resSet_project_role->bind_param("ii", $project_id, $ruolo_id);
                    if (!$resSet_project_role->execute()) {
                        throw new Exception("errore durante l'inserimento del ruolo '" . htmlspecialchars($ruolo_id) . "' per il progetto: " . $resSet_project_role->error);
                    }
                }
                $resSet_project_role->close();
            }

            $this->connection->commit();
            return true;

        } catch(Exception $e) {
            $this->connection->rollback(); // rollback in caso di errore
            error_log("errore in addProject: " . $e->getMessage());

            // restituisce "duplicate_title"
            if($e->getCode() == 1062) {
                return "duplicate_title";
            }
            return false;
        }
    }

    /**
     * recupera tutti i progetti dal database, di base 
     * altrimenti con project id ne restituisce uno
     * @return array un array di progetti.
     */
    public function getAllProjects($id = null) {
        if($id === null){
            //caso tutti i progetti richiesti
            $query = "
                SELECT
                    p.id,
                    p.titolo,
                    p.titolo_footer,   
                    p.data_creazione,
                    p.descrizione_breve,
                    p.descrizione_completa,
                    p.stato,
                    GROUP_CONCAT(CONCAT(img.percorso_file, '|||', img.nome_file) ORDER BY img.id ASC) AS immagini_details,
                    GROUP_CONCAT(DISTINCT pr.ruolo_id ORDER BY pr.ruolo_id ASC) AS ruoli_ids
                FROM progetti p
                LEFT JOIN immagini_progetti img ON p.id = img.progetto_id
                LEFT JOIN progetti_ruoli pr ON p.id = pr.progetto_id 
                GROUP BY p.id, p.titolo, p.titolo_footer, p.data_creazione, p.descrizione_breve, p.descrizione_completa
                ORDER BY p.data_creazione DESC
            ";
        }else{
            //caso singolo progetto richiesto
            $query = "
                SELECT
                    p.id,
                    p.titolo,
                    p.titolo_footer,   
                    p.data_creazione,
                    p.descrizione_breve,
                    p.descrizione_completa,
                    p.stato,
                    GROUP_CONCAT(CONCAT(img.percorso_file, '|||', img.nome_file) ORDER BY img.id ASC) AS immagini_details,
                    GROUP_CONCAT(DISTINCT pr.ruolo_id ORDER BY pr.ruolo_id ASC) AS ruoli_ids
                FROM progetti p
                LEFT JOIN immagini_progetti img ON p.id = img.progetto_id
                LEFT JOIN progetti_ruoli pr ON p.id = pr.progetto_id 
                GROUP BY p.id, p.titolo, p.titolo_footer, p.data_creazione, p.descrizione_breve, p.descrizione_completa
                WHERE p.id = '$id'
                ORDER BY p.data_creazione DESC
            ";
        }
        $resSet = $this->connection->query($query);
        $projects = [];

        while($row = $resSet->fetch_assoc()) {
            $project_data = [
                'id' => $row['id'],
                'titolo' => $row['titolo'],
                'titolo_footer' => $row['titolo_footer'],
                'data_creazione' => $row['data_creazione'],
                'descrizione_breve' => $row['descrizione_breve'],
                'descrizione_completa' => $row['descrizione_completa'],
                'tipo' => ($row['stato'] === 1) ? 'progetto' : 'evento',//tipo scheda
                'images' => [],
                'roles' => []
            ];

            // dettagli immagini
            if (!empty($row['immagini_details'])) {
                $all_image_details = explode(',', $row['immagini_details']);

                foreach ($all_image_details as $image_detail_string) {
                    $parts = explode('|||', $image_detail_string);
                    if (count($parts) === 2) {
                        $project_data['images'][] = [
                            'path' => trim($parts[0]),
                            'name' => trim($parts[1])
                        ];
                    }
                }
            }

            // elabora gli ID dei ruoli
            if (!empty($row['ruoli_ids'])) {
                $all_role_ids = explode(',', $row['ruoli_ids']);
                $project_data['roles'] = array_map('intval', $all_role_ids); // ogni ID di ruolo a intero
            }

            $projects[] = $project_data;
        }

        return $projects;
    }

    /**
     * Recupera i progetti visibili per un dato ID ruolo.
     * Un ruolo con un ID più alto può vedere i progetti associati al suo ID e a tutti gli ID ruolo inferiori.
     *
     * @param int $role_id L'ID del ruolo per cui recuperare i progetti.
     * @return array Un array di progetti visibili per il ruolo specificato, inclusi quelli di livelli inferiori.
     */
    public function getAllProjectsByRole(int $role_id) {
        require_once __DIR__ . "/../protected/minimum_authorization_level.php";

        $query = "
            SELECT
                p.id,
                p.titolo,
                p.titolo_footer,
                p.data_creazione,
                p.descrizione_breve,
                p.descrizione_completa,
                p.stato,
                p.descrizione_link_1,
                p.link_1,                
                p.descrizione_link_2,
                p.link_2,
                GROUP_CONCAT(DISTINCT CONCAT(img.percorso_file, '|||', img.nome_file) ORDER BY img.id ASC) AS immagini_details,
                GROUP_CONCAT(DISTINCT pr.ruolo_id ORDER BY pr.ruolo_id ASC) AS ruoli_ids
            FROM progetti p
            LEFT JOIN immagini_progetti img ON p.id = img.progetto_id
            LEFT JOIN progetti_ruoli pr ON p.id = pr.progetto_id
            WHERE
                pr.ruolo_id >= ? -- (1) Progetti assegnati, visibili per il ruolo corrente o ruoli inferiori.
                OR (
                    pr.progetto_id IS NULL
                    AND ? <= " . MINIMUM_REQUIRED_AUTHORIZATION_LEVEL . "
                )
            GROUP BY p.id, p.titolo, p.titolo_footer, p.data_creazione, p.descrizione_breve, p.descrizione_completa
            ORDER BY p.data_creazione DESC
        ";

        $resSet = $this->connection->prepare($query);

        if ($resSet === false) {
            error_log("Errore nella preparazione della query getProjectsByRole: " . $this->connection->error);
            return [];
        }

        // Lega l'ID del ruolo come parametro intero
        // doppio parametro
        $resSet->bind_param("ii", $role_id, $role_id);

        $resSet->execute();
        $result = $resSet->get_result();
        $projects = [];

        while ($row = $result->fetch_assoc()) {
            $project_data = [
                'id' => $row['id'],
                'titolo' => $row['titolo'],
                'titolo_footer' => $row['titolo_footer'],
                'data_creazione' => $row['data_creazione'],
                'descrizione_breve' => $row['descrizione_breve'],
                'descrizione_completa' => $row['descrizione_completa'],
                'tipo' => ($row['stato'] === 1) ? 'progetto' : 'evento',//tipo scheda
                'images' => [],
                'roles' => [],
                'descrizione_link_1' => $row['descrizione_link_1'],
                'link_1' => $row['link_1'],
                'descrizione_link_2' => $row['descrizione_link_2'],
                'link_2' => $row['link_2']
            ];

            // Elaborazione delle immagini
            if (!empty($row['immagini_details'])) {
                $all_image_details = explode(',', $row['immagini_details']);
                foreach ($all_image_details as $image_detail_string) {
                    $parts = explode('|||', $image_detail_string);
                    if (count($parts) === 2) {
                        $project_data['images'][] = [
                            'path' => trim($parts[0]),
                            'name' => trim($parts[1])
                        ];
                    }
                }
            }

            // Elaborazione degli ID dei ruoli
            if (!empty($row['ruoli_ids'])) {
                $all_role_ids = explode(',', $row['ruoli_ids']);
                $project_data['roles'] = array_map('intval', $all_role_ids);
            }

            $projects[] = $project_data;
        }

        $resSet->close();
        return $projects;
    }

    /**
     * Recupera i percorsi completi delle immagini associate a un progetto.
     * Questo metodo è privato e usato internamente.
     * @param int $project_id l'id del progetto.
     * @return array un array di percorsi completi dei file.
     */
    private function getProjectImageFullPaths($project_id) {
        $paths = [];
        $query = "SELECT percorso_file FROM immagini_progetti WHERE progetto_id = ?";
        $resSet = $this->connection->prepare($query);

        if ($resSet === false) {
            error_log("Errore nella preparazione della query per recuperare i percorsi immagine: " . $this->connection->error);
            return [];
        }

        $resSet->bind_param("i", $project_id);
        $resSet->execute();
        $result = $resSet->get_result();

        while ($row = $result->fetch_assoc()) {
            // Ricostruisci il percorso fisico completo del file
            $base_dir = __DIR__ . "/../../"; // Risale a luigi-tanzillo.com/
            $full_path = realpath($base_dir . $row['percorso_file']); // Combina con il percorso relativo dal DB

            if ($full_path !== false) {
                $paths[] = $full_path;
            }
        }
        $resSet->close();
        return $paths;
    }

    /**
     * Elimina un progetto dal database e i suoi file associati dal file system.
     * Utilizza ON Delete cascadee
     * @param int $project_id l'id del progetto da eliminare.
     * @return bool true se l'eliminazione ha successo, false altrimenti.
     */
    public function deleteProject($project_id) {
        // Avvio transazione
        $this->connection->begin_transaction();
        try {
            // 1. Recupera i percorsi delle immagini PRIMA di eliminare il progetto dal DB
            $images_path = $this->getProjectImageFullPaths($project_id);

            // 2. Elimina il progetto dal database con cascade
            $query = "DELETE FROM progetti WHERE id = ?";
            $resSet = $this->connection->prepare($query);
            
            $resSet->bind_param("i", $project_id);
            
            if(!$resSet->execute()) {
                throw new Exception("Errore durante l'eliminazione del progetto: " . $resSet->error);
            }
            $resSet->close();

            $this->connection->commit(); // Commit della transazione DB

            // 3. Elimina fisicamente i file dal server
            foreach ($images_path as $file_path) {
                if (file_exists($file_path)) {
                    if (!unlink($file_path)) {
                        error_log("Errore: impossibile eliminare il file " . htmlspecialchars($file_path));
                    }
                } else {
                    error_log("Avviso: il file " . htmlspecialchars($file_path) . " non esiste sul file system, ma era nel DB.");
                }
            }

            return true;
        } catch(Exception $e) {
            $this->connection->rollback(); 
            error_log("Errore in deleteProject: " . $e->getMessage()); 
            return false;
        }
    }
    
}
?>