<?php
	$db->close();
	$time_end = microtime();
	$time = round($time_end - $time_begin, 2) * 100;
	$smarty->assign('runtime', $time);
	$smarty->display('footer.tpl');
?>