<?php

function smarty_modifier_timezone($number)
{
	return sprintf("GMT%+d", $number);
}

?>
