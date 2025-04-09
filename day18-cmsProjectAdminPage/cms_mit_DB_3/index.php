<?php

require_once __DIR__ . '/inc/all.php';
	/* pdo container */

$container = new \App\Support\Container();

$container->add('pdo',function(){
		return require __DIR__ . '/inc/db-connect.inc.php';
	});
	/* pages Repository */
$container->add('pagesRepository', function() use($container){
		return new \App\Pages\PagesRepository($container->get('pdo'));
	});
$container->add('pagesController', function() use($container){
		return new \App\Controller\PagesController($container->get('pagesRepository'));
	});
$container->add('notFoundController', function() use($container){
		return new \App\Controller\NotFoundController($container->get('pagesRepository'));
	});
	
	/* var_dump($container->get('pagesRepository'));
	die(); */

$route = @(string) ($_GET['route'] ?? 'page');

if ($route === 'page') {
	/* PagesController container  */
    $pagesController = $container->get('pagesController');
    $page = @(string) ($_GET['page'] ?? 'index');
    $pagesController->showPage($page);
} else {
	/* notFoundController container  */
    $notFoundController = $container->get('notFoundController');
    $notFoundController->error404();
} 