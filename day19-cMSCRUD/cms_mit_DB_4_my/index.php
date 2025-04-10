<?php

require_once __DIR__ . '/inc/all.php';

$container = new \App\Support\Container();
$container->add('pdo', function() {
    return require __DIR__ . '/inc/db-connect.inc.php';
});

$container->add('pagesRepository', function() use($container) {
    return new \App\Pages\PagesRepository($container->get('pdo'));
});
$container->add('pagesController', function() use($container) {
    return new \App\Controller\PagesController(
        $container->get('pagesRepository')
    );
});
$container->add('pagesAdminController', function() use($container) {
    return new \App\Controller\Admin\PagesAdminController(
        $container->get('pagesRepository')
    );
});
$container->add('notFoundController', function() use($container) {
    return new \App\Controller\NotFoundController(
        $container->get('pagesRepository')
    );
});

// 🆕 Add ProductsAdminController
$container->add('productsAdminController', function() use($container) {
    return new \App\Controller\Admin\ProductsAdminController(
        $container->get('pdo')
    );
});

$route = @(string) ($_GET['route'] ?? 'page');

if ($route === 'page') {
    $pagesController = $container->get('pagesController');
    $page = @(string) ($_GET['page'] ?? 'index');
    $pagesController->showPage($page);
}
else if ($route === 'admin/page') {
    $pagesAdminController = $container->get('pagesAdminController');
    $pagesAdminController->index();
}
else if ($route === 'admin/page/create') {
    $pagesAdminController = $container->get('pagesAdminController');
    $pagesAdminController->create();
}
else if ($route === 'admin/page/delete') {
    $pagesAdminController = $container->get('pagesAdminController');
    $id = @(int) ($_POST['id'] ?? 0);
    $pagesAdminController->delete($id);
}
else if ($route === 'admin/page/edit') {
    $pagesAdminController = $container->get('pagesAdminController');
    $id = @(int) ($_GET['id'] ?? 0);
    $pagesAdminController->edit($id);
}

// 🆕 Product Admin Routes
else if ($route === 'admin/product') {
    $productsAdminController = $container->get('productsAdminController');
    $productsAdminController->index();
}
else if ($route === 'admin/product/create') {
    $productsAdminController = $container->get('productsAdminController');
    $productsAdminController->create();
}
else if ($route === 'admin/product/edit') {
    $productsAdminController = $container->get('productsAdminController');
    $id = @(int) ($_GET['id'] ?? 0);
    $productsAdminController->edit($id);
}
else if ($route === 'admin/product/delete') {
    $productsAdminController = $container->get('productsAdminController');
    $id = @(int) ($_GET['id'] ?? 0);
    $productsAdminController->delete($id);
}

else {
    $notFoundController = $container->get('notFoundController');
    $notFoundController->error404();
}
