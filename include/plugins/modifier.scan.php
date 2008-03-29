<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.scan.php
 * Type:     modifier
 * Name:     growth
 * Purpose:  Calculate growth from last number, format it to
 *           a percentage and create a nice color.
 * -------------------------------------------------------------
 */
function smarty_modifier_scan($id, $type)
{
	if($id > 0)
		$ret = '<a href="scan.php?id=' . $id . '" target="_blank">' . $type . '</a>';
	else
		$ret = '';
		
	return $ret;
}
?> 