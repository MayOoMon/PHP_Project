<?php


$_SESSION['user'] = null;

session_destroy();

setcookie(session_name(),'',time()-3600);

header('location: /login');
exit();