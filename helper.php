<?php
DEFINE('CURR_URL', "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}");
DEFINE('BASE_URL', 'http://rickardhforslund.se/sportleague/');


function isLoggedIn(){
  if(isset($_SESSION['loginID'])){
    return true;
  }
  else{
    return false;
  }
}
function login(){
  session_start();
  $s = new Select();
  if(isset($_POST['loginPassword']) && isset($_POST['loginEmail'])){

    if($s->login($_POST['loginEmail'], $_POST['loginPassword'])){
      $_SESSION['loginID'] = $_POST['loginEmail'];

    }else{
      session_unset();
      session_destroy();
      header("Location:index.php?page=login.php");
      exit();
    }
  }else{
    session_unset();
    session_destroy();
  }
  header("Location:");
}
  function logout(){
    session_unset();
    session_destroy();
      header("Location:index.php");
  }
 ?>
