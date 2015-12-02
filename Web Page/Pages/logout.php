<?php
include '../Server/startSession.php';
$_SESSION = array();
session_destroy();
header("Location: LoginRegisterPage.php"); 
?>