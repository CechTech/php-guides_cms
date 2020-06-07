<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="./index.php">Guides Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="guides-navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="guides-navbar">
    <ul class="navbar-nav bg-dark mr-auto">
      <li class='nav-item'><a class='nav-link' href="./index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>

      <li class='nav-item dropdown'>
        <a class='nav-link dropdown-toggle' href="#" id="postsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-fw fa-list" aria-hidden="true"></i> Posts <b class="caret"></b>
        </a>

        <div class="dropdown-menu bg-dark" aria-labelledby="postsDropdown">
          <a class='nav-link' href="posts.php">View All Posts</a>
          <a class='nav-link' href="posts.php?source=add_post">Add Post</a>
        </div>
      </li>

      <li class='nav-item'><a class='nav-link' href="categories.php"><i class="fa fa-fw fa-folder"></i> Categories</a></li>
      <li class='nav-item'><a class='nav-link' href="comments.php"><i class="fa fa-fw fa-comment"></i> Comments</a></li>

      <li class='nav-item dropdown'>
        <a class='nav-link dropdown-toggle' href="#" id="usersDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-fw fa-user" aria-hidden="true"></i> Users <b class="caret"></b>
        </a>

        <div class="dropdown-menu bg-dark" aria-labelledby="postsDropdown">
          <a class='nav-link' href="users.php">View All Users</a>
          <a class='nav-link' href="users.php?source=add_user">Add User</a>
        </div>
      </li>
    </ul>

    <ul class="navbar-nav bg-dark">
      <li class='nav-item'><a class='nav-link' href="../index.php?page=1">Home</a></li>
      <li class="nav-item dropdown">
        <a class='nav-link dropdown-toggle' href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user"></i>
          <?php
          if(isset($_SESSION['username'])) {
            echo $_SESSION['username'];
          }
          ?>
          <b class="caret"></b>
        </a>

        <div class="dropdown-menu bg-dark dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class='nav-link' href="profile.php"><i class="fa fa-fw fa-cog"></i> Your Profile</a>
          <a class='nav-link' href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
