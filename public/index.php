<?php
require '../vendor/autoload.php';

$router = new AltoRouter();

$router = new Router(dirname(__DIR__) . '/views');
//Affichage des routes ('URL', 'CHEMIN', 'NOM DE LA PAGE')
$router->get('/blog', 'post/index', 'blog');
$router->get('/blog/category', 'category/show', 'category');
//Lancer le router
$router->run();