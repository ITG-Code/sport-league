<?php
  class dbSetup{
    protected $db;
    private $DB_HOST = "";
    private $DB_DB = "";
    private $DB_USERNAME = "";
    private $DB_PASSWORD = "";


    function __construct(){
      try{
         $this->db = new mysqli($this->DB_HOST, $this->DB_USERNAME, $this->DB_PASSWORD, $this->DB_DB);
      }
      catch(Exeception $e){
         echo 'Caught exception: ', $e->getMessage(), "\n";
      }

  }
}
?>
