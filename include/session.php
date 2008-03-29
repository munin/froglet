<?php

class Session
{
	private $db = null;
	
	function __construct()
	{
		global $db;
		session_name('MUNINSESSID');
		session_start();
		$this->db = $db;
	}
	
	private function set($user, $pass, $access)
	{
		$_SESSION['USER'] = $user;
		$_SESSION['PASS'] = $pass;
		$_SESSION['ACCESS'] = $access;
	}
	
	private function isAuthenticated($login, $pass)
	{
		$ret = false;
				
		$sql = "SELECT salt, passwd, userlevel FROM user_list WHERE pnick ILIKE '" . addslashes($login) . "'";
		
		$res = $this->db->query($sql, true);
		
		if($res != FALSE)
		{
			if($res['passwd'] == md5(md5($res['salt']).$pass))
			{
				$ret = $res['userlevel'];
			}
		}
		
		return $ret;
	}
	
	public function isValid()
	{
		$setSession = false;
		
		if(!empty($_SESSION['USER']) && !empty($_SESSION['PASS']))
		{
			$user = $_SESSION['USER'];
			$pass = $_SESSION['PASS'];
		}
		elseif(!empty($_POST['login_name']) || !empty($_POST['login_password']))
		{
			$setSession = true;
			$user = $_POST['login_name'];
			$pass = md5($_POST['login_password']);
		}
		else
		{
			return false;
		}
		
		if(($access = $this->isAuthenticated($user, $pass))===false)
		{
			return false;
		}

		if ($setSession)
			$this->set($user, $pass, $access);
			
		return true;	
	}
	
	public function destroy()
	{
		$_SESSION = array();
		session_destroy();		
	}
	
	public function hasAccess($requiredLevel)
	{
		return (isset($_SESSION['ACCESS']) && $requiredLevel <= $_SESSION['ACCESS']);
	}
}
?>