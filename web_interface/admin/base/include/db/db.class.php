<?php
  require_once("dbcommon.class.php");
  require_once("mysql.class.php");

  class Database{
    var $dbconn;

    function __construct($driver) {
      $this->dbconn = new $driver;
    }

    function Database($driver) {
      $this->__construct($driver);
    }
  }
?>
