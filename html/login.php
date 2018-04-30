<?php
session_start();
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$user = $conn->escape_string($_POST['user']);
$sql = "select * from user where user = '$user';";
$result = $conn->query($sql);

//var_dump($result);

if ( $result->num_rows == 0 )
{ 
    // User doesn't exist
    echo "<br><strong>User Doesn't Exist!!</strong><br>".PHP_EOL;
    
}
else 
{ 
    // User exists
    $sql = "select * from user where user = '$user';";
    $result = $conn->query($sql);
    
    $userArray = $result->fetch_assoc();
    echo "<br><strong>User Exists!!</strong><br>";

    if ($_POST['password'] == $userArray['pass']) 
    {   
    	var_dump($user);
      	// This is how we'll know the user is logged in	
    	
	$_SESSION['logged_in'] = true;

        header("location: tasker.php");
	
    }
    else
    {
        echo "You have entered wrong password, try again!".PHP_EOL;
    }
}
?>
