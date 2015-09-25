<?php
require 'dbSetup.php';
class Select extends dbSetup{

  public function getScoreBoardBySeason($s){
    require 'App/objects/SeasonObjects.php';
    //Fetches the goals that a team has done in a certain game
    $stmt = $db->prepare(''); //Rickardh add the query
    $stmt->bind_param('i', $s);
    $stmt->execute();
    $r = array();
    $obj = new SeasonObjects();
    while($t1 = $stmt->fetch_object()){
      $t2 = $stmt->fetch_object();
      $obj->add($t1, $t2);
    }
    return $obj->fetchAll();
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
