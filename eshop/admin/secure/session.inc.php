<?php
session_start();
if(!isset($_SESSION['admin'])){
	header("Location: /mysite2.local/eshop/admin/secure/login.php?ref=".$_SERVER['REQUEST_URI']);
	exit;
}