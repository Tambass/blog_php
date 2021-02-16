<?php
require '../vendor/autoload.php';

$router = new AltoRouter();

// Créer une variable de direction pour éviter les répétitions
define('VIEW_PATH', dirname(__DIR__) . '/views');

// Chargement des premières Uroutes
$router->map('GET', '/blog', function () {
    require VIEW_PATH . '/post/index.php';
});
$router->map('GET', '/blog/category', function () {
    require VIEW_PATH . '/category/show.php';
});

// Demander au router si l'url rentrée correspond aux routes
$match = $router->match();
$match['target']();