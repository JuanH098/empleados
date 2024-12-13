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
    <title>Modificar Empleado</title>
</head>
<body>

<section class="section">
    <div class="container">
        <h1 class="title">Modificar Empleado</h1>

        <form action="../Controlador/cont_ModificarEmp.php" method="post">
            <div class="columns">
                <div class="column is-half">
                    <div class="field">
                        <label class="label">NIF del Empleado</label>
                        <div class="control">
                            <input class="input" type="text" name="nif"  pattern="\d{8}[a-zA-Z]" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Accion</label>
                        <div class="control">
                            <div class="select">
                                <select name="accion">
                                    <option value="nombre">Modificar Nombre</option>
                                    <option value="apellidos">Modificar Apellidos</option>
                                    <option value="profesion">Modificar Profesión</option>
                                    <option value="salario" pattern="^\d{4,}$">Modificar Salario</option>
                                    <option value="fechaNacimiento" pattern="[0-9-]{0-10}">Modificar Fecha de Nacimiento</option>
                                    <option value="fechaIngreso" pattern="[0-9-]{0-10}">Modificar Fecha de Ingreso</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Nuevo Valor</label>
                        <div class="control">
                            <input class="input" type="text" name="nuevo_valor" required>
                        </div>
                    </div>
                </div>

                <div class="column is-half">
               
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <input name="enviar" value="Modificar" type="hidden">
                    <button class="button is-primary" type="submit" name="enviarform">Modificar</button>
                </div>
            </div>
        </form>
    </div>
</section>

</body>
</html>
