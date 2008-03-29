<?php
header ("Content-type: image/png");

require_once('include/config.php');
include('include/planet_data.php');
require('include/database.php');

$db = new Database($config['dbhost'], $config['dbname'], $config['dbuser'], $config['dbpass']);

$data = new PlanetData;
$data->x = $_REQUEST['x'];
$data->y = $_REQUEST['y'];
$data->z = $_REQUEST['z'];
$width = $_REQUEST['width'];
$height = $_REQUEST['height'];

if($width == "")
	$width = 640;
if($height == "")
	$height = 480;

$im = @imagecreatetruecolor($width, $height)
     or die("Cannot Initialize new GD image stream");

$score_color = imagecolorallocate($im, 0, 255, 0);
$size_color = imagecolorallocate($im, 255, 255, 0);
$value_color = imagecolorallocate($im, 0, 255, 255);

$result = $data->selectPlanetHistory();
$max_and_min = $data->maxAndMinValues();

$x1 = 0;
$y1_score = 0;
$y1_size = 0;
$first_tick = $max_and_min["min_tick"];
$last_tick = $max_and_min["max_tick"];
$max_score = $max_and_min["max_score"];
$max_size = $max_and_min["max_size"];

//echo $first_tick . " " . $last_tick . "<br>";

$row = array_shift($result);
$x1 = floor($width * ($row["tick"] - $first_tick) / ($last_tick - $first_tick));
$y1_score = $height - floor($height * $row["score"] / $max_score);
$y1_value = $height - floor($height * $row["value"] / $max_score);
$y1_size = $height - floor($height * $row["size"] / $max_size);

foreach($result as $row)
{
	$x2 = floor($width * ($row["tick"] - $first_tick) / ($last_tick - $first_tick));
	$y2_score = $height - floor($height * $row["score"] / $max_score);
	$y2_value = $height - floor($height * $row["value"] / $max_score);
	$y2_size = $height - floor($height * $row["size"] / $max_size);
//	echo $x1 . " " . $y1_score . " " . $x2 . " " . $y2_score . "<br>";
	imageline($im, $x1, $y1_score, $x2, $y2_score, $score_color);
	imageline($im, $x1, $y1_value, $x2, $y2_value, $value_color);
	imageline($im, $x1, $y1_size, $x2, $y2_size, $size_color);
	$x1 = $x2;
	$y1_score = $y2_score;
	$y1_value = $y2_value;
	$y1_size = $y2_size;
}

imagepng($im);
imagedestroy($im);
?> 