<?php
require 'App/database/dbSetup.php';
class Select extends dbSetup{




  public function getPersonProfle(){
    /**
    *
    * This function is supposed to get all of the data needed to later create a complete profile of a player
    *
    **/
    "SELECT person.id, person.fName, person.sName, role, shirt_nr, weight, height team_id
FROM person LEFT JOIN team_person ON person.id=team_person.person_id
(SELECT person_id, shirt_nr, weight, height, team_id, role, team_person_leave FROM team_person_link LEFT JOIN role ON team_person_link.id=role.id FULL OUTER JOIN team_person_leave ON team_person_link.id=team_person_leave.team_person_link.id)
as team_person WHERE team_person_leave=NULL;";
  }


  public function getAllFullTeamName(){
    /**
    *
    * This function returns a object array containing the attributes:
    * teamName: the name of the team eg. U17
    * orgName: the name of the org eg. Brolaugh's football club
    *
    **/
    $stmt =
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
    /**
    *
    * This function returns a string array of all the orginazation names
    *
    **/
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
    //This functions is supposed to get make a class out of a match containing who did what goals, what the scores where and so on.
  }


  public function getTeamTable($season){
    /*
    * season: Integer of what season by its id
    * returns 2D array which is sorted by score, goal difference, matches
    * return values:
    * team_id: selected team id
    * name: name of selected team
    * points: points which is scored by 2 for win, 1 for tie, 0 for loss
    * goals: total amount of goals by team in season
    * matches: total matches played in season
    * wins: total amount of wins in season
    * loses: total amount of losses in season
    * ties: total amount of ties in season
    * goalsAgainst: total goals that the team have let in
    * goalDiff: difference of goals done and goals let in
    */
    $teams = array();

    $query = "SELECT game_id, team_id, SUM( Goals ) AS teamGoals, team.name AS team_name, org.name AS org_name FROM (SELECT game_person_link.id AS game_person_id, team_person_link.team_id AS team_id, game_person_link.game_id AS game_id, (SELECT COUNT( * ) FROM goals WHERE goals.game_person_id = game_person_link.id) AS Goals FROM game_person_link LEFT JOIN team_person_link ON game_person_link.team_person_id = team_person_link.id LEFT JOIN game ON game_person_link.game_id = game.id WHERE game.season_id = $season) AS allGoals LEFT JOIN team ON team.id = team_id LEFT JOIN org ON org.id = team.org_id GROUP BY game_id, team_id;";
    $result  = $this->db->getSQL($query);

    while ($team = $result->fetch_object()) {
      $team2 = $result->fetch_object();
      $Homekey = array_search($team->team_id, array_column($teams,'team_id'), true);
      $Gonekey = array_search($team2->team_id, array_column($teams,'team_id'), true);

      if (is_bool($Homekey) === true) {
        $Homekey = array_push($teams, array('team_id' => $team->team_id,'name' => $team->team_name,'points' => 0,'goals' => 0,'matches' => 0, 'wins' => 0, 'loses' => 0, 'ties' => 0, 'goalsAgainst' => 0, 'goalDiff' => 0)) - 1;
      }
      if(is_bool($Gonekey) === true){
        $Gonekey = array_push($teams, array('team_id' => $team2->team_id,'name' => $team2->team_name,'points' => 0,'goals' => 0,'matches' => 0, 'wins' => 0, 'loses' => 0, 'ties' => 0, 'goalsAgainst' => 0, 'goalDiff' => 0)) - 1;
      }

      if($team->teamGoals > $team2->teamGoals){
        $teams[$Homekey]['wins'] += 1;
        $teams[$Homekey]['points'] += 2;
        $teams[$Homekey]['goals'] += $team->teamGoals;
        $teams[$Homekey]['matches'] += 1;
        $teams[$Homekey]['goalsAgainst'] += $team2->teamGoals;

        $teams[$Gonekey]['loses'] += 1;
        $teams[$Gonekey]['goals'] += $team2->teamGoals;
        $teams[$Gonekey]['matches'] += 1;
        $teams[$Gonekey]['goalsAgainst'] += $team->teamGoals;
      }elseif ($team->teamGoals < $team2->teamGoals) {
        $teams[$Homekey]['loses'] += 1;
        $teams[$Homekey]['goals'] += $team->teamGoals;
        $teams[$Homekey]['matches'] += 1;
        $teams[$Homekey]['goalsAgainst'] += $team2->teamGoals;

        $teams[$Gonekey]['wins'] += 1;
        $teams[$Gonekey]['points'] += 2;
        $teams[$Gonekey]['goals'] += $team2->teamGoals;
        $teams[$Gonekey]['matches'] += 1;
        $teams[$Gonekey]['goalsAgainst'] += $team->teamGoals;
      }else{
        $teams[$Homekey]['ties'] += 1;
        $teams[$Homekey]['points'] += 1;
        $teams[$Homekey]['goals'] += $team->teamGoals;
        $teams[$Homekey]['matches'] += 1;
        $teams[$Homekey]['goalsAgainst'] += $team2->teamGoals;

        $teams[$Gonekey]['ties'] += 1;
        $teams[$Gonekey]['points'] += 1;
        $teams[$Gonekey]['goals'] += $team2->teamGoals;
        $teams[$Gonekey]['matches'] += 1;
        $teams[$Gonekey]['goalsAgainst'] += $team->teamGoals;
      }
    }
    for ($i=0; $i < count($teams); $i++) {
      $teams[$i]['goalDiff'] = ($teams[$i]['goals'] - $teams[$i]['goalsAgainst']);
    }

    $sort = array();
    foreach($teams as $k=>$v) {
      $sort['points'][$k] = $v['points'];
      $sort['goalDiff'][$k] = $v['goalDiff'];
      $sort['matches'][$k] = $v['matches'];
    }
    array_multisort($sort['points'], SORT_DESC,$sort['goalDiff'],$sort['matches'], SORT_DESC,$teams);
    return $teams;
  }

  public function getGoalLeague($season){
    /* season: Integer of what season by its id
    * returns 2D array which is sorted by score, goal difference, matches
    * return values:first_name, sur_name,total, goals,straff
    * first_name: first name of current player
    * sur_name: last name of current player
    * total: total amount of goals
    * goals: goals scored in a match
    * straff: penalty goals
    */
    $people = array();

    $goals = "SELECT person_id, person.fname AS first_name, person.sname AS sur_name, SUM( Goals ) AS goals, SUM(totalGoals) as total, SUM(Straff) as straff FROM (SELECT game_person_link.id AS game_person_id, team_person_link.person_id AS person_id, game_person_link.game_id AS game_id, (SELECT COUNT( * ) FROM goals WHERE goals.game_person_id = game_person_link.id AND goals.type =1) AS Goals, (SELECT COUNT( * ) FROM goals WHERE goals.game_person_id = game_person_link.id) AS totalGoals, (SELECT COUNT( * ) FROM goals WHERE goals.game_person_id = game_person_link.id AND goals.type =2) AS Straff FROM game_person_link LEFT JOIN team_person_link ON game_person_link.team_person_id = team_person_link.id LEFT JOIN game ON game_person_link.game_id = game.id WHERE game.season_id = $season) AS allGoals LEFT JOIN person ON person.id = person_id GROUP BY person_id ORDER BY total DESC ";
    $goalsResult  = $this->db->getSQL($goals);

    while ($person = $goalsResult->fetch_object()) {
      array_push($people, array('first_name' => $person->first_name, 'sur_name' => $person->sur_name,'total' => $person->total, 'goals' => $person->goals,'straff' => $person->penalty));
    }
    return $people;
  }

}
?>
