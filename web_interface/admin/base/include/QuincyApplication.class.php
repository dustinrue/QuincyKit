<?php
	/*
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
  // represents an app

  class QuincyApplication {
    var $bundleidentifier;
    var $name;
    var $symbolicate;
    var $issueTrackerURL;
    var $emails;
    var $pushids;
    var $hockeyAppIdentifier;
    var $appID;

    public function __construct() {
    }

    public function setBundleIdentifier($bundleidentifier) {
      $this->bundleidentifier = $bundleidentifier;
    }

    public function bundleidentifier() {
      return $this->bundleidentifier;
    }

    public function setName($name) {
      $this->name = $name;
    }

    public function name() {
      return $this->name;
    }

    public function setSymbolicate($symbolicate) {
      $this->symbolicate = $symbolicate;
    }

    public function symbolicate() {
      return $this->symbolicate;
    }

    public function setIssueTrackerURL($url) {
      $this->issueTrackerURL = $url;
    }

    public function issueTrackerURL() {
      return $this->issueTrackerURL;
    }

    public function setEmails($emails) {
      $this->emails = $emails;
    }

    public function emails() {
      return $this->emails;
    }

    public function setPushIDs($pushids) {
      $this->pushids = $pushids;
    }

    public function pushIDs() {
      return $this->pushids;
    }

    public function setHockeyAppIdentifier($hockeyappidentifier) {
      $this->hockeyAppIdentifier = $hockeyappidentifier;
    }

    public function hockeyAppIdentifier() {
      return $this->hockeyAppIdentifier;
    }

    public function setAppID($appid) {
      $this->appID = $appid;
    }

    public function appID() {
      return $this->appID;
    }


  }
?>
