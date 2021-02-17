<?php
require '../vendor/autoload.php';

// Variable de débugage pour le temps de chargement des pages visible dans le footer
define('DEBUG_TIME', microtime(true));

$router = new App\Router(dirname(__DIR__) . '/views');
//Affichage des routes ('URL', 'CHEMIN', 'NOM DE LA PAGE')
$router
    ->get('/blog', 'post/index', 'blog')
    ->get('/blog/category', 'category/show', 'category')
    //Lancer le router
    ->run();