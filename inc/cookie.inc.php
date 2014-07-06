<?php
$visitCounter = 0;
$lastVisit = '';

if(isset($_COOKIE['visitCounter']))
	$visitCounter = $_COOKIE['visitCounter'];
if(isset($_COOKIE['lastVisit']))
	$lastVisit = date('d-m-Y H:i:s', $_COOKIE['lastVisit']);
if(date('d-m-Y') != date('d-m-Y', @$_COOKIE['lastVisit'])){
	$visitCounter++;
	setcookie('visitCounter', $visitCounter, 0x7FFFFFFF);
	setcookie("lastVisit", time(), 0x7FFFFFFF);
}
