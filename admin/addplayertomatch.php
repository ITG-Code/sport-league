<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
  require_once('../database/dbSetup.php');
  require_once('../objects/player.php');
  require_once('../database/insert.php');
  $i = new Insert();
  $i->addPlayerToMatch($_POST['addplayer'], $_POST['matchid']);
  $s ="http://rickardhforslund.se/sportleague/?page=admin.php&match_player=" . $_POST['matchid'];
  header("Location:".$s);
?>
