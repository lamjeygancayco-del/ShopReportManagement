<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Gestión de tienda</title>
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
<!-- <body></body> -->

<body>
  <div class="signincontainer">
    <div class="container" id="container">
      <div class="form-container sign-up-container">
        <form class="signin" name="form" action="sign.php?q=index.php" onSubmit="return validateForm()" method="POST">
          <h1 style="margin-bottom: 10px;">Crear una cuenta</h1>

          <input class="signin" type="text" name="firstname" placeholder="first name" />
          <input class="signin" type="text" name="lastname" placeholder="last name" />
          <input class="signin" type="email" name="email" placeholder="Email" />
          <input class="signin" type="password" name="password" placeholder="Password" />
          <input class="signin" type="password" name="cpassword" placeholder="Conform Password" />
          <select class="signin" id="shop" name="shop_id">
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
          <button type="submit">Inscribirse</button>
        </form>
      </div>
      <div class="form-container sign-in-container">
        <form class="signin" action="login.php?q=index.php" method="POST">
          <h1>Iniciar sesión</h1>
          <input class="signin" type="email" name="email" placeholder="Email" />
          <input class="signin" type="password" name="password" placeholder="Password" />

          <!-- <a href="#">Forgot your password?</a> -->
          <button class="signin" type="submit">Iniciar sesión</button>
        </form>
      </div>
      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-left">
            <h1>¡Bienvenido de nuevo!</h1>
            <p>Para mantenerse conectado con nosotros, inicie sesión con su información personal.</p>
            <button class="ghost" id="signIn">Sign In</button>
          </div>
          <div class="overlay-panel overlay-right">
            <h1 id="asd">Hola amiga</h1>
            <p>Introduce tus datos personales y comienza tu viaje con nosotros</p>
            <button class="ghost" id="signUp">Inscribirse</button>
          </div>
        </div>
      </div>
    </div>

    <footer>
      <p>
        Número de teléfono: <b>+x xxxxxxxx</b>
        <br>
        Contacto <a target="_blank" href="#">aquí.</a>
      </p>
    </footer>
  </div>


</body>


</html>
<script>
  onchange = "<?php echo htmlentities('calculateDifference(' . $row['codigo']) . ')'; ?>"


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