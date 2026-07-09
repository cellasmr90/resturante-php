<?php
declare(strict_types=1);

/********** CONEXIÓN A LA BASE DE DATOS **********/
include("conexion.php");


/********** VERIFICAR SI SE SELECCIONÓ UN PLATILLO **********/
if (isset($_POST['platillos'])) {

    // Obtener los datos del pedido
    $cliente = $_POST['cliente'];
    $fecha = date("Y-m-d");
    $estado = "Pendiente";
    $total = 0;


    /********** CALCULAR EL TOTAL DEL PEDIDO **********/
    foreach ($_POST['platillos'] as $id_platillo) {

        // Obtener la cantidad del platillo
        $cantidad = $_POST["cantidad_" . $id_platillo];

        // Consultar el precio
        $consulta = "SELECT precio FROM platillos WHERE id_platillo = $id_platillo";

        $resultado = mysqli_query($conexion, $consulta);

        $fila = mysqli_fetch_assoc($resultado);

        // Calcular subtotal
        $subtotal = $fila['precio'] * $cantidad;

        // Sumar al total
        $total += $subtotal;
    }


    /********** GUARDAR EL PEDIDO **********/
    $sql_pedido = "INSERT INTO pedidos
    (cliente, fecha, estado, total)
    VALUES
    ('$cliente','$fecha','$estado','$total')";

    mysqli_query($conexion, $sql_pedido);


    // Obtener el ID del pedido creado
    $id_pedido = mysqli_insert_id($conexion);


    /********** GUARDAR EL DETALLE DEL PEDIDO **********/
    foreach ($_POST['platillos'] as $id_platillo) {

        // Obtener la cantidad
        $cantidad = $_POST["cantidad_" . $id_platillo];

        // Consultar el precio del platillo
        $consulta = "SELECT precio FROM platillos WHERE id_platillo = $id_platillo";

        $resultado = mysqli_query($conexion, $consulta);

        $fila = mysqli_fetch_assoc($resultado);

        $precio = $fila['precio'];

        // Insertar el detalle
        $sql_detalle = "INSERT INTO detalle_pedido
        (id_pedido,id_platillo,cantidad,precio) VALUES ('$id_pedido','$id_platillo','$cantidad','$precio')";

        mysqli_query($conexion, $sql_detalle);
    }


    /********** REDIRECCIONAR A PEDIDOS **********/
    header("Location: pedidos.php");

} else {

    /********** MENSAJE SI NO SE SELECCIONÓ NINGÚN PLATILLO **********/
    echo "Debe seleccionar al menos un platillo";

}
?>