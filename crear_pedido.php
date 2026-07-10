<?php

include("conexion.php");


$sql = "SELECT * FROM platillos WHERE disponible = 1";

$resultado = mysqli_query($conexion, $sql);


include("header.php");

?>


<div class="container mt-4">


<h3 class="mb-4">
    Crear Pedido
</h3>



<form action="guardar_pedido.php" method="POST">



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




<h5>
    Platillos disponibles
</h5>


<br>


<table class="table table-bordered table-primary">


<tr class="table-dark">

<th>Seleccionar</th>
<th>Platillo</th>
<th>Categoría</th>
<th>Precio</th>
<th>Cantidad</th>

</tr>



<?php while($fila = mysqli_fetch_assoc($resultado)){ ?>


<tr>


<td class="text-center">


<input 
class="form-check-input"
type="checkbox"
name="platillos[]"
value="<?php echo $fila['id_platillo']; ?>">


</td>



<td>

<?php echo $fila['nombre']; ?>

</td>



<td>

<?php echo $fila['categoria']; ?>

</td>



<td>

$<?php echo number_format($fila['precio'],2); ?>

</td>




<td>


<input

type="number"

class="form-control"

style="width:90px"

name="cantidad<?php echo $fila['id_platillo']; ?>"

value="1"

min="1">


</td>



</tr>



<?php } ?>



</table>




<button type="submit" class="btn btn-primary">

<i class="bi bi-check-circle"></i>

Guardar Pedido

</button>



<a href="pedidos.php" class="btn btn-primary">

Cancelar

</a>



</form>



</div>



<?php

include("footer.php");

?>