<?php 
    $busca = $banco->query("SELECT usuario, nome, senha, tipo from usuarios WHERE usuario = '". $_SESSION['user']. "'");
    $reg = $busca->fetch_object();
?>

<form style="padding: 50px;" action="user-edit.php" method="post">

<h2 id="a" style="margin-bottom: 30px; text-align: center; font-family: 'Alfa Slab One', cursive; font-size: 45px; letter-spacing: 4px;;color: rgb(17, 17, 17);">Edit</h1>

<div class="form-floating mb-4">
  <input type="text" name="user" id="floatingInput" class="form-control border-primary" placeholder="user" readonly value="<?php echo $reg->usuario ?>">
  <label for="floatingInput">User</label>
</div>

<div class="form-floating mb-4">
  <input type="text" name="username" id="floatingInput" class="form-control border-primary" placeholder="Username" value="<?php echo $reg->nome ?>">
  <label for="floatingInput">Username</label>
</div>

<div class="form-floating mb-4">
  <input type="text" name="type" class="form-control border-primary" placeholder="Type" readonly value="<?php echo $reg->tipo ?>">
  <label for="floatingInput">Type</label>
</div>

<div class="form-floating mb-4">
  <input type="password" name="password_1" id="floatingPassword" class="form-control border-primary" placeholder="Password">
  <label for="floatingPassword">Password</label>
</div>

<div class="form-floating mb-4">
  <input type="password" name="password_2" id="floatingPassword" class="form-control border-primary" placeholder="Password">
  <label for="floatingPassword">Repeat Password</label>
</div>

    <div class="d-grid gap-2 col-9 mx-auto pt-4">
    <button type="submit" class="btn btn-outline-primary p-2" type="button">Edit</button>
    </div>
</form>

