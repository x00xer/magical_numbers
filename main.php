<?php
/**
 * Created by PhpStorm.
 * User: nnn
 * Date: 22.07.14
 * Time: 14:12
 */

/**
 * @param int $number
 * @return array might looks like this, in case 1234 is passed as $number
 *
 * array(
 *      array(1, 234),
 *      array(12, 34),
 *      array(123, 4),
 * )
 *
 */
function ParseNumber($number)
{
	if((int)$number < 0) $number = abs($number);

	for($i = 1; $i < strlen($number); $i++) {
		yield [substr($number, 0, $i), substr($number, $i)];
	}
}

function SummarizeNumber($number)
{
	$result = 0;

	$result = array_sum(str_split($number));

	return ($result >= 10) ? SummarizeNumber($result) : $result;
}

$start = microtime(true);

$min = 1000;
$max = 9999;

$final = array();

for($i = $min; $i <= $max; $i++) {
	$result = array(); // init

	$number = ParseNumber($i);

	foreach($number as $n) {
		$result[] = SummarizeNumber($n[0] + $n[1]);
	}

	$result[] = SummarizeNumber($i);

	if(count(array_unique($result)) > 1) die("found: ".$i);

	$final[$result[0]] = isset($final[$result[0]]) ? ($final[$result[0]] + 1) : 1;
}

print_r($final);

$time_elapsed_us = microtime(true) - $start;

echo $time_elapsed_us . PHP_EOL;

