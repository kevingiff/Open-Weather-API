<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'openWeatherApi';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = mysqli_connect($host, $user, $pass, $db);
} catch (\mysqli_sql_exception $e) {
     throw new \mysqli_sql_exception($e->getMessage(), $e->getCode());
}
unset($host, $db, $user, $pass); // we don't need them anymore

?>