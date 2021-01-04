<?php
include_once('connects.php');
$counter = $_POST['counter'];
$ingr = $_POST['ingr']; 
$amount = $_POST['amount'];
$meas = $_POST['meas'];
$id = 1;



for($i = 0; $i<$counter; $i++)
{
	$string  = "SELECT * FROM ingredient_stocks where stock_name ='$ingr[$i]' AND measurement='$meas[$i]'";
	$result = mysqli_query($con,$string);
	
	if(mysqli_num_rows($result)>=1)
	{
		$row = mysqli_fetch_assoc($result);
		$sid = $row['stock_id'];
		$total = $amount[$i] + $row['amount'];

		$string2  = "UPDATE ingredient_stocks SET amount='$total' WHERE stock_id='$sid'";
		mysqli_query($con,$string2);

	}
	else
	{
		$string1 = "INSERT INTO ingredient_stocks(stock_name,amount,measurement,user_id) VALUES ('$ingr[$i]','$amount[$i]','$meas[$i]','$id')";
		mysqli_query($con,$string1);
	}

}


echo "Checklist Saved in Inventory";

?>