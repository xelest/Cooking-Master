<?php 
  $con = mysqli_connect('localhost', 'root', '', 'cookmaster');

  //on page load
  $fname = "";
  $lname = "";
  $username = "";
  $pwd1 = "";
  $pwd2 = "";
  $pwdN = "";


 if (isset($_POST['register'])) {
 	$username = $_POST['username'];
 	$fname = $_POST['fname'];
 	$lname = $_POST['lname'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd2'];
    $pwdN = passAjinomoto($pwd1);
    $role = $_POST['role'];
    $status = "A";

      $sql_u = "SELECT * FROM accounts WHERE uname='".$username."'";
      $res_u = mysqli_query($con, $sql_u);
    
      if (mysqli_num_rows($res_u) > 0) 
      {
        $name_error = "Sorry... username already taken"; 
        echo "<script type='text/javascript'>alert('$name_error');</script>";
      }
      else
      {
        if ($pwd1 === $pwd2)
        {
           $query = "INSERT INTO accounts (`fname`, `lname`, `uname`, `pword`, `status`) 
                    VALUES ('$fname','$lname','$username', '$pwdN', '$status')";
                    
           $results = mysqli_query($con, $query);
           echo "<script type='text/javascript'>alert('Record created. Success!');</script>";
           
           exit();
        }
        else
        {
            echo "<script type='text/javascript'>alert('missmatched password!');</script>";
        }
  	}
  }

  function passAjinomoto($keypass){
      $dbcon = mysqli_connect('localhost', 'root', '', 'cookmaster');
      $p2 = $keypass;
      $p1 = md5($p2);
      $getQRY = mysqli_query($dbcon, "SELECT PASSWORD('$p1') as PWORD;");
      while($rowX = $getQRY->fetch_assoc()){
      $pwordX = $rowX['PWORD'];
      }
      $pwordX = md5($pwordX);
      return $pwordX;
    }



?>