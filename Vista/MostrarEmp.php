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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bulma-rtl.min.css">
    <!-- Añade tu hoja de estilo personalizada -->
    <title>Buscar Empleado por NIF</title>
</head>

<body>

    <section class="section">
        <div class="container">
            <h1 class="title">Datos del Empleado</h1>

            <form action="../Controlador/cont_MostrarEmp.php" method="post">
                <div class="field">
                    <label class="label">NIF del Empleado</label>
                    <div class="control">
                        <input class="input" type="text" name="nif" placeholder="Introduce el NIF del empleado"
                            pattern="[A-Za-z0-9]{9}" required>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary" type="submit" name="buscar">Buscar Empleado</button>
                    </div>
                    <div class="control">
                        <button class="button is-link" type="reset">Limpiar</button>
                    </div>

                </div>
                <div class="buttons">
                    <a class="button is-primary" href="../Vista/index.php">
                        <strong>Volver al inicio</strong>
                    </a>
                </div>
            </form>
            <br>
            
            

            <!-- Aquí se mostrarán los datos del empleado desde PHP -->

        </div>
    </section>

</body>

</html>