<?php
require 'App/database/dbSetup.php';
class Select extends dbSetup{


  public function getPersonProfle(){
    "SELECT person.id, person.fName, person.sName, role, shirt_nr, weight, height team_id
FROM person LEFT JOIN team_person ON person.id=team_person.person_id
(SELECT person_id, shirt_nr, weight, height, team_id, role, team_person_leave FROM team_person_link LEFT JOIN role ON team_person_link.id=role.id FULL OUTER JOIN team_person_leave ON team_person_link.id=team_person_leave.team_person_link.id)
as team_person WHERE team_person_leave=NULL;";
  }


  public function getAllFullTeamName(){
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

    $stmt = $this->db->prepare("SELECT org.name FROM org");
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
