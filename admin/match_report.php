<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
  include_once('../database/dbSetup.php');
  include_once('../database/insert.php');
  $j = new Insert();
  for($i = 1; isset($_POST['match_home_'.$i]);$i++){
    $j->addGoal($_POST['match_home_'.$i]);
  }
  for($i = 1; isset($_POST['match_gone_'.$i]);$i++){
    $j->addGoal($_POST['match_gone_'.$i]);
  }
  $j->addAudience($_POST['match_id'],$_POST['audience']);
  $j->EndMatch($_POST['match_id']);

  header("Location:../?page=admin.php")
?>
