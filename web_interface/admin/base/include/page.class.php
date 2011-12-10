<?php
  // a class to extend the smarty class.  This will allow me to
  // setup all the paths once, instead of per script
 // require_once("../config.php");
  require_once("Smarty.class.php");

  class Page extends Smarty {
    var $template     = "index.tpl";
    var $timers       = array();
    var $query_string;
    var $headers      = array();
    var $widgets      = array();
    var $logging      = array(); //each element is one log entry string
    

    function __construct() {
      parent::__construct(); 
    }

    function __destruct() {
      
    }

    function startTimer($name) {
      $this->timers[$name]['starttime'] = microtime();
      $this->timers[$name]['endtime']   = "0:00";
      $this->timers[$name]['elapsed']   = "0:00";
    }


    function stopTimer($name) {

      $endtime            = microtime();
      $parts_of_starttime = explode(' ', $this->timers[$name]['starttime']);
      $starttime          = $parts_of_starttime[0] + $parts_of_starttime[1];
      $parts_of_endtime   = explode(' ', $endtime);
      $endtime            = $parts_of_endtime[0] + $parts_of_endtime[1];
      $time_taken         = $endtime - $starttime;
      $time_taken         = number_format($time_taken, 4);  // optional
      
      $this->timers[$name]['endtime'] = $endtime;
      $this->timers[$name]['elapsed'] = $time_taken;
    }

    function getTimers() {
      return $this->timers;
    }

    function getTimer($name) {
      if ($this->timers[$name]['endtime'] == "0:00") {
        return -1;
      }
      else {
        return $this->timers[$name]['elapsed'];
      }
    }

    function setQueryString($q) {
      $this->query_string = $q;
    }

    function popQueryString() {
      $num = count($this->query_string);

      if ($num > 0) {
        return @array_shift($this->query_string);
      }
      else {
        return false;
      }
    }

    function setTemplate($template) {
      $this->template = $template;
    }

    function setTheme($template_dir,$theme) {
      $this->template_dir = $template_dir . "/";
      $this->theme = $theme;
    }

    function render() {
      $this->assign("headers",$this->headers);
      $this->assign("themepath","/themes/" . $this->theme);
      $this->logger("Rendering " . $this->template);
      $this->display($this->template);
    }

    function ShowVariables() {
      echo $this->template_dir . "<br>\n";
      echo $this->compile_dir . "<br>\n";
    }

    function redirect($parameters = "") {
      header("Location: " . $this->buildRedirect($parameters));
    }

    function report_error($e) {
      $message = $e->getMessage() . " at line " . $e->getLine() . " of " . $e->getFile() . "<br/>\n";
      $message .= "Stack trace:<br/>\n";
      $message .= $e->getCode();
      $this->flash("error",$message, $_SERVER['PHP_SELF']);
    }

    function flash($messagetype, $message, $url, $noauto = 0) {
      $this->assign("messagetype", $messagetype);
      $this->assign("message", $message);
      $this->assign("url", $url);
      $this->setTemplate("flash.tpl");

      if ($noauto == 0) {
        $this->render();
        exit;
      }
    }

    function buildRedirect($parameters) {
      global $config;
      $location = "http://" . $_SERVER["SERVER_NAME"] . $config['base_uri'] . "";

      if ($parameters != "") {
        $location .= "$parameters";
      }
      return $location;
      
    }

    function addCSSHeader($css, $media = "screen") {
      $this->headers[] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/$css\" media=\"$media\" />";
    }

    function addJSHeader($js) {
      $this->headers[] = "<script src=\"/js/$js\" type=\"text/javascript\"></script>";
    }

    function logger($entry) {
      $this->logging[] = $entry;
    }

    function flushLogs() {
      return $this->logging;
    }

  }
?>
