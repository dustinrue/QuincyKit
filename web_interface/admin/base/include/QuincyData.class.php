<?php

	/*
	 * Author: Andreas Linde <mail@andreaslinde.de>
         * Author: Dustin Rue <ruedu@dustinrue.com>
	 *
	 * Copyright (c) 2009-2011 Andreas Linde, Kent Sutherland & Dustin Rue.
	 * All rights reserved.
	 *
	 * Permission is hereby granted, free of charge, to any person
	 * obtaining a copy of this software and associated documentation
	 * files (the "Software"), to deal in the Software without
	 * restriction, including without limitation the rights to use,
	 * copy, modify, merge, publish, distribute, sublicense, and/or sell
	 * copies of the Software, and to permit persons to whom the
	 * Software is furnished to do so, subject to the following
	 * conditions:
	 *
	 * The above copyright notice and this permission notice shall be
	 * included in all copies or substantial portions of the Software.
	 *
	 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
	 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
	 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
	 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
	 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
	 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
	 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
	 * OTHER DEALINGS IN THE SOFTWARE.
	 */

  require_once("QuincyApplication.class.php");

  class QuincyData extends MySQL {
    var $dbapptable;
    var $dbcrashtable;
    var $dbgrouptable;
    var $dbversiontable;
    var $dbsymbolicatetable;

    public function __construct() {
      parent::__construct();
      $this->dbapptable         = "apps";
      $this->dbcrashtable       = "crash";
      $this->dbgrouptable       = "crash_groups";
      $this->dbversiontable     = "versions";
      $this->dbsymbolicatetable = "symbolicated";
    }

    /**
     * @brief Adds or Updates an Application in the database
     *
     * @param A QuincyApplication object
     */
    public function addUpdateApplication(&$qa) {
      $bundleidentifier    = $qa->bundleIdentifier();
      $name                = $qa->name();
      $symbolicate         = $qa->symbolicate();
      $issuetrackrurl      = $qa->issueTrackerURL();
      $emails              = $qa->emails();
      $pushids             = $qa->pushIDs();
      $hockeyappidentifier = $qa->hockeyAppIdentifier();
      $appid               = $qa->appID();


      // insert new app
      // version is not available, so add it with status VERSION_STATUS_AVAILABLE

      if ($appid != NULL) {
        $query = "INSERT INTO " . $this->dbapptable . " (
                    bundleidentifier, 
                    name, 
                    symbolicate, 
                    issuetrackerurl, 
                    notifyemail, 
                    notifypush, 
                    hockeyappidentifier
                  ) 
                  VALUES (
                    '".$bundleidentifier."', 
                    '".$name."', 
                    ".$symbolicate.", 
                    '".$issuetrackerurl."', 
                    '".$emails."', 
                    '".$pushids."', 
                    '".$hockeyappidentifier."'
                  )";
        }
        else {
          $query = "UPDATE ".$dbapptable." 
                    SET symbolicate = ".$symbolicate.", 
                        name = '".$name."', 
                        issuetrackerurl = '".$issuetrackerurl."', 
                        hockeyappidentifier = '".$hockeyappidentifier."', 
                        notifyemail = '".$emails."', 
                        notifypush = '".$pushids."' 
                    WHERE id = ".$id;
        }

        $this->query($query);
    }

    /**
      * @brief Gets configured application[s] from the database
      *
      * @param (optional) Application Id as assigned by the database system
      */
    public function getApplication($appid = null) {
      $query = "SELECT bundleidentifier, symbolicate, id, name, issuetrackerurl, notifyemail, notifypush, hockeyappidentifier 
                FROM " . $this->dbapptable . " 
                ORDER BY bundleidentifier asc, symbolicate desc";

      if ($appid != null) {
         $query .= " WHERE id = $appid";
      }  

      $this->query($query);

      while ($this->NextRecord()) {
        $tmpApp = new QuincyApplication();

        $tmpApp->setBundleIdentifier($this->getColumn('bundleidentifier'));
        $tmpApp->setSymbolicate($this->getColumn('symbolicate'));
        $tmpApp->setAppId($this->getColumn('id'));
        $tmpApp->setName($this->getColumn('name'));
        $tmpApp->setIssueTrackerURL($this->getColumn('issuetrackerurl'));
        $tmpApp->setEmails($this->getColumn('notifyemail'));
        $tmpApp->setPushIDs($this->getColumn('notifypush'));
        $tmpApp->setHockeyAppIdentifier($this->getColumn('hockeyappidentifer'));

        $apps[] = &$tmpApp;
      }

      return $apps;
    }

    /**
      * @brief Returns the number of crashes for a given bundle identifier
      *
      * @param bundleidentifer
      */
    public function getNumberofCrashesForBundle($bundleidentifier) {
      $query = "SELECT count(1) AS numberOfCrashes
                 FROM " . $this->dbcrashtable . " 
                 WHERE bundleidentifier = '" . $bundleidentifier . "'";

      $this->query($query);
      $this->moveFirst();

      return $this->getColumn('numberOfCrashes');

   }
    public function deleteApplication($id) {
      $query = "DELETE FROM ".$dbapptable." WHERE id = ".$id;
    }

    public function setSymbolicate($id, $symbolicate) {
      $query = "UPDATE ".$dbapptable." SET symbolicate = ".$symbolicate." WHERE id = ".$id;
    }

  }
