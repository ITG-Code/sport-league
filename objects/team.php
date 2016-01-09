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
		$this->wins = $stats['wins'];
		$this->points = $stats['points'];
		$this->loses = $stats['loses'];
		$this->ties = $stats['ties'];

		$this->nemesis = $select->getTeamNemesis($this->id);

		$this->mvp = $select->getMVP($this->id);
	}
}
?>