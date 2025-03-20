<?php
require_once 'autoloader.php';

use Admin\Admin;
use User\User as client;

$admin = new Admin();
$admin->showRole();
$admin->accessAdminName();

echo "\n";

$user1 = new client(); // client is an alias for User

// Correctly check if $user1 is a subclass of User
echo is_subclass_of($user1, \User\User::class) ? 'Yes' : 'No';

$user1->showRole();
$user1->showUserName();
?>
