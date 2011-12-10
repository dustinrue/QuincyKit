<?
  class DatabaseCommon {
    var $username;
    var $password;
    var $hostname;
    var $host; // backwards compat
    var $numResults;
    var $resultSet;
    var $recordPosition;
    var $currentRecord;
    var $querycount;
    var $querytimes;
    var $queryperformed;
    var $keepstats = true;
    var $fieldnames = array();
    var $numfields;

    
    function __construct() {
    }
    function DatabaseCommon(){
      $this->__construct();
    }

    function setUsername($username) {
      $this->username = $username;
    }

    function setPassword($password) {
      $this->password = $password;
    }

    function setHostname($hostname) {
      $this->hostname = $hostname;
      $this->host = $hostname;
    }

    function getNumResults() {
      return $this->numResults;
    }

    function MoveFirst() {
      $this->recordPosition = 0;
    }

    function GetColumn($column) {
      return trim($this->currentRecord[$column]);
    }

    function keepStats($value) {
      $this->keepstats = $value;
    }

    function startTransaction() {
      return $this->query("begin");
    }

    function endTransaction() {
      return $this->query("commit");
    }

    function rollbackTransaction() {
      return $this->query("rollback");
    }

  }
?>
