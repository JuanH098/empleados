<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Document</title>
</head>
<body>
    <h1 class="title is-3">Sesion cerrada correctamente.✔</h1>
    <h2 class="title is-4">¡¡Hasta pronto <?php echo $_COOKIE['usuario'] ?>👋!!</h2>
    <h3 class="title is-5">Numero de webs visitadas: <?php echo $_COOKIE['contador']?>.</h3>
    <?php
session_start();

// Verificar si la variable de sesión existe
$eliminaciones = isset($_SESSION['eliminaciones']) ? $_SESSION['eliminaciones'] : 0;

// Mostrar la información
echo "Número total de empleados eliminados: $eliminaciones";

//no me da tiempo a hacer que muestre los departamentos tambien
?>

    <div class="buttons">
        <a class="button is-primary" href="../Vista/login.php">
            <strong>Volver atrás.</strong>
        </a>
    </div>
    </div>
</body>
</html>