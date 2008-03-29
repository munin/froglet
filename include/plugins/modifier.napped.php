<?php

function smarty_modifier_napped($text, $napped)
{
	if($napped)
	{
		return '<div class="napped">' . $text . '</div>';
	}
	else
	{
		return $text;
	}
}

?>
