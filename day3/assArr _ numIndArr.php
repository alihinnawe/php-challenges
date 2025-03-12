<?php
	$siteTitle="arrays";
	$pageTitle="mehrdimensionale Arrays";
	include 'inc/header.inc.php';
?>
	<main>
		<h2><?php echo $pageTitle; ?></h2>
		<p>assArr _ numIndArr</p>
		<?php 
		$artikel=array();
		// Artikelname, Preis, Artikelnummer
		// array = [value1, value2, value3, value4]
		// array = [[ValArtNr,ValPreis,ValArtname],[ValArtNr,ValPreis,ValArtname],[ValArtNrValArtname],[ValArtNrValPreis,ValArtname]]
		$artikel[0]['ArtNr']= 206770;
		$artikel[0]['Preis']= 5.79;
		$artikel[0]['Artname']= 'dryWipe Marker green';
		
		$artikel[1]['ArtNr']= 206772;
		$artikel[1]['Preis']= 5.79;
		$artikel[1]['Artname']= 'dryWipe Marker5 black';
		
		$artikel[2]['ArtNr']= 206788;
		$artikel[2]['Preis']= 5.79;
		$artikel[2]['Artname']= 'dryWipe Marker blue';
		
		$artikel[3]['ArtNr']= 206797;
		$artikel[3]['Preis']= 5.79;
		$artikel[3]['Artname']= 'dryWipe Erase Marker red';
		$artikel1 = [ 0 => array('ArtNr' => 206770, 'Preis' => 5.79,'Artname'=> 'dryWipe Marker green'),
		1 => array('ArtNr' => 206772, 'Preis' => 5.79,'Artname'=> 'dryWipe Marker5 black'),
		2 => array('ArtNr' => 206788, 'Preis' => 5.79,'Artname'=> 'dryWipe Marker blue')];
		
		foreach ($artikel1 as $artikel) {
			echo "ArtNr: " . $artikel['ArtNr'] . "\n";
			echo "Preis: " . $artikel['Preis'] . "\n";
			echo "Artname: " . $artikel['Artname'] . "\n";
			echo "\n";

		}
	?>
	</main>
<?php
	include 'inc/footer.inc.php';
?>