<?php
require_once "../DBconect.php";
session_start();

if (!isset($_SESSION["user_role"]) || !isset($_SESSION["admin_login"])) {
    header("Location: ../login.php"); // Redirigir si no hay inicio de sesión
}

if ($_SESSION["user_role"] !== "admin") {
    header("Location: ../login.php"); // Redirigir si el rol no es admin
}


if (isset($_REQUEST['btn_register'])) //compruebe el nombre del botón "btn_register" y configúrelo
{
    $username = $_REQUEST['txt_username']; //input nombre "txt_username"
    $email = $_REQUEST['txt_email']; //input nombre "txt_email"
    $password = $_REQUEST['txt_password']; //input nombre "txt_password"
    $role = $_REQUEST['txt_role']; //seleccion nombre "txt_role"

    if (empty($username)) {
        $errorMsg[] = "Ingrese nombre de usuario"; //Compruebe input nombre de usuario no vacío
    } else if (empty($email)) {
        $errorMsg[] = "Ingrese email"; //Revisar email input no vacio
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg[] = "Ingrese email valido"; //Verificar formato de email
    } else if (empty($password)) {
        $errorMsg[] = "Ingrese password"; //Revisar password vacio o nulo
    } else if (strlen($password) < 6) {
        $errorMsg[] = "Password minimo 6 caracteres"; //Revisar password 6 caracteres
    } else if (empty($role)) {
        $errorMsg[] = "Seleccione rol"; //Revisar etiqueta select vacio
    } else {
        try {
            $select_stmt = $db->prepare("SELECT username, email FROM mainlogin WHERE username=:uname OR email=:uemail"); // consulta sql
            $select_stmt->bindParam(":uname", $username);
            $select_stmt->bindParam(":uemail", $email); //parámetros de enlace
            $select_stmt->execute();
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            if ($row["username"] == $username) {
                $errorMsg[] = "Usuario ya existe"; //Verificar usuario existente
            } else if ($row["email"] == $email) {
                $errorMsg[] = "Email ya existe"; //Verificar email existente
            } else if (!isset($errorMsg)) {
                $insert_stmt = $db->prepare("INSERT INTO mainlogin(username,email,password,role) VALUES(:uname,:uemail,:upassword,:urole)"); //Consulta sql de insertar 
                $insert_stmt->bindParam(":uname", $username);
                $insert_stmt->bindParam(":uemail", $email); //parámetros de enlace 
                $insert_stmt->bindParam(":upassword", $password);
                $insert_stmt->bindParam(":urole", $role);

                if ($insert_stmt->execute()) {
                    $registerMsg = "Registro exitoso: Esperar página de inicio de sesión"; //Ejecuta consultas 
                    header("refresh:0;index.php"); //Actualizar despues de 2 segundo a la portada
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sistema - Pizza Mundo</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../css/estiloIndex.css">

    <link href="../../css/estilo_inicio_administrador.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="../js/myscript.js"></script>
</head>

<body>
    <header>
        <nav class="navbar bg-body-tertiary mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="inicio_administrador.html">
                    <img src="../../img/logo-icon-both.png" alt="Logo" width="300px" height="130px"
                        class="d-inline-block align-text-top">
                </a>
            </div>
        </nav>
    </header>
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 ">
                <nav>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="">Registrar nuevo usuario</a>
                        </li>
                        <li class="nav-item">
                            <a href="../cerrar_sesion.php">Salir</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col col-sm-12 col-md-12 col-lg-8 col-xl-8 m-0">

                <div class="container">



                    <div class="login-form">
                        <center>
                            <h2>Registrar</h2>
                        </center>
                        <form method="post" class="form-horizontal">

                            <div class="form-group">
                                <label class="col-sm-9 text-left">Usuario</label>
                                <div class="col-sm-12">
                                    <input type="text" name="txt_username" class="form-control"
                                        placeholder="Ingrese usuario" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-9 text-left">Email</label>
                                <div class="col-sm-12">
                                    <input type="text" name="txt_email" class="form-control"
                                        placeholder="Ingrese email" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-9 text-left">Password</label>
                                <div class="col-sm-12">
                                    <input type="password" name="txt_password" class="form-control"
                                        placeholder="Ingrese password" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-9 text-left">Seleccione tipo</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="txt_role">
                                        <option value="">SELECCIONE UN ROL</option>
                                        <option value="bodega">Bodega</option>
                                        <option value="produccion">Produccion</option>
                                        <option value="ventas">Ventas</option>
                                        <option value="reportes">Reportes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="submit" name="btn_register" class="btn btn-primary btn-block"
                                        value="Registro"><br><br>
                                    <a href="index.php" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>

                        </form>
                    </div>



                </div>
            </div>
        </div>
    </div>
    </div>


</body>

</html>