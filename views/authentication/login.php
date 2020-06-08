<?php
is_logged_in_and_redirect('/admin');

if(is_method('post')) {
  if(isset($_POST['username']) && isset($_POST['password'])) {
    login_user($_POST['username'], $_POST['password']);
  } else {
    redirect('/login.php');
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
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                      <input name="password" type="password" class="form-control" placeholder="Enter Password">
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
