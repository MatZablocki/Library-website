

<?php
include 'format.php';
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit']))
{

if ( !empty($_POST["uname"]) && !empty($_POST["pword"]) ){
	$sql= "SELECT username, password FROM Users WHERE username = "."'".$_POST['uname']."'"." AND password = "."'".$_POST['pword']."';";
	$result = $conn->query($sql);
	if($result->num_rows > 0 )
		{ 
			$_SESSION['uname'] = $conn -> real_escape_string($_POST['uname']);
			$_SESSION['pword'] = $conn -> real_escape_string($_POST['pword']);
			header("Location: /LabCode/CA/search.php");
			return;
		}
	else
		{
			$_SESSION["error"] = "Incorrect Username or Password";
			header("Location: /LabCode/CA/login.php");
			return;
		}
}
else{
	$_SESSION["error"] = "Please input Username AND Password";
	header("Location: /LabCode/CA/login.php");
	return;
}
}

elseif($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['register']))
{
	header("Location: /LabCode/CA/register.php");
}
elseif(isset($_SESSION["uname"])){
	//if the username is defined then a session is on, this code turns off the session and reloads the page which turns on a fresh one
	//This is how the code detects if the login site is being used to log off
	session_destroy();
	
	header("Location: /LabCode/CA/login.php");
}

?>
<section id="login">
<h2>Login</h2>
<?php
//Basic error and success display, success is for when user registers successfully and is redirected here.
if ( isset($_SESSION["error"]) ) {
echo('<p style="color:red">Error:'.
$_SESSION["error"]."</p>\n");
unset($_SESSION["error"]);
}

if ( isset($_SESSION["success"]) ) {
echo('<p style="color:green">'.$_SESSION["success"]."</p>\n");
unset($_SESSION["success"]);
}
?>
<form action="login.php" method="post">
<label for="uname">Username:</label>
<input type="text" id="uname" name="uname">
<br>
<label for="pword">Password:</label>
<input type="password" id="pword" name="pword">
<br>
<input type="submit" name="submit" value="Submit">
<input type="submit" name="register" value="Register">
</form>
</section>
<?php
	include 'bottom.php';
?>
