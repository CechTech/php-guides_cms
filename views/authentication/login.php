<?php
is_logged_in_and_redirect('/admin');


if(is_method('post')) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $error = [
    'username'=> '',
    'password'=> ''
  ];

  if($username == '') {
    $error['username'] = 'Username cannot be empty';
  }

  if($password == '') {
    $error['password'] = 'Password cannot be empty';
  }

  foreach ($error as $key => $value) {
    if(empty($value)) {
      unset($error[$key]);
    }
  }

  if(empty($error)) {
    login_user($username, $password);
  }
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-4 offset-4">
      <div class="card">
        <div class="card-body">
          <div class="text-center">

            <i class="fa fa-user fa-4x"></i>
            <h1 class="text-center">Login</h1>
            <div class="panel-body">

              <form id="login-form" autocomplete="off" class="form" method="post">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>

                    <input name="username" type="text" class="form-control" placeholder="Enter Username">
                    <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                    <input name="password" type="password" class="form-control" placeholder="Enter Password">
                    <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                  </div>
                </div>

                <div class="form-group">
                  <input name="login" class="btn btn-lg btn-primary btn-block" value="Login" type="submit">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
