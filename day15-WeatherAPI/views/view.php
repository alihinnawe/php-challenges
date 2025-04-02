<?php 
	$cityName = 'Budapest';
	if(empty($weather)):?>
	<h2>Der Wert konnte nicht angefragt werden.</h2>
<?php else:?>
	<h2>Temperatur in <?php echo $cityName; ?> ist: <?php echo e($weather->temperature); ?>°C</h2>
<?php endif; ?>