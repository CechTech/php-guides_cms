<?php
if(isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $query = "SELECT * FROM users WHERE username = '{$username}'";
  $select_user_profile_query = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($select_user_profile_query)) {
    $id = $row ['id'];
    $username = $row ['username'];
    $password = $row ['password'];
    $firstname = $row ['firstname'];
    $lastname = $row ['lastname'];
    $email = $row ['email'];
    $image = $row ['image'];
    $role = $row ['role'];
    $user_rand_salt = $row ['user_rand_salt'];
  }
}

if(isset($_POST['edit_user'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $role = $_POST['role'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "UPDATE users SET ";
  $query .= "firstname = '{$firstname}', ";
  $query .= "lastname = '{$lastname}', ";
  $query .= "role = '{$role}', ";
  $query .= "username = '{$username}', ";
  $query .= "email = '{$email}', ";
  $query .= "password = '{$password}' ";
  $query .= "WHERE username = '{$username}'";

  $update_user_query = mysqli_query($connection, $query);
  confirmQuery($update_user_query);
}
?>
<div class="container">
  <h1 class="page-header">Your Profile</h1>
  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="firstname">Firstname</label>
      <input type="text" class="form-control" id="firstname" value="<?php echo $firstname; ?>" name="firstname">
    </div>

    <div class="form-group">
      <label for="lastname">Lastname</label>
      <input type="text" class="form-control" id="lastname" value="<?php echo $lastname; ?>" name="lastname">
    </div>

    <div class="form-group">
      <label for="role">Role</label>
      <select name="role" class="form-control" id="role">
        <option value="admin"><?php echo $role; ?></option>
        <?php
        if($role == 'admin') {
          echo "<option value='subscriber'>subscriber</option>";
        } else {
          echo "<option value='admin'>admin</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" value="<?php echo $username; ?>" name="username">
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" name="email">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" value="<?php echo $password; ?>" name="password">
    </div>

    <div class="form-group">
      <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
    </div>
  </form>
</div>