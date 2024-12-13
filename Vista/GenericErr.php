<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" contenct="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/bulma-rtl.min.css">
        <title>Mensajes</title>
    </head>
<body>
    <p class="title is-5">
        <?php
            echo urldecode($_GET['message']);    
        ?>
    </p>
    <div class="buttons">
        <a class="button is-primary" href="../Vista/index.php">
            <strong>Volver al inicio</strong>
        </a>
    </div>
</body>