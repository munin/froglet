<?php
include_once('include/utils.php');

class UserData
{
	public $pnick;
	public $sponsor;
	public $invites;
	public $order;
	public $direction;
	
	private $db;

	public function UserData()
	{
		global $db;
		$this->db = $db;
	}
	
	public function selectUser()
	{
		$sql  = "SELECT pnick, sponsor, invites, phone, pubphone ";
		$sql .= "FROM user_list ";
		
		if($this->pnick != "")
		{
			$sql .= "WHERE pnick = '" . $this->pnick . "' ";
			return $this->db->query($sql, true);
		}
		else
		{
			$sql .= "ORDER BY " . $this->order . " " . $this->direction;
			return $this->db->query($sql);
		}
	}
	
	public function updateUser()
	{
		/*
		$sql = "UPDATE user_list SET ";
		$sql = $sql . "pnick = " . format_sql_string($this->pnick) . ", ";
		$sql = $sql . "timezone = " . $this->timezone . ", ";
		$sql = $sql . "phone = " . format_sql_string($this->phone) . ", ";
		$sql = $sql . "email = " . format_sql_string($this->email) . ", ";
		$sql = $sql . "force_nodef = " . $this->force_nodef . " ";
		$sql = $sql . "WHERE pnick = " . format_sql_string($this->username);
		
		return $this->db->exec($sql);
		*/
	}
}