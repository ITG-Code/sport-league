<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
  include("../database/dbSetup.php");
  include("../database/select.php");
  require_once('../objects/player.php');
  require_once('../objects/match.php');

  $s = new Select();
  $res = $s->getMatchMembers($_GET['match']);
  $sendTeam;
  $teams = $s->getHomerFromGame($_GET['match']);
  if($_GET['home'] == 1){
    $sendTeam = $teams->home_team_id;
    $string = "home";
  }
  else{
    $sendTeam = $teams->gone_team_id;
    $string = "gone";
  }
  for($j = 1; $j < $_GET['amount']+1;$j++){
      echo '<select  class="form-control" name="match_'. $string . "_" . $j . '" placeholder="Select Player">'."\n";
    for($i = 0; $i < count($res);$i++){
      if($res[$i]->team_id == $sendTeam){
        echo "<option value=\"" . $res[$i]->game_person_id . "\">" . $res[$i]->first_name . " " . $res[$i]->sur_name . "</option>\n";
      }

    }
    echo "</select>\n";
  }

  //List all players with names visible and representing the player IDs
?>