/*
} else if ($symbolicate != "" && $id != "") {
} else if ($id != "" && $symbolicate == "") {

?>
<?php
/*
//
// This is the main admin UI script
//
// You can add applications by adding their respective bundle identifiers
// and you can delete applications and define if external symbolification
// should be turned on or not
//

require_once('../config.php');
require_once('common.inc');

if ($acceptallapps)
{
	die('<html><head><META http-equiv="refresh" content="0;URL=app_versions.php"></head><body></body></html>'); 
}

init_database();
parse_parameters(',bundleidentifier,symbolicate,id,name,issuetrackerurl,hockeyappidentifier,pushids,emails,');

if (!isset($bundleidentifier)) $bundleidentifier = "";
if (!isset($symbolicate)) $symbolicate = "";
if (!isset($id)) $id = "";
if (!isset($name)) $name = "";
if (!isset($issuetrackerurl)) $issuetrackerurl = "";
if (!isset($hockeyappidentifier)) $hockeyappidentifier = "";
if (!isset($pushids)) $pushids = "";
if (!isset($emails)) $emails = "";

$query = "";
// update the app
if ($id != "" && $symbolicate != "") {
	$query = "UPDATE ".$dbapptable." SET symbolicate = ".$symbolicate.", name = '".$name."', issuetrackerurl = '".$issuetrackerurl."', hockeyappidentifier = '".$hockeyappidentifier."', notifyemail = '".$emails."', notifypush = '".$pushids."' WHERE id = ".$id;
} else if ($bundleidentifier != "" && $id == "" && $symbolicate != "") {
	// insert new app
	// version is not available, so add it with status VERSION_STATUS_AVAILABLE
	$query = "INSERT INTO ".$dbapptable." (bundleidentifier, name, symbolicate, issuetrackerurl, notifyemail, notifypush, hockeyappidentifier) values ('".$bundleidentifier."', '".$name."', ".$symbolicate.", '".$issuetrackerurl."', '".$emails."', '".$pushids."', '".$hockeyappidentifier."')";
} else if ($symbolicate != "" && $id != "") {
	$query = "UPDATE ".$dbapptable." SET symbolicate = ".$symbolicate." WHERE id = ".$id;
} else if ($id != "" && $symbolicate == "") {
	// delete a version
	$query = "DELETE FROM ".$dbapptable." WHERE id = ".$id;
}
if ($query != "")
	$result = mysql_query($query) or die(end_with_result('Error in SQL '.$query));

show_header('- Apps');

echo '<h2><a href="app_name.php">Apps</a></h2>';

$cols = '<colgroup><col width="230"/><col width="200"/><col width="200"/><col width="150"/><col width="150"/></colgroup>';
echo '<table>'.$cols;
echo "<tr><th>Bundle identifier / Name</th><th>Email - / Push Notifications</th><th>Issue Tracker / HockeyApp</th><th>Crashes</th><th>Actions</th></tr>";
echo '</table>';

if (!$acceptallapps)
{
	echo "<form name='add_app' action='app_name.php' method='get'>";
	echo '<table>'.$cols;
	
	echo "<tr align='center'><td><input type='text' name='bundleidentifier' size='25' maxlength='50' placeholder='com.yourcompany.appidentifier'/>";
	echo "<input type='text' name='name' size='25' maxlength='250' placeholder='Application Name'/></td>";
	echo "<td class='message'>";
	if ($mail_activated)
        echo "<input type='text' name='emails' size='25' maxlength='250' placeholder=', separated email addresses'/><br/>";
    else
        echo "Email notifications not activated!<br/>";
	if ($push_activated)
        echo "<input type='text' name='pushids' size='25' maxlength='250' placeholder='max. 5 , separated Prowl IDs'/>";
    else if ($boxcar_activated)
		echo "Boxcar notifications set for $boxcar_uid<br/>";
	else
        echo "Push notifications not activated!";
    echo "</td>";
	echo "<td><input type='text' name='issuetrackerurl' size='25' maxlength='4000' placeholder='%subject% %description%'/><br/>";
    echo "<input type='text' name='hockeyappidentifier' size='25' maxlength='4000' placeholder='HockeyApp Public Identifier'/>";
	echo "</td><td><select name='symbolicate'><option value=0 selected>Don't symbolicate</option><option value=1>Symbolicate</option></select>";
	echo "<br/></td>";
	echo "<td><button type='submit' class='button'>Create new App</button></td></tr>";	
	echo '</table></form>';
}

// get all applications and their symbolication status
$query = "SELECT bundleidentifier, symbolicate, id, name, issuetrackerurl, notifyemail, notifypush, hockeyappidentifier FROM ".$dbapptable." ORDER BY bundleidentifier asc, symbolicate desc";
$result = mysql_query($query) or die(end_with_result('Error in SQL '.$query));

$numrows = mysql_num_rows($result);
if ($numrows > 0) {
	// get the status
	while ($row = mysql_fetch_row($result))
	{
		$bundleidentifier = $row[0];
		$symbolicate = $row[1];
		$id = $row[2];
		$name = $row[3];
		$issuetrackerurl = $row[4];
		$email = $row[5];
		$push = $row[6];
		$hockeyappidentifier = $row[7];
		
		echo "<form name='update".$id."' action='app_name.php' method='get'><input type='hidden' name='id' value='".$id."'/>";
		echo '<table>'.$cols;

		echo "<tr align='center'><td><a href='app_versions.php?bundleidentifier=".$bundleidentifier."' placeholder='com.yourcompany.appidentifier'>".$bundleidentifier."</a><br/>";
		echo "<input type='text' name='name' size='25' maxlength='250' value='".$name."' placeholder='Application Name'/></td>";
        echo "<td class='message'>";
        if ($mail_activated)
            echo "<input type='text' name='emails' size='25' maxlength='250' placeholder='; separated email addresses' value='".$email."'/><br/>";
        else
            echo "Email notifications not activated!<br/>";
    	if ($push_activated)
            echo "<input type='text' name='pushids' size='25' maxlength='250' placeholder='max. 5 , separated Prowl IDs' value='".$push."'/>";
        else if ($boxcar_activated)
			echo "Boxcar notifications set for $boxcar_uid<br/>";
	    else
            echo "Push notifications not activated!";
        echo "</td>";
		echo "<td><input type='text' name='issuetrackerurl' size='25' maxlength='4000' value='".$issuetrackerurl."' placeholder='%subject% %description%'/><br>";
		echo "<input type='text' name='hockeyappidentifier' size='25' value='".$hockeyappidentifier."' maxlength='4000' placeholder='HockeyApp Public Identifier'/></td>";

		echo "<td><select name='symbolicate' onchange='javascript:document.update".$id.".submit();'>";
        add_option("Don't symbolicate", 0, $symbolicate);
        add_option('Symbolicate', 1, $symbolicate);			
		echo "</select><br/>";
		
		// get the total number of crashes
        $query2 = "SELECT count(*) FROM ".$dbcrashtable." WHERE bundleidentifier = '".$bundleidentifier."'";
        $result2 = mysql_query($query2) or die(end_with_result('Error in SQL '.$query2));

        $totalcrashes = 0;
        $numrows2 = mysql_num_rows($result2);
        if ($numrows2 > 0) {
            $row2 = mysql_fetch_row($result2);
            $totalcrashes = $row2[0];
            
            mysql_free_result($result2);
        }
        
        echo $totalcrashes . "</td>";

		echo "<td><button class='button' type='submit'>Update</button>";
		echo " <a href='app_name.php?id=".$id."' class='button redButton' onclick='return confirm(\"Do you really want to delete this item?\");'>Delete</a></td>";
		echo "</tr></table></form>";
	}
	
	mysql_free_result($result);
}

mysql_close($link);

echo '</body></html>';
*/
?>
