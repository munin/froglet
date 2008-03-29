<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.bcalc.php
 * Type:     modifier
 * Name:     growth
 * Purpose:  Calculate growth from last number, format it to
 *           a percentage and create a nice color.
 * -------------------------------------------------------------
 */
function smarty_modifier_bcalc($url, $notes)
{
	if($url <> "")
		$ret = '<a href="' . $url . '" target="_blank" title="' . $notes . '">bcalc/notes</a>';
	else
		$ret = '';
		
	return $ret;
}
?> 