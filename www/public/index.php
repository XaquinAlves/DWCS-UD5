<?php
require '../vendor/autoload.php';
mb_internal_encoding('UTF-8');        
try{
    $dotenv = Dotenv\Dotenv::createImmutable('../');
    $dotenv->load();
    Com\Daw2\Core\FrontController::main();    
} catch (Exception $e) {
    if($_ENV['folder.views']){
        throw $e;
    }
    else{
        echo $e->getMessage();
    }
}
