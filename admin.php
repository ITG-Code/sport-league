<?php
if(isset($_POST['login'])){
  login();
}
if(isset($_REQUEST['logout'])){
  logout();
}
if(!isLoggedIn()){
  header("index.php");
}

  if(isset($_REQUEST['match'])){
    require_once('includes/match_report.php');
  }
  elseif(isset($_REQUEST['match_player'])){
    require_once('includes/add_match_player_form.php');
  }
  else{
    echo '<div class="row">';
    require_once("includes/admin_matches.php");
    echo "<div class='col-md-2'></div>";
    require_once("includes/add_match_player.php");
    echo "<div>";
  }


?>
