<?php
session_start();

if (!isset($_COOKIE['ambito'])){
    header("Location: ../Vista/login.php");
exit();
}else{
    setcookie('contador' , $_COOKIE['contador'] + 1, time() + (86400 * 30), "/");
}
?>
<html>

<head>

  <link rel="stylesheet" href="../css/style.css">
</head>

<body>
  <h1>BBDD Empresa</h1>
<?php
if(isset($_COOKIE['ambito'])){
  if($_COOKIE['ambito']=='adminempleados'){

?>
  <div class="empleados">
    <button class="empleado">Empleados</button>
    <div class="empleados-content">
      <a href="AltaEmp.php">Alta Empleado</a>
      <a href="BajaEmp.php">Baja Empleado</a>
      <a href="ModificarEmp.php">Modificar Empleado</a>
      <a href="MostrarEmp.php">Consultar Ficha Empleado</a>
    </div>
  </div>
  <div class="empleados">
    <button class="departamentos">Departamentos</button>
    <div class="empleados-content">
      <a href="autorizacion.php">Alta Departamento</a>
      <a href="autorizacion.php">Baja Departamento</a>
      <a href="autorizacion.php">Modificar Departamento</a>
    </div>
  </div>
  <div class="empleados">
    <button class="listados">Listados</button>
    <div class="empleados-content">
      <a href="Empleados.php">Listado Empleados</a>
      <a href="EmpleadosCPD.php">Listado Completo Empleados</a>
      <a href="EmpleadosCompletos.php">Listado Completo por Empleados</a>
      <a href="Empleadosbaja.php">Listado Completo por Empleados de baja</a>
      <a href="dadosdebajaahora.php">Listado Completo por Empleados de baja en esta sesion</a>
    </div>
  </div>
  <div class="empleados">
    <a href="CerrarSesion.php"><button class="listados">Cerrar Sesion</button></a>
    </div>
  </div>
  <?php }else if ($_COOKIE['ambito']=='admindepartamentos') {?>
<div class="empleados">
    <button class="empleado">Empleados</button>
    <div class="empleados-content">
      <a href="autorizacion.php">Alta Empleado</a>
      <a href="autorizacion.php">Baja Empleado</a>
      <a href="autorizacion.php">Modificar Empleado</a>
      <a href="autorizacion.php">Consultar Ficha Empleado</a>
    </div>
  </div>
  <div class="empleados">
    <button class="departamentos">Departamentos</button>
    <div class="empleados-content">
      <a href="AltaDep.php">Alta Departamento</a>
      <a href="BajaDep.php">Baja Departamento</a>
      <a href="ModificarDep.php">Modificar Departamento</a>
    </div>
  </div>
  <div class="empleados">
    <button class="listados">Listados</button>
    <div class="empleados-content">
      <a href="Empleados.php">Listado Empleados</a>
      <a href="EmpleadosCPD.php">Listado Completo Empleados</a>
      <a href="EmpleadosCompletos.php">Listado Completo por Empleados</a>
      <a href="Empleadosbaja.php">Listado Completo por Empleados de baja</a>
      <a href="dadosdebajaahora.php">Listado Completo por Empleados de baja en esta sesion</a>
    </div>
  </div>
  <div class="empleados">
    <a href="CerrarSesion.php"><button class="listados">Cerrar Sesion</button></a>
    </div>
  </div>
<?php }elseif ($_COOKIE['ambito']=='adminsupremo') {?>
<div class="empleados">
    <button class="empleado">Empleados</button>
    <div class="empleados-content">
      <a href="AltaEmp.php">Alta Empleado</a>
      <a href="BajaEmp.php">Baja Empleado</a>
      <a href="ModificarEmp.php">Modificar Empleado</a>
      <a href="MostrarEmp.php">Consultar Ficha Empleado</a>
    </div>
  </div>
  <div class="empleados">
    <button class="departamentos">Departamentos</button>
    <div class="empleados-content">
      <a href="AltaDep.php">Alta Departamento</a>
      <a href="BajaDep.php">Baja Departamento</a>
      <a href="ModificarDep.php">Modificar Departamento</a>
    </div>
  </div>
  <div class="empleados">
    <button class="listados">Listados</button>
    <div class="empleados-content">
      <a href="Empleados.php">Listado Empleados</a>
      <a href="EmpleadosCPD.php">Listado Completo Empleados</a>
      <a href="EmpleadosCompletos.php">Listado Completo por Empleados</a>
      <a href="Empleadosbaja.php">Listado Completo por Empleados de baja</a>
      <a href="dadosdebajaahora.php">Listado Completo por Empleados de baja en esta sesion</a>
    </div>
  </div>
  <div class="empleados">
    <a href="CerrarSesion.php"><button class="listados">Cerrar Sesion</button></a>
    </div>
  </div>
<?php
} 
}?>
</body>
</html>