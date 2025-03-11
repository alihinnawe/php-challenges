<main>
    <?php
    $pageTitle = "First page";
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $storedHashedPassword = "your hash";
		
        if (password_verify($password, $storedHashedPassword)) {
            echo "<h2>" . htmlspecialchars($pageTitle) . "</h2>";
            header("Location: seiteTwo.php");
			exit();
        } else {
            echo "Invalid username or password.";
			echo '<a href="index.php">Back to login</a>';
        }
    }
    ?>
</main>
