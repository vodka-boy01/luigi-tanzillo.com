<?php
    $conn = (new database())->connect();
    $userOperations = new user($conn);
    $projectOperations = new project($conn);
    $userRoleId = $_SESSION['ruoloId'] ?? GUEST_AUTHORIZATION_LEVEL;
    $allProjects = $projectOperations->getAllProjectsByRole($userRoleId);


    if($_GET['page'] === 'eventi'){
        $richiesta_visualizzazione = "evento";

    }else if($_GET['page'] === 'progetti'){
        $richiesta_visualizzazione = "progetto";

    }

    $projects = array_filter($allProjects, fn($p) => $p['tipo'] === $richiesta_visualizzazione);
    $conn->close();

    if($richiesta_visualizzazione === "progetto"){
        ?>
            <div id="page-title">
                <h1>Progetti recenti</h1> 
            </div>
        <?php
    }else if($richiesta_visualizzazione === "evento"){
        ?>
            <div id="page-title">
                <h1>Eventi recenti</h1> 
            </div>
        <?php
    }

?>

<section class="image-slider">
    <div class="projects-grid-container" id="projectGrid">
        <?php if (!empty($projects)): ?>
            <?php foreach ($projects as $project): ?>
                <div class="project-grid-card">
                    <div class="project-card">
                        <h1 id="slider-title" class="project-text"><?php echo htmlspecialchars($project['titolo']); ?></h1>

                        <div class="main-project-image-container">
                            <?php
                            $main_image_src = !empty($project['images'][0]['path']) ? htmlspecialchars($project['images'][0]['path']) : 'https://placehold.co/500x300/333/ffffff?text=Immagine+Non+Disponibile';
                            ?>
                            <a href="index.php?page=progetto&id=<?php echo htmlspecialchars($project['id'])?>" title="Apri scheda Progetto">
                                <img src="<?php echo $main_image_src; ?>" alt="<?php echo htmlspecialchars($project['titolo']); ?>" class="project-grid-image">
                            </a>
                        </div>

                        <p id="short-description" class="project-text"><?php echo htmlspecialchars($project['descrizione_breve']); ?></p>
                        
                        <a href="index.php?page=progetto&id=<?php echo htmlspecialchars($project['id'])?>" title="Apri scheda Progetto">
                            <div id="container-link-scheda-progetto">
                                <h3 class="link-scheda-progetto">Apri scheda <?php echo htmlspecialchars($project['tipo'])?></h3>
                                <i class="fa-solid fa-link link-scheda-progetto"></i>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-gray-400">Nessun progetto trovato.</p>
        <?php endif; ?>
    </div>

    <div class="slider-navigation hidden-navigation">
        <button class="nav-button prev-button">❮</button>
        <button class="nav-button next-button">❯</button>
    </div>
</section>