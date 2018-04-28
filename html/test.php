<?php
$host = 'localhost';
$user = 'root';
$pass = 'monkey';
$db = 'Used_Cars';
$conn = new mysqli($host,$user,$pass,$db);

if($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select * from reps";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo $row['user'];
}

var_dump($result);
?>