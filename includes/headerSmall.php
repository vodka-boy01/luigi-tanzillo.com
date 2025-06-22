<style>
    nav {
        z-index: 2;
    }
    header {
        padding: 0;
        padding-left: 20px;
        padding-right: 20px;
        background-color: transparent !important;
    }
</style>

<?php 
	//utente loggato?
	$loggedIn = isset($_SESSION['username']);

	//utente autorizzato per l'accesso alla pagina cpanel?
	if($loggedIn){
		$ruoloId = intval($_SESSION['ruoloId']);

		//livello di autorizzazione richiesto
		$authorized = $ruoloId <= MINIMUM_REQUIRED_AUTHORIZATION_LEVEL;	
    }
?>

<header>
    <nav>
        <div id="nav_bar">
            <div id="nav_links">
                <li><a href="index.php" title="Home" class="home-button">Home</a></li>
                <li><a href="index.php?page=about" title="Informazioni">About</a></li>
                <li><a href="index.php?page=progetti" title="I miei Progetti">Progetti</a></li>
                <li><a href="index.php?page=eventi" title="Il mio percorso formativo">Eventi</a></li>
                <li><a href="index.php?page=contatti" title="Contattami">Contatti</a></li>
            </div>

            <div id="nav_login_container">
                <?php if (!$loggedIn): ?>
                    <ul>
                        <li><a class="button primary" href="/pages/login.php" title="Accedi al tuo account">Sign In</a></li>
                        <li><a class="button primary" href="/pages/registrazione.php" title="Registra un nuovo account">Sign Up</a></li>
                    </ul>
                <?php else: ?>
					<div class="dropdown">
						<h1 class="dropdown-button">
							<?php echo htmlspecialchars($_SESSION['ruolo']) . ' ' . htmlspecialchars($_SESSION['nome']); ?>
							<i class="fa fa-arrow-down dropdown-arrow"></i>
						</h1>

						<div class="dropdown-content">
							<a href="index.php?page=profilo" title="Visualizza il tuo profilo"><i class="fas fa-user"></i> Account</a>
							<?php if ($loggedIn && $authorized): ?>
								<a href="index.php?page=phpInfo" title="Info server"><i class="fas fa-info-circle"></i> Php info</a>
								<a href="index.php?page=debug" title="Pagina di debug"><i class="fas fa-info-circle"></i> Debug</a>
								<a href="index.php?page=dashboard" title="Gestisci i contenuti del sito"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
							<?php endif; ?>
							<a href="includes/logout.php" title="Termina sessione">
							<i class="fas fa-sign-out-alt" title="Termina sessione"></i> Logout
							</a>
						</div>
					</div>

                    <a href="index.php?page=profilo" id="login-icon" class="fa-solid fa-circle-user" title="Visualizza il tuo profilo"></a>
                <?php endif; ?>
            </div>

            <div id="circle-icon" class="container-colorChange" onclick="colorChange()">
                <i id="light" class="fa-regular fa-sun" title="Cambia tema pagina"></i>
                <i id="dark" class="fa-regular fa-moon" title="Cambia tema pagina"></i>
            </div>
        </div>
    </nav>
</header>
