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
	private $roleName;


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
	public function addRoleName($roleName){
		$this->roleName = $roleName;
	}
	public function addGoals($goals){
		$this->goals += $goals;
	}

	public function addPenaltyGoals($goals){
		$this->penaltyGoals += $goals;
	}

	public function addTeamGoal($goals){
		$this->curTeamGoals += $goals;
	}

	public function addFinishes($finishes){
		$this->finishes += $finishes;
	}

	public function addPastTeam($id,$left){
		array_push($this->pastTeams, $id);
		array_push($this->pastTeamsTime, $left);
	}

	public function addTeam($id){
		array_push($this->curTeam, $id);
	}

	public function addShirtNr($nr){
		array_push($this->shirtNr, $nr);
	}

	public function addLeftShirtNr($nr){
		array_push($this->leftShirtNr, $nr);
	}

	public function addMatches($matches){
		$this->matches += $matches;
	}
	public function getRoleName(){
		return $this->roleName;
	}
    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of Name
     *
     * @return mixed
     */
    public function getFName()
    {
        return $this->fName;
    }

    /**
     * Get the value of Name
     *
     * @return mixed
     */
    public function getSName()
    {
        return $this->sName;
    }

    /**
     * Get the value of Birth Date
     *
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Get the value of Height
     *
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Get the value of Weight
     *
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Get the value of Avatar
     *
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Get the value of Goals
     *
     * @return mixed
     */
    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * Get the value of Penalty Goals
     *
     * @return mixed
     */
    public function getPenaltyGoals()
    {
        return $this->penaltyGoals;
    }

    /**
     * Get the value of Cur Team Goals
     *
     * @return mixed
     */
    public function getCurTeamGoals()
    {
        return $this->curTeamGoals;
    }

    /**
     * Get the value of Finishes
     *
     * @return mixed
     */
    public function getFinishes()
    {
        return $this->finishes;
    }

    /**
     * Get the value of Matches
     *
     * @return mixed
     */
    public function getMatches()
    {
        return $this->matches;
    }

    /**
     * Get the value of Past Teams
     *
     * @return mixed
     */
    public function getPastTeams()
    {
        return $this->pastTeams;
    }

    /**
     * Get the value of Past Teams Time
     *
     * @return mixed
     */
    public function getPastTeamsTime()
    {
        return $this->pastTeamsTime;
    }

    /**
     * Get the value of Cur Team
     *
     * @return mixed
     */
    public function getCurTeam()
    {
        return $this->curTeam;
    }

    /**
     * Get the value of Shirt Nr
     *
     * @return mixed
     */
    public function getShirtNr()
    {
        return $this->shirtNr;
    }

    /**
     * Get the value of Left Shirt Nr
     *
     * @return mixed
     */
    public function getLeftShirtNr()
    {
        return $this->leftShirtNr;
    }

}
?>
