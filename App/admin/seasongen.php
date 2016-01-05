<?php
/**
 *
 */

$s = new SeasonGen(array(1,2,3,4,5,6));

class SeasonGen{
  private $teams = array();
  private $teamScheduleOrder = array();
  private $matchIndex = 0;
  private $matches;

  //argument should be an array of team_season_link IDs
  function __construct($t){
    foreach ($t as $key => $value) {
      if(is_numeric($value) && !($value % 1 == 0) && !($value > 0)){
        throw new Exception("$value isn't a valid teamID");
      }
      else{
        array_push($this->teams, $value);
      }
    }
    if(!(count($this->teams)%2 == 0)){
      array_push($this->teams, 0);
    }
  }
  public function makeRobin(){
    $r1 = $this->runRobin();
    $r2 = $this->runRobin();
    $this->teams = array_reverse($this->teams);
    $m = array_merge($r1,$r2);
    shuffle($m);
    $done = $this->removeDummies($m);
    $this->matches = $done;
  }
  private function removeDummies($a){
    for($i = 0; $i < count($a);$i++){
      if($a[$i][0] == 0 || $a[$i][1] == 0){
        array_splice($a, $i);

      }
    }
    return $a;
  }
  private function runRobin(){
    $retval = array();
    for($j = 0; $j < count($this->teams)-1;$j++){
      for ($i=0; $i < count($this->teams)/2; $i++) {
        echo $this->teams[$i]." ". $this->teams[count($this->teams)-1-$i]."<br>\n";
        array_push($retval, array($this->teams[$i], $this->teams[count($this->teams)-1-$i]));
      }

      $t = $this->teams[1];
      array_splice($this->teams,1,1);
      array_push($this->teams,$t);
    }
    return $retval;
  }
  public function getNextMatch(){
    $this->matchIndex++;
    if($this->matchIndex <= count($this->teams)){
      return false;
    }
    else{
      return $this->matches[$this->matchIndex-1];
    }
  }
}

 ?>
