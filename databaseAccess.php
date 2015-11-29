<?php
$dbName = $_SERVER["DOCUMENT_ROOT"] . "localhost:8080\LTW-Project\Database\LTW_Database.sql";
if (!file_exists($dbName)) {
    die("Could not find database file.");
}

?>

