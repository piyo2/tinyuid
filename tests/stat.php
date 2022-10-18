<?php

use piyo2\util\tinyuid\TinyUID;

require __DIR__ . '/../vendor/autoload.php';

$length = 14;
$N = 100000;

$base = 62;
$lineWidth = 76;

$bucket = [];
foreach (range(1, $N) as $i) {
	$uid = TinyUID::generate($length);
	for ($i = 0; $i < strlen($uid); $i++) {
		if (!isset($bucket[$uid[$i]])) $bucket[$uid[$i]] = 0;
		$bucket[$uid[$i]]++;
	}
}

ksort($bucket, SORT_STRING);

foreach ($bucket as $char => $frequency) {
	echo $char, ' ', str_repeat('*', round($lineWidth * $frequency / $N / $length * $base)), PHP_EOL;
}
