<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <?php
    if (isset($_POST['invia'])) {
        session_start();

        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPass = '';
        $dbName = 'nome'; 


        try {
            $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

            if ($conn->connect_error) {
              throw new Exception("Connessione fallita: " . $conn->connect_error);
            }

            $username = $_POST['username'];
            $password = $_POST['password'];
            $error = '';
            
            // VULNERABILITÀ CRITICA: Query diretta con variabili non sanificate
            // Questo è un codice estremamente pericoloso!
            $sql = "SELECT id, name, password, ruolo FROM users WHERE username = '$username' AND password = '$password'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
              $user = $result->fetch_assoc();

              $_SESSION['username'] = $username;
              $_SESSION['nome'] = $user['name'];

              $conn->close();
                
              header("Location: ../index.php");
              exit();
            }else{
              $error = "Nome utente o password non validi.";
            }

            $conn->close();

        } catch (Exception $e) {
            $error = "Errore di connessione o query: " . $e->getMessage();
        }
    }
    ?>
    <main>
        <h2>ACCESSO</h2>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Inserisci username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Inserisci password" required>
            <?php 
            if (isset($error) && $error !== '') {
                echo "<p style='color: red;'>$error</p>";
            }
            ?>
            <input type="submit" name="invia" value="Accedi">
        </form>

        <p>Non hai ancora un account?</p>
        <a href="registrazione.php">Registrati</a>
    </main>
</body>
</html>