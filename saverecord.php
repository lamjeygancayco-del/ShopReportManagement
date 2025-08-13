<?php
include_once 'dbConnection.php';

$result = mysqli_query($con, "SELECT * FROM producto") or die('Error');


// foreach ($_POST as $key => $value) {
//   echo $key . ":" . "$value" . "\n";
// }
$shop_id = $_POST["shops"];
echo $shop_id;
while ($row = mysqli_fetch_array($result)) {
  $flag =  (int)@$_POST[$row['codigo'] . "flag"];
  if ($flag == 1) {
    $productname = @$row['descripcion'];
    $productid = @$row['codigo'];
    $inv = @$row['inv'];;

    $date = getdate();
    $sales =  (int)@$_POST[$row['codigo'] . "sales"];
    $agreed =  (int)@$_POST[$row['codigo'] . "agreed"];
    $damaged =  (int)@$_POST[$row['codigo'] . "damaged"];
    $transferred =  (int)@$_POST[$row['codigo'] . "transferred"];
    $physical =  (int)@$_POST[$row['codigo'] . "physical"];

    $current_inv = $inv  - $sales - $agreed - $damaged - $transferred - $physical;
    $datestr = $date['year'] . "-" . $date['mon'] . "-" . $date['mday'] . "-"
      . $date['hours'] . "-" . $date['minutes'] . "-" . $date['seconds'];
    // session_start();
    // $email = $_SESSION['email'];
    // echo "" . gettype($sales) . $date . $damaged . $transferred . $physical;
    $qd = mysqli_query($con, "INSERT INTO record(user,productoid,agreed,sales,damaged,transferred,physical,current_inv,shop_id,update_date) VALUES  
    (1,$productid,$agreed,$sales,$damaged,$transferred,$physical,$current_inv,'$shop_id','$datestr')") or die('Error1');
    $q_update_product = mysqli_query($con, "UPDATE producto SET inv = $current_inv WHERE codigo = '$productid';") or die('Error2');
  }
}

header("location:activity.php?");
// ob_end_flush();
