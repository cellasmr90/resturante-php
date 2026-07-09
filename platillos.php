<?php
declare(strict_types=1);

/********** ENCABEZADO Y CONEXIÓN **********/
include("header.php");
include("conexion.php");

/********** VALIDAR ACCESO **********/
if ($_SESSION['rol'] != "Administrador") {
    header("Location:index.php");
    exit();
}

/********** GUARDAR PLATILLO **********/
if (isset($_POST['guardar'])) {

    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];

    mysqli_query($conexion,
    "INSERT INTO platillos(nombre,categoria,precio)
    VALUES('$nombre','$categoria','$precio')");
}

/********** CONSULTAR PLATILLOS **********/
$resultado = mysqli_query($conexion, "SELECT * FROM platillos");
?>

<h3 class="mt-4">Platillos</h3>

<form method="POST">

    <label>Nombre</label>

    <input type="text"
        name="nombre"
        class="form-control mb-2"
        required>

    <label>Categoría</label>

    <input type="text"
        name="categoria"
        class="form-control mb-2"
        required>

    <label>Precio</label>

    <input type="number"
        step="0.01"
        name="precio"
        class="form-control mb-3"
        required>

    <button class="btn btn-primary"
            name="guardar">

        Guardar

    </button>

</form>

<hr>

<table class="table table-bordered">

    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Precio</th>
    </tr>

    <?php while($fila = mysqli_fetch_assoc($resultado)){ ?>

    <tr>

        <td>
            <?php echo $fila['id_platillo']; ?>
        </td>

        <td>
            <?php echo $fila['nombre']; ?>
        </td>

        <td>
            <?php echo $fila['categoria']; ?>
        </td>

        <td>
            $<?php echo $fila['precio']; ?>
        </td>

    </tr>

    <?php } ?>

</table>

<?php include("footer.php"); ?>