<?php
require 'db.php';

echo "<br><strong>Welcome to Tasker!</strong><br>";
session_start();

$user = $_SESSION['user'];
echo "<br>User: ".$user."<br>";
?>

<!DOCTYPE html>
<html>
<body>
  <div class="addTask">
    <div id="add">   
        <form action="tasker.php" method="post" autocomplete="off">
            <br>
            <label>
                Add a Task!!
            </label>
            	<br>
            Enter task: <input type="text" required name="description" placeholder="'Do IT640 Homework'"/>
		<br>
            Enter date: <input type="date" required name="date"/>
		<br>
	    <button class="button button-block" name="submit"/>Submit Task</button>
        </form>
    </div><!-- tab-content -->
</body>
</html>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{   
    if (isset($_POST['submit'])) 
    { 
        $desc = $conn->escape_string($_POST['description']);
        $dt = $conn->escape_string($_POST['date']);
	$comp = "no";
	$user = $_SESSION['user'];
	

	$sql = "insert into task (description, due, comp, user) values ('$desc', '$dt', '$comp', '$user');";
	
	if ($conn->query($sql) === TRUE)
            {
                echo "<br>:)<br>";
            }
            else
            {
                echo "<br>Error: ".$sql."<br>".$conn->error;
            }

    }
}
?>

<!DOCTYPE html>
<html>
<body>
  <div class="show">
    <div id="show">   
        <h1>Sales Representative Portal!</h1>
        <form action="tasker.php" method="post" autocomplete="off">
            <br>
            <label>
                Tasks!
            </label>
            <br>
            <button class="button button-block" name="update" />Update Tasks</button>
        </form>
    </div><!-- tab-content -->
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{   
    if (isset($_POST['update'])) 
    { 
        //user logging in
        //display vehicles

	$comp = "no";
        $user = $_SESSION['user'];

        echo "Showing Vehicles For Sale";
	$sql = "select * from task where user = '$user' and comp = '$comp';";
        $result = $conn->query($sql);

        echo "<table border='1'>
        <tr>
        <th>Description</th>
        <th>Due</th>
        <th>Finished?</th>
        </tr>";

	while($row = $result->fetch_assoc())
        {
            echo "<tr>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . '<input type="checkbox" id="' . $row['id'] . '" name="' . $row['id'] . '">' . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
}
?>

