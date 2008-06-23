<?php
	$time_begin = microtime();

	require_once('config.php');
	include($config['path'].'libs/Smarty.class.php');
	require_once('database.php');
	require_once('session.php');
	
	$smarty = new Smarty;
	$smarty->template_dir = $config['path'].'templates';
	$smarty->compile_dir = $config['path'].'templates_c';
	$smarty->cache_dir = $config['path'].'cache';
	$smarty->config_dir = $config['path'].'configs';
	$smarty->plugins_dir[] = $config['path'].'include/plugins';

	$db = new Database($config['dbhost'], $config['dbname'], $config['dbuser'], $config['dbpass']);

	$session = new Session;

	if(isset($_GET['action']) && ($_GET['action'] == "logout"))
	{
		$session->destroy();
	}
	
	$isLoggedIn = $session->isValid();
	
	$sql = 'SELECT slogan FROM slogan ORDER BY RANDOM() LIMIT 1';
	$res = $db->query($sql, true);
	$slogan = $res['slogan']; 
	$userlevel = isset($_SESSION['ACCESS']) ? $_SESSION['ACCESS'] : 0;
	$menu = $loginaction = '';
	
	$sql = "SELECT id, name, url FROM menu ";
	$sql = $sql . "WHERE userlevel <= $userlevel ";
	$sql = $sql . "ORDER BY orderkey";
	$rs = $db->query($sql);
	
	foreach($rs as $row)
	{
		$menu .= "<li><a href=\"" . $row["url"] . "\">" . $row["name"] . "</a>\n";
		
		$sql = "SELECT name, url FROM menuitem ";
		$sql = $sql . "WHERE menu_id = " . $row["id"] . " ";
		$sql = $sql . "AND userlevel <= $userlevel ";
		$sql = $sql . "ORDER BY orderkey";
		$rs2 = $db->query($sql);
		
		$menu .= "<ul>\n";
		
		foreach($rs2 as $row)
		{
			$menu .= "<li><a href=\"" . $row["url"] . "\">" . $row["name"] . "</a></li>\n";
		}
		
		$menu .= "</ul>\n";
		$menu .= "</li>\n";
	}
	
	if ($isLoggedIn) {
	  $loginaction = '<a href="index.php?action=logout">Logout</a>';

	  $stmt_name = "froglet_logger";
	  pg_prepare($db, $stmt_name, 
		     'INSERT INTO froglet_logs (page_url,pnick) VALUES ($1,$2)');
	  pg_execute($db, $stmt_name, array($_SERVER['REQUEST_URI'],$_SESSION['USER']));

	} else
		$loginaction = '<a href="index.php?action=login">Login</a>';
	
	//$smarty->assign('xmltag', '');
	$smarty->assign('slogan', $slogan);
	$smarty->assign('menu', $menu);
	$smarty->assign('loginaction', $loginaction);
	$smarty->display('header.tpl');
?>
