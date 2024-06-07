<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
    header("Location: registro.php");
    exit();
}

// Conexión a la base de datos 
$servername = "localhost:3307";
$username = "root";
$password = "diego";
$database = "productos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los productos
$sql = "SELECT * FROM Product";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página Principal</title>
</head>
<body>

<h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</h2>
<p>Esta es la página principal de tu inventario.</p>

<h3>Inventario de Productos</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre del Producto</th>
        <th>Descripción</th>
        <th>Cantidad en Stock</th>
        <th>Precio</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        // Mostrar los datos de cada fila
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["descripcion"] . "</td>";
            echo "<td>" . $row["cantidad"] . "</td>";
            echo "<td>" . $row["precio"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No hay productos en el inventario</td></tr>";
    }
    ?>
</table>

<a href="logout.php">Cerrar sesión</a>

</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>
