<?php
declare(strict_types=1);

// Incluye el encabezado de la página
include("header.php");

// Incluye la conexión a la base de datos
include("conexion.php");

/* ======================================================
VALIDAR PERMISOS
Solo los usuarios con rol Administrador o Cocina
pueden acceder a esta pantalla.
====================================================== */
if ($_SESSION['rol'] != "Administrador" && $_SESSION['rol'] != "Cocina") {
    header("Location:index.php");
    exit();
}

/* ======================================================
ACTUALIZAR EL ESTADO DEL PEDIDO
Se ejecuta cuando se presiona el botón "Actualizar".
====================================================== */
if (isset($_POST['cambiar'])) {

    // Obtener los datos enviados desde el formulario
    $id = $_POST['id_pedido'];
    $estado = $_POST['estado'];

    // Consulta para actualizar el estado del pedido
    $sql = "UPDATE pedidos
            SET estado='$estado'
            WHERE id_pedido='$id'";

    // Ejecutar la consulta
    mysqli_query($conexion, $sql);
}

/* ======================================================
CONSULTAR TODOS LOS PEDIDOS
Se muestran del más reciente al más antiguo.
====================================================== */
$pedidos = mysqli_query($conexion,
"SELECT * FROM pedidos ORDER BY id_pedido DESC");
?>

<h3 class="mt-4">
    Pantalla Cocina
</h3>

<table class="table table-bordered">

    <tr>
        <th>Pedido</th>
        <th>Cliente</th>
        <th>Estado</th>
        <th>Cambiar</th>
    </tr>

    <?php
    /* ======================================================
RECORRER TODOS LOS PEDIDOS
Cada registro se mostrará en una fila de la tabla.
    ====================================================== */
    while ($fila = mysqli_fetch_assoc($pedidos)) {
    ?>

    <tr>

        <!-- Número del pedido -->
        <td><?= $fila['id_pedido']; ?></td>

        <!-- Nombre del cliente -->
        <td><?= $fila['cliente']; ?></td>

        <!-- Estado actual del pedido -->
        <td><?= $fila['estado']; ?></td>

        <td>

            <!-- Formulario para cambiar el estado -->
            <form method="POST">

                <!-- Enviar el ID del pedido oculto -->
                <input
                    type="hidden"
                    name="id_pedido"
                    value="<?= $fila['id_pedido']; ?>">

                <!-- Lista de estados disponibles -->
                <select
                    name="estado"
                    class="form-control">

                    <option>Pendiente</option>
                    <option>Preparando</option>
                    <option>Listo</option>

                </select>

                <!-- Botón para actualizar -->
                <button
                    class="btn btn-primary mt-2"
                    name="cambiar">

                    Actualizar

                </button>

            </form>

        </td>

    </tr>

    <?php
    } // Fin del while
    ?>

</table>

<?php
// Incluye el pie de página
include("footer.php");
?>