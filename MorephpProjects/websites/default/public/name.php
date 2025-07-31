<?php
$name = $_GET['name'];
echo 'welcome to my Website ' .  htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '!';
?>

