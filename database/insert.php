<?php
require_once('database/dbSetup.php');
require_once('objects/player.php');

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


}


 ?>
