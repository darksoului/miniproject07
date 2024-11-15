<?php
		include "../connection.php";
		$pn=$_POST['Policy_Num'];
		$cn=$_POST['Customer_Num'];
		$ac=$_POST['Agent_code'];
		$d=$_POST['DOC'];
		$p=$_POST['Product'];
		$sa=$_POST['Sum_assured'];
		$pp=$_POST['Payment_period'];
		$ip=$_POST['Ins_period'];		
		$query="insert into policy_data(Policy_Num,Customer_Num,Agent_code,DOC,Product,Sum_Assured,Pay_Period,Ins_Period) values('$pn','$cn','$ac','$d','$p','$sa','$pp','$ip')";
		mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
?>