<?php
$host = 'localhost';
$user = 'root';
$pass = 'monkey';
$db = 'tasker';
$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected to database".PHP_EOL;
?>
