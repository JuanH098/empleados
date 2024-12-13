<?php
include_once("operacionesBBDD.php");

class EmpleadoBBDD
{

    private $conexion;

    public function __construct()
    {
        $operaciones = new OperacionesBBDD();
        $this->conexion = $operaciones->getCon();
    }

    public function DarAltaEmpleado(Empleado $empleado)
    {
        $nif = $empleado->getNif();
        $codigo = $empleado->getCodigo();
        $apellidos = $empleado->getApellidos();
        $nombre = $empleado->getNombre();
        $profesion = $empleado->getProfesion();
        $salario = $empleado->getSalario();
        $fechaNac = $empleado->getFechaNac();
        $fechaIngreso = $empleado->getFechaIngreso();
        $idDep = $empleado->getDepAsig();

        $query = $this->conexion->prepare("INSERT INTO empleado (nif,codigo, apellidos, nombre, profesion, salario, fechaNac, fechaIng, idDepartamento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("sssssdssi", $nif, $codigo, $apellidos, $nombre, $profesion, $salario, $fechaNac, $fechaIngreso, $idDep);
        $query->execute();


        if ($query->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function DarBajaEmp($nif)
    {
        $query = $this->conexion->prepare("DELETE FROM empleado WHERE nif = ?");
        $query->bind_param("s", $nif);

        $query->execute();

        if ($query->affected_rows > 0) {

            echo "Empleado eliminado correctamente.";
        } else {
            throw new Exception(
             "Error al eliminar el Empleado: " . $query->error);
        }

        $query->close();
    }

    public function añadirAntiguos($nif, $motivo)
    {
        // Obtener los datos del empleado dado de baja
        $querySelect = $this->conexion->prepare("SELECT nif, nombre, profesion FROM empleado WHERE nif = ?");
        
        if (!$querySelect) {
            throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
        }
    
        $querySelect->bind_param("s", $nif);
        $querySelect->execute();
        $result = $querySelect->get_result();
    
        if ($result === false) {
            throw new Exception("Error al ejecutar la consulta: " . $querySelect->error);
        }
    
        // Verificar si se encontró el empleado
        if ($result->num_rows > 0) {
            // Obtener los datos del empleado
            $empleado = $result->fetch_assoc();
    
            // Insertar el empleado en la tabla antiguos
            $queryInsert = $this->conexion->prepare("INSERT INTO antiguos (nif, nombre, profesion, motivo) VALUES (?, ?, ?, ?)");
            $queryInsert->bind_param("ssss", $empleado['nif'], $empleado['nombre'], $empleado['profesion'], $motivo);
            $queryInsert->execute();
    
            if ($queryInsert->affected_rows > 0) {
                echo "Empleado añadido a la tabla de antiguos correctamente.";
            } else {
                throw new Exception("Error al añadir el Empleado a la tabla de antiguos: " . $queryInsert->error);
            }
    
            $queryInsert->close();
        } else {
            throw new Exception("No se encontró el empleado con NIF: " . $nif);
        }
    
        $querySelect->close();
    }
 




    public function obtenerEmpleadosAntiguos()
{
    // Consulta para obtener todos los empleados de la tabla antiguos
    $query = $this->conexion->prepare("SELECT nif, nombre, profesion, motivo FROM antiguos");
    
    if (!$query) {
        throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
    }

    $query->execute();
    $result = $query->get_result();

    if ($result === false) {
        throw new Exception("Error al ejecutar la consulta: " . $query->error);
    }

    $empleadosAntiguos = array();

    // Obtener todos los empleados antiguos y almacenarlos en un array asociativo
    while ($empleado = $result->fetch_assoc()) {
        $empleadosAntiguos[] = $empleado;
    }

    $query->close();

    return $empleadosAntiguos;
}
public function almacenarEmpleadosAntiguosEnSesion(){
    //se que el error esta en como relleno la sesion ya que la relleno desde una sentencia entonces la llena con los datos de la base de datos, 
    //pero no le encuentro manera se ve que hoy no estoy lúcido.
{
    // Consulta para obtener todos los empleados de la tabla antiguos
    $query = $this->conexion->prepare("SELECT nif, nombre, profesion, motivo FROM antiguos");

    if (!$query) {
        throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
    }

    $query->execute();
    $result = $query->get_result();

    if ($result === false) {
        throw new Exception("Error al ejecutar la consulta: " . $query->error);
    }

    $empleadosAntiguos = array();

    // Obtener todos los empleados antiguos y almacenarlos en un array asociativo
    while ($empleado = $result->fetch_assoc()) {
        $empleadosAntiguos[] = $empleado;
    }

    $query->close();

    // Almacenar el array de empleados antiguos en la sesión
    session_start();
    $_SESSION['empleadosAntiguos'] = $empleadosAntiguos;
    session_write_close();

}
}
    
    public function ObtenerCodigoEmp($codigo)
    {
        if ($query = $this->conexion->prepare("SELECT codigo FROM empleado")) {
            $query->execute();
            $resultado = $query->get_result();
            while ($row = $resultado->fetch_assoc()) {
                if ($row['codigo'] == $codigo) {
                    throw new Exception("El código ya está en uso para algun empleado.");
                }
            }
        }
        return true;
    }

    public function ObtenerNif($nif)
    {
        if ($query = $this->conexion->prepare("SELECT nif FROM empleado")) {
            $query->execute();
            $resultado = $query->get_result();
            while ($row = $resultado->fetch_assoc()) {
                if ($row['nif'] == $nif) {
                    throw new Exception("El NIF ya está en uso para algun empleado.");
                }
            }
        }
        return true;
    }
    public function comprobarFechas($fechaing, $fechanac)
    {
        $fechaNac = new DateTime($fechanac);
        $fechaIng = new DateTime($fechaing);
        $dateNow = new DateTime("now");
        $dateNow->modify("-18 year");


        if ($dateNow < $fechanac) {
            throw new Exception("No puedes trabajar siendo menor de edad");
        }

        if ($fechaIng > $fechaNac) {
            throw new Exception("La fecha de ingreso no puede ser anterior a la fecha de nacimiento");
        }

    }
    public function listaEmpleados()
    {
        $empleados = [];
        $orden = "SELECT * FROM empleado;";
        $query = $this->conexion->prepare($orden);
        $query->execute();
        $resultado = $query->get_result();
        $fila = $resultado->fetch_assoc();

        while ($fila) {
            array_push($empleados, $fila);
            $fila = $resultado->fetch_assoc();
        }

        return $empleados;
    }
    public function modificarNombre($nif, $nuevoNombre)
    {
        $sql = "UPDATE empleado SET nombre=? WHERE nif=?";
        $query = $this->conexion->prepare($sql);

        if ($query) {
            $query->bind_param("ss", $nuevoNombre, $nif);
            $query->execute();

            if ($query->affected_rows > 0) {
                return true; // Indica éxito
            } else {
                throw new Exception("Error al modificar el nombre del empleado: El Nif no existe");
            }


        } else {
            throw new Exception("Error en la preparación de la consulta.");
        }
    }

    public function modificarApellidos($nif, $nuevosApellidos)
    {
        $sql = "UPDATE empleado SET apellidos=? WHERE nif=?";
        $query = $this->conexion->prepare($sql);

        if ($query) {
            $query->bind_param("ss", $nuevosApellidos, $nif);
            $query->execute();

            if ($query->affected_rows > 0) {
                return true; // Indica éxito
            } else {
                throw new Exception("Error al modificar los apellidos del empleado: " . $query->error);
            }


        } else {
            throw new Exception("Error en la preparación de la consulta.");
        }
    }

    public function modificarProfesion($nif, $nuevaProfesion)
    {
        $sql = "UPDATE empleado SET profesion=? WHERE nif=?";
        $query = $this->conexion->prepare($sql);

        if ($query) {
            $query->bind_param("ss", $nuevaProfesion, $nif);
            $query->execute();

            if ($query->affected_rows > 0) {
                return true; // Indica éxito
            } else {
                throw new Exception("Error al modificar la profesión del empleado: ");
            }


        } else {
            throw new Exception("Error en la preparación de la consulta.");
        }
    }

    public function modificarSalario($nif, $nuevoSalario)
    {
        $sql = "UPDATE empleado SET salario=? WHERE nif=?";
        $query = $this->conexion->prepare($sql);

        if ($query) {
            $query->bind_param("ds", $nuevoSalario, $nif);
            $query->execute();
            
            if ($query->affected_rows > 0) {
                return true; // Indica éxito
            } else {
                throw new Exception("Error al modificar el salario del empleado: " . $query->error);
            }


        } else {
            throw new Exception("Error en la preparación de la consulta.");
        }
    }

    public function modificarFechaNacimiento($nif, $nuevaFechaNac)
    {
        $sql = "UPDATE empleado SET fechaNac=? WHERE nif=?";
        $query = $this->conexion->prepare($sql);

        if ($query) {
            $query->bind_param("ss", $nuevaFechaNac, $nif);
            $query->execute();

            if ($query->affected_rows > 0) {
                return true; // Indica éxito
            } else {
                throw new Exception("Error al modificar la fecha de nacimiento del empleado: ");
            }

        } else {
            throw new Exception("Error en la preparación de la consulta.");
        }
    }

    public function modificarFechaIngreso($nif, $nuevaFechaIng)
    {
        $sql = "UPDATE empleado SET fechaIng=? WHERE nif=?";
        $query = $this->conexion->prepare($sql);

        if ($query) {
            $query->bind_param("ss", $nuevaFechaIng, $nif);
            $query->execute();

            if ($query->affected_rows > 0) {
                return true;
            } else {
                throw new Exception("Error al modificar la fecha de ingreso del empleado: ");
            }


        } else {
            throw new Exception("Error en la preparación de la consulta.");
        }
    }
    public function ObtenerEmpleadoPorNIF($nif)
    {
        $query = $this->conexion->prepare("SELECT nif, codigo, apellidos, nombre, profesion, salario, fechaNac, fechaIng, idDepartamento FROM empleado WHERE nif = ?");
        $query->bind_param("s", $nif);
        $query->execute();

        $resultado = $query->get_result();

        if ($resultado->num_rows > 0) {
            $empleado = $resultado->fetch_assoc();
            return new Empleado($empleado['nif'], $empleado['codigo'], $empleado['apellidos'], $empleado['nombre'], $empleado['profesion'], $empleado['salario'], $empleado['fechaNac'], $empleado['fechaIng'], $empleado['idDepartamento']);
        } else {
            $mensajeError = "No se encontró un empleado con el NIF proporcionado.";
            throw new Exception($mensajeError);
        }
    }

    public function empleadosCompletos()
    {
        $empleados = array();

        $query = $this->conexion->prepare("SELECT * FROM empleado");
        $query->execute();
        $resultado = $query->get_result();

        while ($row = $resultado->fetch_assoc()) {
            $empleado = new Empleado(
                $row['nif'],
                $row['codigo'],
                $row['apellidos'],
                $row['nombre'],
                $row['profesion'],
                $row['salario'],
                $row['fechaNac'],
                $row['fechaIng'],
                $row['idDepartamento']
            );
            array_push($empleados, $empleado);
        }

        return $empleados;
    }

    // Método en la clase EmpleadoBBDD para obtener empleados por departamento

    public function empleadosPorDepartamento($codigoDepartamento)
    {
        $empleados = array();

        $query = $this->conexion->prepare("SELECT * FROM empleado WHERE idDepartamento = ?");
        $query->bind_param("s", $codigoDepartamento);
        $query->execute();
        $resultado = $query->get_result();

        while ($row = $resultado->fetch_assoc()) {
            $empleado = new Empleado(
                $row['nif'],
                $row['codigo'],
                $row['apellidos'],
                $row['nombre'],
                $row['profesion'],
                $row['salario'],
                $row['fechaNac'],
                $row['fechaIng'],
                $row['idDepartamento']
            );
            array_push($empleados, $empleado);
        }

        return $empleados;
    }

    public function listaEmpleado()
    {
        $empleados = [];
        $orden = "SELECT * FROM empleado;";
        $query = $this->conexion->prepare($orden);
        $query->execute();
        $resultado = $query->get_result();

        include_once("../DAO/DepartamentoBBDD.php");
        while ($fila = $resultado->fetch_assoc()) {
            $daoDepartamento = new DepartamentoBBDD();
            $datosDepartamento = $daoDepartamento->getDatosSegunID($fila['idDepartamento']);
            unset($fila['idDepartamento']);
            unset($datosDepartamento['id']);
            $fila['departamento'] = $datosDepartamento;
            array_push($empleados, $fila);
        }

        return $empleados;
    }
}


?>