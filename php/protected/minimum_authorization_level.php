<?php
    //definisce il livello minimo di autorizzazione per l'accesso alle pagine di amministrazione e il cpanel
    define('MINIMUM_REQUIRED_AUTHORIZATION_LEVEL', 1);
    define('GUEST_AUTHORIZATION_LEVEL', 5);
    
    define('USER_AUTHORIZATION_LEVEL', 4);
    define('USER_AUTHORIZATION_LEVEL_NAME', "utente");
    
    define('PAGE_START_LEVEL', 10);
    define('ABOUT_PAGE', 10);

    //altro 
    define('USERNAME_MINIMUM_LENGHT', 3);
    //config php server
    /*
    upload_max_filesize = 70M
    post_max_size = 80M
    memory_limit = 128M
    max_execution_time = 300
    max_input_time = 300
    */
?>
