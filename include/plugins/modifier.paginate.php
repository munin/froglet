<?php
/**
* Smarty paginate modifier plugin
*
* Type: modifier<br>
* Name: paginate<br>
* Purpose: return an image based on rank change
* number_format (Smarty online manual)
* @param integer
* @return string
*/

function smarty_modifier_paginate($count, $page, $params = "")
{
	$pages = ceil($count / 50.0);
	
	$first = $page - 4;
	if($first < 1) $first = 1;
	$last = $first + 8;
	if($last > $pages) $last = $pages;
	
	$string = "";
	
	for($i = $first; $i <= $last; $i++)
	{
		if($i == $page)
			$string = $string . ' ' . $i;
		else
			$string = $string . ' <a href="?' . $params . '&page=' . $i . '">' . $i . '</a>';
	}
	
	if($i < $pages)
		$string = $string . ' ... of ' . $pages;
	
	return $string;
}

/* vim: set expandtab: */

?>
