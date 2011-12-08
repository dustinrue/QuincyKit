<?php


	/*
	 * Author: Andreas Linde <mail@andreaslinde.de>
	 *
	 * Copyright (c) 2009-2011 Andreas Linde.
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


// database server hostname
$server                 = 'your.server.com';      

// username to access the database
$loginsql               = 'database_username';    

// password for the above username
$passsql                = 'database_password';    

// database name which contains the below listed tables
$base                   = 'database_name';        

// if set to true, all crash logs will be added and todo entries for 
// symbolication will be added too otherwise the app identifiers need to be 
// added in the UI and todo can be turned on individually
$acceptallapps          = false;

// activate push notifications via Prowl?
$push_activated         = false;                  

// Up to 5 comma separated prowl api keys which should get the notifications
// can also be set per app, this is a global setting also effective when 
// acceptallapps is true
$push_prowlids          = '';        

// Separate setting for Boxcar, so as to not interfere with Prowl config
$boxcar_activated       = true; 

// Boxcar user email
$boxcar_uid             = "";                     

// Boxcar password
$boxcar_pwd             = "";  

// activate email notifications
$mail_activated         = true;

// comma separated mail addresses to send notification emails to. Can also be 
// set per app, this is a global setting also effective when acceptallapps 
// is true
$mail_addresses         = '';

// sender address used for notification emails
$mail_from              = 'sender@yourdomain.com';

// if the mail should contain a link to the crash, at the base url like 
// http://www.yourserver.com/admin/crashes.php?..." with a direct link to the 
// crash group will be added automatically!
$crash_url              = "http://" . $_HTTP['HOST_NAME'];

// the amount of crashes found for a type which invokes a push notification to 
// be send, 1 to deactivate
$notify_amount_group    = 10;                      

// default behaviour for a new app version push behaviour
$notify_default_version = NOTIFY_OFF;          

// amount of crashes shown by default per pattern, enhances page loading speed 
// in case there are a lot of crashes
$default_amount_crashes = 5;		

// color of timestamp if the latest crash is within the last 24h in Version view
$color24h               = "red";

// color of timestamp if the latest crash is within the last 48h in Version view
$color48h               = "orange";

// color of timestamp if the latest crash is within the last 72h in Version view
$color72h               = "black";

// color of timestamp for older last crashes in Version view
$colorOther             = "grey";  

// Adjust this string to your own title string shown on top of every page
$admintitle             = "CrashReporter Admin Interface";

// The title given for a new issue
$createIssueTitle       = "New crash type";




#
# Database Table Names
# 

// contains the actual crash log data
$dbcrashtable           = 'crash';                

// contains the automatically generated grouping definitions for crash log data
$dbgrouptable           = 'crash_groups';         

// contains a list of allowed applications which crash logs will be accepted
$dbapptable             = 'apps';                 

// contains a list of versions per application with a status, that can be used 
// to provide the user with some feedback
$dbversiontable         = 'versions';

// contains a todo list of crash log data which has to be symbolicated by an 
// external task (symbolicate.php)
$dbsymbolicatetable     = 'symbolicated';



// The HockeyApp server address to route the crashes to, this should normally 
// never be edited!
$hockeyAppURL           = 'ssl://beta.hockeyapp.net/';    



$statusversions         = array(
                            0 => 'Unknown', 
                            1 => 'In development', 
                            2 => 'Submitted', 
                            3 => 'Available', 
                            4 => 'Discontinued'
                          );

// set the default timezone (see http://de3.php.net/manual/en/timezones.php)
$config['time_zone']    = "Europe/Berlin";

// set base_uri to the URL QuincyKit scripts are installed to
$config[base_uri]       = "/"; 
$config[base_dir]       = $_SERVER[DOCUMENT_ROOT] . $config[base_uri];

// set the include path
$include_path           = get_include_path();
ini_set(include_path, $include_path . ":" .
    $config[base_dir] . "/include");

date_default_timezone_set($config['time_zone']);	
require_once("defines.php");
?>
