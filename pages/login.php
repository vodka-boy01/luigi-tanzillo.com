<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/style_login.css">
	<link rel="stylesheet" href="/assets/css/colors-purple.css">
  <link rel="stylesheet" href="/assets/css/style.css">
  <!--funzione loader-->
	<script src="/assets/js/load.js"></script>
  <title>Login</title>
</head>
<body>
    <?php
    if(isset($_POST['invia'])){
      session_start();

      require_once __DIR__ . "/../php/query/database.php";
      require_once __DIR__ . "/../php/query/user.php";

      //oggetti, connessione e variabili
      $conn = (new database())->connect();
      $userOperations = new user($conn);
      $error = '';

      //dati POST
      $username = $_POST['username'];
      $password = $_POST['password'];
      
      //verifica esistenza username
      if($userOperations->login($username, $password)){
        $userInfo = $userOperations->getUserInfo($username);

        $_SESSION['username'] = $username;
        $_SESSION['nome'] = $userInfo['name'];
        $_SESSION['ruoloId'] = $userInfo['ruolo'];
        $_SESSION['ruolo'] = $userOperations->getUserRole($username);

        $conn->close();
        
        header("Location: ../index.php");
        exit();
        
      }else{
        $error = "Utente non trovato";

      }

      $conn->close();
    }
    ?>
    <div class="loading-screen">
      <div class="spinner"></div>
    </div>

    <main class="login-container">
      <h2>ACCESSO</h2>

      <!--bottoni home color change-->
      <div id="login_page_buttons">
        <a href="/index.php" title="Torna alla home page"><i class="fa-solid fa-house"></i></a>
        <div id="circle-icon" class="container-colorChange" onclick="colorChange()">
          <i id="light" class="fa-regular fa-sun" title="Cambia tema pagina"></i>
          <i id="dark" class="fa-regular fa-moon" title="Cambia tema pagina"></i>
          <br>
        </div>
      </div>

      <!--accedi con email e password-->
      <form action="<?php $_SERVER['PHP_SELF']?>" method="post" id="form">
        <!--username-->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="pippo" required class="<?php if(isset($error) && $error != ''){echo "error_border";}?>">

        <!--password-->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="1234" required class="<?php if(isset($error) && $error != ''){echo "error_border";}?>">
        <?php 
          if (isset($error) && $error !== '') {
            echo "<h3 class='error_message'>$error</h3>";
          }
        ?>
        <!--invia-->
        <input type="submit" name="invia" class="button primary">
      </form>

      <p>Oppure</p>
      
      <!--accedi con google-->
      <div id="social_button_container" title="Accedi con google">
        <button class="gsi-material-button" id="loginBtnGoogle">
          <div class="gsi-material-button-state"></div>
          <div class="gsi-material-button-content-wrapper">
            <div class="gsi-material-button-icon">
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;"">
                <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                <path fill="none" d="M0 0h48v48H0z"></path>
              </svg>
            </div>
            <span class="gsi-material-button-contents">Accedi con google</span>
            <br>
            <span style="display: none;">Accedi con google/span>
          </div>
        </button>

        <!--accedi con appleID-->
        <button class="gsi-material-button" id="loginAppleBtn" title="Accedi con appleID">
          <div class="gsi-material-button-state"></div>
          <div class="gsi-material-button-content-wrapper">
            <div class="gsi-material-button-icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="display: block;">
                <path fill="black" d="M16.365 1.43c0 1.14-.403 2.07-1.207 2.816-.963.892-2.068 1.42-3.287 1.335-.095-1.156.364-2.194 1.18-2.922.812-.728 1.938-1.189 3.314-1.23zm5.408 16.826c-.221.522-.462 1.015-.727 1.48-.385.674-.799 1.315-1.263 1.923-.73.959-1.515 1.916-2.674 1.946-1.05.026-1.382-.681-2.885-.671-1.504.01-1.866.686-2.919.66-1.158-.027-1.983-.98-2.714-1.938-.748-.978-1.357-2.02-1.86-3.137-1.286-2.911-1.096-6.421.753-8.537 1.004-1.162 2.27-1.814 3.586-1.787 1.063.024 2.063.724 2.886.724.82 0 2.093-.893 3.528-.762.6.025 2.289.24 3.372 1.806-.087.056-2.016 1.185-2 3.532.024 2.79 2.45 3.71 2.476 3.722-.02.057-.39 1.352-1.292 2.683z"/>
              </svg>
            </div>
            <span class="gsi-material-button-contents">Accedi con apple</span>
            <br>
            <span style="display: none;">Accedi con apple</span>
          </div>
        </button>
      </div>
    <!--<div id="userInfo"></div>-->
    <p>Non hai ancora un account?</p>
    <a class="button primary" href="registrazione.php" title="Registra un nuovo account">Registrati</a>
  </main>
  <!--main script-->
  <!--<script src="/assets/js/script_loginPage.js"></script>-->
  <script src="/assets/js/script.js"></script>
  <!--icone-->
	<script src="https://kit.fontawesome.com/4383a54113.js" crossorigin="anonymous"></script>
  <!--firebase webapp defer carica lo script solo dopo aver caricato gli elementi del dome-->
  <script defer type="module" src="/assets/js/app_auth.js"></script>
</body>
</html>
