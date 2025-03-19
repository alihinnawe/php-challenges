<?php

function counter() {
static $count = 0;
$count++;
echo $count . "\n";
}

counter();
counter();
counter();



?>