<?php
include('startSession.php');
$_SESSION = array();
session_destroy();
include('../Pages/LoginRegisterPage.php');
?>