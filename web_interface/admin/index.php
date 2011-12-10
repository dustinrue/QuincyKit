<?php

  require_once("../config.php");
  require_once("db.class.php");
  require_once("page.inc.php");

  $page = new Page();

  // web interface requires clean URLs so all URLs will come in 
  // in the form of index.php?q= and then the query string
  // this means that *all* requests are fed through this script.
  // the very first parameter is the action to be performed.  This
  // action is included at run time and that action is reponsible
  // for pulling additional parameters from the query string.
  // In essence, you continue to stack additional included files
  // until the job is done and then return to this index.php
  // file to call the template that is responsible for displaying
  // the gathered data
  // 

  // TODO: add method to page to allow for setting allowed actions
  if ($_GET['q'] != "") {
    $page->setQueryString(explode("/",$_GET[q]));

    $action = $page->popQueryString();
  }


  // the "theme" is determined by the config file but could easily be 
  // database based
  // The action or a file included by the action is responsible for
  // setting which template needs to be rendered for the user
  $page->setTheme($config['template_dir'],$config['defaulttheme']);


  // these directories must exist and must be writable by the process
  // under which apache is running
  $page->compile_dir  = $config['compile_dir'];
  $page->cache_dir    = $config['cache_dir'];
 
  // called for action better exist or this is going to simply die
  require_once($config['base_dir'] . "/actions/" . "/" . $action . ".inc.php");


  // render the page
  $page->render();
?>
