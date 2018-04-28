#!/usr/bin/php
<?php
# this is a comment here
$variablename = "this is now a string";
$variable2 = "carl";// but this is an integer
$variable3 = 0.5; // and this is a float
$variableArray = array();
$variableArray[0] = 3;
$variableArray[1] = "potato";
$variableArray['steve'] = "jobs";
$variableArray[] = array();
$variableArray[2][0] = 5;
if ($variable2 === 4)
{
	print_r($variableArray);
	/*
	multi line comment
	*/
}

for ($i = 0;$i < 10; $i++)
{
	echo "loop: ".$i.PHP_EOL;
}

for ($i = 0; $i< 3; $i++)
{
	echo "array[$i]: ".$variableArray[$i].PHP_EOL;
}

foreach ($variableArray as $value)
{
	var_dump($value);
}
switch($variable2)
{
	case 4:
	case 4.0:
		echo "value was 4".PHP_EOL;
	break;
	case 5:
		echo "value was 5".PHP_EOL;
	break;
	default:
		echo "value was $variable2".PHP_EOL;
}

function testFunc($inputVariable,$default = "default")
{
	echo "input variable was:";
	print_r($inputVariable);
	echo PHP_EOL;
	echo "default was:";
	print_r($default);
	echo PHP_EOL;
	return $default;
}

testFunc($variable2);
$result = testFunc($variableArray,"steve");

echo "result was $result".PHP_EOL;

class testClass
{
	private $v = 2;
	function __construct ($var)
	{
		$v = 3;
		if (isset($var))
		{
			$this->v = $var;
		}
	}

	function __destruct()
	{
		unset($this->v);
	}
	function print_v()
	{
		echo $this->v.PHP_EOL;
	}
}

$test = new testClass(4);
$test->print_v();
?>
