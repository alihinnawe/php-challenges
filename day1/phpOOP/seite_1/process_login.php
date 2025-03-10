<main>
    <?php
    $pageTitle = "First page";
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $storedHashedPassword = "$2y$10$6RiKqYx52cZeS2Xk2UrMg.PX2o8/iF8qto3KTpZlFqzpglyvpI3lm";

        if (password_verify($password, $storedHashedPassword)) {
            // Password is correct, show the HTML content
            echo "<h2>" . htmlspecialchars($pageTitle) . "</h2>";
            echo '<img src="./img/whiteroom.png" alt="White Room">';
            echo '<p>
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.
            </p>';
        } else {
            echo "Invalid username or password.";
			echo '<a href="index.php">Back to login</a>';
        }
    }
    ?>
</main>
