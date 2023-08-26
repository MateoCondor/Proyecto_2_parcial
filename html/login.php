<?php
require_once 'DBconect.php';
session_start();

if (isset($_SESSION["admin_login"])) {
    header("location: ");
    exit();
}
if (isset($_SESSION["personal_login"])) {
    header("location: ");
    exit();
}
if (isset($_SESSION["usuarios_login"])) {
    header("location: ");
    exit();
}

if (isset($_REQUEST['btn_login'])) {


    $email = $_REQUEST["txt_email"];
    $password = $_REQUEST["txt_password"];

    if (empty($email)) {
        $errorMsg[] = "Por favor ingrese Email";
    } else if (empty($password)) {
        $errorMsg[] = "Por favor ingrese Password";
    } else {
        try {
            $select_stmt = $db->prepare("SELECT email, password, username, role FROM mainlogin WHERE email=:uemail AND password=:upassword");
            $select_stmt->bindParam(":uemail", $email);
            $select_stmt->bindParam(":upassword", $password);
            $select_stmt->execute();

            if ($select_stmt->rowCount() > 0) {
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                $dbemail = $row["email"];
                $dbpassword = $row["password"];
                $dbrole = $row["role"];
                $dbusername = $row["username"];

                switch ($dbrole) {
                    case "admin":
                        $_SESSION["admin_login"] = $email;
                        $_SESSION["username"] = $dbusername;
                        $_SESSION["user_role"] = "admin";
                        $loginMsg = "Admin: Inicio sesión con éxito";
                        header("refresh:0; Administrador/index.php");
                        break;

                    case "bodega":
                        $_SESSION["bodega_login"] = $email;
                        $_SESSION["username"] = $dbusername;
                        $_SESSION["user_role"] = "bodega";
                        $loginMsg = "Personal: Inicio sesión con éxito";
                        header("refresh:0; Bodega/index.php");
                        break;

                    case "produccion":
                        $_SESSION["produccion_login"] = $email;
                        $_SESSION["username"] = $dbusername;
                        $_SESSION["user_role"] = "produccion";
                        $loginMsg = "Usuario: Inicio sesión con éxito";
                        header("refresh:0; Produccion/index.php");
                        break;

                    case "ventas":
                        $_SESSION["ventas_login"] = $email;
                        $_SESSION["username"] = $dbusername;
                        $_SESSION["user_role"] = "ventas";
                        $loginMsg = "Admin: Inicio sesión con éxito";
                        header("refresh:0; Ventas/index.php");
                        break;

                    case "reportes":
                        $_SESSION["reportes_login"] = $email;
                        $_SESSION["username"] = $dbusername;
                        $_SESSION["user_role"] = "reportes";
                        $loginMsg = "Admin: Inicio sesión con éxito";
                        header("refresh:0; Reportes/index.php");
                        break;

                    default:
                        $errorMsg[] = "Correo electrónico o contraseña incorrectos";
                }
            } else {
                $errorMsg[] = "Correo electrónico o contraseña incorrectos";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css">
    <title>Inicio de sesion - Pizza Mundo</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container login-container">
            <a href="../index.html"><img src="../img/button-back.png" width="10%" height="auto"></a>
            <div class="">
                <br><br><br><br>
                <form method="post">
                    <h1>Inicia sesión</h1>
                    <input type="text" name="txt_email" class="form-control" placeholder="Email"
                        value="<?php echo isset($email) ? $email : ''; ?>" />
                    <input type="password" name="txt_password" class="form-control" placeholder="Password"
                        value="<?php echo isset($password) ? $password : ''; ?>" />
                    <input type="submit" name="btn_login" class="" value="Iniciar Sesion">
                </form>
            </div>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1 class="title">Bienvenido</h1>
                    <h2>Porfavor inicie sesion</h2>
                </div>
            </div>
        </div>

    </div>
    <script src="../js/main.js"></script>
</body>

</html>