<?php
require 'db.php';
/* Displays user information and some useful messages */
echo "<BR>DEALERSHIP OWNER<BR>";
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) 
{
  $_SESSION['message'] = "You must log in before viewing your profile page!";

}
else {
    // Makes it easier to read
    echo "successfully logged in!!! :))<br>";

    $user = $_SESSION['user'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $phone = $_SESSION['phone'];
    $com = $_SESSION['commission'];

    echo "User: ".$user."<br>";
    echo "First: ".$fname."<br>";
    echo "Last: ".$lname."<br>";
    echo "Phone #: ".$phone."<br>";
    echo "Commission: ".$com."<br>";
}
?>

<!DOCTYPE html>
<html>
<body>
  <div class="addR">
    <div id="addR">
      <h1>Dealership Owner Portal!</h1>   
        <form action="owner.php" method="post" autocomplete="off">
            <br>
            <label>
                Add New Sales Representative!
            </label>
            <br>
            Username: <input type="user" required name="usr" placeholder="Enter username"/><br>
            First Name: <input type="text" name="fname" placeholder="First name"/><br>
            Last Name: <input type="text" name="lname" placeholder="Last name"/><br>
            Phone #: <input type="text" name="phone" placeholder="Phone number"/><br>
            Commission: <input type="text" name="com" placeholder="Commission (0.xx)"/><br>
            Password: <input type="password" required name="pass" placeholder="Enter password"/><br>
            
            <button class="button button-block" name="addRep" />Add Representative</button>
        </form>
    </div><!-- tab-content -->
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{   
    if (isset($_POST['addRep'])) 
    { 
        $usr = $conn->escape_string($_POST['usr']);
        $fname = $conn->escape_string($_POST['fname']);
        $lname = $conn->escape_string($_POST['lname']);
        $phone = $conn->escape_string($_POST['phone']);
        $com = $conn->escape_string($_POST['com']);
        $pass = $conn->escape_string($_POST['pass']);
        

        //find out if rep exists
        $sql = "select * from users where user = '$usr';";
        $result = $conn->query($sql);
        $result->fetch_assoc();

        $sql2 = "select * from reps where user = '$usr';";
        $result2 = $conn->query($sql2);
        $result2->fetch_assoc();

        if($result->num_rows == 0 )
        {
            if($result2->num_rows == 0)
            {
                $sql = "insert into users (user, pass)
                values ('$usr', '$pass');";

                if ($conn->query($sql) === TRUE)
                {
                    echo "<br>User added successfully!<br>";
                }
                else
                {
                    echo "<br>Error: ".$sql."<br>".$conn->error;
                }

                $sql = "insert into reps (user, fname, lname, phone, com)
                values ('$usr', '$fname', '$lname', '$phone', '$com');";

                if ($conn->query($sql) === TRUE)
                {
                    echo "<br>Sales representative added successfully!<br>";
                }
                else
                {
                    echo "<br>Error: ".$sql."<br>".$conn->error;
                }
            }
            else
            {
                echo "<br>Sales Rep already exists";
            }
        }
        else
        {
           echo "<br>User already exists!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<body>
  <div class="add">
    <div id="add">
        <form action="owner.php" method="post" autocomplete="off">
            <br>
            <label>
                Add New Vehicle!
            </label>
            <br>
            <input type="text" required name="vin" placeholder="Enter vin"/><br>
            <input type="text" name="make" placeholder="Enter make"/><br>
            <input type="text" name="model" placeholder="Enter model"/><br>
            <input type="text" name="year" placeholder="Enter year"/><br>
            <input type="text" name="miles" placeholder="Enter milage"/><br>
            <input type="text" name="type" placeholder="Enter type"/><br>
            <input type="text" name="color" placeholder="Enter color"/><br>
            <input type="text" name="trans" placeholder="Enter trans"/><br>
            <input type="text" name="price" placeholder="Enter price"/><br>
            <button class="button button-block" name="addVeh" />Add Vehicle</button>
        </form>
    </div><!-- tab-content -->
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{   
    if (isset($_POST['addVeh'])) 
    { 
        $vin = $conn->escape_string($_POST['vin']);
        $mk = $conn->escape_string($_POST['make']);
        $md = $conn->escape_string($_POST['model']);
        $yr = $conn->escape_string($_POST['year']);
        $mi = $conn->escape_string($_POST['miles']);
        $ty = $conn->escape_string($_POST['type']);
        $co = $conn->escape_string($_POST['color']);
        $tr = $conn->escape_string($_POST['trans']);
        $pr = $conn->escape_string($_POST['price']);

        //find out if vehicle exists
        $sql = "select * from vehicle where vin = '$vin';";
        $result = $conn->query($sql);
        $result->fetch_assoc();

        if($result->num_rows == 0 )
        {
            $sql = "insert into vehicle (vin, make, model, year, miles, type, color, trans, price)
            values ('$vin', '$mk', '$md', '$yr', '$mi', '$ty', '$co', '$tr', '$pr');";

            if ($conn->query($sql) === TRUE)
            {
                echo "<br>Vehicle Added successfully!<br>";
            }
            else
            {
                echo "<br>Error: ".$sql."<br>".$conn->error;
            }

            $sql = "insert into unsold (vin, make, model, year, miles, type, color, trans, price)
            values ('$vin', '$mk', '$md', '$yr', '$mi', '$ty', '$co', '$tr', '$pr');";

            if ($conn->query($sql) === TRUE)
            {
                echo "<br>:)<br>";
            }
            else
            {
                echo "<br>Error: ".$sql."<br>".$conn->error;
            }
        }
        else
        {
            echo "<br>This vehicle exists already!<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<body>
  <div class="sales">
    <div id="sales">
        <form action="owner.php" method="post" autocomplete="off">
            <br>
            <label>
                View Sales
            </label>
            <br>
            <input type="radio" name="sales" value="all" checked/>Show all sales<br>
            <input type="radio" name="sales" value="year"/>In the past year<br>
            <input type="radio" name="sales" value="month"/>In the past month<br>
            <input type="radio" name="sales" value=""/>By sales rep:<input type="text" name="rep" placeholder="Enter usrname"/><br>
            <button class="button button-block" name="show" />Show Sales</button>
        </form>
    </div><!-- tab-content -->
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{   
    if (isset($_POST['show'])) 
    { 
        $type = $conn->escape_string($_POST['sales']);
        $rep = $conn->escape_string($_POST['rep']);
        
        switch($type)
        {
            case "all":
               
                echo "<br>Show all sales";

                $sql = "select * from sales;";
                $result = $conn->query($sql);

                if ($result->num_rows == 0 )
                {
                    echo "<br>No sales made yet<br>";
                }
                else
                {
                    echo "<table border='1'>
                    <tr>
                    <th>Date</th>
                    <th>User</th>            
                    <th>Vin</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Miles</th>
                    <th>Type</th>
                    <th>Color</th>
                    <th>Trans</th>
                    <th>Price</th>
                    </tr>";
        
                    while($row1 = $result->fetch_assoc())
                    {
                        $sql = "select * from vehicle where vin = '".$row1['vin']."';";
                        $res = $conn->query($sql);
        
                        $row = $res->fetch_assoc();

                        echo "<tr>";
                        echo "<td>" . $row1['date'] . "</td>";
                        echo "<td>" . $row1['user'] . "</td>";
                        echo "<td>" . $row['vin'] . "</td>";
                        echo "<td>" . $row['make'] . "</td>";
                        echo "<td>" . $row['model'] . "</td>";
                        echo "<td>" . $row['year'] . "</td>";
                        echo "<td>" . $row['miles'] . "</td>";
                        echo "<td>" . $row['type'] . "</td>";
                        echo "<td>" . $row['color'] . "</td>";
                        echo "<td>" . $row['trans'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }

                break;

            case "year":
                
                echo "<br>Sales made in the past year";
                $current = date("Y-m-d");
                $date = strtotime("-1 year", time());
                $last = date("Y-m-d", $date);  
                
                $sql = "select * from sales where date between '$last' and '$current'";;
                $result = $conn->query($sql);

                if ($result->num_rows == 0 )
                {
                    echo "<br>No sales made yet this year<br>";
                }
                else
                {
                    echo "<table border='1'>
                    <tr>
                    <th>Date</th>
                    <th>User</th>            
                    <th>Vin</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Miles</th>
                    <th>Type</th>
                    <th>Color</th>
                    <th>Trans</th>
                    <th>Price</th>
                    </tr>";
        
                    while($row1 = $result->fetch_assoc())
                    {
                        $sql = "select * from vehicle where vin = '".$row1['vin']."';";
                        $res = $conn->query($sql);
        
                        $row = $res->fetch_assoc();

                        echo "<tr>";
                        echo "<td>" . $row1['date'] . "</td>";
                        echo "<td>" . $row1['user'] . "</td>";
                        echo "<td>" . $row['vin'] . "</td>";
                        echo "<td>" . $row['make'] . "</td>";
                        echo "<td>" . $row['model'] . "</td>";
                        echo "<td>" . $row['year'] . "</td>";
                        echo "<td>" . $row['miles'] . "</td>";
                        echo "<td>" . $row['type'] . "</td>";
                        echo "<td>" . $row['color'] . "</td>";
                        echo "<td>" . $row['trans'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                
                break;

            case "month":
                
                echo "<br>Sales made in the past month";
                $current = date("Y-m-d");
                $date = strtotime("-1 month", time());
                $last = date("Y-m-d", $date);  
                
                $sql = "select * from sales where date between '$last' and '$current'";;
                $result = $conn->query($sql);

                if ($result->num_rows == 0 )
                {
                    echo "<br>No sales made yet this month<br>";
                }
                else
                {
                    echo "<table border='1'>
                    <tr>
                    <th>Date</th>
                    <th>User</th>            
                    <th>Vin</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Miles</th>
                    <th>Type</th>
                    <th>Color</th>
                    <th>Trans</th>
                    <th>Price</th>
                    </tr>";
        
                    while($row1 = $result->fetch_assoc())
                    {
                        $sql = "select * from vehicle where vin = '".$row1['vin']."';";
                        $res = $conn->query($sql);
        
                        $row = $res->fetch_assoc();

                        echo "<tr>";
                        echo "<td>" . $row1['date'] . "</td>";
                        echo "<td>" . $row1['user'] . "</td>";
                        echo "<td>" . $row['vin'] . "</td>";
                        echo "<td>" . $row['make'] . "</td>";
                        echo "<td>" . $row['model'] . "</td>";
                        echo "<td>" . $row['year'] . "</td>";
                        echo "<td>" . $row['miles'] . "</td>";
                        echo "<td>" . $row['type'] . "</td>";
                        echo "<td>" . $row['color'] . "</td>";
                        echo "<td>" . $row['trans'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                break;

            case "";

                $sql = "select * from sales where user = '$rep';";
                $result = $conn->query($sql);
        
                
                if ($result->num_rows == 0 )
                {
                    echo "<br>No sales made yet by ".$rep."<br>";
                }
                else
                {
                    echo "<br>Showing sales made by: <strong>".$rep."!!</strong><br>";
                    echo "<table border='1'>
                    <tr>
                    <th>Date</th>
                    <th>User</th>            
                    <th>Vin</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Miles</th>
                    <th>Type</th>
                    <th>Color</th>
                    <th>Trans</th>
                    <th>Price</th>
                    </tr>";
        
                    while($row1 = $result->fetch_assoc())
                    {
                        $sql = "select * from vehicle where vin = '".$row1['vin']."';";
                        $res = $conn->query($sql);
        
                        $row = $res->fetch_assoc();
                
                        echo "<tr>";
                        echo "<td>" . $row1['date'] . "</td>";
                        echo "<td>" . $row1['user'] . "</td>";
                        echo "<td>" . $row['vin'] . "</td>";
                        echo "<td>" . $row['make'] . "</td>";
                        echo "<td>" . $row['model'] . "</td>";
                        echo "<td>" . $row['year'] . "</td>";
                        echo "<td>" . $row['miles'] . "</td>";
                        echo "<td>" . $row['type'] . "</td>";
                        echo "<td>" . $row['color'] . "</td>";
                        echo "<td>" . $row['trans'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "</tr>";
                    }
        
                    echo "</table>";
        
                }
                break;
        }


        /*
        //find out if vehicle exists
        $sql = "select * from vehicle where vin = '$vin';";
        $result = $conn->query($sql);
        $result->fetch_assoc();

        if($result->num_rows == 0 )
        {
            $sql = "insert into vehicle (vin, make, model, year, miles, type, color, trans, price)
            values ('$vin', '$mk', '$md', '$yr', '$mi', '$ty', '$co', '$tr', '$pr');";

            if ($conn->query($sql) === TRUE)
            {
                echo "<br>Vehicle Added successfully!<br>";
            }
            else
            {
                echo "<br>Error: ".$sql."<br>".$conn->error;
            }

            $sql = "insert into unsold (vin, make, model, year, miles, type, color, trans, price)
            values ('$vin', '$mk', '$md', '$yr', '$mi', '$ty', '$co', '$tr', '$pr');";

            if ($conn->query($sql) === TRUE)
            {
                echo "<br>:)<br>";
            }
            else
            {
                echo "<br>Error: ".$sql."<br>".$conn->error;
            }
        }
        else
        {
            echo "<br>This vehicle exists already!<br>";
        }
        */
    }
}
?>