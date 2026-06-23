<?php
require_once "config/Database.php";


try {
    $database = new Database();
    $db = $database->getConnection();

    // Generamos el hash exacto usando el motor PHP de tu máquina
    $nueva_clave = password_hash('admin123', PASSWORD_BCRYPT);

    // Limpiamos y actualizamos los usuarios de prueba
    $query = "UPDATE usuarios SET password = :password WHERE username IN ('admin', 'empleado')";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':password', $nueva_clave);
    
    if ($stmt->execute()) {
        echo "<h3 style='color:green;'>¡Contraseñas actualizadas con éxito en tu servidor local!</h3>";
        echo "Contraseña generada: <b>admin123</b><br>";
        echo "Hash guardado: <code>" . $nueva_clave . "</code><br><br>";
        echo "<a href='index.php'>Ir al Login</a>";
    }
} catch (Exception $e) {
    echo "<h3 style='color:red;'>Error al actualizar:</h3> " . $e->getMessage();
}
