<?php
		include "../connection.php";
		$ac=$_POST['Agent_code'];
		$an=$_POST['Agent_Name'];
		$d=$_POST['DOB'];
		$br=$_POST['Branch'];
		$con=$_POST['Contact_Number'];
		$query="insert into agent(Agent_code,Agent_name,DOB,Branch, Contact_Num) values('$ac','$an','$d','$br','$con')";
		mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
?>