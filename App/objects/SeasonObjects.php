<?php
  class SeasonScore{
    private $teams = array();
    private $teamIndexes = array();
    private $i = 0;
    private $fetchArr;

    public function add($a, $b){
      if(!isset($this->teams[$a->team_id])){
        $this->teams[$a->team_id] = new stdClass();
        $this->teams[$a->team_id]->score = 0;
        $this->teams[$a->team_id]->wins = 0;
        $this->teams[$a->team_id]->matches = 0;
        $this->teams[$a->team_id]->loses = 0;
        $this->teams[$a->team_id]->scoreDiff = 0;
        $this->teams[$a->team_id]->goals = 0;
      }
      if(!isset($this->teams[$b->team_id])){
        $this->teams[$b->team_id] = new stdClass();
        $this->teams[$b->team_id]->score = 0;
        $this->teams[$b->team_id]->wins = 0;
        $this->teams[$b->team_id]->matches = 0;
        $this->teams[$b->team_id]->loses = 0;
        $this->teams[$b->team_id]->scoreDiff = 0;
        $this->teams[$b->team_id]->goals = 0;

      }
      $this->sorted = false;
      if($a->teamGoals > $b->teamGoals){
      //  var_dump($a);
        echo $a->team_id;
        try{
          $this->teams[$a->team_id]->score =+ 2;
          $this->teams[$a->team_id]->wins =+ 1;
          $this->teams[$a->team_id]->matches =+ 1;
          $this->teams[$b->team_id]->loses =+ 1;
          $this->teams[$a->team_id]->scorediff=+ $a->teamGoals - $b->teamgoals;
          $this->teams[$a->team_id]->goals=+$a->teamGoals;
          $this->teams[$b->team_id]->goals=+$b->teamGoals;
          $this->teams[$a->team_id]->name = $a->org_name . " " . $a->team_name;
          array_push($this->teamIndexes, $a->team_id);
          return true;
        }
        catch(Exeption $e){

        }

      }
      elseif($a->teamGoals < $b->teamGoals){
        try{
          $this->teams[$b->team_id]->score =+ 2;
          $this->teams[$b->team_id]->wins =+ 1;
          $this->teams[$b->team_id]->matches =+ 1;
          $this->teams[$a->team_id]->loses =+ 1;
          $this->teams[$b->team_id]->scorediff=+ $b->teamGoals - $a->teamgoals;
          $this->teams[$a->team_id]->goals=+$a->teamGoals;
          $this->teams[$b->team_id]->goals=+$b->teamGoals;
          $this->teams[$b->team_id]->name = $b->org_name . " " . $b->team_name;
          array_push($this->teamIndexes, $b->team_id);
          return true;
        }
        catch(Exeption $e){

        }

      }
      elseif($a->teamGoals == $b->teamGoals){
        try{
          $this->teams[$a->team_id]->goals=+$a->teamGoals;
          $this->teams[$b->team_id]->goals=+$b->teamGoals;

          $this->teams[$a->team_id]->score =+ 1;
          $this->teams[$a->team_id]->ties =+ 1;
          $this->teams[$a->team_id]->matches =+ 1;
          $this->teams[$a->team_id]->name = $a->org_name . " " . $a->team_name;
          $this->teams[$a->team_id]->scorediff=+ $a->teamGoals - $b->teamgoals;
          array_push($this->teamIndexes, $a->team_id);

          $this->teams[$b->team_id]->score =+ 1;
          $this->teams[$b->team_id]->ties =+ 1;
          $this->teams[$b->team_id]->matches =+ 1;
          $this->teams[$b->team_id]->scorediff=+ $b->teamGoals - $a->teamgoals;
          $this->teams[$b->team_id]->name = $b->org_name . " " . $b->team_name;
          array_push($this->teamIndexes, $b->team_id);
          return true;
        }
        catch(Exeption $e){

        }
      }
      else{
        return false;
      }
    }
    public function fetchAll(){
      return $this->sort();
    }
    private function sort(){
      array_unique($this->teamIndexes);
      $r = array();
      foreach ($teamIndexes as $key => $value) {
        array_push($r, $this->teams[$value]);
        $r[$key]->id = $value;
      }
      return array_orderby($r, 'score', SORT_DESC, 'scorediff', SORT_DESC, 'goals', SORT_DESC);
    }
    public function fetch(){
      if(!isset($this->fetchArr)){
        $this->fetchArr = $this->sort();
      }
      $this->i =+1;
      return $this->fetchArr[$i-1];
    }
    public function reset(){
      unset($this->fetchArr);
      return true;
    }
    private function NextIndex(){
      $this->i=+1;
      return $this->i-1;
    }

  }
  class teamStat{
    private $team_id;
    private $win;
    private $ties;
    private $loses;
    private $goals;
    private $scoreDiff;
    private $name;


    //add
    public function addScoreDiff($d){
      $this->scoreDiff+=$d;
    }
    public function addLoss(){
      $this->loses+=1;
    }
    public function addWin(){
      $this->wins+=1;
    }
    public function addTie(){
      $this->ties+=1;
    }
    public function addGoal($g){
      $this->ties+=$g;
    }
    public function addId($id){
      $this->team_id = $id;
    }
    public function addName(){
      $this->name = $name;
    }

    //get
    public function getScoreDiff(){
    return   $this->scoreDiff;
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
    public function getGoals(){
      return $this->ties;
    }
    public function getTeamId(){
      return $this->team_id;
    }
    public function getName(){
      return $this->name;
    }

  }


?>
