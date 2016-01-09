<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once ('helper.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Sport-League</title>

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
      <h1>Sport-League Admin Page</h1>
      <p>A league of sports</p>
    </div>

    <?php
    if(isset($_SESSION['loginID'])){
      include_once("includes/menu.php");
    }else{
      ?>
      <div class="row">
        <div class="col-md-4"></div>
        <form class="form-horizontal well col-md-4" action="login.php" method="post">
          <fieldset>
            <legend>Admin Login</legend>
            <div class="form-group">
              <label for="loginEmail" class="col-md-2 control-label">Email</label>
              <div class="col-md-10">
                <input type="email" name="loginEmail" class="form-control" placeholder="Email"required="required"/>
              </div>

            </div>
            <div class="form-group">
              <label for="loginPassword" class="col-md-2 control-label">Password</label>
              <div class="col-md-10">
                <input type="password" name="loginPassword" class="form-control" placeholder="Password" required="required"/>
              </div>

            </div>

            <input type="submit" value="Login" class="btn btn-primary"/>
          </fieldset>
        </form>
        <div class="col-md-4"></div>
      </div>
      <?php
    }


    ?>



    <footer class="row">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/material.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/ripples.min.js"></script>
      <p class="col-lg-4">Copyright &copy; Hannes Kindströmmer & Rickardh Forslund</p>
    </footer>
  </div>

</body>
</html>
