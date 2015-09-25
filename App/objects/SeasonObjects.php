<?php
  class SeasonScore{
    private $teams = array();
    private $teamIndexes = array();
    private $i = 0;
    private $fetchArr;
    function __construct(){

    }


    public function add($a, $b){
      $this->sorted = false;
      if($a->teamGoals > $b->teamGoals){
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
      elseif($a->teamGoals < $b->teamGoals){
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
      elseif($a->teamGoals == $b->teamGoals){
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


?>
