<?php
session_start();

if (!isset($_COOKIE['ambito'])){
    header("Location: ../Vista/login.php");
exit();
}else{
    setcookie('contador' , $_COOKIE['contador'] + 1, time() + (86400 * 30), "/");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Document</title>
</head>
<body>
    <h1>Usuario no autorizado para realizar esta acción</h1>
 
    <div class="buttons">
        <a class="button is-primary" href="../Vista/index.php">
            <strong>Volver atrás.</strong>
        </a>
    </div>
    </div>
</body>
</html>