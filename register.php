<?php
include 'format.php';

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['cancel'])){
	header("Location: /LabCode/CA/login.php");
}
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit'])){
	//each nested if statement checks for an error and if all find no errors, account is created
	if ( !empty($_POST["uname"]) && !empty($_POST["pword"]) && !empty($_POST["fname"]) && !empty($_POST["sname"]) && !empty($_POST["addr"]) && !empty($_POST["addr2"]) && !empty($_POST["city"]) && !empty($_POST["phone"]) && !empty($_POST["mobile"]) && !empty($_POST["pword2"])){
		if($_POST["pword"] == $_POST["pword2"])
		{
			$ucheck= "SELECT Username FROM Users";
			$result = $conn->query($ucheck);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()){
					if ($row["Username"] == $_POST["uname"]){
						$_SESSION["error"] = "This username is taken.";
						header("Location: /LabCode/CA/register.php");
						return;
					}
				}
			}
			if(!($_POST['mobile'] > 99999999 && $_POST['mobile'] < 1000000000)){//this checks if the number is 9 chars in length (which is 10 chars because all mobile numbers start with 0)
				$_SESSION["error"] = "You're phone number should be 10 characters in length.";
				header("Location: /LabCode/CA/register.php");
				return;
			}
			if(strlen($_POST['pword']) < 6){//Password needs to be min 6 chars long
				$_SESSION["error"] = "You're password should be at least 6 characters in length.";
				header("Location: /LabCode/CA/register.php");
				return;
			}
			$uname = $conn -> real_escape_string($_POST['uname']);
			$pass = $conn -> real_escape_string($_POST['pword']);
			$fname = $conn -> real_escape_string($_POST['fname']);
			$sname = $conn -> real_escape_string($_POST['sname']);
			$addr = $conn -> real_escape_string($_POST['addr']);
			$addr2 = $conn -> real_escape_string($_POST['addr2']);
			$city = $conn -> real_escape_string($_POST['city']);
			$phone = $conn -> real_escape_string($_POST['phone']);
			$mobile = $conn -> real_escape_string($_POST['mobile']);
			$conpass = $conn -> real_escape_string($_POST['pword2']);
			
			$sql= "INSERT INTO Users (Username, Password, FName, SName, Address, Address2, City, PhoneNO, MobileNO) VALUES ('$uname', '$pass', '$fname', '$sname', '$addr', '$addr2', '$city', '$phone', '$mobile');";
			$conn->query($sql);
			$_SESSION["success"] = "Account Created Successfully.";
			header("Location: /LabCode/CA/login.php");
			return;
		}
		else{
			$_SESSION["error"] = "The passwords do not match.";
			header("Location: /LabCode/CA/register.php");
			return;
		}
	}
	else {
		$_SESSION["error"] = "Please fill in all required fields.";
		header("Location: /LabCode/CA/register.php");
		return;
	}
}

?>
<section id="login">
<h2>Register</h2>
<?php
if ( isset($_SESSION["error"]) ) {
echo('<p style="color:red">Error:'.
$_SESSION["error"]."</p>\n");
unset($_SESSION["error"]);
}
?>
<form action="register.php" method="post">
<label for="uname">Username:</label>
<input type="text" id="uname" name="uname">
<br>
<label for="pword">Password:</label>
<input type="text" id="pword" name="pword">
<br>
<label for="pword">Confirm Password:</label>
<input type="text" id="pword2" name="pword2">
<br>
<label for="pword">First Name:</label>
<input type="text" id="fname" name="fname">
<br>
<label for="pword">Last Name:</label>
<input type="text" id="sname" name="sname">
<br>
<label for="pword">Address line 1:</label>
<input type="text" id="addr" name="addr">
<br>
<label for="pword">Address line 2:</label>
<input type="text" id="addr2" name="addr2">
<br>
<label for="pword">City:</label>
<input type="text" id="city" name="city">
<br>
<label for="pword">Phone Number:</label>
<input type="number" id="phone" name="phone">
<br>
<label for="pword">Mobile Number:</label>
<input type="number" id="mobile" name="mobile">
<br>
<input type="submit" name="submit" value="Submit">
<input type="submit" name="cancel" value="Cancel">
</form>
</section>
<?php
	include 'bottom.php';
?>