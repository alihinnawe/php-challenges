<?php foreach ($products as $product): ?>
	<div>
		<p><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></p>
	</div>
<?php endforeach; ?>  

