<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.growth_rank.php
 * Type:     modifier
 * Name:     growth
 * Purpose:  Calculate growth from last number, format it to
 *           a percentage and create a nice color.
 * -------------------------------------------------------------
 */
function smarty_modifier_growth_rank($diff, $now)
{
	if($diff < 0)
		return 'Down ' . -$diff . ' ' . (diff == 1 ? 'place' : 'places');
	elseif($diff > 0)
		return 'Up ' . $diff . ' ' . (diff == 1 ? 'place' : 'places');
	else
		return 'Non mover';
}
?> 