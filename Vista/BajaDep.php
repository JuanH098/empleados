<?php
session_start();

if (!isset($_COOKIE['ambito'])){
    header("Location: ../Vista/login.php");
exit();
}else{
    setcookie('contador' , $_COOKIE['contador'] + 1, time() + (86400 * 30), "/");
    setcookie('ContadorDep' , $_COOKIE['ContadorDep'] + 1, time() + (86400 * 30), "/");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Baja de Departamento</title>
</head>
<body>

<section class="section">
    <div class="container">
        <h1 class="title">Baja de Departamento</h1>

        <form action="../Controlador/cont_BajaDep.php" method="post">
            <div class="field">
                <label class="label">Código del departamento</label>
                <div class="control">
                    <input class="input" type="number" name="codigo_dep" placeholder="codigo_dep" pattern="{2}" required>
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <input name="darDeBajaDep" value="true" type="hidden">
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