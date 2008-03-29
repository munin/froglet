<?php
include_once('include/utils.php');

class FleetData
{
	public $paste;
	public $shipname;
	public $alpha;
	public $beta;
	public $gamma;
	public $username;
	public $defclass;
	public $attclass;
	public $eta;
	
	private $db;

	public function FleetData()
	{
		global $db;
		$this->db = $db;
	}
	
	public function parseFleets()
	{
		$sql = "DELETE FROM pa_user_fleet WHERE username = '" . $this->username . "'";
		$this->db->exec($sql);
		
		$this->paste = str_replace(",", "", $this->paste);

		preg_match_all("/(.*)\s(FI|CO|FR|DE|CR|BS)\s+(FI|CO|FR|DE|CR|BS|RO|ST)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)/", $this->paste, $fleets, PREG_SET_ORDER);
		
		foreach($fleets as $ship)
		{
			$this->shipname = $ship[1];
			
			if($ship[4] == 0 && $ship[5] == 0 && $ship[6] == 0 && $ship[7] == 0) continue;
			
			$sql = "INSERT INTO pa_user_fleet (username, shipname, base, fleet1, fleet2, fleet3) VALUES (";
			$sql = $sql . "'" . $this->username . "', ";
			$sql = $sql . "'" . $this->shipname . "', ";
			$sql = $sql . $ship[4] . ", ";
			$sql = $sql . $ship[5] . ", ";
			$sql = $sql . $ship[6] . ", ";
			$sql = $sql . $ship[7] . ")";
			
			$this->db->exec($sql);
		}
		
		$this->alpha = ($this->alpha == "on" ? 'Away' : 'Home');
		$this->beta  = ($this->beta  == "on" ? 'Away' : 'Home');
		$this->gamma = ($this->gamma == "on" ? 'Away' : 'Home');
		
		$sql = "UPDATE pa_user SET ";
		$sql = $sql . "fleet1 = '" . $this->alpha . "', ";
		$sql = $sql . "fleet2 = '" . $this->beta  . "', ";
		$sql = $sql . "fleet3 = '" . $this->gamma . "', ";
		$sql = $sql . "fleet_updated = NOW() ";
		$sql = $sql . "WHERE username = '" . $this->username . "'";

		$this->db->exec($sql);
	}
	
	public function selectFleet()
	{
		$sql = "SELECT fleet1, fleet2, fleet3 FROM pa_user WHERE username = '" . $this->username . "'";
		$status = $this->db->query($sql);
		$this->alpha = $status[0]['fleet1'];
		$this->beta = $status[0]['fleet2'];
		$this->gamma = $status[0]['fleet3'];

		$sql = "SELECT shipname, base, fleet1, fleet2, fleet3 FROM pa_user_fleet, pa_ship ";
		$sql = $sql . "WHERE username = '" . $this->username . "' ";
		$sql = $sql . "AND name = shipname ";
		$sql = $sql . "ORDER BY id ";
		
		return $this->db->query($sql);
	}
	
	public function selectFleets()
	{
		$sql = "SELECT f.shipname, ";
		$sql = $sql . "CASE WHEN u.fleet1 = 'Home' OR u.fleet2 = 'Home' OR u.fleet3 = 'Home' THEN f.base ELSE 0 END + ";
		$sql = $sql . "CASE WHEN u.fleet1 = 'Home' THEN f.fleet1 ELSE 0 END + ";
		$sql = $sql . "CASE WHEN u.fleet2 = 'Home' THEN f.fleet2 ELSE 0 END + ";
		$sql = $sql . "CASE WHEN u.fleet3 = 'Home' THEN f.fleet3 ELSE 0 END AS count, ";
		$sql = $sql . "u.username, u.phone, ";
		$sql = $sql . "FLOOR(UNIX_TIMESTAMP(NOW())/3600) - FLOOR(UNIX_TIMESTAMP(u.fleet_updated)/3600) AS last ";
		$sql = $sql . "FROM pa_user_fleet f, pa_user u, pa_ship s ";
		$sql = $sql . "WHERE f.username = u.username ";
		$sql = $sql . "AND f.shipname = s.name ";
		$sql = $sql . "AND ((u.fleet1 = 'Home' AND (f.base > 0 OR f.fleet1 > 0)) OR ";
		$sql = $sql . "(u.fleet2 = 'Home' AND (f.base > 0 OR f.fleet2 > 0)) OR ";
		$sql = $sql . "(u.fleet3 = 'Home' AND (f.base > 0 OR f.fleet3 > 0))) ";
		if($this->defclass != "")
		{
			$sql = $sql . "AND s.class = '" . $this->defclass . "' ";
		}
		if($this->attclass != "")
		{
			$sql = $sql . "AND s.target = '" . $this->attclass . "' ";
		}
		if($this->eta != "")
		{
			$sql = $sql . "AND " . $this->eta . " >= CASE s.class ";
			$sql = $sql . "WHEN 'Fighter' THEN 11 + u.eta_bonus ";
			$sql = $sql . "WHEN 'Corvette' THEN 11 + u.eta_bonus ";
			$sql = $sql . "WHEN 'Frigate' THEN 12 + u.eta_bonus ";
			$sql = $sql . "WHEN 'Destroyer' THEN 12 + u.eta_bonus ";
			$sql = $sql . "WHEN 'Cruiser' THEN 13 + u.eta_bonus ";
			$sql = $sql . "WHEN 'Battleship' THEN 13 + u.eta_bonus END ";
		}
		$sql = $sql . "GROUP BY f.username, f.shipname ";
		
		return $this->db->query($sql);
	}
}