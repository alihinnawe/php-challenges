<?php

require_once __DIR__ . '/inc/all.php';

$route = @(string) ($_GET['route'] ?? 'page');

if ($route === 'page') {
    // var_dump("Hier ist die Startseite ");
    $pagesController = new \App\Controller\PagesController(
        new \App\Pages\PagesRepository()
    );
    $page = @(string) ($_GET['page'] ?? 'index');
    $pagesController->showPage($page);
}
else {
    // var_dump("Hier ist die Fehlerseite (Error 404)");

    $notFoundController = new \App\Controller\NotFoundController();
    $notFoundController->error404();
}