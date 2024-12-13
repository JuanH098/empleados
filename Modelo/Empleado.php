<?php
class Empleado{
    public  $nif, $apellidos, $nombre, $profesion, $codigo;
    public  $salario;
    public $fechaNac;
    public $fechaIngreso;

    public $idDep;
   
    public function __construct(
         $nif,
         $codigo,
         $apellidos,
         $nombre,
         $profesion,
         $salario,
         $fechaNac,
         $fechaIngreso,
         $idDep
    ) {
        $this->setNif($nif);
        $this->setCodigo($codigo);
        $this->setApellidos($apellidos);
        $this->setNombre($nombre);
        $this->setProfesion($profesion);
        $this->setSalario($salario);
        $this->setFechaNac($fechaNac);
        $this->setFechaIngreso($fechaIngreso);
        $this->setIdDep($idDep);
    }

 
    public function setNif( $nif)
    {
        $nif = trim($nif);

        if (strlen($nif) === 9) {
            $numero = substr($nif, 0, 8);
            if (ctype_digit($numero)) {
                $letra = strtoupper(substr($nif, -1));
                if (ctype_alpha($letra)) {
                    $this->nif = $nif;
                } else {
                    throw new InvalidArgumentException('El último carácter del NIF debe ser una letra.');
                }
            } else {
                throw new InvalidArgumentException('Los primeros 8 caracteres del NIF deben ser números.');
            }
        } else {
            throw new InvalidArgumentException('El NIF debe tener una longitud de 9 caracteres.');
        }
    }

    public function setCodigo($codigo)
    {
        if (strlen($codigo) > 50 || strlen($codigo) < 0) {
            return false;
        } else {
            $this->codigo = $codigo;
        }
    }
    public function setApellidos(string $apellidos)
    {
        if (strlen($apellidos) > 25 || strlen($apellidos) < 0) {
            return false;
        } else {
            $this->apellidos = $apellidos;
        }
    }

    public function setNombre(string $nombre)
    {
        if (strlen($nombre) > 15 || strlen($nombre) < 0) {
            return false;
        } else {
            $this->nombre = $nombre;
        }

    }

    public function setProfesion(string $profesion)
    {
        if (strlen($profesion) > 15 || strlen($profesion) < 0) {
            return false;
        } else {
            $this->profesion = $profesion;
        }

    }

    public function setSalario(float $salario)
    {
        $this->salario = $salario;
    }

    public function setFechaNac($fechaNac)
    {
        $this->fechaNac = $fechaNac;
    }

    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;
    }

    public function setIdDep(int $idDep)
    {
        $this->idDep = $idDep;
    }

    

    public function getNif(): string
    {
        return $this->nif;
    }
    public function getCodigo(){
        return $this->codigo;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getProfesion(): string
    {
        return $this->profesion;
    }

    public function getSalario(): float
    {
        return $this->salario;
    }

    public function getFechaNac()
    {
        return $this->fechaNac;
    }

    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    public function getDepAsig(): int
    {
        return $this->idDep;
    }
}
?>