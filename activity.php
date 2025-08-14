<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Project </title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/font.css">
  <script src="js/jquery.js" type="text/javascript"></script>

  <script src="js/bootstrap.min.js" type="text/javascript"></script>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

  <script>
    function calculateDifference(row_id) {
      console.log("" + row_id + "prev_inv");
      let prev_inv = document.getElementById("" + row_id + "prev_inv").value;
      let sales = document.getElementById("" + row_id + "sales").value;
      let agreed = document.getElementById("" + row_id + "agreed").value;
      let damaged = document.getElementById("" + row_id + "damaged").value;
      let transferred = document.getElementById("" + row_id + "transferred").value;
      let inv = document.getElementById("" + row_id + "inv").value;
      let difference = document.getElementById("" + row_id + "difference").value;
      let physical = document.getElementById("" + row_id + "physical").value;
      let result = prev_inv - sales - agreed - damaged - transferred;
      document.getElementById("" + row_id + "inv").setAttribute("value", result)
      let result2 = physical - result;
      document.getElementById("" + row_id + "difference").setAttribute("value", result2)
    }

    function changeDisableStatus(row_id) {
      let is_disable = document.getElementById("" + row_id + "check").checked;
      if (is_disable == false) {
        document.getElementById("" + row_id + "flag").value = 0

        document.getElementById("" + row_id + "flag").disabled = true;
        document.getElementById("" + row_id + "sales").disabled = true;
        document.getElementById("" + row_id + "agreed").disabled = true;
        document.getElementById("" + row_id + "damaged").disabled = true;
        document.getElementById("" + row_id + "transferred").disabled = true;
        document.getElementById("" + row_id + "physical").disabled = true;
      } else {
        document.getElementById("" + row_id + "flag").value = 1;

        document.getElementById("" + row_id + "flag").disabled = false;
        document.getElementById("" + row_id + "sales").disabled = false;
        document.getElementById("" + row_id + "agreed").disabled = false;
        document.getElementById("" + row_id + "damaged").disabled = false;
        document.getElementById("" + row_id + "transferred").disabled = false;
        document.getElementById("" + row_id + "physical").disabled = false;
      }
    }
  </script>
</head>

<body>

  <div class="header">
    <div class="row" id="headercontainer">
      <div class="col-md-6">
        <span class="logo">Shop Management</span>
      </div>
      <div class="col-md-6 ">
        <?php
        include_once 'dbConnection.php';
        session_start();
        if (!(isset($_SESSION['email']))) {
          header("location:index.php");
        } else {
          $name = $_SESSION['name'];
          $email = $_SESSION['email'];

          include_once 'dbConnection.php';
          echo '<span class="pull-right title1" >
                  <span class="log log1">
                    <div style="margin-top:-5px;"
                    class="glyphicon glyphicon-user" aria-hidden="true"></div>
                    &nbsp;&nbsp;&nbsp;'
            . $name . '</span>' . '
                  &nbsp;&nbsp;&nbsp;
                  <a href="logout.php?q=index.php">
                    <button class="smallghost">
                      <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout
                    </button>
                  </a>
                </span>';
        } ?>
      </div>
    </div>
  </div>
  <div style="overflow-y:auto;">
    <form action="saverecord.php" method="post">
      <div class="w-100 d-flex flex-row justify-content-center align-items-center" style="margin: 50px;">

        <label class="col-md-2 control-label title1" for="Date">DATE</label>
        <div class="col-md-3">
          <input type="date" id="recorddate" value="" +Date.now() name="recorddate">
        </div>
        <label class="col-md-2 control-label title1" for="Date">SHOP</label>
        <div class="col-md-3 h-100">
          <select style="margin: 0px;padding:0px" id="shop" name="shops" onchange="getProducts(this.value)">
            <?php
            include_once 'dbConnection.php';
            $result = mysqli_query($con, "SELECT cod_localidad, des_localidad FROM localidad") or die('Error');
            $rowcount = mysqli_num_rows($result);
            while ($row = mysqli_fetch_array($result)) {
              $shopname = $row['des_localidad'];
              $shopid = $row['cod_localidad'];
              echo '<option' . ' value=' . $shopid . '>' . $shopname . '</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <br>
      <br>

      <input type="submit" value="SAVE">
      <br>
      <table id="table" class="w-100 table">
        <tr>
          <th>No</th>
          <th>Check</th>
          <th>Description</th>
          <th>Previous Inv</th>
          <th>Sales</th>
          <th>Agreed</th>
          <th>Damaged</th>
          <th>Transferred</th>
          <th>Inv</th>
          <th>Physical</th>
          <th>Diffrenece</th>
          <th>Cost</th>
        </tr>
        <?php
        include_once 'dbConnection.php';
        $result = mysqli_query($con, "SELECT * FROM producto") or die('Error');
        $no = 1;
        while ($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <td><?php echo $no ?></td>
            <td><input type="checkbox" id="<?php echo htmlentities($row['codigo'] . "check"); ?>" onchange="<?php echo htmlentities('changeDisableStatus(' . $row['codigo']) . ')'; ?>"></td>
            <td>
              <?php echo htmlentities($row['descripcion']); ?>
            </td>
            <td>
              <input value=<?php echo $row['inv'] ?> disabled type="number" id="<?php echo htmlentities($row['codigo'] . "prev_inv"); ?>">
            </td>
            <td><input disabled onchange="<?php echo htmlentities('calculateDifference(' . $row['codigo']) . ')'; ?>" value=0 type="number" id="<?php echo htmlentities($row['codigo'] . "sales"); ?>" name="<?php echo htmlentities($row['codigo'] . "sales"); ?>"></input></td>
            <td><input disabled onchange="<?php echo htmlentities('calculateDifference(' . $row['codigo']) . ')'; ?>" type="number" value=0 id="<?php echo htmlentities($row['codigo'] . "agreed"); ?>" name="<?php echo htmlentities($row['codigo'] . "agreed"); ?>"></input></td>
            <td><input disabled onchange="<?php echo htmlentities('calculateDifference(' . $row['codigo']) . ')'; ?>" type="number" value=0 id="<?php echo htmlentities($row['codigo'] . "damaged"); ?>" name="<?php echo htmlentities($row['codigo'] . "damaged"); ?>"></input></td>
            <td><input disabled onchange="<?php echo htmlentities('calculateDifference(' . $row['codigo']) . ')'; ?>" type="number" value=0 id="<?php echo htmlentities($row['codigo'] . "transferred"); ?>" name="<?php echo htmlentities($row['codigo'] . "transferred"); ?>"></input></td>
            <td><input disabled type="number" value=0 id="<?php echo htmlentities($row['codigo'] . "inv"); ?>" name="<?php echo htmlentities($row['codigo'] . "inv"); ?>"></input></td>
            <td><input disabled onchange="<?php echo htmlentities('calculateDifference(' . $row['codigo']) . ')'; ?>" type="number" value=0 id="<?php echo htmlentities($row['codigo'] . "physical"); ?>" name="<?php echo htmlentities($row['codigo'] . "physical"); ?>"></input></td>
            <td><input disabled type="number" value=0 id="<?php echo htmlentities($row['codigo'] . "difference"); ?>" name="<?php echo htmlentities($row['codigo'] . "difference"); ?>"></input></td>
            <td>Cost</td>
            <td>
              <input value=0 disabled style="visibility: hidden;" name="<?php echo htmlentities($row['codigo'] . "flag"); ?>" type="number" id="<?php echo htmlentities($row['codigo'] . "flag"); ?>">
            </td>
          </tr>
        <?php $no++;
        } ?>
      </table>
    </form>
  </div>

</body>

</html>