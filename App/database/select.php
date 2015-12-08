<?php
require_once('dbSetup.php');
require_once('objects/player.php');

class Select extends dbSetup{

  public function getPersonProfile($id){
    /**
    *
    * This function is supposed to get all of the data needed to later create a complete profile of a player
    *
    **/
    $query = "SELECT team_person_link.id AS team_person_id, joindate, shirt_nr, weight, height, avatar, person.id AS person_id, person.fname AS fName, person.sname AS sName, person.social_sec AS social_sec, role.name, team.id as team_id, (SELECT COUNT(*) FROM game_person_link WHERE game_person_link.team_person_id = team_person_link.id) as matches, (team_person_link.id NOT IN (SELECT team_person_id FROM team_person_leave)) as left_team FROM team_person_link LEFT JOIN person ON team_person_link.person_id = person.id LEFT JOIN role ON team_person_link.role_id = role.id LEFT JOIN team ON team_person_link.team_id = team.id LEFT JOIN org ON team.org_id = org.id WHERE team_person_link.person_id = $id GROUP BY team_person_link.id ORDER BY team_person_link.joindate DESC";
    $result = $this->getSQL($query);

    $retPlayer;
    $personSet = false;
    while ($person = $result->fetch_object()) {
      if(!$personSet){
        $retPlayer = new Player($person->person_id, $person->fName, $person->sName, $person->social_sec, $person->height, $person->weight, $person->avatar);
        $personSet = true;
      }
      $playerGoals = $this->getPlayerGoals($person->team_person_id);
      $retPlayer->addPenaltyGoals($playerGoals->straff);
      $retPlayer->addMatches($person->matches);
      if($person->left_team == 1){
        $retPlayer->addTeam($person->team_id);
        $retPlayer->addShirtNr($person->shirt_nr);
        $retPlayer->addGoals($playerGoals->goals);
        $retPlayer->addTeamGoal($playerGoals->goals);
      }else{
        $retPlayer->addPastTeam($person->team_id);
        $retPlayer->addLeftShirtNr($person->shirt_nr);
        $retPlayer->addGoals($playerGoals->goals);
      }
    }
    return $retPlayer;
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
    $result  = $this->getSQL($query);

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

  public function getPlayerWins($teamID){
    $wins = 0;

    $query = "SELECT game_id, team_id, SUM( Goals ) AS teamGoals, team.name AS team_name, org.name AS org_name FROM (SELECT game_person_link.id AS game_person_id, team_person_link.team_id AS team_id, game_person_link.game_id AS game_id, (SELECT COUNT( * ) FROM goals WHERE goals.game_person_id = game_person_link.id) AS Goals FROM game_person_link LEFT JOIN team_person_link ON game_person_link.team_person_id = team_person_link.id LEFT JOIN game ON game_person_link.game_id = game.id WHERE game.home_team_id = $teamID OR game.gone_team_id = $teamID) AS allGoals LEFT JOIN team ON team.id = team_id LEFT JOIN org ON org.id = team.org_id GROUP BY game_id, team_id;";
    $result  = $this->getSQL($query);
    
    while ($team = $result->fetch_object()) {
      $team2 = $result->fetch_object();
      if($team->team_id === $teamID){
        if($team->teamGoals > $team2->teamGoals){
          $wins++;
        }
      }else{
        if($team2->teamGoals > $team->teamGoals){
          $wins++;
        }
      }
    }
    return $wins;
  }

  public function getPlayerGoals($team_link_id){
    $goalsQuery = "SELECT SUM( Goals ) AS goals, SUM( totalGoals ) AS total, SUM( Straff ) AS straff FROM ( SELECT game_person_link.id AS game_person_id, team_person_link.person_id AS person_id, game_person_link.game_id AS game_id, ( SELECT COUNT( * ) FROM goals WHERE goals.game_person_id = game_person_link.id AND goals.type =1 ) AS Goals, ( SELECT COUNT( * ) FROM goals WHERE goals.game_person_id = game_person_link.id ) AS totalGoals, ( SELECT COUNT( * ) FROM goals WHERE goals.game_person_id = game_person_link.id AND goals.type =2 ) AS Straff FROM game_person_link LEFT JOIN team_person_link ON game_person_link.team_person_id = team_person_link.id LEFT JOIN game ON game_person_link.game_id = game.id WHERE team_person_link.id =1 ) AS allGoals LEFT JOIN person ON person.id = person_id GROUP BY person_id ORDER BY total DESC";
    $goalsResult = $this->getSQL($goalsQuery);

    return $goalsResult->fetch_object();
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
    $goalsResult  = $this->getSQL($goals);

    while ($person = $goalsResult->fetch_object()) {
      array_push($people, array('first_name' => $person->first_name, 'sur_name' => $person->sur_name,'total' => $person->total, 'goals' => $person->goals,'straff' => $person->penalty));
    }
    return $people;
  }

}
?>
