<?php
include_once("operacionesBBDD.php");

class Credenciales{

    private $conexion;
    public function __construct()
    {
        $operaciones = new OperacionesBBDD();
        $this->conexion = $operaciones->getCon();
    }
    
    
    public function comprobarcredenciales($nombre, $contrasena)
    {
        // Utiliza sentencias preparadas para evitar la inyección SQL
        $sql = "SELECT * FROM credenciales WHERE nombre = ? AND contraseña = ?";
        $query = $this->conexion->prepare($sql);
    
        if ($query) {
            // Enlaza los parámetros y ejecuta la consulta
            $query->bind_param("ss", $nombre, $contrasena);
            $query->execute();
    
            // Obtiene el resultado
            $result = $query->get_result();
           
    
            if ($result->num_rows > 0) {
                // Si se encuentra una fila, devuelve los datos del usuario
                $row = $result->fetch_assoc();
                return $row;
            } else {
                // Si no se encuentra ninguna fila, devuelve null
                return null;
            }
        } else {
            // Manejo de errores en caso de fallo en la preparación de la consulta
            return null;
        }
    }
    
}
?>