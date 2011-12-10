<?php

   // Author: Dustin Rue
   // Date: Sept 22, 2002

   //! Simple MySQL abstraction layer
   /*!
        a simple database abstraction layer
   */

   class mysql extends DatabaseCommon {

     var $database; /**< name of database to use */
     var $username;
     var $password;
     var $port;
     var $dbconn;
     var $results;
     var $numresults;
     var $row;
     var $current_row_number;

     function __construct() {
       $this->MySQL();
     }
     function MySQL () {
       $this->host = "localhost";
       $this->username = "root";
       $this->password = "";
     }

     /** 
      * sets the database name
      * 
      * @param name name of the database to use
      * @return nothing
     */
     function setDatabase($name) { 
       $this->database = $name;
     }
  
     function setUsername ($username) {
       $this->username = $username;
     }

     function setPassword ($password) { 
       $this->password = $password;
     }
 
     function GetLastId() {
       return  mysql_insert_id($this->dbconn);
     }
     function keepStats($value) {
       $this->keepstats = $value;
     }
     function Port ($port) {
       $this->port = $port;
     }

     function Connect () {
       $this->dbconn = mysql_pconnect($this->host,$this->username,$this->password);
       mysql_select_db($this->database);
       $this->current_row_number = 0;
       $this->numresults=0;
       $this->querycount = 0;
       
       if ( ! $this->dbconn) {
         echo "<span style=\"color:#FF0000\">Error: Unable to connect to database</span><br>\n";
       }
       return $this->dbconn;
     }

     function ConnectionStatus() {
       return $this->dbconn;
     }

     function escape_string($string) {
       if (get_magic_quotes_gpc()) {
          $string = stripslashes($string);
       }

       return mysql_real_escape_string($string);
     }

     function Query($query) {
       $starttime          = microtime();
       if (is_null($this->dbconn)) {
         echo "Error: Not connected to database, issue Connect() first<br>\n";
       }
       else {
         $this->results = mysql_query($query);

         // cut out early if this fails...
         if ($this->results == "") {
           echo mysql_error($this->dbconn);
           return $this->results;
         }
           
         $this->numresults = @mysql_num_rows($this->results);
         $this->current_row_number = 0;
         $this->numfields = @mysql_num_fields($this->results);
         $this->fieldnames = array();
         for ($i = 0; $i < $this->numfields; $i++) {
           array_push($this->fieldnames,@mysql_field_name($this->results,$i));
         }
       }
       $endtime            = microtime();
       $parts_of_starttime = explode(' ', $starttime);
       $starttime          = $parts_of_starttime[0] + $parts_of_starttime[1];
       $parts_of_endtime   = explode(' ', $endtime);
       $endtime            = $parts_of_endtime[0] + $parts_of_endtime[1];
       $time_taken         = $endtime - $starttime;
       $this->querytimes[$this->querycount]  = number_format($time_taken, 3);  // optional
       $this->queryperformed[$this->querycount] = $query;
       $this->querynumresults[$this->querycount] = $this->numresults;
       $this->querycount++;
       
       return $this->results;
       
     }

     function getFieldNameArray() {
       return $this->fieldnames;
     }

     function Move($number) {
       if ($number > $this->numresults) {
         return 1;
       }
       $this->current_row_number = $number;
       return 0;
     }

     function lastError() {
       
       return mysql_error($this->dbconn);
     }

     function NumResults() { 
       return $this->numresults;
     }
   
     function MoveFirst () {
       mysql_data_seek($this->results, 0);
       $this->row = mysql_fetch_assoc($this->results);
       $this->current_row_number = 0;
     }

     function GetColumn ($column) {
       return $this->row[$column];
     }

     function Insert($table, $fields) {
      $insert_fields = ""; /* make sure we start empty */
      $insert_values = "";
      while (false !== (list($key,$value) = each($values))) {
        if ($insert_fields == "") {
          $insert_fields = $key;
          $insert_values = "'" . $value . "'";
        }
        else {
          $insert_fields = $insert_fields . "," . $key;
          $insert_values = $insert_values . ",'" . $value . "'";
        }

      }

      echo "INSERT INTO $table(" . $insert_fields . ") VALUES($insert_values)<br>\n";
     }

     function NextRecord() {
       if ($this->current_row_number >= $this->numresults) {
         return false;
       }
       else {
         mysql_data_seek($this->results, $this->current_row_number);
         $this->row = mysql_fetch_assoc($this->results);
         $this->current_row_number++;
         return true;
       }
     }

     function getRowAsArray() {
       return $this->row;
     }

     function ResultSet() {
        return $this->results;
     }

     function Destroy () {
       @mysql_close ($this->dbconn);
       unset ($this->results);
       if ($this->keepstats) {
         echo "\n\n<!-- Stats for mysql dbconn $this->dbconn\n";
         echo "     Total Queries: $this->querycount\n";
         echo "     Query times and query performed are as follows\n";
         for ($i = 0; $i < $this->querycount; $i++) {
           echo "     Query $i time: " . $this->querytimes[$i] . " seconds and returned " . $this->querynumresults[$i] . " row[s]\n";
	   echo "       " . $this->queryperformed[$i] . "\n";
         }
         echo "\n-->\n\n";
       }
     }
  } // End class db

?>
