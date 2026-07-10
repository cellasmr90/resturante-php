<?php

include("header.php");


if (!isset($_SESSION['usuario'])) {

    header("Location: login.php");
    exit();

}

?>


<h3 class="mt-4">
    Bienvenido al sistema
</h3>


<p>
    Usuario: <?php echo $_SESSION['nombre']; ?>
</p>


<p>
    Rol: <?php echo $_SESSION['rol']; ?>
</p>



<?php if ($_SESSION['rol'] == "Administrador") { ?>


<a href="platillos.php" class="btn btn-primary">
    Gestionar Platillos
</a>


<a href="pedidos.php" class="btn btn-primary">
    Ver Pedidos
</a>


<a href="cocina.php" class="btn btn-primary">
    Pantalla Cocina
</a>


<a href="crear_pedido.php" class="btn btn-primary">
    Crear Pedido
</a>



<?php } ?>



<?php if ($_SESSION['rol'] == "Mesero") { ?>


<a href="crear_pedido.php" class="btn btn-primary">
    Crear Pedido
</a>


<?php } ?>



<?php if ($_SESSION['rol'] == "Cocina") { ?>


<a href="cocina.php" class="btn btn-primary">
    Ver Cocina
</a>


<a href="pedidos.php" class="btn btn-primary">
    Ver Pedidos
</a>


<?php } ?>



<?php

include("footer.php");

?>