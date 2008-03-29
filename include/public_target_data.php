<?php
include_once('include/utils.php');

class PublicTargetData
{
	public $order;
	public $direction;
	
	private $db;

	public function PublicTargetData()
	{
		global $db;
		$this->db = $db;
	}
	
	public function listPublicTargets()
	{
		$sql = "SELECT p.x, p.y, p.z, p.ruler_name, p.planet_name, p.race, p.score, p.value, p.size, p.xp, ";
		$sql = $sql . "(SELECT q.rand_id FROM pa_scan q WHERE p.ruler_name = q.ruler_name AND p.planet_name = q.planet_name ";
		$sql = $sql . "AND q.type = 'planet' ORDER BY scan_id DESC LIMIT 1) AS planet, ";
		$sql = $sql . "(SELECT u.rand_id FROM pa_scan u WHERE p.ruler_name = u.ruler_name AND p.planet_name = u.planet_name ";
		$sql = $sql . "AND u.type = 'unit' ORDER BY scan_id DESC LIMIT 1) AS unit, ";
		$sql = $sql . "(SELECT j.rand_id FROM pa_scan j WHERE p.ruler_name = j.ruler_name AND p.planet_name = j.planet_name ";
		$sql = $sql . "AND j.type = 'jumpgate' ORDER BY scan_id DESC LIMIT 1) AS jumpgate, ";
		$sql = $sql . "(SELECT m.rand_id FROM pa_scan m WHERE p.ruler_name = m.ruler_name AND p.planet_name = m.planet_name ";
		$sql = $sql . "AND m.type = 'military' ORDER BY scan_id DESC LIMIT 1) AS military ";
		$sql = $sql . "FROM pa_planet p, pa_tick t , pa_planet_intel i ";
		$sql = $sql . "WHERE p.tick = t.planet_tick AND ";
		$sql = $sql . "p.ruler_name = i.ruler_name AND p.planet_name = i.planet_name ";
		$sql = $sql . "AND i.alliance = 'ND' ";
		$sql = $sql . "ORDER BY " . $this->order . " " . $this->direction;

		return $this->db->query($sql);
	}	
}