<?php
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

// Iniciar sesión
session_start();

// Verificar si se envió el formulario
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];

    // Consulta SQL para verificar las credenciales
    $sql = "SELECT ID, Nombre FROM Usuarios WHERE Nombre=? AND Contraseña=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nombre, $contraseña);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró un usuario con esas credenciales
    if ($result->num_rows > 0) {
        // Iniciar sesión y redirigir al usuario a la página principal
        $_SESSION['nombre'] = $nombre;
        header("Location: db_connection.php");
        exit();
    } else {
        // Mostrar mensaje de error si las credenciales son incorrectas
        $error = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
</head>
<body>

<h2>Iniciar sesión</h2>
<?php
if (isset($error)) {
    echo "<p style='color:red;'>$error</p>";
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Nombre de usuario: <input type="text" name="nombre" required><br><br>
    Contraseña: <input type="password" name="contraseña" required><br><br>
    <input type="submit" value="Iniciar sesión">
</form>

</body>
</html>

<?php
// Cerrar conexión
$conn->close();
?>
