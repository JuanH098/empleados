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
    <title>Alta de Departamento</title>
</head>
<body>

<section class="section">
    <div class="container">
        <h1 class="title">Alta de Departamento</h1>

        <form action="../Controlador/cont_AltaDep.php" method="post">
            <div class="columns">
                <div class="column is-half">
                    <div class="field">
                        <label class="label">Código del Departamento</label>
                        <div class="control">
                            <input class="input" type="number" name="codigo" placeholder="Código del departamento" pattern="[0-9]{2}" required>
                        </div>
                    </div>

        
                    <div class="field">
                        <label class="label">Descripción del Departamento</label>
                        <div class="control">
                            <input class="input" type="text" name="descripcion" placeholder="Descripción del departamento" pattern="^[a-zA-Z_0-9]{5,50}"required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Localización del Departamento</label>
                        <div class="control">
                            <input class="input" type="text" name="localizacion" placeholder="Localización del departamento" pattern="^[a-zA-Zº0-9]{4,50}" required>
                        </div>
                    </div>
                </div>

                <div class="column is-half">
               
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <input name="enviar" value="true" type="hidden">
                    <button class="button is-primary" type="submit" name="enviarform">Dar de Alta</button>
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