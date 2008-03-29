<?php
class Database
{
	function Database($host, $db, $user, $pass)
	{
		$this->host = $host;
		$this->db = $db;
		$this->user = $user;
		$this->pass = $pass;
		$this->conn = 'host=%s port=5432 dbname=%s user=%s password=%s';
		$this->link = pg_connect(sprintf($this->conn, $this->host, $this->db, $this->user, $this->pass));
	}
	
	function query($sql, $single = false)
	{
		if($single)
		{
			$result = pg_query($this->link, $sql);
			return pg_fetch_assoc($result);
		}
		else
		{
			$data = array();
			$result = pg_query($this->link, $sql);
			while($row = pg_fetch_assoc($result))
			{
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function exec($sql)
	{
		$res = @pg_query($this->link, $sql);
		return @pg_affected_rows($res);
	}
	
	function close()
	{
		pg_close($this->link);
	}
}
?>