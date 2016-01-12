<?php
  class Match{
    private $id;
    private $startTime; //Stored in unix time?
    private $homeTeam; //Store a team object here?
    private $goneTeam; //Store a team object here?
    private $arena;
    private $audience;
    private $status;

    function __construct($id, $startTime, $homeTeam, $goneTeam, $arena, $audience, $status){
      $this->id = $id;
      $this->startTime = $startTime;
      $this->homeTeam = $homeTeam;
      $this->goneTeam = $goneTeam;
      $this->arena = $arena;
      $this->audience = $audience;
      $this->status = $status;
    }
    public function getStartTime(){
        return $this->startTime;
    }
    public function getEndTime(){

    }

    public function getHomeTeam(){
      return $this->homeTeam;
    }

    public function getGoneTeam(){
      return $this->goneTeam;
    }

    public function getArena(){
      return $this->arena;
    }

    public function getStatus(){
      return $this->status;
    }

    public function getGoalsAsString(){
      $select = new Select();
      $home = $select->getTeamGoal($this->id, $this->homeTeam);
      $gone = $select->getTeamGoal($this->id, $this->goneTeam);
      return "$home - $gone";
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
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set the value of Start Time
     *
     * @param mixed startTime
     *
     * @return self
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Set the value of Home Team
     *
     * @param mixed homeTeam
     *
     * @return self
     */
    public function setHomeTeam($homeTeam)
    {
        $this->homeTeam = $homeTeam;

        return $this;
    }

    /**
     * Set the value of Gone Team
     *
     * @param mixed goneTeam
     *
     * @return self
     */
    public function setGoneTeam($goneTeam)
    {
        $this->goneTeam = $goneTeam;

        return $this;
    }

    /**
     * Set the value of Arena
     *
     * @param mixed arena
     *
     * @return self
     */
    public function setArena($arena)
    {
        $this->arena = $arena;

        return $this;
    }

    /**
     * Get the value of Audience
     *
     * @return mixed
     */
    public function getAudience()
    {
        return $this->audience;
    }

    /**
     * Set the value of Audience
     *
     * @param mixed audience
     *
     * @return self
     */
    public function setAudience($audience)
    {
        $this->audience = $audience;

        return $this;
    }

    /**
     * Set the value of Status
     *
     * @param mixed status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }


}
?>
