<?php
class GalaxyData
{
	public $x;
	public $y;
	public $page;
	public $order;
	public $direction;
	
	private $db;

	public function GalaxyData()
	{
		global $db;
		$this->db = $db;
	}
	
	public function top10Galaxies()
	{
		$sql = "SELECT g.score_rank, h.score_rank - g.score_rank AS score_rank_diff, ";
		$sql = $sql . "g.x, g.y, g.name, ";
		$sql = $sql . "g.size, g.size - h.size AS size_growth, ";
		$sql = $sql . "g.score, g.score - h.score AS score_growth ";
		$sql = $sql . "FROM galaxy_dump g, galaxy_dump h ";
		$sql = $sql . "WHERE g.tick = (SELECT max_tick()) AND h.tick = GREATEST(g.tick - 2, 37) ";
		$sql = $sql . "AND h.id = g.id ";
		$sql = $sql . "ORDER BY score DESC LIMIT 10";
		
		return $this->db->query($sql);
	}
	
	public function selectGalaxyPlanets()
	{
		$sql = "SELECT p.score_rank, q.score_rank - p.score_rank AS score_rank_diff, ";
		$sql = $sql . "p.value_rank, q.value_rank - p.value_rank AS value_rank_diff, ";
		$sql = $sql . "p.size_rank, q.size_rank - p.size_rank AS size_rank_diff, ";
		$sql = $sql . "p.xp_rank, q.xp_rank - p.xp_rank AS xp_rank_diff, ";
		$sql = $sql . "p.x, p.y, p.z, p.rulername as ruler_name, p.planetname as planet_name, p.race, p.xp, ";
		$sql = $sql . "p.size, p.size - q.size AS size_growth, ";
		$sql = $sql . "p.value, p.value - q.value AS value_growth, ";
		$sql = $sql . "p.score, p.score - q.score AS score_growth, ";
		$sql = $sql . "i.nick, a.name as alliance_long ";
		$sql = $sql . "FROM planet_dump q, planet_dump p ";
		$sql = $sql . "LEFT JOIN intel i ON p.id = i.pid ";
		$sql = $sql . "LEFT JOIN alliance_canon a ON i.alliance_id = a.id ";
		$sql = $sql . "WHERE p.tick = (SELECT max_tick()) AND q.tick = GREATEST(p.tick - 2, 37) ";
		$sql = $sql . "AND q.id = p.id ";
		$sql = $sql . "AND p.x = " . $this->x . " AND p.y = " . $this->y . " ";
		$sql = $sql . "ORDER BY z";
		
		return $this->db->query($sql);
	}

	public function selectGalaxy()
	{
		$sql = "SELECT g.score_rank, h.score_rank - g.score_rank AS score_rank_diff, ";
		$sql = $sql . "g.value_rank, h.value_rank - g.value_rank AS value_rank_diff, ";
		$sql = $sql . "g.size_rank, h.size_rank - g.size_rank AS size_rank_diff, ";
		$sql = $sql . "g.xp_rank, h.xp_rank - g.xp_rank AS xp_rank_diff, ";
		$sql = $sql . "g.x, g.y, g.name, g.xp, ";
		$sql = $sql . "g.size, g.size - h.size AS size_growth, ";
		$sql = $sql . "g.value, g.value - h.value AS value_growth, ";
		$sql = $sql . "g.score, g.score - h.score AS score_growth ";
		$sql = $sql . "FROM galaxy_dump g, galaxy_dump h ";
		$sql = $sql . "WHERE g.tick = (SELECT max_tick()) AND h.tick = GREATEST(g.tick - 2, 37) ";
		$sql = $sql . "AND h.x = g.x AND h.y = g.y ";
		if($this->x != "" && $this->y != "")
		{
			$sql = $sql . "AND g.x = " . $this->x . " AND g.y = " . $this->y;
			return $this->db->query($sql, true);
		}
		else
		{
			if($this->page == "") $this->page = 1;
			$sql = $sql . "ORDER BY " . $this->order . " " . $this->direction . " LIMIT 50 ";
			$sql = $sql . "OFFSET " . (($this->page - 1) * 50);
			return $this->db->query($sql);
		}
	}
	
	public function numberOfGalaxies()
	{
		$sql = "SELECT COUNT(*) AS count FROM galaxy_dump WHERE tick = (SELECT max_tick())";
		$result = $this->db->query($sql, true);
		return $result['count'];
	}
}
?>