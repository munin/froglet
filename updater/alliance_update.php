<?php

set_time_limit(0);
ignore_user_abort(true);

function size_cmp($a, $b)
{
   if ($a[2] == $b[2]) {
       return 0;
   }
   return ($a[2] < $b[2]) ? 1 : -1;
}
function members_cmp($a, $b)
{
   if ($a[3] == $b[3]) {
       return 0;
   }
   return ($a[3] < $b[3]) ? 1 : -1;
}
function avg_score_cmp($a, $b)
{
   if ($a[4] / $a[3] == $b[4] / $b[3]) {
       return 0;
   }
   return ($a[4] / $a[3] < $b[4] / $b[3]) ? 1 : -1;
}
function avg_size_cmp($a, $b)
{
   if ($a[2] / $a[3] == $b[2] / $b[3]) {
       return 0;
   }
   return ($a[2] / $a[3] < $b[2] / $b[3]) ? 1 : -1;
}
$begin = time();

require_once 'include.php';

$alliances = file(LISTING_LOCATION . ALLIANCE_LISTING);

$tick = explode(' ', $alliances[3]);
$tick = $tick[1];

for ($i = 7; $i < count($alliances) - 1; $i++){
	$alliance_data[] = explode("\t", rtrim($alliances[$i]));
}
usort($alliance_data, "size_cmp");
for ($i = 0; $i < count($alliance_data); $i++){
	$alliance_data[$i]['size_rank'] = $i+1;	
}
usort($alliance_data, "members_cmp");
for ($i = 0; $i < count($alliance_data); $i++){
	$alliance_data[$i]['members_rank'] = $i+1;	
}
usort($alliance_data, "avg_score_cmp");
for ($i = 0; $i < count($alliance_data); $i++){
	$alliance_data[$i]['avg_score_rank'] = $i+1;	
}
usort($alliance_data, "avg_size_cmp");
for ($i = 0; $i < count($alliance_data); $i++){
	$alliance_data[$i]['avg_size_rank'] = $i+1;	
}

$link = mysql_connect('localhost', 'd001d74b', 'oiashdo2') or die('Could not connect: ' . mysql_error());
mysql_select_db('d001d74b') or die('Could not select database');

$insert = 0;
$update = 0;
$write = '';
for ($i = 0; $i < count($alliance_data); $i++){
	
	$name = addslashes(
	str_replace('"', '', $alliance_data[$i][1])
	);
	
	$dataarray = array(	
	"score_rank"	=>	$alliance_data[$i][0],	
	"name" 			=>	$name,
	"size" 			=>	$alliance_data[$i][2],
	"members" 		=>	$alliance_data[$i][3],
	"score" 		=>	$alliance_data[$i][4],	
	"tick"			=>	$tick,
	"size_rank" 			=> 	$alliance_data[$i]['size_rank'],
	"members_rank" 			=> 	$alliance_data[$i]['members_rank'],
	"avg_score_rank" 			=> 	$alliance_data[$i]['avg_score_rank'],
	"avg_size_rank" 			=> 	$alliance_data[$i]['avg_size_rank']
	);
	
	insertquery($dataarray, ALLIANCES_TABLE);
	$insert++;
}


mysql_query("UPDATE pa_tick SET alliance_tick = $tick");

echo "$i entries in pa dump\n";
echo "$insert rows inserted\n";

mysql_close();

/*$handle = fopen('dumps/' . $tick . '_' . ALLIANCE_LISTING, "w+");
foreach ($alliances as $line){
	$data .= $line;
}
fwrite($handle, $data);
fclose($handle);*/

$end = time();
$diff = $end - $begin;
echo 'time: ' . $diff . '\n';
?>