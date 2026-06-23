<?php
include_once(dirname(__FILE__).'/../include/config.ini.php');
include_once(dirname(__FILE__).'/../library/dbClass.php');

class openClass extends dbClass{
	function __construct($config) {
		parent::connect($config);
	}
}