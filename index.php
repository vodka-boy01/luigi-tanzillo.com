<?php
/*inizializzazione*/
ob_start();
session_start();

/*Classi */
require_once __DIR__ . '/php/protected/minimum_authorization_level.php';
require_once __DIR__ . '/php/query/database.php';
require_once __DIR__ . '/php/query/operations.php';
require_once __DIR__ . '/php/query/project.php';
require_once __DIR__ . '/php/query/user.php';

/*Verifica login e livello autorizzazione */
$loggedIn   = isset($_SESSION['username']);
$authorized = false;
if ($loggedIn) {
    $ruoloId   = intval($_SESSION['ruoloId']);
    $authorized = $ruoloId <= MINIMUM_REQUIRED_AUTHORIZATION_LEVEL;
}

/*Pagine amministrative*/
$page = $_GET['page'] ?? 'home';
if ($page === 'mysqlInfinity' && $loggedIn && $authorized) {
    header('Location: https://php-myadmin.net/db_structure.php?db=if0_38885359_luigi_tanzillo');
    exit;
}
if ($page === 'mysqlLocal' && $loggedIn && $authorized) {
    header('Location: http://localhost/phpmyadmin/');
    exit;
}
if ($page === 'phpInfo' && $loggedIn && $authorized) {
    header('Location: pages/phpInfo.php');
    exit;
}
if ($page === 'debug' && $loggedIn && $authorized) {
    header('Location: php/debug.php');
    exit;
}
if ($page === 'dashboard' && $loggedIn && $authorized) {
    header('Location: php/views/dashboard.php');
    exit;
}

/*Altre pagine*/
if ($page === 'modifica?profilo' && $loggedIn) {
    header('Location: pages/modifica_profilo.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/colors-purple.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/about.css">
    <link rel="stylesheet" href="assets/css/profile.css">

    <script src="assets/js/script.js"></script>
    <title>Portfolio Tanzillo</title>
</head>

<body>
    <!-- Loading Screen & spinner-->
    <div class="loading-screen">
        <div class="spinner"></div>

    </div>

    <!-- Header -->
    <?php
    if ($page === 'home' || $page === '') {
        include 'includes/header.php';
    } else {
        include 'includes/headerSmall.php';
    }
    ?>

    <!-- Contenuto dinamico Main-->
    <main>
        <?php
        switch ($page) {
            case 'profilo':
                echo '<div id="page-title"><h1>profilo</h1></div>';
                include 'pages/profile.php';
                break;

            case 'about':
                echo '<div id="page-title"><h1>about</h1></div>';
                include 'pages/about.php';
                break;

            case 'progetti':
            case 'eventi':
                include 'pages/projects.php';
                break;

            case 'contatti':
                echo '<div id="page-title"><h1>contatti</h1></div>';
                include 'pages/contacts.php';
                break;

            case 'progetto':
                include 'pages/project_selective.php';
                break;
            /*
                case 'modifica?profilo':
                    include 'pages/modifica_profilo.php';
                    break;
                */
            case 'home':
            default:
                include 'pages/home.php';
                break;
        }
        ?>
    </main>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="https://kit.fontawesome.com/4383a54113.js" crossorigin="anonymous"></script>
</body>

</html>