<?php

$link = mysql_connect('localhost', 'd001d74b', 'oiashdo2') or die('Could not connect: ' . mysql_error());
mysql_select_db('d001d74b') or die('Could not select database');

mysql_query("UPDATE pa_fleet SET eta_now = eta_now - 1");
mysql_query("UPDATE pa_defcall SET status = 'Impossible' WHERE EXISTS (SELECT defcall_id FROM pa_fleet WHERE eta_now < 7 AND pa_defcall.defcall_id = pa_fleet.defcall_id AND pa_defcall.status = 'Uncovered')");

mysql_close($link);

?>