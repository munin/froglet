<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.growth_roid.php
 * Type:     modifier
 * Name:     growth
 * Purpose:  Calculate growth from last number, format it to
 *           a percentage and create a nice color.
 * -------------------------------------------------------------
 */
function smarty_modifier_growth_roid($diff, $now)
{
	$ret = '<span class="';
	
	if($diff < 0)
		$ret = $ret . 'red" title="' . number_format($diff, 0, ".", ",") . ' ' . (diff == 1 ? 'roid">' : 'roids">');
	elseif($diff > 0)
		$ret = $ret . 'green" title="' . number_format($diff, 0, ".", ",") . ' ' . (diff == 1 ? 'roid">' : 'roids">');
	else
		$ret = $ret . 'yellow" title="0 roids">';
		
	if($now - $diff == 0)
		$ret = $ret . "0.0";
	else
		$ret = $ret . number_format($diff * 100.0 / ($now - $diff), 1, ".", ",");

	$ret = $ret . '%</span>';
	
	return $ret;
}
?> 