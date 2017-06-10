<?php
$time_state = microtime(true);

$serverName = "localhost";
$connectionOptions = array(
    "Database" => "goldenglobes",
    "Uid" => "globesearch",
    "PWD" => "Turtledove1"
);

// Establish connection
$dbc = sqlsrv_connect($serverName, $connectionOptions) OR die('Could not connect to Microsoft SQL Server');
?>