<?php
function render($path, array $data = []){
	// ob_start — Ausgabepufferung aktivieren
	ob_start();
	extract($data);
	require $path;
	// ob_get_contents — Liefert den Inhalt des Ausgabepuffers
	$content = ob_get_contents();
	// ob_end_clean — Löscht den Inhalt des aktiven Ausgabepuffers und deaktiviert ihn
	ob_end_clean();
	
	require __DIR__ . '/../views/layouts/main.view.php';
}

function e($html){
	return htmlspecialchars($html,ENT_QUOTES, 'UTF-8',true);
}