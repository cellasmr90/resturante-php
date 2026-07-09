<?php
declare(strict_types=1);

/********** INCLUIR ARCHIVOS NECESARIOS **********/
include("header.php");
include("conexion.php");

/********** VALIDAR QUE EL USUARIO SEA ADMINISTRADOR **********/
if ($_SESSION['rol'] != "Administrador") {

    header("Location:index.php");
    exit();

}

/********** REGISTRAR UN NUEVO USUARIO **********/
if (isset($_POST['guardar'])) {

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['rol'];

    // Insertar el usuario en la base de datos
    mysqli_query($conexion,
    "INSERT INTO usuarios(nombre,usuario,contrasena,rol)
    VALUES('$nombre','$usuario','$contrasena','$rol')");

}

/********** CONSULTAR LOS USUARIOS REGISTRADOS **********/
$usuarios = mysqli_query($conexion, "SELECT * FROM usuarios");

?>

<h3 class="mt-4">
    Usuarios
</h3>

<!-- FORMULARIO PARA REGISTRAR USUARIOS -->
<form method="POST">

    <label>Nombre</label>

    <input
        type="text"
        name="nombre"
        class="form-control mb-2"
        required>

    <label>Usuario</label>

    <input
        type="text"
        name="usuario"
        class="form-control mb-2"
        required>

    <label>Contraseña</label>

    <input
        type="password"
        name="contrasena"
        class="form-control mb-2"
        required>

    <label>Rol</label>

    <select
        name="rol"
        class="form-control mb-3">

        <option>Administrador</option>
        <option>Mesero</option>
        <option>Cocina</option>

    </select>

    <button
        class="btn btn-primary"
        name="guardar">

        Guardar Usuario

    </button>

</form>

<hr>

<h3>
    Usuarios registrados
</h3>

<table class="table table-bordered">

    <tr>

        <th>ID</th>
        <th>Nombre</th>
        <th>Usuario</th>
        <th>Rol</th>

    </tr>

    <?php
    /********** MOSTRAR LOS USUARIOS **********/
    while ($fila = mysqli_fetch_assoc($usuarios)) {
    ?>

    <tr>

        <td>
            <?php echo $fila['id_usuario']; ?>
        </td>

        <td>
            <?php echo $fila['nombre']; ?>
        </td>

        <td>
            <?php echo $fila['usuario']; ?>
        </td>

        <td>
            <?php echo $fila['rol']; ?>
        </td>

    </tr>

    <?php } ?>

</table>

<?php

/********** INCLUIR EL PIE DE PÁGINA **********/
include("footer.php");

?>