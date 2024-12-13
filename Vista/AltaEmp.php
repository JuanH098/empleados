<?php
session_start();

if (!isset($_COOKIE['ambito'])){
    header("Location: ../Vista/login.php");
exit();
}else{
    setcookie('Contador' , $_COOKIE['Contador'] + 1, time() + (86400 * 30), "/");
    
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Alta de Empleado</title>
</head>

<body>

    <section class="section">
        <div class="container">
            <h1 class="title">Alta de Empleado</h1>

            <form action="../Controlador/cont_AltaEmp.php" method="post">
                <div class="columns">
                    <div class="column is-half">
                        <div class="field">
                            <label class="label">NIF</label>
                            <div class="control">
                                <input class="input" type="text" name="nif" placeholder="NIF del empleado"
                                pattern="\d{8}[a-zA-Z]" maxlength="20" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Codigo</label>
                            <div class="control">
                                <input class="input" type="text" name="codigo" placeholder="codigo" pattern="[A-Z0-9]{1,11}" maxlength="20"
                                    required>
                            </div>
                        </div>


                        <div class="field">
                            <label class="label">Apellidos</label>
                            <div class="control">
                                <input class="input" type="text" name="apellidos" placeholder="Apellidos del empleado" pattern="[a-zA-Z ]{4,20}" maxlength="15"
                                    required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Nombre</label>
                            <div class="control">
                                <input class="input" type="text" name="nombre" placeholder="Nombre del empleado" pattern="[a-zA-Z0-9]{4,20}" maxlength="20"
                                    required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Profesión</label>
                            <div class="control">
                                <input class="input" type="text" name="profesion" placeholder="Profesión del empleado" pattern="[a-zA-Z0-9]{4,20}" maxlength="20"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="column is-half">
                        <div class="field">
                            <label class="label">Salario</label>
                            <div class="control">
                                <input class="input" type="number" name="salario" placeholder="Salario del empleado" pattern="^\d{4,}$" maxlength="20"
                                    required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Fecha de Nacimiento</label>
                            <div class="control">
                                <input class="input" type="date" name="fecha_nac"  pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Fecha de Ingreso</label>
                            <div class="control">
                                <input class="input" type="date" name="fecha_ingreso" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
                            </div>
                        </div>
                        
                        <div class="field">
                            <label class="label">ID del Departamento</label>
                            <div class="control">
                                <div class="select">
                                    <select name="id_dep" required>
                                        <option value="" disabled selected>Selecciona un departamento</option>
                                        <?php
                                        include_once("../DAO/DepartamentoBBDD.php");

                                        $departamento = new DepartamentoBBDD();

                                        $options=$departamento->ObtenerDepartamentos();

                                        foreach ($options as $option) {
                                            echo"
                                                <option value='$option[id]'>$option[descripcion]</option>
                                            ";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="field is-grouped">
                            <div class="control">
                                <input name="enviarEmp" value="true" type="hidden">
                                <button class="button is-primary" type="submit">Dar de Alta</button>
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