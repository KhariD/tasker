<?php
require 'db.php';

/* Displays user information and some useful messages */
echo "<br>SALES REPRESENTATIVE<BR>";
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) 
{
  $_SESSION['message'] = "You must log in before viewing your profile page!";

}
else 
{
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
  <div class="veh">
    <div id="veh">   
        <h1>Sales Representative Portal!</h1>
        <form action="sales.php" method="post" autocomplete="off">
            <br>
            <label>
                Show vehicles for sale!
            </label>
            <br>
            <button class="button button-block" name="veh" />Show Vehicles</button>
        </form>
    </div><!-- tab-content -->
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{   
    if (isset($_POST['veh'])) 
    { 
        //user logging in
        //display vehicles

        echo "Showing Vehicles For Sale";
        
        
        $sql = "select * from unsold";
        $result = $conn->query($sql);

        echo "<table border='1'>
        <tr>
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

        while($row = $result->fetch_assoc())
        {
            echo "<tr>";
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
}
?>

<!DOCTYPE html>
<html>
<body>
  <div class="showVeh">
    <div id="veh">   
        <form action="sales.php" method="post" autocomplete="off">
            <br>
            <label>
                Show a specific vehicle!
            </label>
            <br>
            <input type="text" required name="showVeh" placeholder="enter vin"/><br>
            <button class="button button-block" name="showButton" />Show Vehicle</button>
        </form>
    </div><!-- tab-content -->
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{   
    if (isset($_POST['showButton'])) 
    { 
        //user logging in
        //display vehicles

        $vin = $conn->escape_string($_POST['showVeh']);
        
        $sql = "select * from vehicle where vin = '$vin';";
        $result = $conn->query($sql);
        
        if ($result->num_rows == 0 )
        {
            echo "Vehicle doesn't exist<br>";
            
        }
        else
        {
            echo "<table border='1'>
            <tr>
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

            while($row = $result->fetch_assoc())
            {
                echo "<tr>";
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
    }
}
?>


<!DOCTYPE html>
<html>
<body>
  <div class="sales">
    <div id="sales">   
        <form action="sales.php" method="post" autocomplete="off">
            <br>
            <label>
                Show your sales!
            </label>
            <br>
            <button class="button button-block" name="salesButton" />Show Sales</button>
        </form>
    </div><!-- tab-content -->
</body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{   
    if (isset($_POST['salesButton'])) 
    { 
        //user logging in
        //display vehicles
        
        $sql = "select * from sales where user = '$user';";
        $result = $conn->query($sql);

        
        if ($result->num_rows == 0 )
        {
            echo "<br>No sales made yet<br>";
        }
        else
        {
            echo "<br>Showing sales made by: <strong>".$fname." ".$lname."!!</strong><br>";
            echo "<table border='1'>
            <tr>
            <th>Date</th>
            <th>Commission</th>            
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

                $commission = $com * $row['price'];

                echo "<tr>";
                echo "<td>" . $row1['date'] . "</td>";
                echo "<td>" . $commission . "</td>";
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
    }
}
?>

<!DOCTYPE html>
<html>
<body>
  <div class="book">
    <div id="book">   
        <form action="sales.php" method="post" autocomplete="off">
            <br>
            <label>
                Book a sale!
            </label>
            <br>
            <input type="text" required name="vin" placeholder="Enter vin"/><br>
            <input type="date" required name="date" /><br>
            <button class="button button-block" name="bookSale" />Sell Vehicle</button>
        </form>
    </div><!-- tab-content -->
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{   
    if (isset($_POST['bookSale'])) 
    { 
        $vin = $conn->escape_string($_POST['vin']);
        $dt = $conn->escape_string($_POST['date']);

        //find out if vehicle exists
        $sql = "select * from vehicle where vin = '$vin';";
        $result = $conn->query($sql);
        $result->fetch_assoc();

        $sql2 = "select * from unsold where vin = '$vin';";
        $result2 = $conn->query($sql2);
        $result2->fetch_assoc();

        if($result->num_rows > 0 )
        {
            if($result2->num_rows > 0)
            {
                $sql = "insert into sold select * from unsold where vin = '$vin';";

                if ($conn->query($sql) === TRUE)
                {
                    echo "<br>..1";
                }
                else
                {
                    echo "<br>Error: ".$sql."<br>".$conn->error;
                }
                
                $sql = "delete from unsold where vin = '$vin';";

                if ($conn->query($sql) === TRUE)
                {
                    echo "<br>..2";
                }
                else
                {
                    echo "<br>Error: ".$sql."<br>".$conn->error;
                }

                $sql = "insert into sales (vin, user, date)
                values ('$vin', '$user', '$dt');";
                
                if ($conn->query($sql) === TRUE)
                {
                    echo "<br>The sale has been booked successfully!<br>";
                }
                else
                {
                    echo "<br>Error: ".$sql."<br>".$conn->error;
                }
            }
            else
            {
                echo "<br>Vehicle already sold!<br>";
            }
        }
        else
        {
            echo "<br>This vehicle does not exist!<br>";
        }
    }
}
?>