<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  $error = [
    'username'=> '',
    'email'=> '',
    'password'=> '',
    'confirm_password'=> ''
  ];

  if(strlen($username) < 4) {
    $error['username'] = 'Username needs to be at least 4 characters long';
  }

  if($username == '') {
    $error['username'] = 'Username cannot be empty';
  }

  if(username_exists($username)) {
    $error['username'] = 'Username already exists, pick another';
  }

  if($email == '') {
    $error['email'] = 'Email cannot be empty';
  }

  if(email_exists($email)) {
    $error['email'] = 'Email already exists, <a href="login.php">Please login</a>';
  }

  if($password == '') {
    $error['password'] = 'Password cannot be empty';
  }

  if(strlen($password) < 6) {
    $error['password'] = 'Password needs to be at least 6 characters long';
  }

  if($password != $confirm_password) {
    $error['password'] = 'Passwords has to match';
  }

  foreach ($error as $key => $value) {
    if(empty($value)) {
      unset($error[$key]);
    }
  }

  if(empty($error)) {
    register_user($username, $email, $password);
    $data['message'] = $username;
    login_user($username, $password);
  }
}

?>

<div class="container">
  <section id="login">
    <div class="row justify-content-md-center">
      <div class="col-sm-6">
        <h1>Register</h1>
        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
          <div class="form-group">
            <label for="username" class="sr-only">username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Username"
                   autocomplete="on"
                   value="<?php echo isset($username) ? $username : '' ?>">
            <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
          </div>

          <div class="form-group">
            <label for="email" class="sr-only">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>" >

            <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
          </div>

          <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">

            <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
          </div>

          <div class="form-group">
            <label for="confirm_password" class="sr-only">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">

            <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
          </div>

          <input type="submit" name="resgister" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
        </form>
      </div>
    </div>
  </section>
  <hr>