<?php
/** 
 * questa classe contiene i metodi per gestire gli utenti:
 * autenticazione, verifica esistenza, registrazione ed eliminazione
 * 
 * @author luigi tanzillo
 * @version 1.2
*/
class user{
    private $connection;

    /**
     * costruttore per inizializzare la connessione al database
     * 
     * @param mysqli $db connessione al dabase
     */
    public function __construct($db){
        $this->connection = $db;
    }

    /**
     * Verifica la password dell'utente 
     * @param string $username username dell'utente
     * @param string $password password da verificare
     * @return bool true se la password è corretta, false altrimenti
     */
    public function verifyPassword($username, $password) {
        $resSet = $this->connection->query("SELECT id FROM utenti WHERE username = '$username' AND password = '$password'");

        return $resSet->num_rows > 0;
    }

    /**
     * verifica se un utente con il nome utente fornito esiste nel database
     * 
     * @param string $username nome utente da cercare
     * @return bool restituisce true se l'utente esiste, altrimenti false
     */
    public function exist($username){
        $resSet = $this->connection->query("SELECT id FROM utenti WHERE username = '$username'");
        if($resSet->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * autentica l'utente verificando username e password
     * 
     * @param string $username nome utente
     * @param string $password password dell'utente
     * @return bool restituisce true se le credenziali sono corrette, altrimenti false
     */
    public function login($username, $password){
        $current_dateTime = date('Y-m-d H:i:s');
        //verifica presenza utente
        $resSet = $this->connection->query("SELECT id FROM utenti WHERE username = '$username' AND password = '$password'");
        
        //aggiorna ultimo login query 
        $queryLatestLogin = "UPDATE utenti SET latest_login = '$current_dateTime' WHERE username = '$username' ";

        if($resSet->num_rows > 0){
            $resSet2 = $this->connection->query($queryLatestLogin);

            if($resSet2 && $this->connection->affected_rows > 0){
                return true;

            }else{
                return false;

            }
        }else{
            return false;

        }
    }

    /**
     * registra un nuovo utente (metodo non implementato)
     * 
     * @param string $new_name nome dell'utente
     * @param string $new_surname cognome dell'utente
     * @param string $new_username nome utente
     * @param string $new_email email dell'utente
     * @param string $new_password password dell'utente
     */
    public function register($new_name, $new_surname, $new_username, $new_email, $new_password, $new_avatar) {
        $query = "INSERT INTO utenti (name, surname, username, email, password, avatar) 
            VALUES ('$new_name', '$new_surname', '$new_username', '$new_email', '$new_password', '$new_avatar')
        ";

        $resSet = $this->connection->query($query);

        return $resSet;
    }

    /**
     * Aggiorna profilo utente
     * @param string $currentUsername username attuale
     * @param string $newName nuovo nome
     * @param string $newSurname nuovo cognome
     * @param string $newUsername nuovo username
     * @param string $newEmail nuova email
     * @return bool true se l'aggiornamento è riuscito, false altrimenti
     */
    public function updateProfile($currentUsername, $newName, $newSurname, $newUsername, $newEmail) {
        $query = "UPDATE utenti SET 
                    name = '$newName', 
                    surname = '$newSurname', 
                    username = '$newUsername', 
                    email = '$newEmail' 
                WHERE username = '$currentUsername'";
        
        $resSet = $this->connection->query($query);
        return $resSet;
    }

    /**
     * Aggiorna solo i campi specificati del profilo utente
     * @param string $currentUsername username attuale
     * @param array $fieldsToUpdate array di stringhe nel formato "campo = 'valore'"
     * @param string|null $oldAvatarPath path del vecchio avatar da rimuovere (opzionale)
     * @return bool true se l'aggiornamento è riuscito, false altrimenti
     */
    public function updateSpecificFields($username, $fieldsToUpdate, $oldAvatarPath = null) {
        if (empty($fieldsToUpdate)) {
            return false;
        }
        
        $setClause = implode(", ", $fieldsToUpdate);
        $query = "UPDATE utenti SET $setClause WHERE username = '$username'";
        
        $resSet = $this->connection->query($query);
        
        // Se l'aggiornamento è riuscito e c'è un vecchio avatar da rimuovere
        if($resSet && $oldAvatarPath !== null && !empty($oldAvatarPath) && $oldAvatarPath !== 'null') {
            $this->removeAvatarFile($oldAvatarPath);
        }
        
        return $resSet;
    }

    /**    
     * Trova utente per Google ID
     * @param string $googleId Google ID
     * @return array|null dati utente o null se non trovato
     */
    public function findByGoogleId($googleId) {
        $googleId = $this->connection->real_escape_string($googleId);
        $sql = "SELECT * FROM utenti WHERE google_id = '$googleId'";
        $resSet = $this->connection->query($sql);

        if ($resSet && $resSet->num_rows > 0) {
            return $resSet->fetch_assoc();
        }

        return null;
    }

    /**
     * Rimuove un file avatar dal filesystem
     * @param string $avatarPath path dell'avatar da rimuovere
     * @return bool true se rimosso con successo o se il file non esisteva, false in caso di errore
     */
    private function removeAvatarFile($avatarPath) {
        if(empty($avatarPath) || $avatarPath === 'null') {
            return true;
        }
        
        $fullAvatarPath = __DIR__ . "/../../" . $avatarPath;
        
        // Verifica che il file esista e rimuovilo
        if(file_exists($fullAvatarPath)) {
            if(unlink($fullAvatarPath)) {
                return true;
            } else {
                error_log("Impossibile eliminare l'avatar: " . $fullAvatarPath);
                return false;
            }
        }
        
        return true; // File non esisteva, considerato successo
    }

    /**
     * elimina un utente e il suo avatar dal filesystem
     * @param string $username username dell'utente da eliminare
     * @return bool true on success, false on failure
     */
    public function deleteUser($username){
        // Prima recupera il path dell'avatar prima di eliminare l'utente
        $avatarQuery = "SELECT avatar FROM utenti WHERE username = '$username'";
        $avatarResult = $this->connection->query($avatarQuery);
        
        $avatarPath = null;
        if($avatarResult && $avatarResult->num_rows > 0) {
            $row = $avatarResult->fetch_assoc();
            $avatarPath = $row['avatar'];
        }
        
        // Elimina l'utente dal database
        $deleteQuery = "DELETE FROM utenti WHERE username = '$username'";
        $deleteResult = $this->connection->query($deleteQuery);
        
        // Se l'eliminazione dal database è riuscita
        if($deleteResult) {
            // Rimuovi l'avatar dal filesystem se esiste
            if($avatarPath !== null && $avatarPath !== '' && $avatarPath !== 'null') {
                $this->removeAvatarFile($avatarPath);
            }
            
            return true;
        }
        
        return false;
    }

    /**
    *controlla se un valore esiste in un campo
    *@param string $field campo da controllare
    *@param mixed $value valore da cercare
    *@return bool true se esiste, altrimenti false
    */
    public function existsInField($field, $value) {
        $resSet = $this->connection->query("SELECT id FROM utenti WHERE $field = '$value'");
        return $resSet->num_rows > 0;
    }

    /**
    *restituisce un campo di un utente
    *@param string $field campo da restituire
    *@param int $id id dell'utente
    *@return mixed valore del campo
    */
    public function getUserInfo($username) {
        $query = "
            SELECT 
                *
            FROM utenti 
            WHERE username = '$username'
        ";

        $resSet = $this->connection->query($query);
        $row = $resSet->fetch_assoc();
        return $row;
    }

    /**
    *restituisce il ruolo di un utente
    *@param string $username username dell'utente
    *@return mixed nome del ruolo
    */
    public function getUserRole($username) {
        $query = "
            select
                nome as ruolo
            from utenti u
            inner join ruoli r on r.id = u.ruolo
            where u.username = '$username'
        ";
        $resSet = $this->connection->query($query);
        if($resSet){
            $row = $resSet->fetch_assoc();
            return $row['ruolo'];

        }else{
            echo "error";
            
        }
    }

    /**
     * restituisce tutti gli utenti con i loro ruoli.
     * @return array un array di oggetti utente, o un array vuoto se non ci sono utenti.
     */
    public function getAllUsers() {
        $query = "
            SELECT
                u.id,
                u.name,
                u.surname,
                u.username,
                u.email,
                r.nome AS ruolo
            FROM utenti u
            INNER JOIN ruoli r ON u.ruolo = r.id
            ORDER BY u.name ASC
        ";
        $resSet = $this->connection->query($query);
        $users = [];
        if ($resSet && $resSet->num_rows > 0) {
            while ($row = $resSet->fetch_assoc()) {
                $users[] = $row;
            }
        }

        return $users;
    }

    /**
     * Valida un file avatar
     * @param array $file array $_FILES per il file caricato
     */
    public function validateAvatar($file) {
        $errors = [];
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 2 * 1024 * 1024; // 2MB
        
        if($file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "Errore durante il caricamento del file";
            return ['valid' => false, 'errors' => $errors];
        }
        
        if(!in_array($file['type'], $allowedTypes)) {
            $errors[] = "Formato non supportato. Usa JPG, JPEG, PNG, GIF o WEBP";
        }
        
        if($file['size'] > $maxSize) {
            $errors[] = "Il file non può superare i 2MB";
        }
        
        // Verifica aggiuntiva del tipo di file usando getimagesize
        $imageInfo = getimagesize($file['tmp_name']);
        if($imageInfo === false) {
            $errors[] = "Il file non è un'immagine valida";
        }
        
        return ['valid' => empty($errors), 'errors' => $errors];
    }

    /**
     * Carica un avatar nel filesystem
     * @param array $file array $_FILES per il file caricato
     * @param string $username username dell'utente
     * @return array array con 'success' (bool), 'path' (string) e 'error' (string)
     */
    public function uploadAvatar($file, $username) {
        $validation = $this->validateAvatar($file);
        
        if(!$validation['valid']) {
            return ['success' => false, 'error' => implode(', ', $validation['errors'])];
        }
        
        $uploadDir = __DIR__ . '/../assets/uploads/avatars';
        if(!is_dir($uploadDir)) {
            if(!mkdir($uploadDir, 0755, true)) {
                return ['success' => false, 'error' => 'Impossibile creare la directory per gli avatar'];
            }
        }
        
        // nome file unico
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = $username . '_' . time() . '.' . $extension;
        $uploadPath = $uploadDir . $filename;
        $dbPath = 'assets/uploads/avatars/' . $filename;
        
        if(move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return ['success' => true, 'path' => $dbPath];
        } else {
            return ['success' => false, 'error' => 'Errore durante il salvataggio del file'];
        }
    }
}
?>