<?php
define("VERSION_STATUS_UNKNOWN", 0);        // bug may get fixed in an unknown version
define("VERSION_STATUS_ASSIGNED", 1);       // bug will get fixed in a defined version
define("VERSION_STATUS_SUBMITTED", 2);      // bug is fixed in a defined version, and the version has been submitted to the publisher
define("VERSION_STATUS_AVAILABLE", 3);      // bug is fixed in a defined version, and the version is available for the customer
define("VERSION_STATUS_DISCONTINUED", 4);   // version is no longer maintained, don't accept crash logs

// notify status per version
define("NOTIFY_OFF", 0);                      // don't send notifications
define("NOTIFY_ACTIVATED", 1);                // send notifications for first and for $notify_amount_group
define("NOTIFY_ACTIVATED_AMOUNT", 2);         // send notifications for $notify_amount_group only

// sending crash log ended in failure error codes
define("FAILURE_DATABASE_NOT_AVAILABLE", -1);           // database cannot be accessed, check hostname, username, password and database name settings in config.php 
define("FAILURE_INVALID_INCOMING_DATA", -2);           	// incoming data may not be added, because e.g. bundle identifier wasn't found 
define("FAILURE_INVALID_POST_DATA", -3);           		// the post request didn't contain valid data 
define("FAILURE_SQL_SEARCH_APP_NAME", -10);    			// SQL for finding the bundle identifier in the database failed
define("FAILURE_SQL_FIND_KNOWN_PATTERNS", -11); 		// SQL for getting all the known bug patterns for the current app version in the database failed
define("FAILURE_SQL_UPDATE_PATTERN_OCCURANCES", -12); 	// SQL for updating the occurances of this pattern in the database failed
define("FAILURE_SQL_CHECK_BUGFIX_STATUS", -13); 		// SQL for checking the status of the bugfix version in the database failed
define("FAILURE_SQL_ADD_PATTERN", -14); 				// SQL for creating a new pattern for this bug and set amount of occurrances to 1 in the database failed
define("FAILURE_SQL_CHECK_VERSION_EXISTS", -15); 		// SQL for checking if the version is already added in the database failed
define("FAILURE_SQL_ADD_VERSION", -16); 				// SQL for adding a new version in the database failed
define("FAILURE_SQL_ADD_CRASHLOG", -17);                // SQL for adding crash log in the database failed
define("FAILURE_SQL_ADD_SYMBOLICATE_TODO", -18);        // SQL for adding a symoblicate todo entry in the database failed
define("FAILURE_XML_VERSION_NOT_ALLOWED", -20); 		// XML: Version string contains not allowed characters, only alphanumberical including space and . are allowed
define("FAILURE_XML_SENDER_VERSION_NOT_ALLOWED", -21);  // XML: Sender ersion string contains not allowed characters, only alphanumberical including space and . are allowed
define("FAILURE_VERSION_DISCONTINUED", -30);            // The app version causing this crash has been discontinued
define("FAILURE_PHP_XMLREADER_CLASS", -40);             // PHP: XMLReader class is not available in PHP
define("FAILURE_PHP_PROWL_CLASS", -41);                 // PHP: Prowl class is not available in PHP
define("FAILURE_PHP_CURL_LIB", -41);                    // PHP: cURL library missing vital functions or does not support SSL. cURL w/SSL is required to execute ProwlPHP.

define("SEARCH_TYPE_ID", 0);                            // Search for a crash ID
define("SEARCH_TYPE_DESCRIPTION", 1);                   // Search for in the crash descriptions
define("SEARCH_TYPE_CRASHLOG", 2);                      // Search for in the crashlogs
?>
