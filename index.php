<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
include_once('database/dbSetup.php');
include_once('database/select.php');
include_once('helper.php');
require_once('objects/player.php');
require_once('objects/match.php');
require_once('database/dbSetup.php');
require_once('objects/player.php');
require_once('objects/match.php');
require_once('objects/team.php');
if(isset($_POST['login'])){
  login();
}
if(isset($_REQUEST['logout'])){
  logout();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Sport-League</title>

  <link rel="stylesheet" href="index.css">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <!-- Material Design -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/roboto.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material-fullpalette.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/ripples.min.css">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <div class="container-fluid">
    <div class="jumbotron">
      <h1>Sport-League</h1>
      <p>A league of sports</p>
    </div>


    <!-- Content of the site -->
    <?php

    if(isset($_REQUEST['page'])){
      if($_REQUEST['page'] == "login.php"){
        require_once('includes/login.php');
      }
      elseif($_REQUEST['page'] == "admin.php" && isLoggedIn()){
        require_once ('admin.php');
      }
      elseif($_REQUEST['page'] == "matchhistory.php"){
        require_once ('includes/menu.php');
        require_once("includes/matchhistory.php");
      }
      else{
        require_once ('includes/menu.php');
        require_once ($_REQUEST['page']);
      }

    }
    else{
      require_once ('includes/menu.php');
      require_once ('includes/teamtable.php');
    }
    ?>
    <!-- Score table -->

    <footer class="row">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/material.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/ripples.min.js"></script>
      <?php
        //echo "Process time: " . (microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]);
      ?>
      <p class="col-lg-4">Copyright &copy; Hannes Kindströmmer & Rickardh Forslund</p>
      <?php
    //  echo "<br>";
    //  echo "Current page: " . CURR_URL;
      ?>
    </footer>
  </div>
</body>
</html>