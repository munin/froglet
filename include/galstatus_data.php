<?php
include_once('include/utils.php');

class GalstatusData
{
	public $paste;
	public $username;
	
	private $db;
	private $tx;
	private $ty;
	private $tz;
	private $ox;
	private $oy;
	private $oz;
	private $name;
	private $count;
	private $mission;
	private $eta;

	public function GalstatusData()
	{
		global $db;
		$this->db = $db;
	}
	
	public function parseFleets()
	{
		$fleetcount = 0;
		
		preg_match_all("/(\d+):(\d+):(\d+)\s+(\d+):(\d+):(\d+)\s+(.*)\s+(.*)\s+(\d+)\s+(Attack|Defend|Return)\s+(\d+)/", $this->paste, $fleets, PREG_SET_ORDER);

		foreach($fleets as $fleet)
		{
			$this->tx = $fleet[1];
			$this->ty = $fleet[2];
			$this->tz = $fleet[3];
			$this->ox = $fleet[4];
			$this->oy = $fleet[5];
			$this->oz = $fleet[6];
			$this->name = $fleet[7];
			$this->count = $fleet[9];
			$this->mission = $fleet[10];
			$this->eta = $fleet[11];
			
			$fleetcount += $this->insertFleet();
		}
		
		echo "Inserted " . $fleetcount . " new fleet actions into database.";
	}

	private function insertFleet()
	{
		$ingal = 0;

		if($this->tx == $this->ox && $this->ty == $this->oy)
		{
			$ingal = 1;
		}

		$sql = "SELECT * FROM fleet f, planet_dump p, planet_dump q ";
		$sql = $sql . "WHERE f.target = p.id ";
		$sql = $sql . "AND f.owner_id = q.id ";
		$sql = $sql . "AND p.tick = (SELECT max_tick()) ";
		$sql = $sql . "AND p.x = " . $this->tx . " AND p.y = " . $this->ty . " AND p.z = " . $this->tz . " ";
		$sql = $sql . "AND q.x = " . $this->ox . " AND q.y = " . $this->oy . " AND q.z = " . $this->oz . " ";
		$sql = $sql . "AND f.fleet_name = '" . $this->name . "' ";
		$sql = $sql . "AND f.fleet_size = " . $this->count . " ";
		$sql = $sql . "AND f.mission = '" . $this->mission . "' ";
		$sql = $sql . "AND f.landing_tick = (SELECT max_tick()) + " . $this->eta . " ";
			
		$result = $this->db->query($sql);
			
		if(count($result) == 0)
		{
			$sql = "INSERT INTO fleet (target, owner_id, ";
			$sql = $sql . "fleet_name, fleet_size, mission, landing_tick) ";
			$sql = $sql . "SELECT p.id, q.id, ";
			$sql = $sql . "'" . $this->name . "', " . $this->count . ", lower('" . $this->mission . "'), ";
			$sql = $sql . " (SELECT max_tick()) + " . $this->eta . " ";
			$sql = $sql . "FROM planet_dump p, planet_dump q ";
			$sql = $sql . "WHERE p.x = " . $this->tx . " AND p.y = " . $this->ty . " AND p.z = " . $this->tz . " ";
			$sql = $sql . "AND q.x = " . $this->ox . " AND q.y = " . $this->oy . " AND q.z = " . $this->oz . " ";
			$sql = $sql . "AND p.tick = (SELECT max_tick()) AND q.tick = (SELECT max_tick()) ";
			
			$this->db->exec($sql);
			
			return 1;
		}
		return 0;
	}
}