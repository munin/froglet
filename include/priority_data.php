<?php
include_once('include/utils.php');

class PriorityData
{
	public $high;
	public $medium;
	public $low;
	
	private $db;

	public function PriorityData()
	{
		global $db;
		$this->db = $db;
	}
	
	public function selectPriority()
	{
		$sql = "SELECT high, medium, low ";
		$sql = $sql . "FROM pa_priority ";
		$sql = $sql . "WHERE name = 'defence'";
		
		return $this->db->query($sql, true);
	}
	
	public function updatePriority()
	{
		$sql = "UPDATE pa_priority ";
		$sql = $sql . "SET high = " . $this->high . ", medium = " . $this->medium . ", low = " . $this->low . " ";
		$sql = $sql . "WHERE name = 'defence'";
		
		$this->db->exec($sql);
	}
}