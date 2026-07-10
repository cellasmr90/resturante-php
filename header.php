<?php

/********** INICIAR LA SESIÓN **********/
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema Restaurante</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.7/dist/flatly/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<!-- BARRA DE NAVEGACIÓN -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <div class="container">

        <!-- NOMBRE DEL SISTEMA -->
        <a class="navbar-brand" href="index.php">
            Restaurante
        </a>

        <div>

            <?php
            /********** MOSTRAR EL MENÚ SI EL USUARIO INICIÓ SESIÓN **********/
            if (isset($_SESSION['usuario'])) {
            ?>

            <a class="btn btn-light btn-sm" href="index.php">
                Inicio
            </a>

            <?php
            /********** OPCIONES PARA ADMINISTRADOR Y MESERO **********/
            if ($_SESSION['rol'] == "Administrador" || $_SESSION['rol'] == "Mesero") {
            ?>

            <a class="btn btn-light btn-sm" href="pedidos.php">
                Pedidos
            </a>

            <?php } ?>

            <?php
            /********** OPCIONES PARA ADMINISTRADOR Y COCINA **********/
            if ($_SESSION['rol'] == "Administrador" || $_SESSION['rol'] == "Cocina") {
            ?>

            <a class="btn btn-light btn-sm" href="cocina.php">
                Cocina
            </a>

            <?php } ?>

            <!-- BOTÓN PARA CERRAR SESIÓN -->
            <a class="btn btn-light btn-sm" href="cerrar_sesion.php">
                Salir
            </a>

            <?php } ?>

        </div>

    </div>

</nav>

<div class="container mt-3">

<?php

/********** MOSTRAR EL USUARIO Y SU ROL **********/
if (isset($_SESSION['nombre'])) {

    echo "<p>Usuario: " . $_SESSION['nombre'] . " (" . $_SESSION['rol'] . ")</p>";

}

?>