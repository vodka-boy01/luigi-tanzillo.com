<?php
/*Classi */
require_once __DIR__ . '/../php/protected/minimum_authorization_level.php';
require_once __DIR__ . '/../php/query/database.php';
require_once __DIR__ . '/../php/query/operations.php';
require_once __DIR__ . '/../php/query/project.php';
require_once __DIR__ . '/../php/query/user.php';

session_start();
$conn = (new database())->connect();
$userOperations = new user($conn);

if(!isset($_SESSION['username'])){
    header("Location: pages/login.php");
    exit();
}


$userInfo = $userOperations->getUserInfo($_SESSION['username']);
$message = '';
$messageType = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'];
    $errors = [];

    if(empty($currentPassword)) {
        $errors[] = "La password attuale è obbligatoria";
        
    }elseif(!$userOperations->verifyPassword($_SESSION['username'], $currentPassword)) {
        $errors[] = "Password attuale non corretta";

    }

    if(empty($errors)) {
        $fieldsToUpdate = [];
        $changedFields = [];

        $fields = ['name', 'surname', 'username', 'email'];
        foreach($fields as $field) {
            if (isset($_POST[$field]) && !empty(trim($_POST[$field]))) {
                $newValue = trim($_POST[$field]);

                if ($field === 'username' && strlen($newValue) < 3) {
                    $errors[] = "L'username deve essere di almeno 3 caratteri";
                    continue;
                }
                if ($field === 'email' && !filter_var($newValue, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Formato email non valido";
                    continue;
                }

                if ($newValue !== $userInfo[$field]) {
                    if ($field === 'username' && $userOperations->existsInField('username', $newValue)) {
                        $errors[] = "Username già in uso";
                        continue;
                    }
                    if ($field === 'email' && $userOperations->existsInField('email', $newValue)) {
                        $errors[] = "Email già in uso";
                        continue;
                    }

                    $fieldsToUpdate[] = "$field = '$newValue'";
                    $changedFields[] = ucfirst($field);
                }
            }
        }

        if(!empty($errors)) {
            $message = implode("<br>", $errors);
            $messageType = "error";

        }elseif(empty($fieldsToUpdate)) {
            $message = "Nessuna modifica da salvare";
            $messageType = "info";

        }else{
            if($userOperations->updateSpecificFields($_SESSION['username'], $fieldsToUpdate)) {
                if (isset($_POST['username']) && $_POST['username'] !== $_SESSION['username']) {
                    $_SESSION['username'] = trim($_POST['username']);

                }if (isset($_POST['name']) && trim($_POST['name']) !== $userInfo['name']) {
                    $_SESSION['nome'] = trim($_POST['name']);
                    
                }
                $userInfo = $userOperations->getUserInfo($_SESSION['username']);
                $message = "Aggiornato: " . implode(", ", $changedFields);
                $messageType = "success";
            } else {
                $message = "Errore durante l'aggiornamento";
                $messageType = "error";
            }
        }
    }else{
        $message = implode("<br>", $errors);
        $messageType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Modifica Profilo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="/../assets/css/profile_modify.css"/>
    <link rel="stylesheet" href="/../assets/css/colors-purple.css"/>
</head>
<body>

<section class="edit-profile-section">
    <div class="page-header">
        <a href="../index.php?page=profilo" class="back-button" title="Torna al profilo">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="page-title">Modifica Profilo</h1>
    </div>

    <!--errori-->
    <?php if ($message): ?>
        <div class="message <?= $messageType ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="" id="editForm">
        <div class="form-grid">
            <?php 
            $fields = [
                'name' => 'Nome',
                'surname' => 'Cognome', 
                'username' => 'Username',
                'email' => 'Email'
            ];
            foreach ($fields as $field => $label): ?>
                <div class="form-group">
                    <label class="form-label" for="<?= $field ?>"><?= $label ?></label>
                    <input type="<?= $field === 'email' ? 'email' : 'text' ?>" id="<?= $field ?>" name="<?= $field ?>" class="form-input" value="<?= htmlspecialchars($userInfo[$field]) ?>" placeholder="<?= htmlspecialchars($userInfo[$field]) ?>">
                </div>
            <?php endforeach; ?>
        </div>

        <div class="password-section">
            <h3><i class="fas fa-lock"></i> Conferma Modifiche</h3>
            <div class="password-note">
                <i class="fas fa-info-circle"></i>
                Per sicurezza, inserisci la tua password attuale per confermare le modifiche.
            </div>
            <div class="form-group">
                <label class="form-label" for="current_password">Password</label>
                <input type="password" id="current_password" name="current_password" class="form-input" placeholder="Inserisci la tua password "required>
            </div>
        </div>

        <div class="form-actions">
            <a href="../index.php?page=profilo" class="btn btn-secondary">
                <i class="fas fa-times"></i> Annulla
            </a>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Salva Modifiche
            </button>

        </div>
    </form>
</section>

<script>
let changed = false;
document.getElementById('editForm').addEventListener('input', () => changed = true);
document.getElementById('editForm').addEventListener('submit', () => changed = false);
window.addEventListener('beforeunload', (e) => {
    if (changed) {
        e.preventDefault();
        e.returnValue = '';
    }
});
</script>

</body>
</html>
