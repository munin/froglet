<?php
class AllianceData
{
	public $name;
	public $minroids;
	public $maxroids;
	public $minvalue;
	public $maxvalue;
	public $page;
	public $order;
	public $direction;
	public $limit;
	public $action;
	
	private $db;

	public function AllianceData()
	{
		global $db;
		$this->db = $db;
		$this->limit = 50;
	}
	
	public function top5Alliances()
	{
		$sql = "SELECT a.score_rank, b.score_rank - a.score_rank AS score_rank_diff, ";
		$sql = $sql . "a.name, a.members, a.size/a.members AS avgsize, a.score/CAST(a.members AS bigint) AS avgscore, ";
		$sql = $sql . "a.size, a.size - b.size AS size_growth, ";
		$sql = $sql . "a.score, a.score - b.score AS score_growth ";
		$sql = $sql . "FROM alliance_dump a, alliance_dump b ";
		$sql = $sql . "WHERE a.tick = (SELECT max_tick()) AND b.tick = GREATEST(a.tick - 2, 37)  ";
		$sql = $sql . "AND a.id = b.id ";
		$sql = $sql . "ORDER BY score DESC LIMIT 5";
		
		return $this->db->query($sql);
	}
	
	public function allianceList()
	{
		$sql = "SELECT a.score_rank, b.score_rank - a.score_rank AS score_rank_diff, ";
		$sql = $sql . "a.size_rank, b.size_rank - a.size_rank AS size_rank_diff, ";
		$sql = $sql . "a.score_avg_rank, b.score_avg_rank - a.score_avg_rank AS avg_score_rank_diff, ";
		$sql = $sql . "a.size_avg_rank, b.size_avg_rank - a.size_avg_rank AS avg_size_rank_diff, ";
		$sql = $sql . "a.name, a.members, ";
		$sql = $sql . "a.size_avg AS avg_size, a.size_avg - b.size_avg AS avg_size_growth, ";
		$sql = $sql . "a.score_avg AS avg_score, a.score_avg - b.score_avg AS avg_score_growth, ";
		$sql = $sql . "a.size, a.size - b.size AS size_growth, ";
		$sql = $sql . "a.score, a.score - b.score AS score_growth ";
		$sql = $sql . "FROM alliance_dump a, alliance_dump b ";
		$sql = $sql . "WHERE a.tick = (SELECT max_tick()) AND b.tick = GREATEST(a.tick - 2, 37) ";
		$sql = $sql . "AND a.id = b.id ";
		if($this->page == "") $this->page = 1;
		$sql = $sql . "ORDER BY " . $this->order . " " . $this->direction . " LIMIT " . $this->limit . " ";
		$sql = $sql . "OFFSET " . (($this->page - 1) * $this->limit);
		
		return $this->db->query($sql);
	}
	
	public function numberOfAlliances()
	{
		$sql = "SELECT COUNT(*) AS count FROM alliance_canon WHERE active = true";
		$result = $this->db->query($sql, true);
		return $result['count'];
	}

