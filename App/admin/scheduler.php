<?php
class Scheduler{
  /**
  * This class is supposed to take an array of teams, send the teams to SeasonGen and then put dates
  * on the returning matches
  **/

  private $teams;
  private $matchOverride;
  private $allowedDays;
  private $windowOffset;
  private $startWindow;
  private $matchMax;
  private $matches = array();
  function _construct($teams, $allowedDays, $matchOverride, $times, $matchMax){
    /**
    * teams:          an array of ints that represent the teams that are to play
    * allowedDays:    what days the matches are allowed to be played on (default all)
    * matchOverride:  true or false depending on if the admin wants multiple matches to be played at once
    * times:          an array consisting of two unixTime values the first one being the opening of the time window and the second one being the closing of the time window
    * matchMax:       the max amount of matches allowed to be played in one day
    **/

    //Checks wether the teams are correctly formated ints
    if(isset($teams)){
      foreach ($teams as $key => $value) {
        if(!(is_numeric($value) && !($value % 1 == 0) && !($value > 0))){
          throw new Exeption("first argument was not set correctly, expected an array of ints");
        }
        else{
            array_push($this->teams, $value);
        }
      }
    }
    else{
      throw new Exeption("first argument was not set correctly, expected an array of ints");
    }


    //Checks for invalid day arguments and prepares the days for futher calculations
    $dayArray;
    if(isset($allowedDays) || strlen($allowedDays) <= 0){
      /**
      * Formats 1-7, Mon-Sun and Monday-Sunday to 1-7
      *
      **/
      $dayArray = explode(',',$allowedDays);
      for($i = 0; $i < count($allowedDays);$i++){
        $allowedDays[$i] = trim($allowedDays[$i]);
      }
      $strDays = array('Monday','Tuesday','Wednesday','Thursday', 'Friday', 'Saturday', 'Sunday');
      //
      foreach ($dayArray as $dk => $dv) {
        if(!is_numeric($dayArray[$sk])){
          foreach ($strDays as $sk => $sv) {
            if(strtolower($sv) == strtolower($dv) || strtolower($sv) == strtolower(substr($dv, 0, 3))){
              array_push($this->allowedDays, $sk);
            }
          }
        }
        else{
            //This is where you end up if the $allowedDays[$dk] is numeric
          if(is_numeric($value) && ($value % 1 == 0) && ($value > 0) && $value <= 1 && $value >= 7){
            array_push($this->allowedDays, $value-1);
          }
          else{
            throw new Exeption($value. " is not a valid entry as a Day");
          }

        }

      }
    }
    //This is where you end up if the $allowedDays are not set
    else{
       $this->allowedDays = array(0,1,2,3,4,5,6);
    }

    //Checks if the matchOverride is a boolean, if not it outputs an error
    if(is_bool($matchOverride)){
      $this->matchOverride = $matchOverride;
    }
    else{
      throw new Exception("Add error message for matchOverride");
    }

    //Checks and fixes the time
    if($times[0] > $times[1]){
      throw new Exception("Start time can not be after the closing time");
    }
    else{
      $this->startWindow = $times[0];
      $this->windowOffset = $times[0] - $times[1];
    }



    //Checks and organizes the max amount of matches
    if(is_numeric($matchMax) && $matchMax%1 == 0 && $matchMax > 0){
        $this->matchMax = $matchMax;
    }
  }
  public function generate(){
    /**
    *This is where the matches additional info is generated compared to SeasonGen();
    **/
    
  }

}


?>
