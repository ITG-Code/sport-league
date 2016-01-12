<?php

class Select extends dbSetup{

  public function login($un, $pw){
    $stmt = $this->db->prepare("SELECT password FROM admin WHERE email = ?");
    $stmt->bind_param('s', $un);
    $stmt->execute();
    $res = $stmt->get_result();
    $stmt->close();
    $row = $res->fetch_object();
    if(password_verify($pw, $row->password)){
      return true;
    }
    else{
      return false;
    }
  }

  public function getPersonProfile($id){
    /**
    *
    * This function is supposed to get all of the data needed to later create a complete profile of a player
    *
    **/
    $query = "SELECT team_person_link.id AS team_person_id, joindate, shirt_nr, weight, height, team_person_link.avatar, person.id AS person_id, person.fname AS fName, person.sname AS sName, person.social_sec AS social_sec, role.name as role_name, team.id as team_id, (SELECT COUNT(*) FROM game_person_link WHERE game_person_link.team_person_id = team_person_link.id) as matches, (team_person_link.id NOT IN (SELECT team_person_id FROM team_person_leave)) as left_team FROM team_person_link LEFT JOIN person ON team_person_link.person_id = person.id LEFT JOIN role ON team_person_link.role_id = role.id LEFT JOIN team ON team_person_link.team_id = team.id LEFT JOIN org ON team.org_id = org.id WHERE team_person_link.person_id = $id GROUP BY team_person_link.id ORDER BY team_person_link.joindate DESC";
    $result = $this->getSQL($query);

    $retPlayer;
    $personSet = false;
    while ($person = $result->fetch_object()) {
      if(!$personSet){
        $retPlayer = new Player($person->person_id, $person->fName, $person->sName, $person->social_sec, $person->height, $person->weight, $person->avatar);
        $personSet = true;
      }
      $playerGoals = $this->getPlayerGoals($person->team_person_id);
      $retPlayer->addPenaltyGoals($playerGoals['straff']);
      $retPlayer->addMatches($person->matches);
      if($person->left_team == 1){
        $retPlayer->addTeam($person->team_id);
        $retPlayer->addShirtNr($person->shirt_nr);
        $retPlayer->addGoals($playerGoals['goals']);
        $retPlayer->addTeamGoal($playerGoals['goals']);
        $retPlayer->addRoleName($person->role_name);
      }else{
        $retPlayer->addPastTeam($person->team_id,0);
        $retPlayer->addLeftShirtNr($person->shirt_nr);
        $retPlayer->addGoals($playerGoals['goals']);
      }
    }
    return $retPlayer;
  }

