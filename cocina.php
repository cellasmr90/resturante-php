<?php
declare(strict_types=1);

/********** CONEXIÓN Y ENCABEZADO **********/
include("conexion.php");
include("header.php");


/********** VALIDAR PERMISOS **********/
if ($_SESSION['rol'] != "Administrador" && $_SESSION['rol'] != "Cocina") {

    header("Location:index.php");
    exit();

}


/********** CAMBIAR ESTADO DEL PEDIDO **********/
if (isset($_POST['cambiar'])) {

    $id = $_POST['id_pedido'];
    $estado = $_POST['estado'];

    mysqli_query($conexion,
    "UPDATE pedidos
     SET estado='$estado'
     WHERE id_pedido='$id'");

}


/********** CONSULTAR PEDIDOS **********/
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
    <th>Detalle</th>
    <th>Estado</th>
    <th>Cambiar</th>

</tr>


<?php
/********** MOSTRAR PEDIDOS **********/
while ($fila = mysqli_fetch_assoc($pedidos)) {
?>

<tr>

<td>
    <?php echo $fila['id_pedido']; ?>
</td>


<td>
    <?php echo $fila['cliente']; ?>
</td>


<td>

<?php

/********** CONSULTAR DETALLE DEL PEDIDO **********/
$id_pedido = $fila['id_pedido'];

$detalle = mysqli_query($conexion,
"SELECT 
    platillos.nombre,
    detalle_pedido.cantidad

FROM detalle_pedido

INNER JOIN platillos
ON detalle_pedido.id_platillo = platillos.id_platillo

WHERE detalle_pedido.id_pedido = $id_pedido");


/********** MOSTRAR PLATILLOS **********/
while ($producto = mysqli_fetch_assoc($detalle)) {

    echo $producto['cantidad'];
    echo " x ";
    echo $producto['nombre'];
    echo "<br>";

}

?>

</td>


<td>
    <?php echo $fila['estado']; ?>
</td>


<td>

<form method="POST">

<input type="hidden"
name="id_pedido"
value="<?php echo $fila['id_pedido']; ?>">


<select name="estado"
class="form-control">

<option>Pendiente</option>
<option>Preparando</option>
<option>Listo</option>

</select>


<button
class="btn btn-primary mt-2"
name="cambiar">

Actualizar

</button>


</form>

</td>

</tr>


<?php } ?>

</table>


<?php
/********** PIE DE PÁGINA **********/
include("footer.php");
?>