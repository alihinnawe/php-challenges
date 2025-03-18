<?php
session_start();
session_destroy();
include('parts/header.php');
?>

<h1>My Login Page</h1>
<form action="" method="post">
    <div>
        <label for="Email">Email: </label>
        <input value="ali@example.com" name="Email" type="email" placeholder="Write your Email">
    </div>
    <button type="submit" name="sent">Submit</button>
</form>

<?php
class PageModel {
    public function __isset($email) {
        return isset($_POST['Email']);
    }

    public function __get($property) {
        if ($property === "email" && isset($_POST['sent'])) {
            $email = isset($_POST['Email']) && is_string($_POST['Email']) ? $_POST['Email'] : "";  
            return htmlspecialchars($email);
        }
        return null;
    }
}

$page = new PageModel();
var_dump($page-> __get("email"));
?>

<?php
include('parts/footer.php');
?>
