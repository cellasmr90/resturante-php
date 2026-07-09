<?php
declare(strict_types=1);

/********** INCLUIR EL ENCABEZADO **********/
include("header.php");

/********** VERIFICAR QUE EL USUARIO HAYA INICIADO SESIÓN **********/
if (!isset($_SESSION['usuario'])) {

    header("Location: login.php");
    exit();

}

?>

<h3 class="mt-4">
    Bienvenido al sistema
</h3>

<!-- INFORMACIÓN DEL USUARIO -->
<p>
    Usuario: <?php echo $_SESSION['nombre']; ?>
</p>

<p>
    Rol: <?php echo $_SESSION['rol']; ?>
</p>

<?php
/********** MENÚ DEL ADMINISTRADOR **********/
if ($_SESSION['rol'] == "Administrador") {
?>

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
    Crear Pedidos
</a>

<?php } ?>


<?php
/********** MENÚ DEL MESERO **********/
if ($_SESSION['rol'] == "Mesero") {
?>

<a href="pedidos.php" class="btn btn-primary">
    Crear Pedidos
</a>

<?php } ?>


<?php
/********** MENÚ DE COCINA **********/
if ($_SESSION['rol'] == "Cocina") {
?>

<a href="cocina.php" class="btn btn-primary">
    Ver Cocina
</a>

<?php } ?>


<?php

/********** INCLUIR EL PIE DE PÁGINA **********/
include("footer.php");

?>