<?php
include("../DAO/EmpleadoBBDD.php"); // Asegúrate de incluir la clase EmpleadoBBDD

if (isset($_POST['enviarform'])) {
    try {
        $nif = $_POST['nif'];

        // Crear una instancia de la clase EmpleadoBBDD
        $empleadoBBDD = new EmpleadoBBDD();

        // Verificar qué acción se debe realizar (por ejemplo, modificar nombre)
        $accion = $_POST['accion'];

        switch ($accion) {
            case 'nombre':
                $nuevoNombre = $_POST['nuevo_valor'];
                $empleadoBBDD->modificarNombre($nif, $nuevoNombre);
                header("Location: ../Vista/GenericErr.php?message=" . "Nombre modificado");
                break;

            case 'apellidos':
                $nuevosApellidos = $_POST['nuevo_valor'];
                $empleadoBBDD->modificarApellidos($nif, $nuevosApellidos);
                header("Location: ../Vista/GenericErr.php?message=" . "Apellidos modificados");
                break;

            case 'profesion':
                $nuevaProfesion = $_POST['nuevo_valor'];
                $empleadoBBDD->modificarProfesion($nif, $nuevaProfesion);
                header("Location: ../Vista/GenericErr.php?message=" . "Profesion modificada");
                break;

            case 'salario':
                $nuevoSalario = $_POST['nuevo_valor'];
                $empleadoBBDD->modificarSalario($nif, $nuevoSalario);
                header("Location: ../Vista/GenericErr.php?message=" . "Salario modificado");
                break;

            case 'fechaNacimiento':
                $nuevaFechaNac = $_POST['nuevo_valor'];
                $empleadoBBDD->modificarFechaNacimiento($nif, $nuevaFechaNac);
                header("Location: ../Vista/GenericErr.php?message=" . "Fecha de nacimiento modificada");
                break;

            case 'fechaIngreso':
                $nuevaFechaIng = $_POST['nuevo_valor'];
                $empleadoBBDD->modificarFechaIngreso($nif, $nuevaFechaIng);
                header("Location: ../Vista/GenericErr.php?message=" . "Fecha de ingreso a la empresa modificada");
                break;

                
            default:
                
                
        }
    } catch (Exception $e) {
        // Redirigir a una vista genérica en caso de error
        header("Location: ../Vista/GenericErr.php?message=" . urlencode($e->getMessage()));
    }
} else {
    echo "Formulario no enviado.";
}
?>