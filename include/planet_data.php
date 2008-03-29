<?php
include_once('include/utils.php');

class PlanetData
{
	public $id;
	public $x;
	public $y;
	public $z;
	public $ruler_name;
	public $planet_name;
	public $nick;
	public $fakenick;
	public $alliance;
	public $channel;
	public $amplifiers;
	public $distorters;
	public $nap;
	public $username;
	public $page;
	public $nick_search;
	public $order;
	public $direction;
	public $count;
	public $nappedOnly;
	
	private $db;

	public function PlanetData()
	{
		global $db;
		$this->db = $db;
	}
	
	public function top10Planets()
	{
		$sql = "SELECT p.score_rank, q.score_rank - p.score_rank AS score_rank_diff, ";
		$sql = $sql . "p.x, p.y, p.z, p.planetname as planet_name, p.race, ";
		$sql = $sql . "p.size, p.size - q.size AS size_growth, ";
		$sql = $sql . "p.score, p.score - q.score AS score_growth, ";
		$sql = $sql . "a.name AS alliance ";
		$sql = $sql . "FROM planet_dump q, planet_dump p ";
		$sql = $sql . "LEFT JOIN intel n ON p.id = n.pid ";
		$sql = $sql . "LEFT JOIN alliance_canon AS a ON n.alliance_id = a.id ";
		$sql = $sql . "WHERE p.tick = (SELECT max_tick()) AND q.tick = GREATEST(p.tick - 2, 37) ";
		$sql = $sql . "AND q.id = p.id ";
		$sql = $sql . "ORDER BY score DESC LIMIT 10";
		
		return $this->db->query($sql);
	}

	public function selectPlanet()
	{
		global $session;
		
		$sql = "SELECT p.id, p.score_rank, q.score_rank - p.score_rank AS score_rank_diff, ";
		$sql = $sql . "p.value_rank, q.value_rank - p.value_rank AS value_rank_diff, ";
		$sql = $sql . "p.size_rank, q.size_rank - p.size_rank AS size_rank_diff, ";
		$sql = $sql . "p.xp_rank, q.xp_rank - p.xp_rank AS xp_rank_diff, ";
		$sql = $sql . "p.x, p.y, p.z, p.rulername as ruler_name, p.planetname as planet_name, p.race, p.xp, ";
		$sql = $sql . "p.size, p.size - q.size AS size_growth, ";
		$sql = $sql . "p.value, p.value - q.value AS value_growth, ";
		$sql = $sql . "p.score, p.score - q.score AS score_growth ";
		
		if ($session->hasAccess(100))
		{
			$sql = $sql . ",n.nick, n.fakenick, n.reportchan, n.nap, a.name AS alliance ";
		}
		
		$sql = $sql . "FROM planet_dump q, planet_dump p ";
		$sql = $sql . "LEFT JOIN intel n ON p.id = n.pid ";
		$sql = $sql . "LEFT JOIN alliance_canon a ON n.alliance_id = a.id ";
		$sql = $sql . "WHERE p.tick = (SELECT max_tick()) AND q.tick = GREATEST(p.tick - 2, 37) ";
		$sql = $sql . "AND q.id = p.id ";
		if($this->nick_search != "")
		{
			$sql = $sql . "AND lower(n.nick) LIKE lower('%" . $this->nick_search . "%') ";
			if($this->count > 1)
			{
				$result = $this->db->query($sql);
			}
			else
			{
				$result = $this->db->query($sql, true);
			}
			if($result != "")
			{
				$this->x = $result['x'];
				$this->y = $result['y'];
				$this->z = $result['z'];
			}
			else
			{
				$this->x = 0;
				$this->y = 0;
				$this->z = 0;
			}
			return $result;
		}
		elseif($this->x != "" && $this->y != "" && $this->z != "")
		{
			$sql = $sql . "AND p.x = " . $this->x . " AND p.y = " . $this->y . " AND p.z = " . $this->z;
			return $this->db->query($sql, true);
		}
		elseif($this->username != "")
		{
			$sql = $sql . "AND lower(n.nick) = lower('" . $this->username . "') ";
			return $this->db->query($sql, true);
		}
		else
		{
			if($this->nappedOnly == 1)
			{
				$sql = $sql . "AND n.nap = 't' ";
			}
			if($this->page == "") $this->page = 1;
			$sql = $sql . "ORDER BY " . $this->order . " " . $this->direction . " LIMIT 50 ";
			$sql = $sql . "OFFSET " . (($this->page - 1) * 50);
			return $this->db->query($sql);
		}
	}

