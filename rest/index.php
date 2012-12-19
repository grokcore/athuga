<?php
session_start();
/* set in /auth/ */

if (empty($_SESSION['user']) && $_SERVER['REQUEST_METHOD']!='GET') {
	die(json_encode(array('noauth'=>1)));
}
require 'slimbean/slimbean.php';


R::setup("mysql:host=localhost;dbname=athuga","root","root");

if (isset($_SESSION['user'])) {
	if (empty($_SESSION['user']['id'])) {
		$u=R::findOne('user',"identifier='{$_SESSION['user']['identifier']}'");
		if (isset($u->id)) $_SESSION['user']['id']=$u->id; else unset($_SESSION['user']['id']);
	}
}


$sb=new SlimBean;

$sb->allow('comments');
$sb->require('comments','c');

