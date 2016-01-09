<?php
class dbSetup{
  protected $db;
  private $host = "localhost";
  private $dbName = "sportleague";
  private $username = "root";
  private $password = "rickfo97";


  function __construct(){
    try{
      $this->db = new mysqli($this->host, $this->username, $this->password, $this->dbName);
    }
    catch(Exeception $e){
      echo 'Caught exception: ', $e->getMessage(), "\n";
    }
    if (!$this->db->set_charset("utf8")) {
      printf("Error loading character set utf8: %s\n", $mysqli->error);
      exit();
    }

  }

  public function getSQL($query){
    return $this->db->query($query);
  }
}
?>
