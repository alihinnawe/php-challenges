<?php
	$siteTitle = "Weißraum";
	$pageTitle = "white space";
	include 'inc/header.inc.php';
?>

<main>
    <form action="process_login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</main>

<?php 
	include 'inc/footer.inc.php';
?>
