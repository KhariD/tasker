#!/usr/bin/php
<?php
echo $argv[0].": begin".PHP_EOL;
$mysql = new mysqli("localhost","studentAdmin","12345","students");

if ($mysql->errno != 0)
{
	echo "error connecting to database: ".$mysql->error.PHP_EOL;
	exit(0);
}

$sql = "select * from students;";

$response = $mysql->query($sql);
if ($mysql->errno != 0)
{
	echo "error executing sql: ".$mysql->error.PHP_EOL;
	echo $sql.PHP_EOL;
	exit(0);
}

while($result = $response->fetch_assoc())
{
	var_dump($result);
	echo PHP_EOL;
}

$insert = "insert into students (id,student,year,major)values (".$argv[1].",'".$argv[2]."','".$argv[3]."','".$argv[4]."');";

$response = $mysql->query($insert);
if ($mysql->errno != 0)
{
	echo "error executing sql: ".$mysql->error.PHP_EOL;
	echo $sql.PHP_EOL;
	exit(0);
}


echo $argv[0].": end".PHP_EOL;
?>

