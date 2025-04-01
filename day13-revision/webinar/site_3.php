<?php
	$siteTitle = 'Namensraum';
	include 'inc/header.inc.php';
	include 'inc/namespace_1.php';
	use myNS\Begruessung;
	
	/* 	
	myNS\hello(myNS\name); 
	use myNS as n;
	n\hello(n\name); 
	use function myNS\helloWorld();*/
	
	
	
?>
<main>
	<?php
	echo "<h2>Includieren 'namespace_1'</h2>";
		$object = new Begruessung("Marta Mustermann");
		$object->helloWorld();
	?>
	<?php
		echo "<h2>Includieren 'autoload psr-4'</h2>";
		use App\Admin\User;
		use App\Admin\Role;
		use App\User\User as client;
		
		require_once __DIR__ . '/inc/autoload_psr4.php';
		
		$objNewUser = new User();
		$object = new Role();
		$objectUser = new client();
		$objNewUser ->methodNamespace();
		$object->writeString();
		$objectUser->methodNamespace();
	?>
</main>
	
<?php
	include 'inc/footer.inc.php';
?>