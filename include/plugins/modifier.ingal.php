<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     modifier.ingal.php
 * Type:     modifier
 * Name:     growth
 * Purpose:  Calculate growth from last number, format it to
 *           a percentage and create a nice color.
 * -------------------------------------------------------------
 */
function smarty_modifier_ingal($ingal)
{
	if($ingal == 1)
		return "in galaxy";
	else
		return "";
}
?> 