<?php
  namespace sportLeague\app\database;
  class Select extends dbSetup{
    /**
    *private $connection;
    *const DB_HOST = "";
    *const DB_DB = "";
    *const DB_USERNAME = "";
    *const DB_PASSWORD = "";
    *
    *
    *function __construct(){
    *  $this->connection = pg_connect("host".DB_HOST." dbname=".DB_DB." user=".DB_USERNAME." password=".DB_PASSWORD." options='--client_encoding=UTF8'")
    *    or die('Could not connect: ' . pg_last_error());
    *}
    *
    *
    *
    *
    */
    private function getSimpleView($view){
      $query = "SELECT * FROM ". $view;
      pg_query_params($this->con, $query);
      $objAr = array();
      while($obj = pg_fetch_object($this->con)){
        array_push($objAr, $obj);
      }

      echo "Function worked!\n";
      echo "Huzza!";
      return $objAr;
    }
    public function getAllgetAllFullTeamName(){
      return getSimpleView("getAllFullTeamName");
    }
    public function getAllOrgName(){
      return getSimpleView("getAllOrgName");
    }
  }

?>
