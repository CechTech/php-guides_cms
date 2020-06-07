<?php
if(isset($_SESSION['id'])) {
  $id = $_SESSION['id'];
  $query = "SELECT * FROM users WHERE id = '{$id}'";
  $select_user_profile_query = mysqli_query($connection, $query);

  confirm_query($select_user_profile_query);

  while($row = mysqli_fetch_assoc($select_user_profile_query)) {
    $username = $row['username'];
    $password = $row['password'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $email = $row['email'];
    $image = $row['image'];
  }
}

if(isset($_POST['edit_user'])) {
  $id = escape($_POST['id']);
  $firstname = escape($_POST['firstname']);
  $lastname = escape($_POST['lastname']);
  $username = escape($_POST['username']);
  $email = escape($_POST['email']);
  $password = $_POST['password'];

  $query = "UPDATE users SET ";
  $query .= "firstname = '{$firstname}', ";
  $query .= "lastname = '{$lastname}', ";
  $query .= "username = '{$username}', ";
  $query .= "email = '{$email}' ";

  if(strlen($password > 0)) {
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    $query .= ", password = '{$password}' ";
  }

  $query .= "WHERE id = '{$id}'";

  $update_user_query = mysqli_query($connection, $query);
  confirm_query($update_user_query);
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
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" value="<?php echo $username; ?>" name="username">
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" name="email">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank if you don't want to change it">
    </div>

    <div style="display: none">
      <label for="id">ID</label>
      <input type="text" id="id" name="id" value="<?php echo $id; ?>">
    </div>

    <div class="form-group">
      <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
    </div>
  </form>
</div>