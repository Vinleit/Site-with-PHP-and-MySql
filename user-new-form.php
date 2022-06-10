<form style="padding: 50px;" action="user-new.php" method="post">

<h2 id="a" style="margin-bottom: 30px; text-align: center; font-family: 'Alfa Slab One', cursive; font-size: 45px; letter-spacing: 4px;;color: rgb(17, 17, 17);">New User</h1>

<div class="form-floating mb-4">
  <input type="text" name="user" class="form-control border-primary" placeholder="User">
  <label for="floatingInput">User</label>
</div>

<div class="form-floating mb-4">
  <input type="text" name="username" class="form-control border-primary" placeholder="Username">
  <label for="floatingInput">Username</label>
</div>

<div class="form-floating mb-4">
  <input type="password" name="password_1" class="form-control border-primary" placeholder="Password">
  <label for="floatingPassword">Password</label>
</div>

<div class="form-floating">
  <input type="password" name="password_2" class="form-control border-primary" placeholder="Password">
  <label>Repeat Password</label>
</div>

<div style="padding: 0;" class="form-check d-flex justify-content-center align-items-center flex-column mt-5">
    <div class="form-check">
    <input class="form-check-input" type="radio" name="type" value="editor" checked>
    <label class="form-check-label" for="flexRadioDefault1">
        Editor authorized
    </label>
    </div>
    <div class="form-check">
    <input class="form-check-input" type="radio" name="type" value="admin">
    <label class="form-check-label">
        Admin of system
    </label>
    </div>
</div>


    <div class="d-grid gap-2 col-9 mx-auto pt-4">
    <button type="submit" class="btn btn-outline-primary p-2" type="button">Sign-up</button>
    </div>
</form>