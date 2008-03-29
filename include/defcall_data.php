<?php
include_once('include/utils.php');

class DefcallData
{
	public $defcall_id;
	public $username;
	public $eta_low;
	public $eta_high;
	public $status;
	public $order;
	public $direction;
	
	private $db;

	public function DefcallData()
	{
		global $db;
		$this->db = $db;
	}
	
	public function selectDefcall()
	{
		$sql = "SELECT p.x, p.y, p.z, p.size, p.value, p.score, p.xp, p.race, n.nick ";
		$sql = $sql . "FROM defcalls c, fleet f ";
		$sql = $sql . "LEFT JOIN planet_dump p ON f.target = p.id ";
		$sql = $sql . "LEFT JOIN intel n ON p.id = n.pid ";
		$sql = $sql . "WHERE c.id = " . $this->defcall_id . " ";
		$sql = $sql . "AND f.landing_tick = c.landing_tick AND f.target = c.target ";
		$sql = $sql . "AND p.tick = (SELECT max_tick())";
		
		return $this->db->query($sql, true);
	}
	
	public function selectDefcallFleets()
	{
		$sql = "SELECT p.x AS ox, p.y AS oy, p.z AS oz, f.fleet_name AS fleet, f.fleet_size AS ships, f.landing_tick - f.launch_tick AS eta, f.landing_tick - (SELECT max_tick()) as eta_now, ";
		$sql = $sql . "p.size, p.value, p.score, p.xp, p.race, n.nick, a.name AS alliance, c.status ";
		$sql = $sql . "FROM defcalls c, fleet f, planet_dump o, planet_dump p ";
		$sql = $sql . "LEFT JOIN intel n ON p.id = n.pid ";
		$sql = $sql . "LEFT JOIN alliance_canon a ON n.alliance_id = a.id ";
		$sql = $sql . "WHERE c.id = " . $this->defcall_id . " ";
		$sql = $sql . "AND f.landing_tick = c.landing_tick AND f.target = c.target ";
		$sql = $sql . "AND f.target = p.id ";
		$sql = $sql . "AND p.tick = (SELECT max_tick()) ";
		$sql = $sql . "AND o.id = f.owner_id ";
		$sql = $sql . "AND o.tick = (SELECT max_tick()) ";
		
		return $this->db->query($sql);
	}
	

	public function listDefcalls()
	{
		$sql = "SELECT DISTINCT c.id AS defcall_id, q.x AS tx, q.y AS ty, q.z AS tz, f.landing_tick - (SELECT max_tick()) AS eta_now, ";
		$sql = $sql . "c.bcalc, c.claimed_by, c.status, m.nick, q.size, FLOOR(q.size/4) AS roids_lost, ";
		$sql = $sql . "p.x AS ox, p.y AS oy, p.z AS oz, f.fleet_name AS fleet, f.fleet_size AS ships, f.mission AS type, f.landing_tick - f.launch_tick AS eta, ";
		$sql = $sql . "p.size AS asize, p.value, p.score, p.xp, p.race, i.name, ";
		$sql = $sql . "(SELECT u.rand_id FROM scan u WHERE p.id = u.pid ";
		$sql = $sql . "AND u.scantype = 'unit' ORDER BY scan_id DESC LIMIT 1) AS unit, ";
		$sql = $sql . "(SELECT v.rand_id FROM scan v WHERE p.id = v.pid ";
		$sql = $sql . "AND v.scantype = 'au' ORDER BY scan_id DESC LIMIT 1) AS military ";
		$sql = $sql . "FROM defcalls c, fleet f, planet_dump q, intel m, planet_dump p ";
		$sql = $sql . "LEFT JOIN intel n ON p.id = n.pid ";
		$sql = $sql . "LEFT JOIN alliance_canon i ON n.alliance_id = i.id ";
		$sql = $sql . "WHERE f.target = c.target AND f.landing_tick = c.landing_tick ";
		$sql = $sql . "AND p.tick = (SELECT max_tick()) ";
		$sql = $sql . "AND f.owner_id = p.id ";
		$sql = $sql . "AND f.target = q.id ";
		$sql = $sql . "AND q.tick = (SELECT max_tick()) ";
		$sql = $sql . "AND q.id = m.id ";
		$sql = $sql . "AND f.landing_tick - (SELECT max_tick()) > " . $this->eta_low . " ";
		if($this->eta_high <= 0)
		{
			$sql = $sql . "AND f.landing_tick - (SELECT max_tick()) <= " . $this->eta_high . " ";
		}
		$sql = $sql . "AND f.mission <> 'defend' ";
		if($this->status != "")
		{
			$sql = $sql . "AND c.status IN (" . $this->status . ") ";
		}
		if($this->username != "")
		{
			$sql = $sql . "AND m.nick = '" . $this->username . "' ";
		}
		$sql = $sql . "ORDER BY " . $this->order . " " . $this->direction;
				
		return $this->db->query($sql);
	}
	
