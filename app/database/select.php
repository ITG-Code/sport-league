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

    //Functions without arguements will are written with views that are in the database
    public function getAllgetAllFullTeamName(){
      $query = "SELECT * FROM getAllFullTeamName";
    }
    public function getAllOrgName(){
      $query = "SELECT * FROM getAllFullTeamName";
    }

    public function __call($name, $arg){
      $avalibleFunctions = Array("getAllOrgName","getAllgetAllFullTeamName");
      if(in_array($name, $avalibleFunctions)){
        $this.calledFunction($name);
      }
      else{
        throw new Exception("Function <b>$name</b> does not exist!");
      }
    }
    private function calledFunction($func){
      $query = "SELECT * FROM ".$func;
    }
  }

?>
