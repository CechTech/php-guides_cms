<div class="col-md-4 home-page-sidebar">
  <div class="well">
    <?php if(isset($_SESSION['role'])): ?>
      <h4>Logged in as <?php echo $_SESSION['username'] ?></h4>
      <a href="includes/logout.php" class="btn btn-primary">Logout</a>
    <?php else: ?>
      <h4>Login</h4>
      <form action="includes/login.php" method="post">
        <div class="form-group">
          <input name="username" type="text" class="form-control" placeholder="Enter Username">
        </div>

        <div class="input-group">
          <input name="password" type="password" class="form-control" placeholder="Enter Password">
          <span class="input-group-btn">
  		    	<button class="btn btn-primary" name="login" type="submit">Submit</button>
  		    </span>
        </div>
      </form>
    <?php endif; ?>
  </div>
</div>
