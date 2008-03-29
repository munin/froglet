<?php
class ScansData
{
	public $page;
	public $order;
	public $direction;
	
	private $db;

	public function ScansData()
	{
		global $db;
		$this->db = $db;
	}
	
	public function selectScans()
	{
		if($this->page == "") 
			$this->page = 1;
		
		$sql = "SELECT s.rand_id, s.scantype, p.x, p.y, p.z, s.tick as request_time, ";
		$sql .= "(SELECT wave_distorter FROM structure WHERE structure.scan_id = s.id) AS wave_distorters ";
		$sql = $sql . "FROM scan s, planet_dump p ";
		$sql = $sql . "WHERE p.tick = (SELECT MAX(tick) FROM updates) ";
		$sql = $sql . "AND s.pid = p.id ";
		$sql = $sql . "ORDER BY " . $this->order . " " . $this->direction . " LIMIT 50 ";
		$sql = $sql . "OFFSET " . (($this->page - 1) * 50);
		return $this->db->query($sql);
	}
	
	public function numberOfScans()
	{
		$sql = "SELECT COUNT(*) AS count FROM scan";
		$result = $this->db->query($sql, true);
		return $result['count'];
	}
}
?>