<?php
namespace Admin;

class Role {
    public $roleName = "Administrator";

    public function showRole() {
        echo "Role: $this->roleName\n";
    }
}
?>
