
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bulma.min.css">
    <title>Document</title>
</head>

<body>
    <form method="post" action="../Controlador/cont_login.php">
<div class="field">
  <label class="label">Name</label>
  <div class="control">
    <input class="input" type="text" placeholder="Text" name="name">
  </div>
</div>



<div class="field">
  <label class="label">Password</label>
  <div class="control has-icons-left has-icons-right">
    <input class="input is-success" type="Password" placeholder="Text input" name="password">
    <span class="icon is-small is-left">
      <i class="fas fa-user"></i>
    </span>
    <span class="icon is-small is-right">
      <i class="fas fa-check"></i>
    </span>
  </div>
</div>




<div class="field is-grouped">
  <div class="control">
    <input class="button" type="submit" value="Submit">
  </div>
 
</div>
</form>
</body>
</html>