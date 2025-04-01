<?php if(empty($weather)):?>
	<h2>Der Wert konnte nicht angefragt werden.</h2>
<?php else:?>
	<h2>Temperatur ist: <?php e($weather->temperature); ?>°C</h2>
<?php endif; ?>