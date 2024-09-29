<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tiem_chung";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>