<?php
namespace Admin;

class Admin {
    private $adminName = "Casper";
    public $role = "Administrator";

    public function showRole() {
        echo "Role: $this->role\n";
    }

	private function showAdminName() {
			echo "Admin Name: $this->adminName\n";
		} 

    public function accessAdminName() {
        return $this ->showAdminName();
    }
}
?>
