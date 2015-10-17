<?php
  class Match{
    private $id;
    private $startTime; //Stored in unix time?
    private $homeTeam; //Store a team object here?
    private $goneTeam; //Store a team object here?
    private $arena;
    private $audience;
    private $status;

    function __construct($homeTeam, $goneTeam){
      if(!(is_numeric($homeTeam) && !($homeTeam % 1 == 0) && !($homeTeam > 0))){
        throw new Exeption("homeTeam argument was not set correctly, expected an int");
      }
      else{
          $this->homeTeam = $homeTeam;
      }
      if(!(is_numeric($goneTeam) && !($goneTeam % 1 == 0) && !($goneTeam > 0))){
        throw new Exeption("goneTeam argument was not set correctly, expected an int");
      }
      else{
          $this->goneTeam = $goneTeam;
      }
    }
    public function getStartTime(){

    }
    public function getEndTime(){

    }
  }



 ?>
