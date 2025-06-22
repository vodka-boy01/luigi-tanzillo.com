<?php
/** 
 * questa classe contiene i metodi per gestire gli utenti:
 * autenticazione, verifica esistenza, registrazione ed eliminazione
 * 
 * @author luigi tanzillo
 * @version 1.1
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
    public function verifyCurrentPassword($username, $password) {
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
    public function register($new_name, $new_surname, $new_username, $new_email, $new_password) {
        $query = "INSERT INTO utenti (name, surname, username, email, password) 
            VALUES ('$new_name', '$new_surname', '$new_username', '$new_email', '$new_password')
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
     * @return bool true se l'aggiornamento è riuscito, false altrimenti
     */
    public function updateSpecificFields($username, $fieldsToUpdate) {
        if (empty($fieldsToUpdate)) {
            return false;
        }
        
        $setClause = implode(", ", $fieldsToUpdate);
        $query = "UPDATE utenti SET $setClause WHERE username = '$username'";
        
        $resSet = $this->connection->query($query);
        return $resSet;
    }

    /**
     * elimina un utente
     * @param string $username username dell'utente da eliminare
     * @return bool true on success, false on failure
     */
    public function deleteUser($username){
        $query = "DELETE FROM utenti WHERE username = '$username'";
        $resSet = $this->connection->query($query);

        return $resSet;
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
}
?>