<?php
require 'App/database/dbSetup.php';
class Select extends dbSetup{

  //Fetches the goals that a team has done in a certain game
  public function getScoreBoardBySeason($s){
    require 'App/objects/SeasonObjects.php';

    $q = "SELECT game_id, team_id, SUM( Goals ) AS teamGoals, team.name AS team_name, org.name AS org_name
    FROM (

      SELECT game_person_link.id AS game_person_id, team_person_link.team_id AS team_id, game_person_link.game_id AS game_id, (

        SELECT COUNT( * )
        FROM goals
        WHERE goals.game_person_id = game_person_link.id
      ) AS Goals
      FROM game_person_link
      LEFT JOIN team_person_link ON game_person_link.team_person_id = team_person_link.id
      LEFT JOIN game ON game_person_link.game_id = game.id
      WHERE season_id =?
    ) AS allGoals
    LEFT JOIN team ON team.id = team_id
    LEFT JOIN org ON org.id = team.org_id
    GROUP BY game_id, team_id";


    $stmt = $this->db->prepare($q);
    $stmt->bind_param('i', $s);
    $stmt->execute();
    $r = array();
    $obj = new SeasonScore();
        $result = $stmt->get_result();
        while ($t1 = $result->fetch_object()){
          $t2 = $result->fetch_object();
          $obj->add($t1, $t2);
        }
  }

  public function getAllgetAllFullTeamName(){
    $stmt = $db->prepare("SELECT org.name AS org_name, team.name AS team_name FROM team JOIN org ON team.org_id = org.id");
    $stmt->execute();
    $stmt->bind_result($on, $tn);
    $retval = array();
    while($stmt->fetch()){
      array_push($retval, (object) array('orgName' => $orgName, 'teamName' => $teamName));
    }
    return $retval;
  }
  public function getAllOrgName(){
    $stmt = $db->prepare("SELECT org.name FROM org");
    $stmt->execute();
    $stmt->bind_result($on);
    $retval = array();
    while($stmt->fetch()){
      array_push($retval, $on);
    }
    return $retval;
  }
  public function getMatchDetails($mid){
  }
}
?>
