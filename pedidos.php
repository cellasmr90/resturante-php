<?php
declare(strict_types=1);

/********** INCLUIR LA CONEXIÓN A LA BASE DE DATOS **********/
include("conexion.php");

/********** ELIMINAR UN PEDIDO **********/
if (isset($_POST['eliminar'])) {

    // Obtener el ID del pedido seleccionado
    $id_pedido = (int)$_POST['id_pedido'];

    // Eliminar primero el detalle del pedido
    mysqli_query($conexion, "DELETE FROM detalle_pedido WHERE id_pedido=$id_pedido");

    // Eliminar el pedido
    mysqli_query($conexion, "DELETE FROM pedidos WHERE id_pedido=$id_pedido");

    // Actualizar la página
    header("Location: pedidos.php");
    exit;
}

/********** CONSULTAR LOS PEDIDOS REGISTRADOS **********/
$resultado_pedidos = mysqli_query($conexion,
"SELECT * FROM pedidos ORDER BY id_pedido DESC");

/********** INCLUIR EL ENCABEZADO **********/
include("header.php");
?>

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header">
            <h4 class="mb-0">Pedidos Realizados</h4>
        </div>

        <div class="card-body">

        <?php
        /********** MOSTRAR LOS PEDIDOS **********/
        while ($pedido = mysqli_fetch_assoc($resultado_pedidos)) {
        ?>

            <div class="card mb-4">

                <div class="card-body">

                    <h5>
                        Pedido #<?php echo $pedido['id_pedido']; ?>
                    </h5>

                    <p class="mb-1">
                        <strong>Cliente:</strong>
                        <?php echo $pedido['cliente']; ?>
                    </p>

                    <p class="mb-1">
                        <strong>Fecha:</strong>
                        <?php echo $pedido['fecha']; ?>
                    </p>

                    <p class="mb-1">
                        <strong>Estado:</strong>
                        <?php echo $pedido['estado']; ?>
                    </p>

                    <p>
                        <strong>Total:</strong>
                        $<?php echo number_format((float)$pedido['total'], 2); ?>
                    </p>

                    <!-- FORMULARIO PARA ELIMINAR EL PEDIDO -->
                    <form method="POST"
                        onsubmit="return confirm('¿Eliminar este pedido?');">

                        <input
                            type="hidden"
                            name="id_pedido"
                            value="<?php echo $pedido['id_pedido']; ?>">

                        <button
                            type="submit"
                            name="eliminar"
                            class="btn btn-danger">

                            Eliminar Pedido

                        </button>

                    </form>

                    <h6 class="mt-3">
                        Detalle del pedido
                    </h6>

                    <div class="table-responsive">

                        <table class="table table-bordered">

                            <tr>

                                <th>Platillo</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>

                            </tr>

                            <?php
                            /********** CONSULTAR EL DETALLE DEL PEDIDO **********/
                            $id_pedido = $pedido['id_pedido'];

                            $resultado_detalle = mysqli_query($conexion,"
                            SELECT
                                platillos.nombre,
                                detalle_pedido.cantidad,
                                detalle_pedido.precio
                            FROM detalle_pedido
                            INNER JOIN platillos
                            ON detalle_pedido.id_platillo = platillos.id_platillo
                            WHERE detalle_pedido.id_pedido = $id_pedido");

                            /********** MOSTRAR EL DETALLE DEL PEDIDO **********/
                            while ($detalle = mysqli_fetch_assoc($resultado_detalle)) {
                            ?>

                            <tr>

                                <td>
                                    <?php echo $detalle['nombre']; ?>
                                </td>

                                <td>
                                    <?php echo $detalle['cantidad']; ?>
                                </td>

                                <td>
                                    $<?php echo number_format((float)$detalle['precio'], 2); ?>
                                </td>

                                <td>
                                    $<?php echo number_format($detalle['precio'] * $detalle['cantidad'], 2); ?>
                                </td>

                            </tr>

                            <?php } ?>

                        </table>

                    </div>

                </div>

            </div>

        <?php } ?>

        </div>

    </div>

</div>

<?php

/********** INCLUIR EL PIE DE PÁGINA **********/
include("footer.php");

?>