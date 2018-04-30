<?php

session_start();

$user = $conn->escape_string($_POST['user']);
$sql = "select * from user where user = '$user';";
$result = $conn->query($sql);

if ( $result->num_rows == 0 )
{ 
    echo "<br><strong>User Doesn't Exist!!</strong><br>".PHP_EOL;  
}
else 
{ 
    $sql = "select * from user where user = '$user';";
    $result = $conn->query($sql);
    
    $userArray = $result->fetch_assoc();
    echo "<br><strong>User Exists!!</strong><br>";

    if ($_POST['password'] == $userArray['pass']) 
    {   
	    $_SESSION['user'] = $user;
    	var_dump($user);
        
        $_SESSION['logged_in'] = true;
        header("location: tasker.php");
    }
    else
    {
        echo "You have entered wrong password, try again!".PHP_EOL;
    }
}
?>
