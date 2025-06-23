<style>
	nav {
		z-index: 2;
	}
</style>

<?php
//utente loggato?
$conn = (new database())->connect();
$loggedIn = isset($_SESSION['username']);
$userOperations = new user($conn);

//utente autorizzato per l'accesso alla pagina cpanel?
if ($loggedIn) {
	$ruoloId = intval($_SESSION['ruoloId']);

	//livello di autorizzazione richiesto
	$authorized = $ruoloId <= MINIMUM_REQUIRED_AUTHORIZATION_LEVEL;

	//prendi i dati dell'utente
	$userInfo = $userOperations->getUserInfo($_SESSION['username']);
}
?>

<header>
	<nav>
		<div id="title_login">
			<div id="nav_title_container">
				<h1 id="nav_title">Web Portfolio Tanzillo</h1>
			</div>

			<div id="nav_login_container">
				<?php if (!$loggedIn): ?>
					<!-- Bottoni login e registrazione per utenti non autenticati -->
					<ul>
						<li><a class="button primary" href="/pages/login.php" title="Accedi al tuo account">Sign In</a></li>
						<li><a class="button primary" href="/pages/registrazione.php" title="Registra un nuovo account">Sign Up</a></li>
					</ul>
				<?php else: ?>
					<!-- Menu dropdown per utenti autenticati -->
					<div class="dropdown">
						<h1 class="dropdown-button">
							<?php echo htmlspecialchars($_SESSION['ruolo']) . ' ' . htmlspecialchars($_SESSION['nome']); ?>
							<i class="fa-solid fa-angle-down dropdown-arrow"></i>
						</h1>

						<div class="dropdown-content">
							<a href="index.php?page=profilo" title="Visualizza il tuo profilo">
								<i class="fas fa-user"></i> Account
							</a>
							<?php if ($authorized): ?>
								<a href="index.php?page=phpInfo" title="Info server">
									<i class="fas fa-info-circle"></i> Php info
								</a>
								<a href="index.php?page=debug" title="Pagina di debug">
									<i class="fas fa-bug"></i> Debug
								</a>
								<a href="index.php?page=firebase" title="Gestisci i contenuti del sito">
									<i class="fas fa-fire"></i> Firebase
								</a>
								<a href="index.php?page=dashboard" title="Gestisci i contenuti del sito">
									<i class="fas fa-tachometer-alt"></i> Dashboard
								</a>
							<?php endif; ?>
							<a href="includes/logout.php" title="Termina sessione">
								<i class="fas fa-sign-out-alt"></i> Logout
							</a>
						</div>
					</div>
				<?php endif; ?>

				<!-- Avatar: solo se l'utente è autenticato -->
				<?php if ($loggedIn): ?>
					<div class="profile-avatar" style="width: 40px; height: 40px;">
						<?php if($userInfo['avatar'] === null): ?>
							<i class="fas fa-user"></i>
						<?php else: ?>
                            <a href="index.php?page=profilo" style="cursor: pointer" title="Visualizza il tuo profilo">
							    <img src="<?php echo $userInfo['avatar']; ?>" alt="img">
                            </a>
						<?php endif ?>
					</div>
				<?php endif; ?>
			</div>

			<div id="circle-icon" class="container-colorChange" onclick="colorChange()">
				<i id="light" class="fa-regular fa-sun" title="Cambia tema pagina"></i>
				<i id="dark" class="fa-regular fa-moon" title="Cambia tema pagina"></i>
			</div>
		</div>

		<hr>

		<div id="nav_bar">
			<div id="nav_links">
				<li><a href="index.php" title="home" class="home-button">Home</a></li>
				<li><a href="index.php?page=about" title=title="Informazioni">About</a></li>
				<li><a href="index.php?page=progetti" title="I miei Progetti">Progetti</a></li>
				<li><a href="index.php?page=eventi" title="Il mio percorso formativo">Eventi</a></li>
				<li><a href="index.php?page=" title="Contattami">Contatti</a></li>
			</div>
			<div id="nav_searchBar_container">
				<!--<label for="search-bar-title"></label>!-->
				<input type="search" id="search-input" name="q" value="Ricerca" spellcheck="false">
				<button type="reset" id="reset-button" name="q" onclick="clearSearch()" title="Cancella la ricerca"><i class="fa-solid fa-xmark"></i></button>
				<button type="search" id="submit-button" name="q" title="Cerca"><i class="fa-solid fa-magnifying-glass"></i></button>
			</div>
		</div>
	</nav>
</header>