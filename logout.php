<?php
require_once('session.php');
require_once('user.php');
$user = new User();
$user->logout();
header('location: index.html');
exit;
