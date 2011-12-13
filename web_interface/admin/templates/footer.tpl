<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML  4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"><html><head><title>CrashReporter Admin Interface - Apps</title><link rel="stylesheet" href="blueprint/screen.css" type="text/css" media="screen, projection"><link rel="stylesheet" href="blueprint/print.css" type="text/css" media="print"><!--[if IE]><link rel="stylesheet" href="blueprint/ie.css" type="text/css" media="screen, projection"><![endif]--><link rel="stylesheet" href="blueprint/plugins/buttons/screen.css" type="text/css" media="screen, projection"><link rel="stylesheet" type="text/css" href="css/layout.css"><link rel="stylesheet" type="text/css" href="css/style.css"><script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js'></script><script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js'></script><script type='text/javascript' src='js/jquery.chromatable.js'></script><script type='text/javascript' src='js/functions.js'></script><!--[if IE]><script language="javascript" type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="js/jquery.jqplot.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jqplot.barRenderer.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jqplot.categoryAxisRenderer.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="js/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="js/jqplot.canvasAxisTickRenderer.min.js"></script>
<script type="text/javascript" src="js/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="js/jqplot.pointLabels.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.jqplot.css" />
</head><body><div id="container" class="container prepend-top append-bottom"><h1>CrashReporter Admin Interface</h1><h2><a href="app_name.php">Apps</a></h2><table><colgroup><col width="230"/><col width="200"/><col width="200"/><col width="150"/><col width="150"/></colgroup><tr><th>Bundle identifier / Name</th><th>Email - / Push Notifications</th><th>Issue Tracker / HockeyApp</th><th>Crashes</th><th>Actions</th></tr></table><form name='add_app' action='app_name.php' method='get'><table><colgroup><col width="230"/><col width="200"/><col width="200"/><col width="150"/><col width="150"/></colgroup><tr align='center'><td><input type='text' name='bundleidentifier' size='25' maxlength='50' placeholder='com.yourcompany.appidentifier'/><input type='text' name='name' size='25' maxlength='250' placeholder='Application Name'/></td><td class='message'><input type='text' name='emails' size='25' maxlength='250' placeholder=', separated email addresses'/><br/><input type='text' name='pushids' size='25' maxlength='250' placeholder='max. 5 , separated Prowl IDs'/></td><td><input type='text' name='issuetrackerurl' size='25' maxlength='4000' placeholder='%subject% %description%'/><br/><input type='text' name='hockeyappidentifier' size='25' maxlength='4000' placeholder='HockeyApp Public Identifier'/></td><td><select name='symbolicate'><option value=0 selected>Don't symbolicate</option><option value=1>Symbolicate</option></select><br/></td><td><button type='submit' class='button'>Create new App</button></td></tr></table></form><form name='update4' action='app_name.php' method='get'><input type='hidden' name='id' value='4'/><table><colgroup><col width="230"/><col width="200"/><col width="200"/><col width="150"/><col width="150"/></colgroup><tr align='center'><td><a href='app_versions.php?bundleidentifier=com.dustinrue.ControlPlane' placeholder='com.yourcompany.appidentifier'>com.dustinrue.ControlPlane</a><br/><input type='text' name='name' size='25' maxlength='250' value='ControlPlane' placeholder='Application Name'/></td><td class='message'><input type='text' name='emails' size='25' maxlength='250' placeholder='; separated email addresses' value='ruedu@dustinrue.com, david.jennes@gmail.com'/><br/><input type='text' name='pushids' size='25' maxlength='250' placeholder='max. 5 , separated Prowl IDs' value='d0669cfea52ead256762234f3de5829deaec06f8'/></td><td><input type='text' name='issuetrackerurl' size='25' maxlength='4000' value='' placeholder='%subject% %description%'/><br><input type='text' name='hockeyappidentifier' size='25' value='' maxlength='4000' placeholder='HockeyApp Public Identifier'/></td><td><select name='symbolicate' onchange='javascript:document.update4.submit();'><option value="0">Don't symbolicate</option><option value="1" selected>Symbolicate</option></select><br/>32</td><td><button class='button' type='submit'>Update</button> <a href='app_name.php?id=4' class='button redButton' onclick='return confirm("Do you really want to delete this item?");'>Delete</a></td></tr></table></form></body></html>
