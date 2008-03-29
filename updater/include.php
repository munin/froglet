<?php



define('LISTING_LOCATION', 'http://195.149.21.23/botfiles/');

define('GALAXY_LISTING', 'galaxy_listing.txt');
define('GALAXIES_TABLE', 'pa_galaxy');

define('ALLIANCE_LISTING', 'alliance_listing.txt');
define('ALLIANCES_TABLE', 'pa_alliance');

define('PLANET_LISTING', 'planet_listing.txt');
define('PLANETS_TABLE', 'pa_planet');

function updatequery($dataarray, $table, $boc, $bov) {
		
		$query = "UPDATE " . $table . " SET ";
		$i = 0;
		foreach ($dataarray as $key => $value) {
			if (!$i == '0')
			$query .= ",`$key` = '$value'";
			else
			{
				$query .= "`$key` = '$value'";
				$i++;
			}
		}
		$query .= " WHERE `$boc` = '$bov'";
		$result = mysql_query($query) or die("FATAL, MySQL Error " . mysql_error() .'<br/>'.$query);
	   return mysql_affected_rows();
	}
	
	
	function insertquery($dataarray, $table) {
		
		$query = "INSERT INTO ";
		$column = "`$table` (";
		$values = "VALUES (";
		
		foreach ($dataarray as $key => $value) {
			$column .= "`$key`, ";
			$values .= "'$value', ";
		}
		$column = rtrim($column, ", ");
	   	$values = rtrim($values, ", ");
	   	
	   	$query = $query . $column . ") " . $values . ") ";
	   	$result = mysql_query($query) or die("FATAL, MySQL Error " . mysql_error() .'<br/>'.$query);
	   return mysql_affected_rows();
	}
?>
