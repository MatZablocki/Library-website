
</div>
<footer>
	<h3>Site by: Mateusz Zablocki &copy; 2021</h3>
	<?php
	if(isset($_SESSION["uname"])){
		echo "<p>Logged in as:".$_SESSION["uname"]."</p>";
	}
	?>
</footer>
</body>

</html>