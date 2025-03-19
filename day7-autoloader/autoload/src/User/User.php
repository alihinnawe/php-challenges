<?php
namespace User;

use Admin\Admin;

class User extends Admin {
    public $userName = "Hinnawe";
    public $role = "User";  

    public function showUserName() {
        echo "User Name: $this->userName\n";
    }

    public function showRole() {
        echo "Role: $this->role\n"; 
    }
}
?>
