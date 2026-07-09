<?php
declare(strict_types=1);

/********** INICIAR LA SESIÓN **********/
session_start();

/********** CONEXIÓN A LA BASE DE DATOS **********/
include("conexion.php");


/********** VALIDAR EL INICIO DE SESIÓN **********/
if (isset($_POST['entrar'])) {

    // Obtener los datos del formulario
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Buscar el usuario en la base de datos
    $sql = "SELECT * FROM usuarios
            WHERE usuario='$usuario'
            AND contrasena='$contrasena'";

    $resultado = mysqli_query($conexion, $sql);

    // Verificar si el usuario existe
    if (mysqli_num_rows($resultado) > 0) {

        // Obtener los datos del usuario
        $datos = mysqli_fetch_assoc($resultado);

        // Guardar los datos en variables de sesión
        $_SESSION['id_usuario'] = $datos['id_usuario'];
        $_SESSION['nombre'] = $datos['nombre'];
        $_SESSION['usuario'] = $datos['usuario'];
        $_SESSION['rol'] = $datos['rol'];

        // Redirigir al menú principal
        header("Location:index.php");
        exit();

    } else {

        // Mostrar mensaje si los datos son incorrectos
        $mensaje = "Usuario o contraseña incorrectos.";

    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.7/dist/flatly/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="col-md-4 mx-auto">

        <!-- Título del sistema -->
        <h3 class="text-center mb-4">
            Sistema Restaurante
        </h3>

        <?php
        /********** MOSTRAR MENSAJE DE ERROR **********/
        if (isset($mensaje)) {
            echo "<div class='alert alert-danger'>$mensaje</div>";
        }
        ?>

        <!-- Formulario de inicio de sesión -->
        <form method="POST">

            <!-- Usuario -->
            <label>Usuario</label>

            <input
                type="text"
                name="usuario"
                class="form-control mb-3"
                required>

            <!-- Contraseña -->
            <label>Contraseña</label>

            <input
                type="password"
                name="contrasena"
                class="form-control mb-3"
                required>

            <!-- Botón para ingresar -->
            <button
                type="submit"
                name="entrar"
                class="btn btn-primary w-100">

                Ingresar

            </button>

        </form>

    </div>

</div>

</body>

</html>