<?php
function format_sql_string($str)
{
	if($str == null)
		return "null";
	elseif($str == "")
		return "null";
	else
	  return "'" . $str . "'";
}

function format_null($str)
{
	if($str == null)
		return "null";
	else
		return $str;
}
		
?>