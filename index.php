<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Schedule Management </title>
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/bootstrap-theme.min.css" /> -->
  <link rel="stylesheet" href="css/index.css">
  <!-- <script src="js/jquery.js" type="text/javascript"></script> -->

  <!-- <script src="js/bootstrap.min.js" type="text/javascript"></script> -->
  <!-- <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'> -->
  <?php if (@$_GET['w']) {
    echo '<script>alert("' . @$_GET['w'] . '");</script>';
  }
  ?>

  <script>
    function validateForm() {
      var y = document.forms["form"]["firstname"].value;
      var letters = /^[A-Za-z]+$/;
      if (y == null || y == "") {
        alert("First Name must be filled out.");
        return false;
      }
      var y2 = document.forms["form"]["lastname"].value;
      var letters = /^[A-Za-z]+$/;
      if (y2 == null || y2 == "") {
        alert("Last Name must be filled out.");
        return false;
      }
      var x = document.forms["form"]["email"].value;
      var atpos = x.indexOf("@");
      var dotpos = x.lastIndexOf(".");
      if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
        alert("Not a valid e-mail address.");
        return false;
      }
      var a = document.forms["form"]["password"].value;
      if (a == null || a == "") {
        alert("Password must be filled out");
        return false;
      }
      if (a.length < 5 || a.length > 25) {
        alert("Passwords must be 5 to 25 characters long.");
        return false;
      }
      var b = document.forms["form"]["cpassword"].value;
      if (a != b) {
        alert("Passwords must match.");
        return false;
      }
    }
  </script>
</head>

<body>
  <div class="container" id="container">
    <div class="form-container sign-up-container">
      <form name="form" action="sign.php?q=account.php" onSubmit="return validateForm()" method="POST">
        <h1>Create Account</h1>
        <span>or use your email for registration</span>
        <input type="text" name="firstname" placeholder="first name" />
        <input type="text" name="lastname" placeholder="last name" />
        <input type="email" name="email" placeholder="Email" />
        <input type="password" name="password" placeholder="Password" />
        <input type="password" name="cpassword" placeholder="Conform Password" />
        <select id="shop" name="shop_id">
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
        <?php if (@$_GET['q7']) {
          echo '<p style="color:red;font-size:15px;">' . @$_GET['q7'];
        } ?>
        <button type="submit">Sign Up</button>
      </form>
    </div>
    <div class="form-container sign-in-container">
      <form action="login.php?q=index.php" method="POST">
        <h1>Sign in</h1>
        <input type="email" name="email" placeholder="Email" />
        <input type="password" name="password" placeholder="Password" />

        <!-- <a href="#">Forgot your password?</a> -->
        <button type="submit">Sign In</button>
      </form>
    </div>
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Welcome Back!</h1>
          <p>To keep connected with us please login with your personal info</p>
          <button class="ghost" id="signIn">Sign In</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1 id="asd">Hello, Friend!</h1>
          <p>Enter your personal details and start journey with us</p>
          <button class="ghost" id="signUp">Sign Up</button>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <p>
      Created with <i class="fa fa-heart"></i> by
      <a target="_blank" href="#">Florin Pop</a>
      - Read how I created this and how you can join the challenge
      <a target="_blank" href="#">here</a>.
    </p>
  </footer>

</body>


</html>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    let signUpButton = document.getElementById('signUp');
    let signInButton = document.getElementById('signIn');
    let container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
      container.classList.add("right-panel-active");
    });
    signInButton.addEventListener('click', () => {
      container.classList.remove("right-panel-active");
    });
  });
</script>