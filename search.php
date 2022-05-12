<?php
include 'format.php';

if ( isset($_SESSION["success"]) ) {
echo('<p style="color:green">'.$_SESSION["success"]."</p>\n");
unset($_SESSION["success"]);

}
?>


<section id="search">
<form action="search.php" method="post">
<label for="title">Search by Book title/Author:</label>
<input type="text" id="title" name="title">
<br>
<label for="categories">Search by Category:</label>
<select id="categories" name="categories">
<option value="">Select Category </option>
<?php
$cat= "SELECT CategoryName FROM Category";
$result = $conn->query($cat);
while($row = $result->fetch_assoc()){
	echo '<option value="'.$row["CategoryName"].'">';
	echo $row["CategoryName"];
	echo "</option>";
}
?>
</select>
<br>
<br>
<input type="submit" name="submit" value="Search">
</form>

<?php

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['reserve'])){
	
	$sql= "UPDATE Books SET reserved = 'Y' WHERE ISBN = '".$_POST['reserve']."';";
	$conn->query($sql);
	$sql2= "INSERT INTO Reserved (ISBN, Username, ResDate) VALUES ('".$_POST['reserve']."','".$_SESSION["uname"]."', NOW());";
	$conn->query($sql2);
	
	
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit'])){
	$_SESSION['page'] = 0;
	
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['prev'])){
	$_SESSION['page'] -= 5;
	
}

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['next'])){
	$_SESSION['page'] += 5;
	
}

if($_SERVER['REQUEST_METHOD'] == "POST" and (isset($_POST['submit']) or isset($_POST['prev']) or isset($_POST['next']))){

if(isset($_POST["title"]) ){ //search by title if it was selected
	//using one variable to select the collumn and another for specific value
	$_SESSION["title"] = $conn -> real_escape_string($_POST['title']);
	$_SESSION["searchfor"] = "(BookTitle LIKE '%".$_SESSION["title"]."%' ) OR (Author LIKE '%".$_SESSION["title"]."%' )";
}

if(!empty($_POST["categories"]) ){//search by category if it was selected, if both, defaults to category
	//using one variable to select the collumn and another for specific value
	$_SESSION["title"] = $conn -> real_escape_string($_POST['categories']);
	$_SESSION["searchfor"] = "CategoryName = '".$_SESSION["title"]."'";
}

if(isset($_POST['submit'])){//if the page is getting refreshed by the submit button new values are needed for rowtotal
//this selects all data so that the page can later know whether a next page button is needed
$search= "SELECT books.ISBN, books.BookTitle, books.Author, books.Edition, books.Year, category.CategoryName, books.Reserved FROM Books JOIN Category ON Books.Category = Category.CategoryID WHERE ". $_SESSION["searchfor"] .";";

$result = $conn->query($search);
$_SESSION["rowtotal"] = $result->num_rows;
}

$search= "SELECT books.ISBN, books.BookTitle, books.Author, books.Edition, books.Year, category.CategoryName, books.Reserved FROM Books JOIN Category ON Books.Category = Category.CategoryID WHERE ". $_SESSION["searchfor"] ." LIMIT 5 OFFSET ".$_SESSION['page'].";";

$result = $conn->query($search);
//displays table
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
		if($row["Reserved"] == 'N'){
			echo '<form action="search.php" method="post">';
			//This code is like this so that the button can display 'Reserve', but the value sent will be the ISBN number
			echo '<input type="hidden" name="reserve" value="'.$row["ISBN"].'" >';
			echo '<input type="submit" value="Reserve">';
			echo '</form>';
		}
		else{
			echo "Unavailable";
		}
		echo "</td></tr>";
		
		
	}
		
		
	}
	echo "</table>";
	
	//Code used to see when buttons for next/prev page are needed 
	echo '<form action="search.php" method="post">';
	if($_SESSION['page'] > 0){
		echo '<input id="prev" type="submit" name="prev" value="Previous Page">';
	}
	if($_SESSION["rowtotal"] - $_SESSION['page'] > 5){
		echo '<input id="next" type="submit" name="next" value="Next Page">';
	}
	echo "</form>";
}

?>
</section>

<?php
	include 'bottom.php';
?>