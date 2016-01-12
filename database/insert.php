<?php


class Insert extends dbSetup{
  public function addUser($un, $pw){
    $options = [
      'cost' => 11,
      'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    ];
    $pass_hash = password_hash($pw , PASSWORD_BCRYPT, $options);

    $stmt = $this->db->prepare("INSERT INTO admin(email, password) values(?,?)");
    $stmt->bind_param('ss', $un, $pass_hash);
    if($stmt->execute()){
      $stmt->close();
      return true;
    }
    else{
      $stmt->close();
      return false;
    }
  }
  public function addGoal($p){
    $stmt = $this->db->prepare("INSERT INTO goals(game_person_id, type) VALUES(?,1)");
    $stmt->bind_param('i', $p);
    $stmt->execute();
    $stmt->close();
  }
  public function addAudience($match, $total){
    $stmt = $this->db->prepare("INSERT INTO audience(total, game_id) VALUES(?,?)");
    $stmt->bind_param('ii', $total, $match);
    $stmt->execute();
    $stmt->close();
  }
  public function EndMatch($id){
    $stmt = $this->db->prepare("UPDATE game SET status_id=4 WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
  }

  public function addPlayerToMatch($player, $match){
    $stmt = $this->db->prepare("INSERT INTO game_person_link(team_person_id, game_id) VALUES(?,?)");
    $stmt->bind_param('ii', $player, $match);
    $stmt->execute();
    $stmt->close();
  }

  public function addGame($start,$home,$gone,$status,$arena,$season){
    $addgame = "INSERT INTO game(start_time, home_team_id, gone_team_id, status_id, arena_id, season_id) VALUES (NOW,$home,$gone,$status,$arena,$season)";
    if ($start != 0) {
      $addgame = "INSERT INTO game(start_time, home_team_id, gone_team_id, status_id, arena_id, season_id) VALUES ($start,$home,$gone,$status,$arena,$season)";
    }
    $this->database->runSQL($addgame);
  }

  public function removeGame($id){
    $remove = "DELETE *FROM game WHERE id = $id";
    $this->database->runSQL($remove);
  }

  public function addTeam($name,$orgid){
    $addteam = "INSERT INTO team(name,org_id) VALUES($name,$orgid)";
    $this->database->runSQL($addteam);
  }

  public function addPersonTeam($personid, $teamid,$role,$shirtnr){
    $addpersonteam = "INSERT INTO team_person_link(joindate,role_id,team_id,person_id,shirt_nr) VALUES(NOW,$role,$teamid,$personid,$shirtnr)";
    $this->database->runSQL($addpersonteam);
  }

}


 ?>
