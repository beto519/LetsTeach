<?php
  // Inicializamos la sesion o la retomamos
  if(!isset($_SESSION)) {
    session_start();
  }

  // Incluimos la conexión a la base de datos
  include("connections/conn_localhost.php");
  include("includes/common_functions.php");


    // Armamos el query para verificar el email y el password en la base de datos
    $queryLogin = sprintf("SELECT idUsuario, nombres, apellidos,telefono,correo,rol,descripcion FROM usuario WHERE correo = '%s' AND contraseña = '%s'",
        mysqli_real_escape_string($connLocalhost, 'Carlos.soto.2000@hotmail.com'),
        mysqli_real_escape_string($connLocalhost, '6221098703')
    );

    // Ejecutamos el query
    $resQueryLogin = mysqli_query($connLocalhost, $queryLogin) or trigger_error("El query de login de usuario falló");

      $userData = mysqli_fetch_assoc($resQueryLogin);

      // Definimos variables de sesion en $_SESSION
      $_SESSION['id'] = $userData['idUsuario'];
      $_SESSION['nombres'] = $userData['nombres']." ".$userData['apellidos'];
      $_SESSION['correo'] = $userData['correo'];
      $_SESSION['rol'] = $userData['rol'];
      $_SESSION['Descripcion'] = $userData['descripcion'];

      // Redireccionamos al usuario al panel de control
      #header('Location: cpanel.php');

    

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Let's Teach</title>
</head>

<body>


    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>


    <! -- cabecera -->
        <?php include("includes/header.php"); ?>




        <div class="container-fluid gedf-wrapper">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">

                        <div class="card-body">
                            <div class="h5">
                                <a href="miPerfil.php">
                                <?php 
                                echo($_SESSION['nombres'])
                                ?> 
                                </a>

                            </div>
                            <div class="h7">


                            <?php 
                            echo($userData['descripcion'])
                            ?>
                            </div>
                        </div>

                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="h5">
                                <h5 class="text-primary">Grupos</h5>



                            </div>
                            <div clas="h5">
                            <?php
                            for ($i=0; $i <15; $i++):
                            
                            ?>
                                <ul>
                                    <li>
                                        <a href="#" class="text-dark">Nombre</a>
                                    </li>
                                </ul>
                                <?php endfor ?>

                            </div>

                        </div>

                    </div>
                </div>



                <div class="col-md-6 gedf-main">

                    <!--- \\\\\\\Post
                    <div class="card gedf-card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab"
                                        aria-controls="posts" aria-selected="true">Hacer una publicación</a>
                                </li>

                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="posts" role="tabpanel"
                                    aria-labelledby="posts-tab">
                                    <div class="form-group">
                                        <label class="sr-only" for="message">post</label>
                                        <textarea class="form-control" id="message" rows="3"
                                            placeholder="¿Que estas pensando?"></textarea>
                                    </div>

                                </div>

                            </div>


                            <div class="btn-toolbar justify-content-between">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary">Publicar</button>
                                </div>

                            </div>
                        </div>


                    </div>
                    -->
                    <hr>
                    <div class="text-center bg-info text-white h1">
                        Publicaciones de tus Grupos
                    </div>
                    <hr>

                    <!--- \\\\\\\Post-->

                    <?php

                            for ($i=0; $i <10; $i++):
                            ?>

                    <div class="card gedf-card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-2">
                                        <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                                    </div>
                                    <div class="ml-2">
                                        <div class="h5 m-0">

                                            <a href="perfil.php">@LeeCross</a>
                                        </div>
                                        <div class="h7 text-muted">Miracles Lee Cross</div>
                                        <a class="text-muted" href="#">>En Grupo</a>
                                    </div>
                                </div>
                                <div>
                                    <div class="dropdown">
                                        <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                            <div class="h6 dropdown-header">Configuration</div>
                                            <a class="dropdown-item" href="#">Save</a>
                                            <a class="dropdown-item" href="#">Hide</a>
                                            <a class="dropdown-item" href="#">Report</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>10 min ago</div>

                            <h5 class="text-primary">Lorem ipsum dolor sit amet, consectetur adip.</h5>

                            <p class="card-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo recusandae nulla rem
                                eos
                                ipsa praesentium esse magnam nemo dolor
                                sequi fuga quia quaerat cum, obcaecati hic, molestias minima iste voluptates.
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                            <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>

                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <?php endfor; ?>
                    <!-- Post /////-->
                </div>
                <!-- barra lateral -->
                <?php include("includes/barraLateral.php"); ?>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
        </script>
</body>

</html>