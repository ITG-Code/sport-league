<?php
	include_once('config.php');

	class adminQuerys{

		private $database;

		function __construct(argument){
			$this->database = new Database('localhost','root','rickfo97','sportleague');
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
