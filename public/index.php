<?php
require '../vendor/autoload.php';

// Variable de débugage pour le temps de chargement des pages visible dans le footer
define('DEBUG_TIME', microtime(true));

// Dépendance WHOOPS pour afficher une belle page de débugage
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

if(isset($_GET['page']) && $_GET['page'] === '1') {
    // réécrire l'url sans le paramètre ?page
    $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
    $get = $_GET;
    unset($get['page']);
    $query = http_build_query($get);
    if(!empty($query)) {
        $uri = $uri . '?' . $query;
    }
    http_response_code(301);
    header('Location: ' . $uri);
    exit();
}

$router = new App\Router(dirname(__DIR__) . '/views');
//Affichage des routes ('URL', 'CHEMIN', 'NOM DE LA PAGE')
$router
    ->get('/', 'post/index', 'home')
    ->get('/blog/[*:slug]-[i:id]', 'post/show', 'post')
    ->get('/blog/category', 'category/show', 'category')
    //Lancer le router
    ->run();