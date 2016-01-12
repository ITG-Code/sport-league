<?php

require_once('database/select.php');

class Team{

	private $id;
	private $name;
	private $org;

	private $wins;
	private $loses;
	private $ties;
	private $nemesis;
	private $mvp;
	private $members;
	private $points;
	private $seasons;
	private $avatar;

	function __construct($id){
		$this->id = $id;
		
		$this->name = '';
		$this->org = '';
		$this->wins = 0;
		$this->loses = 0;
		$this->ties = 0;
		$this->nemesis = 0;
		$this->mvp = 0;
		$this->members = array();
		$this->points = 0;
		$this->seasons = 0;
	}

	public function getData(){
		$select = new Select();
		$this->members = $select->getTeamPlayers($this->id);
		
		$stats = $select->getTeamStat(1,$this->id);
		if($stats['wins'] >= 0 && is_numeric($stats['wins'])){
			$this->wins = $stats['wins'];
		}
		if($stats['points'] >= 0 && is_numeric($stats['points'])){
			$this->points = $stats['points'];
		}
		if($stats['loses'] >= 0 && is_numeric($stats['loses'])){
			$this->loses = $stats['loses'];
		}
		if($stats['ties'] >= 0 && is_numeric($stats['ties'])){
			$this->ties = $stats['ties'];
		}

		$this->nemesis = $select->getTeamNemesis($this->id);

		$this->mvp = $select->getMVP($this->id);
		$val = $select->getTeamAvatar($this->id);
		$this->avatar = $val->avatar;
	}

	public function getId(){
		return $this->id;
	}

	public function getName(){
		return $this->name;
	}

	public function getOrg(){
		return $this->org;
	}

	public function getWins(){
		return $this->wins;
	}

	public function getLoses(){
		return $this->loses;
	}

	public function getTies(){
		return $this->ties;
	}

	public function getNemesis(){
		return $this->nemesis;
	}

	public function getMVP(){
		return $this->mvp;
	}

	public function getMembers(){
		return $this->members;
	}

	public function getPoints(){
		return $this->points;
	}

	public function getAvatar(){
		return $this->avatar;
	}
}
?>