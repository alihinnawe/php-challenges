<?php
require_once 'autoloader.php';

use Admin\Admin;
use User\User;

$admin = new Admin();
$admin->showRole();
$admin->accessAdminName();

echo "\n";

$user = new User();
$user->showRole();
$user->showUserName();
?>
