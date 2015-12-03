<?php
include('startSession.php');
$_SESSION = array();
session_destroy();
exec('../Pages/LoginRegisterPage.php');
?>