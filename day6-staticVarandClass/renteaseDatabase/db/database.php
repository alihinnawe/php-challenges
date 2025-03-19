<?php
 $datensaetze = [];
global $db;
	try {
		$db = new PDO(
        "mysql:dbname=renteasetest;host=localhost;charset=utf8",
        "renteasetest",
        "root"
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $sql = "SELECT * FROM categories";
    $statement = $db->query($sql);
    $datensaetze = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Fehler: ' . htmlspecialchars($e->getMessage());
    exit();
}

	function fetch_posts()
	{
		global $db;
		$sql = "SELECT * FROM categories; ";
		$statement = $db->query($sql);
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
	

function fetch_insert_posts($name, $description)
{
    global $db;

    // Prepare the SQL query to insert a new category
    $sql = "INSERT INTO categories (name, description) VALUES (:name, :description)";
    
    // Bind the parameters
    $params = [
        ":name" => $name,
        ":description" => $description
    ];
    
    // Prepare and execute the query
    $statement = $db->prepare($sql);
    return $statement->execute($params);
}


?>
