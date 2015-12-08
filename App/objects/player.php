<?php

class Player{
	/**
	* What this class needs to fetch
	* Name
	* born
	* nr on tshirt
	* nr of goals
	* nr of goals for current team
	* how many of those goals where penalty kicks
	* nr of finishes (Avslut)
	* height
	* weight
	* shot vs goal ratio
	* total matches played
	* current team
	* past teams
	* when they left past teams
	* player picture
	**/
	
	private $id;
	private $fName;
	private $sName;
	private $birthDate;
	private $height;
	private $weight;
	private $avatar;
	
	private $goals;
	private $penaltyGoals;
	private $curTeamGoals;
	private $finishes;
	private $matches;

	private $pastTeams;
	private $pastTeamsTime;
	private $curTeam;
	private $shirtNr;
	private $leftShirtNr;


	function __construct($id, $fName, $sName, $birthDate, $height, $weight, $avatar){
		$this->id = $id;
		$this->fName = $fName;
		$this->sName = $sName;
		$this->birthDate = $birthDate;
		$this->height = $height;
		$this->weight = $weight;
		$this->avatar = $avatar;

		$this->goals = 0;
		$this->penaltyGoals = 0;
		$this->curTeamGoals = 0;
		$this->finishes = 0;
		$this->matches = 0;

		$this->pastTeams = array();
		$this->pastTeamsTime = array();
		$this->curTeam = array();
		$this->shirtNr = array();
		$this->leftShirtNr = array();
	}

	function addGoals($goals){
		$this->goals += $goals;
	}

	function addPenaltyGoals($goals){
		$this->penaltyGoals += $goals;
	}

	function addTeamGoal($goals){
		$this->curTeamGoals += $goals;
	}

	function addFinishes($finishes){
		$this->finishes += $finishes;
	}

	function addPastTeam($id,$left){
		array_push($this->pastTeams, $id);
		array_push($this->pastTeamsTime, $left);
	}

	function addTeam($id){
		array_push($this->curTeam, $id);
	}

	function addShirtNr($nr){
		array_push($this->shirtNr, $nr);
	}

	function addLeftShirtNr($nr){
		array_push($this->leftShirtNr, $nr);
	}

	function addMatches($matches){
		$this->matches += $matches;
	}
}
?>