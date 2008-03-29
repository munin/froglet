<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>eXilition</title>
<link rel="stylesheet" href="webby.css" type="text/css"/>
</head>
<body>
<div style="clear: both; height: 2em"></div>
<?php
	include('/www/htdocs/w005d69b/libs/Smarty.class.php');
	require_once('include/database.php');
	
	$smarty = new Smarty;

	$smarty->template_dir = '/www/htdocs/w005d69b/templates';
	$smarty->compile_dir = '/www/htdocs/w005d69b/templates_c';
	$smarty->cache_dir = '/www/htdocs/w005d69b/cache';
	$smarty->config_dir = '/www/htdocs/w005d69b/configs';
	$smarty->plugins_dir[] = '/www/htdocs/w005d69b/include/plugins';

	$db = new Database('localhost', 'd001d74b', 'd001d74b', 'oiashdo2');

	include('include/public_target_data.php');
?>
<table width="100%">
	<tr>
		<td width="50%">
<?php
$data = new PublicTargetData;
$data->defcall_id = $_REQUEST['id'];
$data->order = $_REQUEST['order'];
$data->direction = $_REQUEST['dir'];

if($data->order == "")
{
	$data->order = "score";
	$data->direction = "desc";
}

$smarty->assign('data', $data->listPublicTargets());
$smarty->assign('order', $data->order);
$smarty->assign('dir', $data->direction);
$smarty->display('public_target_list.tpl');
?>
		</td>
	</tr>
</table>
<div align="center">&copy; 2006 Arho Huttunen</div>
</body>
</html>
<?php
	$db->close();
?>