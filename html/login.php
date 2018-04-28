<?php
echo "hello!".PHP_EOL;
session_start();
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$user = $conn->escape_string($_POST['user']);
echo "1";
$sql = "select * from users where user = '$user';";
echo "2";
$result = $conn->query($sql);
echo "3";

var_dump($result);

if ( $result->num_rows == 0 )
{ // User doesn't exist
    echo "user doesn't exist".PHP_EOL;
    
}
else { // User exists
    $sql = "select * from users where user = '$user';";
    $result = $conn->query($sql);
    
    $userArray = $result->fetch_assoc();
    echo "<br>user exists<br>";

    if ($_POST['password'] == $userArray['pass']) 
    {   
    
        $sql = "select * from reps where user = '$user';";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
            $rep = $result->fetch_assoc();

            echo "User: ".$rep['user']."<br>";
            echo "First: ".$rep['fname']."<br>";
            echo "Last: ".$rep['lname']."<br>";
            echo "Phone #: ".$rep['phone']."<br>";
            echo "Commission %: ".$rep['com']."<br>";

            $_SESSION['user'] = $rep['user'];
            $_SESSION['fname'] = $rep['fname'];
            $_SESSION['lname'] = $rep['lname'];
            $_SESSION['phone'] = $rep['phone'];
            $_SESSION['commission'] = $rep['com'];
            
            var_dump($user);
            // This is how we'll know the user is logged in
            $_SESSION['logged_in'] = true;

            header("location: sales.php");
        }
        else
        {
            $sql = "select * from owner where user = '$user';";
            $result = $conn->query($sql);
            
            $rep = $result->fetch_assoc();
            
            echo "User: ".$rep['user']."<br>";
            echo "First: ".$rep['fname']."<br>";
            echo "Last: ".$rep['lname']."<br>";
            echo "Phone #: ".$rep['phone']."<br>";
            echo "Commission %: ".$rep['com']."<br>";
    
            $_SESSION['user'] = $rep['user'];
            $_SESSION['fname'] = $rep['fname'];
            $_SESSION['lname'] = $rep['lname'];
            $_SESSION['phone'] = $rep['phone'];
            $_SESSION['commission'] = $rep['com'];
            
            var_dump($user);
            // This is how we'll know the user is logged in
            $_SESSION['logged_in'] = true;
    
            header("location: owner.php");
        }
        
    }
    else {
        echo "You have entered wrong password, try again!".PHP_EOL;
    }
}
?>