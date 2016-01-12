<?php
  $s = new Select();
  $res = $s->getMatchMembers($_REQUEST['match_id']);
  for($i = 0; $i < count($res);$i++){
     echo "<option value=\"" . $res[$i]->game_person_id . "\">" . $res[$i]->first_name . $res[$i]->sur_name . "</option>";
  }
  //List all players with names visible and representing the player IDs
?>
