<?php

set_time_limit(0);
ignore_user_abort(true);

function value_cmp($a, $b)
{
   if ($a[8] == $b[8]) {
       return 0;
   }
   return ($a[8] < $b[8]) ? 1 : -1;
}
function xp_cmp($a, $b)
{
   if ($a[9] == $b[9]) {
       return 0;
   }
   return ($a[9] < $b[9]) ? 1 : -1;
}
function score_cmp($a, $b)
{
   if ($a[7] == $b[7]) {
       return 0;
   }
   return ($a[7] < $b[7]) ? 1 : -1;
}
function size_cmp($a, $b)
{
   if ($a[6] == $b[6]) {
       return 0;
   }
   return ($a[6] < $b[6]) ? 1 : -1;
}

$begin = time();

require_once 'include.php';

$planets = file(LISTING_LOCATION . PLANET_LISTING);

$tick = explode(' ', $planets[3]);
$tick = trim($tick[1]);

for ($i = 7; $i < count($planets) - 1; $i++){
	$planet_data[] = explode("\t", rtrim($planets[$i]));
}

usort($planet_data, "size_cmp");
for ($i = 0; $i < count($planet_data); $i++){
	$planet_data[$i]['size_rank'] = $i+1;	
}
usort($planet_data, "xp_cmp");
for ($i = 0; $i < count($planet_data); $i++){
	$planet_data[$i]['xp_rank'] = $i+1;	
}
usort($planet_data, "value_cmp");
for ($i = 0; $i < count($planet_data); $i++){
	$planet_data[$i]['value_rank'] = $i+1;	
}
usort($planet_data, "score_cmp");
for ($i = 0; $i < count($planet_data); $i++){
	$planet_data[$i]['score_rank'] = $i+1;	
}

$link = mysql_connect('localhost', 'd001d74b', 'oiashdo2') or die('Could not connect: ' . mysql_error());
mysql_select_db('d001d74b') or die('Could not select database');

$insert = 0;
$update = 0;
$write = '';
for ($i = 0; $i < count($planet_data); $i++){

	$planet_name = addslashes(str_replace('"', '', $planet_data[$i][3]));
	$ruler_name = addslashes(str_replace('"', '', $planet_data[$i][4]));

	$dataarray = array(
	"x" 			=> 	$planet_data[$i][0],
	"y" 			=>	$planet_data[$i][1],
	"z" 			=>	$planet_data[$i][2],
	"ruler_name"		=>	$ruler_name,
	"planet_name"		=>	$planet_name,
	"race" 			=>	$planet_data[$i][5],
	"size" 			=>	$planet_data[$i][6],
	"score" 		=>	$planet_data[$i][7],
	"value" 		=>	$planet_data[$i][8],
	"xp" 			=>	$planet_data[$i][9],
	"tick"			=>	$tick,
	"size_rank" 		=> 	$planet_data[$i]['size_rank'],
	"value_rank"		=>	$planet_data[$i]['value_rank'],
	"score_rank"		=>	$planet_data[$i]['score_rank'],	
	"xp_rank"		=>	$planet_data[$i]['xp_rank']
	);
	
	insertquery($dataarray, PLANETS_TABLE);
	$insert++;
}

mysql_query("UPDATE pa_tick SET planet_tick = $tick");

echo "$i entries in pa dump\n";
echo "$insert rows inserted\n";

mysql_close($link);

$end = time();
$diff = $end - $begin;
echo 'time: ' . $diff . '\n';
?>
