<?php
/**
* Smarty number_format modifier plugin
*
* Type: modifier<br>
* Name: rank_move_image<br>
* Purpose: return an image based on rank change
* number_format (Smarty online manual)
* @param integer
* @return string
*/

function smarty_modifier_rank_move_image($difference)
{
	if($difference < 0)
		return "images/down.gif";
	elseif($difference > 0)
		return "images/up.gif";
	else
		return "images/nonemover.gif";
}

/* vim: set expandtab: */

?>
