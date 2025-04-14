<?php
session_start();
//if (empty($_SESSION['token'])) {
//    $_SESSION['token'] = bin2hex(random_bytes(32));
//}

// ####### START Configure the parameters #######

$appName='BepiTBR';
$dbPath='/var/www/dbincloc/bepitbr.inc';

// ####### END Configure the parameters #######

define('APPNAME',$appName);

include_once $dbPath;

?>
