<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/');
    exit;
}

// Obtener la información del usuario de la base de datos usando $_SESSION['user_id']
include '../config/config.php';
$stmt = $db->prepare("SELECT * FROM tusers WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
if (!$stmt->execute()) {
    die("Error: " . $stmt->error);
}
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Mostrar la información personalizada del usuario

// Cerrar la conexión a la base de datos y la sesión
$db->close();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../resources/icon/hbo.png">
    <title>Home</title>
</head>
<body>
    <?php echo "<h1>Benvingut, " . $user['user_fname'] . " " . $user['user_lname'] . "!</h1>"; ?>
    <?php echo "<p>El seu nom d'usuari és: " . $user['username'] . "</p>"; ?>
</body>
</html>
