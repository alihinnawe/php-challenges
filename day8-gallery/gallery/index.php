<?php

require_once __DIR__ . '/inc/all.php'; 

$repository = new GalleryImageRepository($pdo);
$images = $repository->fetchAll();

// Correct path to index.view.php
$viewPath = __DIR__ . '/views/index.view.php';

if (!file_exists($viewPath)) {
    die("Error: View file not found at $viewPath");
}

require_once $viewPath;
