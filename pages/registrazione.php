<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/../assets/css/style_login.css">
	<link rel="stylesheet" href="/../assets/css/colors-purple.css">
	<script src="/assets/js/load.js"></script>
  <title>Pagina di registrazione</title>
</head>
<body>
  <?php
  if(isset($_POST['invia'])){
    require_once "../php/query/database.php";
    require_once "../php/query/user.php";
    require_once "../php/protected/minimum_authorization_level.php";

    session_start();

    //oggetti, connessione e variabili
    $conn = (new database())->connect();
    $userOperations = new user($conn);

    //testo di errore campi form
    $usernameError = '';
    $emailError = '';
    $avatarError = '';
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $max_file_size = 2 * 1024 * 1024; // 2MB in bytes

    //dati da POST
    $name = $_POST['new_name'];
    $surname = $_POST['new_surname'];
    $username = $_POST['new_username'];
    $email = $_POST['new_email'];
    $password = $_POST['new_password'];
    $avatar_path = ''; 

    // Controllo lunghezza minima username
    if(strlen($username) < USERNAME_MINIMUM_LENGHT){
      $usernameError = "L'username deve essere di almeno 3 caratteri";
    }

    //verifica esistenza username
    if($userOperations->existsInField("username", $username)){
      $usernameError = "Username già in uso.";
    }

    //controllo esistenza email
    if($userOperations->existsInField("email", $email)){
      $emailError = "Email già associata ad un account.";
    }

    // Gestione dell'upload dell'avatar
    if(isset($_FILES['new_avatar']) && $_FILES['new_avatar']['error'] === UPLOAD_ERR_OK) {
      // Percorso per gli avatar
      $target_dir = __DIR__ . "/../assets/uploads/avatars/";
      
      // Crea la directory se non esiste
      if(!is_dir($target_dir)) {
        if(!mkdir($target_dir, 0755, true)) {
          $avatarError = 'Errore nella creazione della directory per gli avatar.';
        }
      }
      
      if(empty($avatarError)) {
        // Controlla eventuali errori di caricamento PHP
        if($_FILES['new_avatar']['error'] !== UPLOAD_ERR_OK) {
          $avatarError = 'Errore di caricamento del file avatar.';

        }else{

          // Ottieni informazioni sul file
          $original_avatar_name = $_FILES['new_avatar']['name'];
          $file_extension = strtolower(pathinfo($original_avatar_name, PATHINFO_EXTENSION));
          $filename_without_ext = pathinfo($original_avatar_name, PATHINFO_FILENAME);
          
          // Verifica che sia un'immagine valida
          if(!in_array($file_extension, $allowed_extensions)) {
            $avatarError = 'Formato file non supportato. Usa: JPG, JPEG, PNG, GIF, WEBP.';

          }else{
            // Verifica la dimensione del file (max 2MB)
            if($_FILES['new_avatar']['size'] > $max_file_size) {
              $avatarError = 'Il file è troppo grande. Dimensione massima: 2MB.';

            } else {
              // Genera un nome file unico
              $unique_filename = $username . '_avatar_' . time() . '.' . $file_extension;
              $safe_unique_filename = basename($unique_filename);
              $target_file = $target_dir . $safe_unique_filename;
              
              // Sposta il file caricato
              if(move_uploaded_file($_FILES['new_avatar']['tmp_name'], $target_file)) {
                // Percorso relativo per il database
                $avatar_path = "assets/uploads/avatars/" . $safe_unique_filename;

              }else{
                $avatarError = 'Errore durante il caricamento dell\'avatar.';

              }
            }
          }
        }
      }
    }

    //registrazione nuovo utente
    if($usernameError === '' && $emailError === '' && $avatarError === ''){
      // Passa il path dell'avatar al metodo di registrazione
      if($userOperations->register($name, $surname, $username, $email, $password, $avatar_path)){
        $conn->close();
        header("Location: login.php");
        exit();

      }else{
        // Rimozione avatar in caso di errore
        if(!empty($avatar_path) && file_exists($target_dir . basename($avatar_path))) {
          unlink($target_dir . basename($avatar_path));

        }

      }
    }

    $conn->close();
  }
  ?>
  <div class="loading-screen">
    <div class="spinner"></div>
  </div>

  <main class="login-container">
    <h2>REGISTRAZIONE</h2>

    <!--bottoni home e color change-->
    <div id="login_page_buttons">
      <a href="/index.php" title="Torna alla home page"><i class="fa-solid fa-house"></i></a>
      <div id="circle-icon" class="container-colorChange" onclick="colorChange()">
        <i id="light" class="fa-regular fa-sun" title="Cambia tema pagina"></i>
        <i id="dark" class="fa-regular fa-moon" title="Cambia tema pagina"></i>
        <br>
      </div>
    </div>

    <!--form registrazione-->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form" enctype="multipart/form-data">
      <!--nome-->
      <label for="new_name">Nome:</label>
      <input type="text" id="new_name" name="new_name" placeholder="Nome" required value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">

      <!--cognome-->
      <label for="new_surname">Cognome:</label>
      <input type="text" id="new_surname" name="new_surname" placeholder="Cognome" required value="<?php echo isset($surname) ? htmlspecialchars($surname) : ''; ?>">

      <!--username-->
      <label for="new_username" class="error_text">Username:</label>
      <input type="text" id="new_username" name="new_username" placeholder="Username" required value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" class="<?php echo (isset($usernameError) && $usernameError != '') ? 'error_border' : ''; ?>">
      <!--username error-->
      <?php if(isset($usernameError) && $usernameError != ''): ?>
        <div class="error_message"><?php echo $usernameError; ?></div>
      <?php endif; ?>

      <!--email-->
      <label for="new_email" class="error_text">Email:</label>
      <input type="email" id="new_email" name="new_email" placeholder="email@email.com" required value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" class="<?php echo (isset($emailError) && $emailError != '') ? 'error_border' : ''; ?>">
      <!--email error-->
      <?php if(isset($emailError) && $emailError != ''): ?>
        <div class="error_message"><?php echo $emailError; ?></div>
      <?php endif; ?>

      <!--password-->
      <label for="new_password">Password:</label>
      <input type="password" id="new_password" name="new_password" placeholder="Inserisci password" required>

      <!--avatar-->
      <label for="new_avatar" class="<?php echo (isset($avatarError) && $avatarError != '') ? 'error_text' : ''; ?>">Carica un avatar:</label>
      <input type="file" id="new_avatar" name="new_avatar" accept="image/*" class="<?php echo (isset($avatarError) && $avatarError != '') ? 'error_border' : ''; ?>">
      <small>Formati supportati: JPG, JPEG, PNG, GIF, WEBP. Dimensione massima: 2MB</small>
      <!--avatar error-->
      <?php if(isset($avatarError) && $avatarError != ''): ?>
        <div class="error_message"><?php echo $avatarError; ?></div>
      <?php endif; ?>

      <!--bottone invia-->
      <input type="submit" class="button primary" name="invia" value="Registrati">
    </form>
    <p>Hai gia un account?</p>
    <a class="button primary" href="login.php" title="Accedi al tuo account">Accedi</a>
  </main>
  <script src="/assets/js/script_loginPage.js"></script>
  <script src="https://kit.fontawesome.com/4383a54113.js" crossorigin="anonymous"></script>
  <script src="/assets/js/script.js"></script>
</body>
</html>