	public function selectPlanetHistory()
	{
		$sql = "SELECT p.score, p.value, p.size, p.xp, p.tick ";
		$sql = $sql . "FROM planet_dump p, planet_dump q ";
		$sql = $sql . "WHERE q.x = " . $this->x . " AND q.y = " . $this->y . " AND q.z = " . $this->z . " ";
		$sql = $sql . "AND q.id = p.id  ";
		$sql = $sql . "AND q.tick = (SELECT max_tick()) ";
		$sql = $sql . "ORDER BY p.tick ";
		return $this->db->query($sql);
	}
	
	public function maxAndMinValues()
	{
		$sql = "SELECT MAX(p.score) AS max_score, MAX(p.value) AS max_value, ";
		$sql = $sql . "MAX(p.size) AS max_size, MAX(p.xp) AS max_xp, ";
		$sql = $sql . "MIN(p.tick) AS min_tick, MAX(p.tick) AS max_tick ";
		$sql = $sql . "FROM planet_dump p, planet_dump q ";
		$sql = $sql . "WHERE q.x = " . $this->x . " AND q.y = " . $this->y . " AND q.z = " . $this->z . " ";
		$sql = $sql . "AND q.id = p.id ";
		$sql = $sql . "AND q.tick = (SELECT max_tick()) ";
		return $this->db->query($sql, true);
	}
	
	public function numOfNicks()
	{
		$sql = "SELECT COUNT(*) AS count FROM intel ";
		$sql = $sql . "WHERE lower(nick) LIKE lower('%" . $this->nick_search . "%') ";
		$result = $this->db->query($sql, true);
		return $result['count'];
	}
	
	public function updatePlanetNotes()
	{
		$sql = "UPDATE intel SET ";
		$sql = $sql . "nick = " . format_sql_string($this->nick) . ", ";
		$sql = $sql . "fakenick = " . format_sql_string($this->fakenick) . ", ";
		$sql = $sql . "alliance = " . format_sql_string($this->alliance) . ", ";
		$sql = $sql . "channel = " . format_sql_string($this->channel) . ", ";
		$sql = $sql . "phone = " . format_sql_string($this->phone) . ", ";
		$sql = $sql . "amplifiers = " . format_null($this->amplifiers) . ", ";
		$sql = $sql . "distorters = " . format_null($this->distorters) . ", ";
		$sql = $sql . "nap = " . $this->nap . " ";
		$sql = $sql . "WHERE rulername = '" . $this->ruler_name . "' ";
		$sql = $sql . "AND planetname = '" . $this->planet_name . "'";
		
		return $this->db->exec($sql);
	}

	public function insertPlanetNotes()
	{
		$sql = "INSERT INTO intel (rulername, planetname, ";
		$sql = $sql . "nick, fakenick, alliance, channel, phone, amplifiers, distorters, nap) VALUES (";
		$sql = $sql . format_sql_string($this->ruler_name) . ", ";
		$sql = $sql . format_sql_string($this->planet_name) . ", ";
		$sql = $sql . format_sql_string($this->nick) . ", ";
		$sql = $sql . format_sql_string($this->fakenick) . ", ";
		$sql = $sql . format_sql_string($this->alliance) . ", ";
		$sql = $sql . format_sql_string($this->channel) . ", ";
		$sql = $sql . format_sql_string($this->phone) . ", ";
		$sql = $sql . format_null($this->amplifiers) . ", ";
		$sql = $sql . format_null($this->distorters) . ", ";
		$sql = $sql . $this->nap . ") ";
		
		return $this->db->exec($sql);
	}

	public function numberOfPlanets()
	{
		$sql = "SELECT COUNT(*) AS count FROM planet_dump p LEFT JOIN intel i ";
		$sql = $sql . "ON p.id = i.pid ";
		$sql = $sql . "WHERE p.tick = (SELECT MAX(tick) FROM updates) ";
		if($this->nappedOnly == 1)
		{
			$sql = $sql . "AND nap = 1 ";
		}
		$result = $this->db->query($sql, true);
		return $result['count'];
	}
	
	public function outgoingFleets()
	{
		$sql  = "SELECT fleet_name, fleet_size, landing_tick, mission, t.x, t.y, t.z, a.name ";
		$sql .= "FROM fleet ";
		$sql .= "INNER JOIN planet_dump t ON t.id = target ";
		$sql .= "INNER JOIN intel i ON i.pid = target ";
		$sql .= "INNER JOIN alliance_canon a ON a.id = i.alliance_id "; 
		$sql .= "WHERE owner_id = (SELECT o.id AS id FROM planet_dump o WHERE o.tick = (SELECT max_tick()) ";
		$sql .= "AND o.x = ". $this->x . " AND o.y = ".$this->y." AND o.z = ".$this->z.") ";
		$sql .= "AND t.tick = (SELECT max_tick()) ";
		$sql .= "ORDER BY landing_tick DESC";

		return $this->db->query($sql);
	}
	
