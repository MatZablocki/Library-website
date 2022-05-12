<?php
include 'format.php';
?>

<?php

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['reserve'])){
	
	$sql= "UPDATE Books SET reserved = 'N' WHERE ISBN = '".$_POST['reserve']."';";
	$conn->query($sql);
	$sql2= "DELETE FROM Reserved WHERE ISBN = '".$_POST['reserve']."';";
	$conn->query($sql2);
	
	
}
//This is used to display the next/previous elements in a result
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['prev'])){ 
	$_SESSION['page'] -= 5;
	
}
elseif($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['next'])){
	$_SESSION['page'] += 5;
	
}
else{
	$_SESSION['page'] = 0;//If the page wasnt loaded by the next/prev button, this resets the display to the first 5 results
}

//This searches for all results in order to get the rowtotal global value which is required to know when to display the next/prev page buttons.
$search= "SELECT books.ISBN, books.BookTitle, books.Author, books.Edition, books.Year, category.CategoryName FROM Books JOIN Category ON Books.Category = Category.CategoryID JOIN Reserved ON Books.ISBN = Reserved.ISBN WHERE Reserved = 'Y' AND Username = '".$_SESSION["uname"]."';";

$result = $conn->query($search);

$_SESSION["rowtotal"] = $result->num_rows;


$search= "SELECT books.ISBN, books.BookTitle, books.Author, books.Edition, books.Year, category.CategoryName, reserved.ResDate FROM Books JOIN Category ON Books.Category = Category.CategoryID JOIN Reserved ON Books.ISBN = Reserved.ISBN WHERE Reserved = 'Y' AND Username = '".$_SESSION["uname"]."' LIMIT 5 OFFSET ".$_SESSION['page'].";";
$result = $conn->query($search);
//This prints the rows
if ($result->num_rows > 0) {
	echo "<table id='table'>";
	while($row = $result->fetch_assoc()){
		echo "<tr><td>";
		echo "ISBN: " . $row["ISBN"];
		echo "</td><td>";
		echo "Book Title: " . $row["BookTitle"];
		echo "</td><td>";
		echo "Author: " . $row["Author"];
		echo "</td><td>";
		echo "Edition: " . $row["Edition"];
		echo "</td><td>";
		echo "Year: " . $row["Year"];
		echo "</td><td>";
		echo "Category: " . $row["CategoryName"];
		echo "</td><td>";
		echo "Date reserved: " . $row["ResDate"];
		echo "</td><td>";
		echo '<form action="reserved.php" method="post">';
		//This code is like this so that the button can display 'Return', but the value sent will be the ISBN number
		echo '<input type="hidden" name="reserve" value="'.$row["ISBN"].'" >';
		echo '<input type="submit" value="Return">';
		echo '</form>';
		}
		echo "</td></tr>";
	}	
	else{
		echo "<h3>You do not have any reservations</h3>";
	}

echo "</table>";
echo '<form action="reserved.php" method="post">';
//if past page 0 then there must be a return button, if there are more results than displaying there must be a next page button
if($_SESSION['page'] > 0){
	echo '<input id="prev" type="submit" name="prev" value="Previous Page">';
}
if($_SESSION["rowtotal"] - $_SESSION['page'] > 5){
	echo '<input id="next" type="submit" name="next" value="Next Page">';
}
echo "</form>";


?>



<?php
	include 'bottom.php';
?>