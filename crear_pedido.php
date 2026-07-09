<?php
/* ======================================================
CONEXIÓN A LA BASE DE DATOS
====================================================== */
include("conexion.php");

/* ======================================================
CONSULTAR LOS PLATILLOS DISPONIBLES
solo se mostrarán los platillos que estén disponibles.
====================================================== */
$sql = "SELECT * FROM platillos WHERE disponible = 1";
$resultado = mysqli_query($conexion, $sql);

/* ======================================================
INCLUIR EL ENCABEZADO DE LA PÁGINA
====================================================== */
include("header.php");
?>

<div class="container mt-4">

    <div class="card shadow">

        <!-- Título del formulario --------------------------------------------->
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Crear Pedido</h4>
        </div>

        <div class="card-body">

            <!-- Formulario para registrar un nuevo pedido ----------------------------------------->
            <form action="guardar_pedido.php" method="POST">

                <!-- Campo para ingresar el nombre del cliente ------------------------------------------>
                <div class="mb-3">

                    <label class="form-label">
                        Nombre del Cliente
                    </label>

                    <input
                        type="text"
                        name="cliente"
                        class="form-control"
                        required>

                </div>

                <!-- Título de la lista de platillos -------------------------------------------------->
                <h5 class="mt-4 mb-3">
                    Platillos disponibles
                </h5>

                <!-- Tabla que muestra los platillos --------------------------------------------------->
                <div class="table-responsive">

                    <table class="table table-striped table-hover table-bordered">

                        <thead class="table-dark">

                            <tr>
                                <th>Seleccionar</th>
                                <th>Platillo</th>
                                <th>Categoría</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                            </tr>

                        </thead>

                        <tbody>

                        <?php
                        /* ======================================================
                        RECORRER LOS PLATILLOS DISPONIBLES
                        Cada registro se mostrará en una fila.
                        ====================================================== */
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                        ?>

                            <tr>

                                <!-- Casilla para seleccionar el platillo -------------------------------------------->
                                <td class="text-center">

                                    <input class="form-check-input" type="checkbox" name="platillos[]" value="
                                    <?php echo $fila['id_platillo']; ?>">

                                </td>

                                <!-- Nombre del platillo ------------------------------------------------------>
                                <td>
                                    <?php echo $fila['nombre']; ?>
                                </td>

                                <!-- Categoría del platillo --------------------------------------------------------->
                                <td>
                                    <?php echo $fila['categoria']; ?>
                                </td>

                                <!-- Precio del platillo -------------------------------------------------------------->
                                <td>
                                    $<?php echo number_format($fila['precio'], 2); ?>
                                </td>

                                <!-- Cantidad solicitada del platillo ----------------------------------------------------->
                                <td>

                                    <input
                                        type="number"
                                        class="form-control"
                                        style="width:90px;"
                                        name="cantidad_<?php echo $fila['id_platillo']; ?>"
                                        value="1"
                                        min="1">

                                </td>

                            </tr>

                        <?php
                        } // Fin del recorrido de los platillos-------------------------------------------------------
                        ?>

                        </tbody>

                    </table>

                </div>

                <!-- Botones del formulario -------------------------------------------------------------->
                <div class="mt-4">

                    <!-- Botón para guardar el pedido ------------------------------------------------------------>
                    <button type="submit" class="btn btn-success">

                        <i class="bi bi-check-circle"></i>Guardar Pedido</button>

                    <!-- Botón para cancelar y regresar ------------------------------------------------------------->
                    <a href="pedidos.php"class="btn btn-secondary">Cancelar</a>

                </div>

            </form>

        </div>

    </div>

</div>

<?php
/* ======================================================
INCLUIR EL PIE DE PÁGINA
====================================================== */
include("footer.php");
?>