<?php
include_once('connects.php');

$used = $_POST['used'];
$ingredient = $_POST['ingredient'];
$count = $_POST['count'];
$meas = $_POST['meas'];
$flag = $_POST['flag'];


for($i=0;$i<$count;$i++)
{
  $string  = "SELECT * FROM ingredient_stocks where stock_name ='$ingredient[$i]' AND measurement='$meas[$i]'";
  $result = mysqli_query($con,$string);
  
  if(mysqli_num_rows($result)>=1)
  {
    if($flag[$i] == "false")
    {
      $row = mysqli_fetch_assoc($result);
      $sid = $row['stock_id'];
      $total = $row['amount'] - $used[$i];

      $string2  = "UPDATE ingredient_stocks SET amount='$total' WHERE stock_id='$sid'";
      mysqli_query($con,$string2);
    }

  }
}


?>