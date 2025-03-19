<?php
require_once 'autoloader.php';

use Admin\Admin;
use Admin\Role;
use User\User;

$admin = new Admin();
$admin->showRole();
$admin->accessAdminName();

echo "\n";

$role = new Role();
$role->showRole();

echo "\n";

$user = new User();
$user->showRole();
$user->showUserName();
?>
