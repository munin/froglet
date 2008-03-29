<?php
class ScanData
{
	public $scan_id;
	public $tick;
	public $rand_id;
	
	private $db;

	public function ScanData()
	{
		global $db;
		$this->db = $db;
	}
	
	public function selectScan()
	{
		$sql = "SELECT p.x, p.y, p.z, p.ruler_name, p.planet_name, p.race, p.score, p.value, s.scan_id, s.tick, s.type ";
		$sql = $sql . "FROM planet p, scan s ";
		$sql = $sql . "WHERE s.rand_id = '" . $this->rand_id . "' ";
		$sql = $sql . "AND s.pid = p.id ";
		$sql = "SELECT p.x, p.y, p.z, p.rulername, p.planetname, p.race, p.score, p.value, s.rand_id, s.tick, s.scantype ";
		$sql = $sql . "FROM planet_dump p, scan s ";
		$sql = $sql . "WHERE s.id = '" . $this->rand_id . "' ";
		$sql = $sql . "AND s.pid = p.id ";
		$sql = $sql . "AND p.tick = s.tick ";
		$sql = $sql . "ORDER BY s.rand_id DESC";
		
		$result = $this->db->query($sql, true);
		
		$this->scan_id = $result['scan_id'];
		$this->tick = $result['tick'];
		
		return $result;
	}
	
	public function selectPlanetScan()
	{
		$sql = "SELECT roid_metal, roid_crystal, roid_eonium, res_metal, res_crystal, res_eonium ";
		$sql = $sql . "FROM planet ";
		$sql = $sql . "WHERE scan_id = " . $this->scan_id;

		return $this->db->query($sql, true);
	}
	
	public function selectSurfaceScan()
	{
		$sql = "SELECT light_factory, medium_factory, heavy_factory, wave_amplifier, wave_distorter, ";
		$sql = $sql . "metal_refinery, crystal_refinery, eonium_refinery, research_lab, finance_centre, security_centre ";
		$sql = $sql . "FROM surface WHERE scan_id = " . $this->scan_id;
		
		return $this->db->query($sql, true);
	}

	public function selectTechScan()
	{
		$sql = "SELECT travel, infrastructure, hulls, waves, core, covert_op, mining ";
		$sql = $sql . "FROM technology WHERE scan_id = " . $this->scan_id;
		
		$travel = array(0 => "none", 1 => "Jumpgate (-1)", 2 => "Warpgate (-2)", 3 => "Stargate (-3)", 4 => "Hypergate (-4)");
		$infra = array(0 => 10, 1 => 20, 2 => 50, 3 => 100, 4 => 150);
		$hulls = array(0 => "none", 1 => "Fighter Class Hulls", 2 => "Frigate Class Hulls", 3 => "Siege Weapons");
		$waves = array(0 => "Planet Scan", 1 => "Surface Scan", 2 => "Tech Scan", 3 => "Unit Scan", 4 => "News Scan", 5 => "Jumpgate Probe", 6 => "Fleet Analysis");
		$core = array(0 => "none", 1 => "Advanced Core Extraction", 2 => "Deep Core Drilling", 3 => "Magma Extraction");
		$covert = array(0 => "Set research back", 1 => "Lower Security", 2 => "Blow Asteroids", 3 => "Sabotage Ships", 4 => "Destroy Amps and Jammers", 5 => "Steal Resources", 6 => "Blow constructions");
		$mining = array(0 => 50, 1 => 100, 2 => 200, 3 => 300, 4 => 500, 5 => 750, 6 => 1000, 7 => 1250, 8 => 1500, 9 => 2000, 10 => 2500, 11 => 3000, 12 => 3500, 13 => 4500, 14 => 5500, 15 => 6500, 16 => 8000);
		
		$result = $this->db->query($sql, true);
		
		$result['travel'] = $travel[$result['travel']];
		$result['infrastructure'] = $infra[$result['infrastructure']];
		$result['hulls'] = $hulls[$result['hulls']];
		$result['waves'] = $waves[$result['waves']];
		$result['core'] = $core[$result['core']];
		$result['covert_op'] = $covert[$result['covert_op']];
		$result['mining'] = $mining[$result['mining']];
				
		return $result;
	}
	
	public function selectUnitScan()
	{
		$sql = "SELECT u.ship, u.count FROM unit u, ship s ";
		$sql = $sql . "WHERE scan_id = " . $this->scan_id . " AND u.ship = s.name ORDER BY s.id";
		
		return $this->db->query($sql);
	}
	
	public function selectJumpgateScan()
	{
		$sql = "SELECT p.x, p.y, p.z, s.mission, s.fleet, s.eta, s.ships ";
		$sql = $sql . "FROM pa_planet p, pa_scan_jumpgate s ";
		$sql = $sql . "WHERE s.scan_id = " . $this->scan_id . " ";
		$sql = $sql . "AND p.id = s.pid ";
		$sql = $sql . "AND p.tick = " . $this->tick . " ";
		$sql = $sql . "ORDER BY eta ASC";
		
		return $this->db->query($sql);
	}
	
	public function selectMilitaryScan()
	{
		$sql = "SELECT m.ship, m.base, m.alpha, m.beta, m.gamma FROM pa_scan_military m, pa_ship s ";
		$sql = $sql . "WHERE scan_id = " . $this->scan_id . " AND m.ship = s.name ORDER BY s.id";
		
		return $this->db->query($sql);
	}
}
?>