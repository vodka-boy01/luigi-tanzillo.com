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
    $currentPassword = $_POST['current_password'] ?? '';
    $errors = [];

    if(empty($currentPassword) && $_SESSION['google_login'] === 0) {
        $errors[] = "La password è obbligatoria per apportare le modifiche";
        
    }elseif(!$userOperations->verifyPassword($_SESSION['username'], $currentPassword)) {
        $errors[] = "Password inserita incorretta";
    }

    if(empty($errors)) {
        $fieldsToUpdate = [];
        $changedFields = [];
        $avatarPath = null;

        // Gestione upload avatar
        if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $avatarUpload = $_FILES['avatar'];
            
            // Validazione file
            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            $maxSize = 2 * 1024 * 1024; // 2MB
            
            if(!in_array($avatarUpload['type'], $allowedTypes)) {
                $errors[] = "Formato avatar non supportato. Usa JPG, JPEG, PNG, GIF o WEBP";
            }
            
            if($avatarUpload['size'] > $maxSize) {
                $errors[] = "L'avatar non può superare i 2MB";
            }
            
            if(empty($errors)) {
                // Crea directory se non esiste
                $uploadDir = __DIR__ . '/../assets/uploads/avatars/';
                if(!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                // Genera nome file unico
                $extension = pathinfo($avatarUpload['name'], PATHINFO_EXTENSION);
                $filename = $_SESSION['username'] . '_' . time() . '.' . $extension;
                $uploadPath = $uploadDir . $filename;
                $dbPath = 'assets/uploads/avatars/' . $filename;
                
                if(move_uploaded_file($avatarUpload['tmp_name'], $uploadPath)) {
                    $avatarPath = $dbPath;
                    $changedFields[] = 'Avatar';
                } else {
                    $errors[] = "Errore durante il caricamento dell'avatar";
                }
            }
        }

        // Gestione altri campi
        $fields = ['name', 'surname', 'username', 'email'];
        foreach($fields as $field) {
            if (isset($_POST[$field]) && !empty(trim($_POST[$field]))) {
                $newValue = trim($_POST[$field]);

                if ($field === 'username' && strlen($newValue) < USERNAME_MINIMUM_LENGHT) {
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

        }elseif(empty($fieldsToUpdate) && $avatarPath === null) {
            $message = "Nessuna modifica da salvare";
            $messageType = "info";

        }else{
            // Aggiorna avatar se presente
            if($avatarPath !== null) {
                $fieldsToUpdate[] = "avatar = '$avatarPath'";
            }

            if($userOperations->updateSpecificFields($_SESSION['username'], $fieldsToUpdate, $avatarPath ? $userInfo['avatar'] : null)) {
                if (isset($_POST['username']) && $_POST['username'] !== $_SESSION['username']) {
                    $_SESSION['username'] = trim($_POST['username']);
                }
                if (isset($_POST['name']) && trim($_POST['name']) !== $userInfo['name']) {
                    $_SESSION['nome'] = trim($_POST['name']);
                }
                
                $userInfo = $userOperations->getUserInfo($_SESSION['username']);
                $message = "Aggiornato: " . implode(", ", $changedFields);
                $messageType = "success";
            } else {
                $message = "Errore durante l'aggiornamento";
                $messageType = "error";
                
                // Rimuovi avatar caricato in caso di errore
                if($avatarPath && file_exists(__DIR__ . '/../' . $avatarPath)) {
                    unlink(__DIR__ . '/../' . $avatarPath);
                }
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

    <form method="POST" action="" id="editForm" enctype="multipart/form-data">
        <!-- Sezione Avatar -->
        <div class="avatar-section">
            <div class="current-avatar-container">
                <img src="<?= !empty($userInfo['avatar']) ? '/../' . htmlspecialchars($userInfo['avatar']) : '/../assets/images/default-avatar.png' ?>" alt="Avatar assente" class="current-avatar">
                <div class="avatar-label">Avatar Attuale</div>
            </div>
            
            <div class="avatar-upload-container">
                <div class="upload-title">
                    <i class="fas fa-camera"></i> Modifica Avatar
                </div>
                
                <div class="file-upload-wrapper">
                    <input type="file" id="avatar" name="avatar" class="file-upload-input" accept="image/jpeg,image/jpg,image/png,image/gif,image/webp">

                    <label for="avatar" class="file-upload-button">
                        <i class="fas fa-upload"></i> Seleziona Nuova Immagine
                    </label>
                </div>
                
                <div class="preview-container">
                    <img id="avatarPreviewNew" class="avatar-preview-new" alt="Anteprima nuovo avatar">
                    
                    <span id="previewText" class="preview-text" style="display: none;">
                        <i class="fas fa-eye"></i> Nuovo avatar
                    </span>
                </div>
                
                <div class="avatar-info">
                    <strong>Requisiti:</strong><br>
                    • Formati: JPG, JPEG, PNG, GIF, WEBP<br>
                    • Dimensione massima: 2MB<br>
                    • Risoluzione consigliata: 300x300px
                </div>
            </div>
        </div>

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

        <?php if(isset($_SESSION['google_login']) && $_SESSION['google_login'] === 0):?>
        <div class="password-section">
            <h3><i class="fas fa-lock"></i> Conferma Modifiche</h3>
            <div class="password-note">
                <i class="fas fa-info-circle"></i>
                Per sicurezza, inserisci la tua password attuale per confermare le modifiche.
            </div>
            <div class="form-group">
                <label class="form-label" for="current_password">Password</label>
                <input type="password" id="current_password" name="current_password" class="form-input" placeholder="Inserisci la tua password" required>
            </div>
        </div>
        <?php endif?>

        <div class="form-actions">
            <a href="modifica_profilo.php" class="btn btn-secondary">
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

// preview avatar
document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const previewImg = document.getElementById('avatarPreviewNew');
    const previewText = document.getElementById('previewText');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewImg.style.display = 'block';
            previewText.style.display = 'block';
        }
        reader.readAsDataURL(file);
        changed = true;
    } else {
        previewImg.style.display = 'none';
        previewText.style.display = 'none';
    }
});

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