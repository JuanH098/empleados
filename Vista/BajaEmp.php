<?php
session_start();

if (!isset($_COOKIE['ambito'])) {
    header("Location: ../Vista/login.php");
    exit();
} else {
    setcookie('contador', $_COOKIE['contador'] + 1, time() + (86400 * 30), "/");
}
// Después de eliminar un empleado (donde sea que tengas esta lógica)
// Puedes colocar esto para incrementar el contador en la sesión


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Baja de Empleado</title>
</head>

<body>

    <section class="section">
        <div class="container">
            <h1 class="title">Baja de Empleado</h1>

            <form action="../Controlador/cont_BajaEmp.php" method="post">
                <div class="field">
                    <label class="label">NIF del Empleado</label>
                    <div class="control">
                        <input class="input" type="text" name="nif" placeholder="nif" maxlength="9" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Motivo</label>
                    <div class="control">
                        <input class="input" type="text" name="motivo" placeholder="motivo" maxlength="15" required>
                    </div>
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <input name="darDeBajaEmp" value="true" type="hidden">
                        <button class="button is-danger" type="submit">Dar de Baja</button>
                    </div>
                    <div class="control">
                        <button class="button is-link" type="reset">Limpiar</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>