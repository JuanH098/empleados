<?php
include_once("operacionesBBDD.php");

class DepartamentoBBDD
{

    private $conexion;

    public function __construct()
    {
        $operaciones = new OperacionesBBDD();
        $this->conexion = $operaciones->getCon();
    }
    public function DarAltaDep(Departamento $departamento)
    {
        $codigo = $departamento->getCodigo();
        $descripcion = $departamento->getDescripcion();
        $localizacion = $departamento->getLocalizacion();

        $query = $this->conexion->prepare("INSERT INTO departamento (codigo, descripcion, localizacion) VALUES (?, ?, ?)");
        $query->bind_param("sss", $codigo, $descripcion, $localizacion);


        $query->execute();

        if ($query->affected_rows > 0) {
            echo "Registro insertado correctamente.";
        } else {
            "Error al insertar el registro: " . $query->error;
        }

        $query->close();
    }
    public function DarBajaDep($codigo_dep)
    {
        // Verificar si el departamento existe
        $existenciaQuery = $this->conexion->prepare("SELECT COUNT(*) FROM departamento WHERE codigo = ?");
        $existenciaQuery->bind_param("s", $codigo_dep);
        $existenciaQuery->execute();
        $existenciaQuery->bind_result($count);
        $existenciaQuery->fetch();
        $existenciaQuery->close();

        if ($count == 0) {
            throw new Exception("El departamento no existe en la base de datos.");
        }

        // Verificar si hay empleados asociados a este departamento
        $empleadosQuery = $this->conexion->prepare("SELECT COUNT(*) FROM empleado WHERE idDepartamento = ?");
        $empleadosQuery->bind_param("s", $codigo_dep);
        $empleadosQuery->execute();
        $empleadosQuery->bind_result($employeeCount);
        $empleadosQuery->fetch();
        $empleadosQuery->close();

        if ($employeeCount > 0) {
            throw new Exception("No se puede eliminar el departamento, hay empleados asociados a él.");
        }

        // Iniciar una transacción para realizar la eliminación
        $this->conexion->begin_transaction();

        // Eliminar el departamento
        $deleteQuery = $this->conexion->prepare("DELETE FROM departamento WHERE codigo = ?");
        $deleteQuery->bind_param("s", $codigo_dep);

        if (!$deleteQuery->execute()) {
            // En caso de error, hacer un rollback de la transacción
            $this->conexion->rollback();
            throw new Exception("No se puede eliminar el departamento, hay empleados asociados a él.");
        }

        // Confirmar la transacción
        $this->conexion->commit();

        $deleteQuery->close();
    }



    public function ObtenerDepartamentos()
    {
        $departamentos = [];
        if ($query = $this->conexion->prepare("SELECT id, descripcion FROM departamento")) {
            $query->execute();

            $resultado = $query->get_result();

            while ($row = $resultado->fetch_assoc()) {
                $departamentos[] = $row;
            }

            $query->close();
        } else {
            die("Error en la preparacion de la consula");
        }
        return $departamentos;
    }
    public function ObtenerCodigo($codigo)
    {
        if ($query = $this->conexion->prepare("SELECT codigo FROM departamento")) {
            $query->execute();
            $resultado = $query->get_result();
            while ($row = $resultado->fetch_assoc()) {
                if ($row['codigo'] == $codigo) {
                    throw new Exception("El código ya está en uso en el departamento");
                }
            }
        }
        return true;
    }
    public function modificarLocalizacion($codigo, $nuevaLocalizacion)
    {
        $sql = "UPDATE departamento SET localizacion=? WHERE codigo=?";
        $query = $this->conexion->prepare($sql);

        if (!$query) {
            throw new Exception("Error en la preparación de la consulta.");
        }

        $query->bind_param("ss", $nuevaLocalizacion, $codigo);
        $query->execute();

        if ($query->affected_rows > 0) {
            echo "Localizacion modificada correctamente.";
        } else {
            throw new Exception("No se encontró ningún departamento con el código proporcionado.");
        }

        $query->close();
    }

    public function modificarDescripcion($codigo, $nuevaDescripcion)
    {
        $sql = "UPDATE departamento SET descripcion=? WHERE codigo=?";
        $query = $this->conexion->prepare($sql);

        if (!$query) {
            throw new Exception("Error en la preparación de la consulta.");
        }

        $query->bind_param("ss", $nuevaDescripcion, $codigo);
        $query->execute();

        if ($query->affected_rows > 0) {
            echo "Descripción modificada correctamente.";
        } else {
            throw new Exception("No se encontró ningún departamento con el código proporcionado.");
        }

        $query->close();
    }
    // Método en la clase DepartamentoBBDD para obtener todos los departamentos

    public function todosLosDepartamentos()
    {
        $departamentos = array();

        $query = $this->conexion->prepare("SELECT * FROM departamento");
        $query->execute();
        $resultado = $query->get_result();

        while ($row = $resultado->fetch_assoc()) {
            $departamento = new Departamento(
                $row['id'],
                $row['descripcion'],
                $row['ubicacion']
            );
            array_push($departamentos, $departamento);
        }

        return $departamentos;
    }

    public function getDatosSegunID($id)
    {
        $orden = "SELECT * FROM departamento WHERE id = ?";
        $query = $this->conexion->prepare($orden);
        $query->bind_param("i", $id);


        $query->execute();
        $resultado = $query->get_result();
        $datos = $resultado->fetch_assoc();
        return $datos;
    }
}
?>