	public function selectAlliance()
	{
		if($this->page == "") $this->page = 1;

		$sql = "SELECT p.score_rank, q.score_rank - p.score_rank AS score_rank_diff, ";
		$sql = $sql . "p.value_rank, q.value_rank - p.value_rank AS value_rank_diff, ";
		$sql = $sql . "p.size_rank, q.size_rank - p.size_rank AS size_rank_diff, ";
		$sql = $sql . "p.xp_rank, q.xp_rank - p.xp_rank AS xp_rank_diff, ";
		$sql = $sql . "p.x, p.y, p.z, p.rulername as ruler_name, p.planetname as planet_name, p.race, p.xp, ";
		$sql = $sql . "p.size, p.size - q.size AS size_growth, ";
		$sql = $sql . "p.value, p.value - q.value AS value_growth, ";
		$sql = $sql . "p.score, p.score - q.score AS score_growth, ";
		$sql = $sql . "n.nick, a.name AS alliance, n.nap ";
		$sql = $sql . ", g.size_rank AS galsizerank, g.value_rank AS galvaluerank ";
		$sql = $sql . "FROM planet_dump q, planet_dump p, intel n, alliance_canon a ";
		$sql = $sql . ", galaxy_dump g ";
		$sql = $sql . "WHERE p.id = n.pid ";
		$sql = $sql . "AND p.tick = (SELECT max_tick()) AND q.tick = GREATEST(p.tick - 2, 37) ";
		$sql = $sql . "AND q.id = p.id ";
		$sql = $sql . "AND n.alliance_id = a.id ";
		if($this->names != "")
		{
			$sql = $sql . "AND a.name IN ('" . implode($this->names, "', '") . "') ";
		}
		else
		{
			$sql = $sql . "AND a.name = ''";
		}
		if($this->action == "target")
		{
			$sql = $sql . "AND p.x = g.x AND p.y = g.y AND g.tick = p.tick AND n.nap <> 1 ";
		}
		if($this->minroids != "")
		{
			$sql = $sql . "AND p.size >= " . $this->minroids . " ";
		}
		if($this->maxroids != "")
		{
			$sql = $sql . "AND p.size <= " . $this->maxroids . " ";
		}
		if($this->minvalue != "")
		{
			$sql = $sql . "AND p.value >= " . $this->minvalue . " ";
		}
		if($this->maxvalue!= "")
		{
			$sql = $sql . "AND p.value <= " . $this->maxvalue . " ";
		}
		$sql = $sql . "ORDER BY " . $this->order . " " . $this->direction . " LIMIT " . $this->limit . " ";
		$sql = $sql . "OFFSET " . (($this->page - 1) * $this->limit);
		
		return $this->db->query($sql);
	}

	public function allianceOptions()
	{
		$sql = "SELECT name FROM alliance_canon ORDER BY name WHERE active = true";
		$result = $this->db->query($sql);
		$data = array();
		foreach($result as $alliance)
		{
			$data[$alliance['name']] = $alliance['name'];
		}
		return $data;
	}

	public function numberOfMembers()
	{
		$sql = "SELECT COUNT(*) AS count FROM intel p, alliance_canon a ";
		$sql = $sql . "WHERE p.alliance_id = a.id AND a.name IN (";//'" . $this->names . "'";
		$name = current($this->names);
		while($name)
		{
			$sql = $sql . "'" . $name . "'";
			if($name = next($this->names))
			{
				$sql = $sql . ", ";
			}
		}
		$sql = $sql . ") ";
		$result = $this->db->query($sql, true);
		return $result['count'];
	}
	
	public function allianceIntelList()
	{
		$sql = "SELECT a.name, COUNT(*) AS members, ";
		$sql = $sql . "AVG(size) AS avg_size, AVG(value) AS avg_value, AVG(score) AS avg_score, ";
		$sql = $sql . "SUM(size) AS size, SUM(value) AS value, SUM(score) AS score, ";
		$sql = $sql . "COUNT(CASE WHEN score_rank <= 10 THEN 1 ELSE null END) AS t10, ";
		$sql = $sql . "COUNT(CASE WHEN score_rank <= 50 THEN 1 ELSE null END) AS t50, ";
		$sql = $sql . "COUNT(CASE WHEN score_rank <= 100 THEN 1 ELSE null END) AS t100, ";
		$sql = $sql . "COUNT(CASE WHEN score_rank <= 200 THEN 1 ELSE null END) AS t200, ";
		$sql = $sql . "COUNT(CASE WHEN value_rank <= 10 THEN 1 ELSE null END) AS t10v, ";
		$sql = $sql . "COUNT(CASE WHEN value_rank <= 50 THEN 1 ELSE null END) AS t50v, ";
		$sql = $sql . "COUNT(CASE WHEN value_rank <= 100 THEN 1 ELSE null END) AS t100v, ";
		$sql = $sql . "COUNT(CASE WHEN value_rank <= 200 THEN 1 ELSE null END) AS t200v ";
		$sql = $sql . "FROM intel i, planet_dump p, alliance_canon a ";
		$sql = $sql . "WHERE i.pid = p.id ";
		$sql = $sql . "AND p.tick = (SELECT max_tick()) ";
		$sql = $sql . "AND i.alliance_id = a.id ";
		$sql = $sql . "GROUP BY a.name ";
		$sql = $sql . "ORDER BY " . $this->order . " " . $this->direction;
		
		return $this->db->query($sql);
	}
	
	public function numberOfIntel()
	{
		$sql = "SELECT COUNT(DISTINCT alliance_id) AS count FROM intel WHERE alliance_id IS NOT NULL";
		$result = $this->db->query($sql, true);
		return $result['count'];
	}
}