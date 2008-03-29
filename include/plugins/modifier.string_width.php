<?php

/**

* Smarty plugin

* @package Smarty

* @subpackage plugins

*/

/**

* Smarty number_format modifier plugin

*

* Type: modifier<br>

* Name: number_format<br>

* Purpose: format number via number_format

* @link http://smarty.php.net/manual/en/language.modifier.number.format.php

* number_format (Smarty online manual)

* @param string

* @param integer

* @param character

* @param character

* @return string

*/

function smarty_modifier_string_width($string, $width)
{
	return sprintf("%" . $width . "s", $string);
}

/* vim: set expandtab: */

?>