  public function getFullTeamName($tid){
    /**
    *
    * This function returns a object array containing the attributes:
    * teamName: the name of the team eg. U17
    * orgName: the name of the org eg. Brolaugh's football club
    *
    **/
    $stmt = $this->db->prepare("SELECT org.name AS org_name, team.name AS team_name FROM team JOIN org ON team.org_id = org.id WHERE team.id = ?");
    $stmt->bind_param('i', $tid);
    $stmt->execute();
    $stmt->bind_result($on, $tn);
    $stmt->fetch();
    return $on . " - " . $tn;
  }
  public function getAllFullTeamName(){
    /**
    *
    * This function returns a object array containing the attributes:
    * teamName: the name of the team eg. U17
    * orgName: the name of the org eg. Brolaugh's football club
    *
    **/
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
        $Homekey = array_push($teams, array('team_id' => $team->team_id,'name' => $team->org_name . ' ' . $team->team_name,'points' => 0,'goals' => 0,'matches' => 0, 'wins' => 0, 'loses' => 0, 'ties' => 0, 'goalsAgainst' => 0, 'goalDiff' => 0)) - 1;
      }
      if(is_bool($Gonekey) === true){
        $Gonekey = array_push($teams, array('team_id' => $team2->team_id,'name' => $team2->org_name . ' ' . $team2->team_name,'points' => 0,'goals' => 0,'matches' => 0, 'wins' => 0, 'loses' => 0, 'ties' => 0, 'goalsAgainst' => 0, 'goalDiff' => 0)) - 1;
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
    array_multisort($sort['points'], SORT_DESC,$sort['goalDiff'], SORT_DESC,$sort['matches'], SORT_ASC,$teams);
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
    $stmt = $this->db->prepare("SELECT SUM( Goals ) AS goals, SUM( totalGoals ) AS total, SUM( Straff ) AS straff FROM ( SELECT game_person_link.id AS game_person_id, team_person_link.person_id AS person_id, game_person_link.game_id AS game_id, ( SELECT COUNT( * ) FROM goals WHERE goals.game_person_id = game_person_link.id AND goals.type =1 ) AS Goals, ( SELECT COUNT( * ) FROM goals WHERE goals.game_person_id = game_person_link.id ) AS totalGoals, ( SELECT COUNT( * ) FROM goals WHERE goals.game_person_id = game_person_link.id AND goals.type =2 ) AS Straff FROM game_person_link LEFT JOIN team_person_link ON game_person_link.team_person_id = team_person_link.id LEFT JOIN game ON game_person_link.game_id = game.id WHERE team_person_link.id = ?) AS allGoals LEFT JOIN person ON person.id = person_id GROUP BY person_id ORDER BY total DESC");
    $stmt->bind_param('i', $team_link_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $ret = array('goals' => 0, 'total' => 0, 'straff' => 0);
    if(is_array($result->lengths)){
      $row = $result->fetch_object();
      $ret = array('goals' => $row->goals, 'total' => $row->total, 'straff' => $row->straff);
    }
    return $ret;
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

    $goals = "SELECT person_id, person.fname AS first_name, person.sname AS sur_name, SUM( Goals ) AS goals, SUM(totalGoals) as total, SUM(Straff) as straff FROM (SELECT game_person_link.id AS game_person_id, team_person_link.person_id AS person_id, game_person_link.game_id AS game_id, (SELECT COUNT( * ) FROM goals WHERE goals.game_person_id = game_person_link.id AND goals.type =1) AS Goals, (SELECT COUNT( * ) FROM goals WHERE goals.game_person_id = game_person_link.id) AS totalGoals, (SELECT COUNT( * ) FROM goals WHERE goals.game_person_id = game_person_link.id AND goals.type =2) AS Straff FROM game_person_link LEFT JOIN team_person_link ON game_person_link.team_person_id = team_person_link.id LEFT JOIN game ON game_person_link.game_id = game.id WHERE game.season_id = $season) AS allGoals LEFT JOIN person ON person.id = person_id GROUP BY person_id ORDER BY total DESC";
    $goalsResult  = $this->getSQL($goals);

    while ($person = $goalsResult->fetch_object()) {
      array_push($people, array('first_name' => $person->first_name, 'sur_name' => $person->sur_name,'total' => $person->total, 'goals' => $person->goals,'straff' => $person->penalty));
    }
    return $people;
  }

  public function getMVP($team){
    $stmt = $this->db->prepare("SELECT person_id, role_name as role, person.fname AS first_name, person.sname AS sur_name, person.social_sec AS birthDate, height AS player_heigth, weight AS player_weight, player_avatar, SUM( totalGoals ) AS total FROM (  SELECT game_person_link.id AS game_person_id, team_person_link.person_id AS person_id, role.name as role_name, team_person_link.role_id, team_person_link.avatar as player_avatar, team_person_link.height, team_person_link.weight, game_person_link.game_id AS game_id, ( SELECT COUNT( * ) FROM goals WHERE goals.game_person_id = game_person_link.id ) AS totalGoals FROM game_person_link LEFT JOIN team_person_link ON game_person_link.team_person_id = team_person_link.id LEFT JOIN game ON game_person_link.game_id = game.id LEFT JOIN role ON team_person_link.role_id = role.id WHERE team_person_link.team_id = ? ) AS allGoals LEFT JOIN person ON person.id = person_id GROUP BY person_id ORDER BY total DESC");
    $stmt->bind_param('i', $team);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_object();
    $player;
    if (is_object($row)) {
      $player = new Player($row->person_id, $row->first_name, $row->sur_name, $row->birthDate, $row->player_heigth, $row->player_weight, $row->player_avatar);
      $player->addRoleName($row->role);
    }else{
      $player = new Player(0, "No", "Person", 0, 0, 0, 0);
      $player->addRoleName("No role");
    }
    return $player;
  }

  public function getTeamStat($season, $team){
    //Hämtar poängtavlan och tar ut laget som man har anget
    $table = $this->getTeamTable($season);
    $key = array_search($team, array_column($table,'team_id'), true);
    return $table[$key + 1];
  }

  public function getTeamPlayers($team){
    $stmt = $this->db->prepare("SELECT person.id as person_id,joindate, role.name as role, person.social_sec as brithdate, shirt_nr, team_person_link.weight as player_weight, team_person_link.height as player_heigth, team_person_link.avatar as player_avatar, person.fname as first_name,person.sname as sur_name,person_id FROM team_person_link LEFT JOIN person on team_person_link.person_id = person.id LEFT JOIN role on team_person_link.role_id = role.id where team_person_link.team_id = ? AND (team_person_link.id NOT IN ( SELECT team_person_id FROM team_person_leave))");
    $stmt->bind_param('i', $team);
    $stmt->execute();
    $result = $stmt->get_result();
    $teamPlayers = array();
    while ($row = $result->fetch_object()) {
      $player = new Player($row->person_id, $row->first_name, $row->sur_name, $row->brithdate, $row->player_heigth, $row->player_weight, $row->player_avatar);
      $player->addRoleName($row->role);
      array_push($teamPlayers, $player);
    }
    return $teamPlayers;
  }

  public function getTeamNemesis($team){
    $stmt = $this->db->prepare("SELECT game_id, team_id, SUM( Goals ) AS teamGoals, team.name AS team_name, org.name AS org_name FROM (SELECT game_person_link.id AS game_person_id, team_person_link.team_id AS team_id, game_person_link.game_id AS game_id, (SELECT COUNT( * ) FROM goals WHERE goals.game_person_id = game_person_link.id) AS Goals FROM game_person_link LEFT JOIN team_person_link ON game_person_link.team_person_id = team_person_link.id LEFT JOIN game ON game_person_link.game_id = game.id WHERE game.home_team_id = ? or game.gone_team_id = ?) AS allGoals LEFT JOIN team ON team.id = team_id LEFT JOIN org ON org.id = team.org_id GROUP BY game_id, team_id");
    $stmt->bind_param('ii',$team,$team);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $teams = array();

    while ($team = $result->fetch_object()) {
      $team2 = $result->fetch_object();
      $Homekey = array_search($team->team_id, array_column($teams,'team_id'), true);
      $Gonekey = array_search($team2->team_id, array_column($teams,'team_id'), true);

      if (is_bool($Homekey) === true) {
        $Homekey = array_push($teams, array('team_id' => $team->team_id,'name' => $team->team_name,'goals' => 0,'matches' => 0, 'wins' => 0, 'loses' => 0, 'ties' => 0, 'goalsAgainst' => 0, 'goalDiff' => 0)) - 1;
      }
      if(is_bool($Gonekey) === true){
        $Gonekey = array_push($teams, array('team_id' => $team2->team_id,'name' => $team2->team_name,'goals' => 0,'matches' => 0, 'wins' => 0, 'loses' => 0, 'ties' => 0, 'goalsAgainst' => 0, 'goalDiff' => 0)) - 1;
      }

      if($team->teamGoals > $team2->teamGoals){
        $teams[$Homekey]['wins'] += 1;
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
        $teams[$Gonekey]['goals'] += $team2->teamGoals;
        $teams[$Gonekey]['matches'] += 1;
        $teams[$Gonekey]['goalsAgainst'] += $team->teamGoals;
      }else{
        $teams[$Homekey]['ties'] += 1;
        $teams[$Homekey]['goals'] += $team->teamGoals;
        $teams[$Homekey]['matches'] += 1;
        $teams[$Homekey]['goalsAgainst'] += $team2->teamGoals;

        $teams[$Gonekey]['ties'] += 1;
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
      $sort['wins'][$k] = $v['wins'];
      $sort['goalDiff'][$k] = $v['goalDiff'];
      $sort['matches'][$k] = $v['matches'];
    }
    array_multisort($sort['wins'], SORT_DESC,$sort['goalDiff'],$sort['matches'], SORT_DESC,$teams);
    if($teams[0]['team_id'] == $team){
      return $teams[1];
    }else{
      return $teams[0]['team_id'];
    }
  }

  public function getSeasonMatches($season, $start, $limit){
    $stmt;
    if(is_numeric($limit)){
      $stmt = $this->db->prepare("SELECT game.id, game.start_time, game.home_team_id, game.gone_team_id, game.arena_id, game_status.name FROM game LEFT JOIN game_status ON game.status_id = game_status.id WHERE season_id = ? ORDER BY  game.start_time ASC  LIMIT ? , ?");
      $stmt->bind_param('iii', $season, $start, $limit);
    }else{
      $stmt = $this->db->prepare("SELECT game.id, game.start_time, game.home_team_id, game.gone_team_id, game.arena_id, game_status.name FROM game LEFT JOIN game_status ON game.status_id = game_status.id WHERE season_id = ? ORDER BY  game.start_time ASC ");
      $stmt->bind_param('i', $season);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $matches = array();
    while ($row = $result->fetch_object()) {
      array_push($matches, new Match($row->id, $row->start_time, $row->home_team_id, $row->gone_team_id, $row->arena_id, 0, $row->name));
    }
    return $matches;
  }

  public function getTeamSeasonMatches($season, $team, $start, $limit){
    $stmt = $this->db->prepare("SELECT game.id, game.start_time, game.home_team_id, game.gone_team_id, game.arena_id, game_status.name FROM game LEFT JOIN game_status ON game.status_id = game_status.id WHERE season_id = ? AND (game.home_team_id = ? OR game.gone_team_id = ?) LIMIT ? , ?");
    $stmt->bind_param('iiiii', $season, $team, $team, $start, $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $matches = array();
    while ($row = $result->fetch_object()) {
      array_push($matches, new Match($row->id, $row->start_time, intval($row->home_team_id), intval($row->gone_team_id), $row->arena_id, 0, $row->name));
    }
    return $matches;
  }

  public function getMatchMembers($game){
    $stmt = $this->db->prepare("SELECT game_person_link.id as game_person_id, game_person_link.game_id as game_id, game.start_time as start_time, game.home_team_id as home_team, game.gone_team_id as gone_team, game_status.name as status, arena.name as arena_name, arena.adress as arena_adress, arena.city as arena_city, game.season_id as season_id, season.name as season_name, game_person_link.team_person_id as team_person_id, role.name as role, team_person_link.shirt_nr as shirt_nr, person.id as person_id, person.fname as first_name, person.sname as sur_name, team_person_link.team_id as team_id FROM game_person_link LEFT JOIN game ON game_person_link.game_id = game.id LEFT JOIN team_person_link ON game_person_link.team_person_id = team_person_link.id LEFT JOIN person ON team_person_link.person_id = person.id LEFT JOIN game_status ON game.status_id = game_status.id LEFT JOIN arena ON game.arena_id = arena.id LEFT JOIN season ON game.season_id = season.id LEFT JOIN role ON team_person_link.role_id = role.id WHERE game_person_link.game_id = ?");
    $stmt->bind_param('i', $game);
    $stmt->execute();
    $result = $stmt->get_result();
    $members = array();
    while ($row = $result->fetch_object()) {
      array_push($members, $row);
    }
    return $members;
  }

  public function getHomerFromGame($game){
    $stmt = $this->db->prepare("SELECT home_team_id, gone_team_id FROM game where id = ?;");
    $stmt->bind_param('i', $game);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_object()) {
      return $row;
    }
  }

  public function getTeamGoal($game, $team){
    $stmt = $this->db->prepare("SELECT COUNT(*) as goals FROM goals LEFT JOIN game_person_link ON goals.game_person_id = game_person_link.id LEFT JOIN team_person_link ON game_person_link.team_person_id = team_person_link.id WHERE team_person_link.team_id = ? AND game_person_link.game_id = ?");
    $stmt->bind_param('ii', $team, $game);
    $stmt->execute();
    $result = $stmt->get_result();
    $ret = $result->fetch_object();
    return intval($ret->goals);
  }

  public function getTeamAvatar($team){
    $stmt = $this->db->prepare("SELECT avatar FROM team WHERE id = ?");
    $stmt->bind_param('i', $team);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_object();
  }

  public function getAudience($arena, $start, $end, $order){
    $stmt;
    if(is_numeric($arena)){
      if(is_string($start)){
        if(is_string($end)){
          $stmt = $this->db->prepare("SELECT audience.id as audience_id, audience.total as viewers, audience.game_id as game_id, game.start_time as date_time, game.home_team_id as home_team, game.gone_team_id as gone_team, game.season_id as season_id, arena.name as arena_name FROM audience LEFT JOIN game ON audience.game_id = game.id LEFT JOIN arena ON game.arena_id = arena.id WHERE arena.id = ? AND game.start_time >= ? AND game.start_time <= ? $order");
          $stmt->bind_param('iss', $arena, $start, $end);
        }else{
          $stmt = $this->db->prepare("SELECT audience.id as audience_id, audience.total as viewers, audience.game_id as game_id, game.start_time as date_time, game.home_team_id as home_team, game.gone_team_id as gone_team, game.season_id as season_id, arena.name as arena_name FROM audience LEFT JOIN game ON audience.game_id = game.id LEFT JOIN arena ON game.arena_id = arena.id WHERE arena.id = ? AND game.start_time >= ? $order");
          $stmt->bind_param('is', $arena, $start);
        }
      }else{
        $stmt = $this->db->prepare("SELECT audience.id as audience_id, audience.total as viewers, audience.game_id as game_id, game.start_time as date_time, game.home_team_id as home_team, game.gone_team_id as gone_team, game.season_id as season_id, arena.name as arena_name FROM audience LEFT JOIN game ON audience.game_id = game.id LEFT JOIN arena ON game.arena_id = arena.id WHERE arena.id = ? $order");
        $stmt->bind_param('i', $arena);
      }
    }else{
      $stmt = $this->db->prepare("SELECT audience.id as audience_id, audience.total as viewers, audience.game_id as game_id, game.start_time as date_time, game.home_team_id as home_team, game.gone_team_id as gone_team, game.season_id as season_id, arena.name as arena_name FROM audience LEFT JOIN game ON audience.game_id = game.id LEFT JOIN arena ON game.arena_id = arena.id $order");
    }
    $stmt->execute();
    return $stmt->get_result();
  }

  public function getAllArenor(){
    $stmt = $this->db->prepare("SELECT arena.id as arena_id, arena.name as arena_name FROM arena");
    $stmt->execute();
    return $stmt->get_result();
  }

  public function getPlayers($page, $amount){
    $stmt = $this->db->prepare("SELECT person.id AS person_id, joindate, role.name AS role, person.social_sec AS brithdate, shirt_nr, team_person_link.weight AS player_weight, team_person_link.height AS player_heigth, team_person_link.avatar AS player_avatar, team_person_link.team_id as team_id, person.fname AS first_name, person.sname AS sur_name, person_id FROM team_person_link LEFT JOIN person ON team_person_link.person_id = person.id LEFT JOIN role ON team_person_link.role_id = role.id WHERE (team_person_link.id NOT IN ( SELECT team_person_id FROM team_person_leave )) LIMIT ? , ?"); 
    $stmt->bind_param('ii', $page, $amount);
    $stmt->execute();
    $result = $stmt->get_result();
    $teamPlayers = array();
    while ($row = $result->fetch_object()) {
      $player = new Player($row->person_id, $row->first_name, $row->sur_name, $row->brithdate, $row->player_heigth, $row->player_weight, $row->player_avatar);
      $player->addRoleName($row->role);
      $player->addTeam($row->team_id);
      array_push($teamPlayers, $player);
    }
    return $teamPlayers;
  }

  public function totalPlayers(){
    $stmt = $this->db->prepare("SELECT count(person.id) as total FROM team_person_link LEFT JOIN person ON team_person_link.person_id = person.id LEFT JOIN role ON team_person_link.role_id = role.id WHERE ( team_person_link.id NOT IN (SELECT team_person_id FROM team_person_leave ))");
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_object();
  }

  public function getTeams($page, $amount){
    $stmt = $this->db->prepare("SELECT team.id as team_id FROM team LIMIT ? , ?"); 
    $stmt->bind_param('ii', $page, $amount);
    $stmt->execute();
    $result = $stmt->get_result();
    $teamId = array();
    while ($row = $result->fetch_object()) {
      array_push($teamId, new Team($row->team_id));
    }
    return $teamId;
  }

  public function totalTeams(){
    $stmt = $this->db->prepare("SELECT count(team.id) as total FROM team"); 
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_object();
  }

  public function getAudienceSimple($match){
    $stmt = $this->db->prepare("SELECT total FROM audience WHERE game_id = ?");
    $stmt->bind_param('i', $match);
    $stmt->execute();
    $stmt->bind_result($total);
    $stmt->fetch();
    return $total;
  }
}
?>