<?php

// Conexión a la base de datos
include("conexion.php");

// Encabezado de la página
include("header.php");

// Validar permisos
// Solo Administrador y Cocina pueden entrar

if ($_SESSION['rol'] != "Administrador" && $_SESSION['rol'] != "Cocina") {


    header("Location:index.php");

    exit();

}

// Cambiar estado del pedido

if(isset($_POST['cambiar'])){


    $id = $_POST['id_pedido'];

    $estado = $_POST['estado'];



    $sql = "UPDATE pedidos

            SET estado='$estado'

            WHERE id_pedido='$id'";

    mysqli_query($conexion,$sql);

}

// Consultar pedidos

$pedidos = mysqli_query($conexion,

"SELECT * FROM pedidos 

ORDER BY id_pedido DESC");

?>

<div class="container mt-4">

<h3>
    Pantalla Cocina
</h3>

<br>

<table class="table table-bordered table-striped">

<tr class="table-dark">

<th>Pedido</th>

<th>Cliente</th>

<th>Detalle</th>

<th>Estado</th>

<th>Cambiar</th>

</tr>

<?php


// Mostrar pedidos

while($fila = mysqli_fetch_assoc($pedidos)){
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
// Buscar detalle del pedido actual

$id_pedido = $fila['id_pedido'];

$detalle = mysqli_query($conexion,


"SELECT 

platillos.nombre,

detalle_pedido.cantidad


FROM detalle_pedido


INNER JOIN platillos


ON detalle_pedido.id_platillo = platillos.id_platillo


WHERE detalle_pedido.id_pedido = $id_pedido"

);

// Mostrar platillos del pedido

while($producto = mysqli_fetch_assoc($detalle)){


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



<input 

type="hidden"

name="id_pedido"

value="<?php echo $fila['id_pedido']; ?>">

<select name="estado" class="form-select">


<option>Pendiente</option>

<option>Preparando</option>

<option>Listo</option>


</select>

<br>

<button 

class="btn btn-primary"

name="cambiar">

Actualizar

</button>

</form>


</td>


</tr>

<?php } ?>


</table>

</div>

<?php

// Pie de pagina

include("footer.php");

?>