<?php
  $conn = (new database())->connect();
  $userOperations = new user($conn);
  $operations = new operations($conn);

  if(!isset($_SESSION['username'])){
    header("Location: pages/login.php");
  }

  $userInfo = $userOperations->getUserInfo($_SESSION['username']);
  $date_creation = new DateTime($userInfo['data_creazione']);
  $date_login = new DateTime($userInfo['latest_login']);


  $action = $_POST['action'] ?? '';

  if($action === "modifica"){
    header("Location: index.php?page=modifica?profilo");

  }else if($action === "sicurezza"){

  }else if($action === "impostazioni"){

  }if ($action === "elimina") {
    print_r($_SESSION);
    echo '<script>
        if (confirm("Sei sicuro di eliminare definitivamente il profilo? Ogni informazione, file, contenuto esclusivo verrà cancellato definitivamente. Questa azione è irreversibile.")) {
          window.location.href = "?action=conferma_elimina";
        } else {
          window.location.href = "index.php?page=profilo";
        }
    </script>';
  }

  if ($action === "conferma_elimina" && isset($_SESSION['username'])) {
    $userOperations->deleteUser($_SESSION['username']);
    session_destroy();
    header("Location: pages/home.php");
    exit();
  }

?>

<section class="profile-section">
  <!-- Profile Header -->
  <div class="profile-header">
    <div class="profile-avatar">
      <i class="fas fa-user"></i>
    </div>
    <div class="profile-info">
      <h2><?= htmlspecialchars($userInfo['name'] . ' ' . $userInfo['surname']) ?></h2>
      <p class="profile-username">@<?= htmlspecialchars($userInfo['username']) ?></p>
      <div class="profile-badge">
        <div class="status-dot"></div>
        <?= htmlspecialchars($userOperations->getUserRole($userInfo['username'])) ?>
      </div>
    </div>
  </div>

  <!-- Profile Cards -->
  <div class="profile-cards">
    <!-- Personal Info Card -->
    <div class="profile-card">
      <div class="card-header">
        <div class="card-icon blue">
          <i class="fas fa-id-card"></i>
        </div>
        <h3 class="card-title">Informazioni Personali</h3>
      </div>
      <div class="card-content">
        <div class="info-item">
          <span class="info-label">Nome</span>
          <p class="info-value"><?= htmlspecialchars($userInfo['name']) ?></p>
        </div>

        <div class="info-item">
          <span class="info-label">Cognome</span>
          <p class="info-value"><?= htmlspecialchars($userInfo['surname']) ?></p>
        </div>

        <div class="info-item">
          <span class="info-label">Username</span>
          <p class="info-value"><?= htmlspecialchars($userInfo['username']) ?></p>
        </div>

      </div>
    </div>

    <!-- Contact Info Card -->
    <div class="profile-card">
      <div class="card-header">
        <div class="card-icon green">
          <i class="fas fa-envelope"></i>
        </div>

        <h3 class="card-title">Contatti</h3>
      </div>
      <div class="card-content">
        <div class="info-item">
          <span class="info-label">Email</span>
          <p class="info-value"><?= htmlspecialchars($userInfo['email']) ?></p>
        </div>

        <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">

          <button class="edit-button" type="submit" name="action" value="modifica">
            <i class="fas fa-edit"></i> Modifica Email
          </button>
        </form>
      </div>
    </div>

    <!-- Account Info Card -->
    <div class="profile-card">
      <div class="card-header">
        <div class="card-icon purple">
          <i class="fas fa-cog"></i>
        </div>

        <h3 class="card-title">Account</h3>
      </div>
      <div class="card-content">
        <div class="info-item">
          <span class="info-label">Livello autorizzazione account</span>
          <div class="role-value">
            <div class="role-dot"></div>
            <p class="info-value"><?= htmlspecialchars($userOperations->getUserRole($userInfo['username'])) ?></p>
          </div>

        </div>

        <div class="info-item">
          <span class="info-label">Ultimo Login</span>
          <p class="info-value">
            <?php 
              echo htmlspecialchars($date_login->format('d/m/Y'));
            ?>
            Ore: <?php echo htmlspecialchars($date_login->format('H:i'));?>
            </p>
        </div>

        <div class="info-item">
          <span class="info-label">Data Creazione account</span>
          <p class="info-value">
            <?php 
              echo htmlspecialchars($date_creation->format('d/m/Y'));
            ?>
            Ore: <?php echo htmlspecialchars($date_creation->format('H:i'));?>

          </p>
        </div>

      </div>
    </div>
  </div>

  <!-- Action Buttons -->
  <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
    <div class="action-buttons">
      <button class="action-btn blue"  type="submit" name="action" value="modifica">
        <i class="fas fa-edit"></i>Modifica Profilo
      </button>

      <button class="action-btn green" type="submit" name="action" value="sicurezza">
        <i class="fas fa-shield-alt"></i>Sicurezza
      </button>

      <button class="action-btn gray"  type="submit" name="action" value="impostazioni">
        <i class="fas fa-cog"></i>Impostazioni
      </button>

      <button class="action-btn red"   type="submit" name="action" value="elimina">
        <i class="fas fa-user-slash"></i>Elimina account
      </button>

    </div>
  </form>
</section>