	public function incomingFleets()
	{
		$sql  = "SELECT fleet_name, fleet_size, landing_tick, mission, o.x, o.y, o.z, a.name ";
		$sql .= "FROM fleet ";
		$sql .= "INNER JOIN planet_dump o ON o.id = owner_id ";
		$sql .= "INNER JOIN intel i ON i.pid = owner_id ";
		$sql .= "INNER JOIN alliance_canon a ON a.id = i.alliance_id "; 
		$sql .= "WHERE target = (SELECT t.id AS id FROM planet_dump t WHERE t.tick = (SELECT max_tick()) ";
		$sql .= "AND t.x = ". $this->x . " AND t.y = ".$this->y." AND t.z = ".$this->z.") ";
		$sql .= "AND o.tick = (SELECT max_tick()) ";
		$sql .= "ORDER BY landing_tick DESC";
		
		return $this->db->query($sql);
	}

	public function allianceOptions()
	{
		$sql = "SELECT alliance as name, alliance as short_name FROM intel ORDER by alliance";
		$result = $this->db->query($sql);
		$data = array();
		foreach($result as $alliance)
		{
			$data[$alliance['short_name']] = $alliance['name'];
		}
		return $data;
	}
	
	public function planetChannels()
	{
		$sql = "SELECT i.channel, a.name AS alliance, i.nick, p.x, p.y, p.z ";
		$sql = $sql . "FROM pa_planet p, pa_tick t, pa_planet_intel i ";
		$sql = $sql . "LEFT JOIN pa_alliance_intel a ON i.alliance = a.short_name ";
		$sql = $sql . "WHERE p.ruler_name = i.ruler_name AND p.planet_name = i.planet_name ";
		$sql = $sql . "AND p.tick = t.planet_tick ";
		$sql = $sql . "AND i.channel IS NOT null ";
		if($this->channel != "")
		{
			$sql = $sql . "AND i.channel = '" . $this->channel . "' ";
		}
		elseif($this->alliance != "")
		{
			$sql = $sql . "AND a.short_name = '" . $this->alliance . "' ";
		}
		$sql = $sql . "ORDER BY " . $this->order . " " . $this->direction . " LIMIT 50 ";
		if($this->page == "") $this->page = 1;
		$sql = $sql . "OFFSET " . (($this->page - 1) * 50);
		
		return $this->db->query($sql);
	}
	
	public function numberOfPlanetsWithChannels()
	{
		$sql = "SELECT COUNT(*) AS count ";
		$sql = $sql . "FROM pa_planet p, pa_tick t, pa_planet_intel i ";
		$sql = $sql . "LEFT JOIN pa_alliance_intel a ON i.alliance = a.short_name ";
		$sql = $sql . "WHERE p.ruler_name = i.ruler_name AND p.planet_name = i.planet_name ";
		$sql = $sql . "AND p.tick = t.planet_tick ";
		$sql = $sql . "AND i.channel IS NOT null ";
		if($this->channel != "")
		{
			$sql = $sql . "AND i.channel = '" . $this->channel . "' ";
		}
		elseif($this->alliance != "")
		{
			$sql = $sql . "AND a.short_name = '" . $this->alliance . "' ";
		}
		
		$result = $this->db->query($sql, true);
		return $result['count'];
	}
	
	public function planetNicks()
	{
		$sql = "SELECT p.x, p.y, p.z, i.nick, i.fakenick, a.name AS alliance ";
		$sql = $sql . "FROM pa_planet p, pa_tick t, pa_planet_intel i ";
		$sql = $sql . "LEFT JOIN pa_alliance_intel a ON i.alliance = a.short_name ";
		$sql = $sql . "WHERE p.ruler_name = i.ruler_name AND p.planet_name = i.planet_name ";
		$sql = $sql . "AND p.tick = t.planet_tick ";
		$sql = $sql . "AND (i.nick IS NOT null OR i.fakenick IS NOT null) ";
		$sql = $sql . "ORDER BY " . $this->order . " " . $this->direction;// . " LIMIT 50 ";
		//if($this->page == "") $this->page = 1;
		//$sql = $sql . "OFFSET " . (($this->page - 1) * 50);

		return $this->db->query($sql);
	}

	public function numberOfPlanetsWithNicks()
	{
		$sql = "SELECT COUNT(*) AS count ";
		$sql = $sql . "FROM pa_planet p, pa_tick t, pa_planet_intel i ";
		$sql = $sql . "LEFT JOIN pa_alliance_intel a ON i.alliance = a.short_name ";
		$sql = $sql . "WHERE p.ruler_name = i.ruler_name AND p.planet_name = i.planet_name ";
		$sql = $sql . "AND p.tick = t.planet_tick ";
		$sql = $sql . "AND (i.nick IS NOT null OR i.fakenick IS NOT null) ";

		$result = $this->db->query($sql, true);
		return $result['count'];
	}
}