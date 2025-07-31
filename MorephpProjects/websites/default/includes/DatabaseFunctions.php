<?php
function totalJokes($database) {
    try {
        $stmt = $database->prepare('SELECT COUNT(*) FROM `joke`');
        $stmt->execute();
        $row = $stmt->fetch();
        return $row[0];
    } catch (Exception $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . ' in ' .
                  $e->getFile() . ':' . $e->getLine();
        include __DIR__ . '/../templates/layout.html.php';
        die();
    }
}