	public function listHostileAlliances()
	{
		$sql = "SELECT DISTINCT COALESCE(i.alliance, '-unknown-') AS alliance, ";
		$sql = $sql . "COUNT(IF(f.eta - f.eta_now < 24, 1, NULL)) AS last24, ";
		$sql = $sql . "COUNT(IF(f.eta - f.eta_now < 48, 1, NULL)) AS last48, ";
		$sql = $sql . "COUNT(IF(f.eta - f.eta_now < 72, 1, NULL)) AS last72, ";
		$sql = $sql . "COUNT(IF(f.eta - f.eta_now < HOUR(DATE_SUB(NOW(), INTERVAL 1 HOUR)), 1, NULL)) AS today, ";
		$sql = $sql . "COUNT(IF(f.eta - f.eta_now < HOUR(DATE_SUB(NOW(), INTERVAL 1 HOUR)) + 24 AND f.eta - f.eta_now >= HOUR(DATE_SUB(NOW(), INTERVAL 1 HOUR)), 1, NULL)) AS yday, ";
		$sql = $sql . "COUNT(IF(f.eta - f.eta_now < HOUR(DATE_SUB(NOW(), INTERVAL 1 HOUR)) + 48 AND f.eta - f.eta_now >= HOUR(DATE_SUB(NOW(), INTERVAL 1 HOUR)) + 24, 1, NULL)) AS daybefore, ";
		$sql = $sql . "COUNT(*) AS alltime ";
		$sql = $sql . "FROM pa_planet_intel o, pa_fleet f ";
		$sql = $sql . "LEFT JOIN pa_planet_intel i ";
		$sql = $sql . "ON f.launcher_ruler_name = i.ruler_name AND f.launcher_planet_name = i.planet_name ";
		$sql = $sql . "WHERE f.type = 'Attack' ";
		$sql = $sql . "AND f.target_ruler_name = o.ruler_name AND f.target_planet_name = o.planet_name ";
		$sql = $sql . "AND o.alliance = 'eX' ";
		$sql = $sql . "GROUP BY i.alliance ";
		$sql = $sql . "ORDER BY " . $this->order . " " . $this->direction;
		
		return $this->db->query($sql);
	}

	public function getTotalHostiles()
	{
		$sql = "SELECT ";
		$sql = $sql . "COUNT(IF(f.eta - f.eta_now < 24, 1, NULL)) AS last24, ";
		$sql = $sql . "COUNT(IF(f.eta - f.eta_now < 48, 1, NULL)) AS last48, ";
		$sql = $sql . "COUNT(IF(f.eta - f.eta_now < 72, 1, NULL)) AS last72, ";
		$sql = $sql . "COUNT(IF(f.eta - f.eta_now < HOUR(DATE_SUB(NOW(), INTERVAL 1 HOUR)), 1, NULL)) AS today, ";
		$sql = $sql . "COUNT(IF(f.eta - f.eta_now < HOUR(DATE_SUB(NOW(), INTERVAL 1 HOUR)) + 24 AND f.eta - f.eta_now >= HOUR(DATE_SUB(NOW(), INTERVAL 1 HOUR)), 1, NULL)) AS yday, ";
		$sql = $sql . "COUNT(IF(f.eta - f.eta_now < HOUR(DATE_SUB(NOW(), INTERVAL 1 HOUR)) + 48 AND f.eta - f.eta_now >= HOUR(DATE_SUB(NOW(), INTERVAL 1 HOUR)) + 24, 1, NULL)) AS daybefore, ";
		$sql = $sql . "COUNT(*) AS alltime ";
		$sql = $sql . "FROM pa_planet_intel o, pa_fleet f ";
		$sql = $sql . "WHERE f.type = 'Attack' ";
		$sql = $sql . "AND f.target_ruler_name = o.ruler_name AND f.target_planet_name = o.planet_name ";
		$sql = $sql . "AND o.alliance = 'eX' ";
		
		return $this->db->query($sql, true);
	}
	
	public function updateDefcall()
	{
		$sql = "UPDATE defcall SET status = " . toStatusFlag($this->status) . " WHERE id = " . $this->defcall_id;
		$this->db->exec($sql);
	}
	
	public static function toStatusFlag($_string)
	{
		$ret = 0;
		return $ret;
	}

	public static function fromStatusFlag($_flag)
	{
		$ret = "uncovered";
		return $ret;
	}
}