<?php
session_start();

if (!isset($_COOKIE['ambito'])){
    header("Location: ../Vista/login.php");
exit();
}else{
    setcookie('contador' , $_COOKIE['contador'] + 1, time() + (86400 * 30), "/");
}
?>
<?php
require("../Controlador/cont_EmpleadosCPD.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Empleados por Departamento</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title">Listado de Empleados por Departamento</h1>

            <!-- Formulario para elegir el departamento -->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="field">
                    <label class="label">Seleccione un Departamento:</label>
                    <div class="control">
                        <div class="select">
                            <select name="codigoDepartamento">
                                <?php
                                include_once("../DAO/DepartamentoBBDD.php");

                                $departamento = new DepartamentoBBDD();

                                $options = $departamento->ObtenerDepartamentos();

                                foreach ($options as $option) {
                                    echo "<option value='$option[id]'>$option[descripcion]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="control">
                    <p class="button is-primary">
                        <input type="hidden" name="enviar" value="true">
                        <button type="submit" class="button is-primary">Mostrar</button>
                    </p>
                </div>
            </form>
               <br>
               <br>                     
            <!-- Mostrar los datos de los empleados en una tabla -->
            <?php
            if (isset($empleadosTabla) && !empty($empleadosTabla)) {
                echo '<table class="table is-bordered is-striped is-narrow is-hoverable">';
                foreach ($empleadosTabla as $empleadosTabla) {
                    echo "<tr>";
                    foreach ($empleadosTabla as $key => $dato) {
                        if ($key != 'idDep') {
                            echo "<td>" . $dato . "</td>";
                        }
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
            ?>
            <br>
            <div class="buttons">
                <a class="button is-primary" href="../Vista/index.php">
                    <strong>Volver al inicio</strong>
                </a>
            </div>
        </div>
    </section>
</body>

</html>
