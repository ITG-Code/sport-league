<?php
  namespace sportLeague\app\database;
  class dbSetup{
    private $con;
    const DB_HOST = "";
    const DB_DB = "";
    const DB_USERNAME = "";
    const DB_PASSWORD = "";


    function __construct(){
      $this->connection = pg_connect("host".DB_HOST." dbname=".DB_DB." user=".DB_USERNAME." password=".DB_PASSWORD." options='--client_encoding=UTF8'")
        or die('Could not connect: ' . pg_last_error());
    }
  }
?>
