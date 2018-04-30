<?php
require 'db.php';
session_start();
?>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) 
    { 
        require 'login.php';
    }
}
?>

<!DOCTYPE html>
<html>
<body>
    <div class="form">
    <div id="login">   
        <h1>Welcome to Tasker</h1>
        <form action="main.php" method="post" autocomplete="off">
            
            <label>
                Username<span class="req">*</span>
            </label>
            
            <input type="user" required autocomplete="off" name="user"/><br>
            
            <label>
                Password<span class="req">*</span>
            </label>
            
            <input type="password" required autocomplete="off" name="password"/>
            
            <button class="button button-block" name="login" />Log In</button>

        </form>
    </div>
    </div>
</body>
</html>
