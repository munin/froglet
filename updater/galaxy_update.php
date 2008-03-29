<?php

set_time_limit(0);
ignore_user_abort(true);

function value_cmp($a, $b)
{
   if ($a[5] == $b[5]) {
       return 0;
   }
   return ($a[5] < $b[5]) ? 1 : -1;
}
function xp_cmp($a, $b)
{
   if ($a[6] == $b[6]) {
       return 0;
   }
   return ($a[6] < $b[6]) ? 1 : -1;
}
function score_cmp($a, $b)
{
   if ($a[4] == $b[4]) {
       return 0;
   }
   return ($a[4] < $b[4]) ? 1 : -1;
}
function size_cmp($a, $b)
{
   if ($a[3] == $b[3]) {
       return 0;
   }
   return ($a[3] < $b[3]) ? 1 : -1;
}

$begin = time();

require_once 'include.php';

$galaxies = file(LISTING_LOCATION . GALAXY_LISTING);

$tick = explode(' ', $galaxies[3]);
$tick = trim($tick[1]);

for ($i = 7; $i < count($galaxies) - 1; $i++){
	$galaxy_data[] = explode("\t", rtrim($galaxies[$i]));
}

usort($galaxy_data, "size_cmp");
for ($i = 0; $i < count($galaxy_data); $i++){
	$galaxy_data[$i]['size_rank'] = $i+1;	
}
usort($galaxy_data, "xp_cmp");
for ($i = 0; $i < count($galaxy_data); $i++){
	$galaxy_data[$i]['xp_rank'] = $i+1;	
}
usort($galaxy_data, "score_cmp");
for ($i = 0; $i < count($galaxy_data); $i++){
	$galaxy_data[$i]['score_rank'] = $i+1;	
}
usort($galaxy_data, "value_cmp");
for ($i = 0; $i < count($galaxy_data); $i++){
	$galaxy_data[$i]['value_rank'] = $i+1;	
}

$link = mysql_connect('localhost', 'd001d74b', 'oiashdo2') or die('Could not connect: ' . mysql_error());
mysql_select_db('d001d74b') or die('Could not select database');

$insert = 0;
$update = 0;
$write = '';
for ($i = 0; $i < count($galaxy_data); $i++){

	$name = addslashes(
	str_replace('"', '', $galaxy_data[$i][2])
	);
	
	$dataarray = array(
	"x" 			=> 	$galaxy_data[$i][0],
	"y" 			=>	$galaxy_data[$i][1],
	"name" 			=>	$name,
	"size" 			=>	$galaxy_data[$i][3],
	"score" 		=>	$galaxy_data[$i][4],
	"value" 		=>	$galaxy_data[$i][5],
	"xp" 			=>	$galaxy_data[$i][6],
	"tick"			=>	$tick,
	"size_rank" 			=> 	$galaxy_data[$i]['size_rank'],
	"value_rank"			=>	$galaxy_data[$i]['value_rank'],
	"score_rank"			=>	$galaxy_data[$i]['score_rank'],	
	"xp_rank"				=>	$galaxy_data[$i]['xp_rank']
	);
	
	insertquery($dataarray, GALAXIES_TABLE);
	$insert++;

}

mysql_query("UPDATE pa_tick SET galaxy_tick = $tick");

echo "$i entries in pa dump\n";
echo "$insert rows inserted\n";

mysql_close();

/*$handle = fopen('dumps/' . $tick . '_' . GALAXY_LISTING, "w+");
foreach ($galaxies as $line){
	$data .= $line;
}
fwrite($handle, $data);
fclose($handle);*/

$end = time();
$diff = $end - $begin;
echo 'time: ' . $diff . '\n';
?>