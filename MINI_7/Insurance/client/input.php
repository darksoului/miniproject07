<?php
		include "../connection.php";
		$fn=$_POST['First_Name'];
		$ln=$_POST['Last_Name'];
		$g=$_POST['Gender'];
		$d=$_POST['DOB'];
		$fan=$_POST['Father_Name'];
		$mon=$_POST['Mother_Name'];
		$a=$_POST['Address'];
		$con=$_POST['Contact_Number'];
		$ms=$_POST['Marital_Status'];
		$query="insert into customer(First_Name,Last_Name,Gender,DOB,Father_Name,Mother_Name,Address,Contact_Number, Marital_status) values('$fn','$ln','$g','$d','$fan','$mon','$a','$con','$ms')";
		mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
?>