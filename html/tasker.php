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
   }
}
?>

