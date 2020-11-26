<?php
// Inicializamos la sesion o la retomamos
if(!isset($_SESSION)) {
  session_start();
  // Protegemos el documento para que solamente sea visible cuando NO HAS INICIADO sesión
  if(isset($_SESSION['id'])) header('Location: index.php');

}

// Incluimos la conexión a la base de datos
include("connections/conn_localhost.php");
include("includes/common_functions.php");

// Evaluamos si el formulario ha sido enviado
if(isset($_POST['login_sent'])) {
	header ('Location: perfil.php');
	
  // Validamos si las cajas están vacias
  foreach ($_POST as $calzon => $caca) {
	if($caca == "") $error[] = "La caja $calzon es obligatoria";
  }



  // Armamos el query para verificar el email y el password en la base de datos
  $queryLogin = sprintf("SELECT idUsuario, nombres, apellidos, correo, rol, descripcion FROM usuario WHERE correo = '%s' AND contraseña = '%s'",
	  mysqli_real_escape_string($connLocalhost, trim($_POST['email'])),
	  mysqli_real_escape_string($connLocalhost, trim($_POST['pass']))
  );

  // Ejecutamos el query
  $resQueryLogin = mysqli_query($connLocalhost, $queryLogin) or trigger_error("El query de login de usuario falló");

  // Determinamos si el login es valido (email y password sean coincidentes)
  // Contamos el recordset (el resultado esperado para un login valido es 1)
  if(mysqli_num_rows($resQueryLogin)) {
	// Hacemos un fetch del recordset
	$userData = mysqli_fetch_assoc($resQueryLogin);

	// Definimos variables de sesion en $_SESSION
	$_SESSION['id'] = $userData['idUsuario'];
	$_SESSION['nombres'] = $userData['nombres'];
	$_SESSION['apellidos'] = $userData['apellidos'];
	$_SESSION['correo'] = $userData['correo'];
	$_SESSION['rol'] = $userData['rol'];
	$_SESSION['descripcion'] = $userData['descripcion'];


	header('Location: index.php');

  }
  else {
	$error = "Login failed";
  }

  
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Iniciar Sesion</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>

<body style="background-color: #666666;">

    <div>
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="login.php" method="post">
                    <span class="login100-form-title p-b-43">

                        <span class="text-primary">Let's</span> Teach
                    </span>


                    <div class="wrap-input100 validate-input" data-validate="El correo es requerido">
                        <input class="input100" type="text" name="email">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Correo</span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="La contraseña es requerida">
                        <input class="input100" type="password" name="pass">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Contraseña</span>
                    </div>




                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="login_sent">
                            Iniciar Sesion
						</button>
						
						

                        <button class="login100-form-btn mt-3" onclick="location.href='Registrar.php'">
                            Registrarse
                        </button>

                    </div>



                </form>

                <div class="login100-more" style="background-image: url('imagenes/Fondo.jpg');">
                </div>
            </div>
        </div>
    </div>





    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>

</html>