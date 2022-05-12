<?php

session_start();
?>
<html>


<head>
<title>Library</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<?php
$servername= "localhost";
$username = "root";
$password = "";
$dbname= "CADB";// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);// Check connection
if ($conn->connect_error) 
{
die("Connection failed: ".$conn->connect_error);
}

?>

<body>

<div id="main">

<header>
<h1 id="header">Library Service</h1>
</header>
<?php
if(isset($_SESSION["uname"])){
	echo '<nav>
	<ul>
		<li><a href="search.php">Book Search</a></li>
		<li><a href="reserved.php">Reserved Books</a></li>
		<li><a href="login.php">Logout</a></li>		
	</ul>
</nav>';
}

?>
