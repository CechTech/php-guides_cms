<?php
if(!is_admin($_SESSION['username'])) {
  header("Location: index.php");
}
?>
<div class="container">
  <h1 class="page-header">Users</h1>

  <form method="post">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Email</th>
          <th>Role</th>
          <th>Admin</th>
          <th>Subscriber</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
        </thead>

        <tbody>
        <?php
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);
        confirm_query($select_users);

        while($row = mysqli_fetch_assoc($select_users)) {
          $id = $row ['id'];
          $username = $row ['username'];
          $password = $row ['password'];
          $firstname = $row ['firstname'];
          $lastname = $row ['lastname'];
          $email = $row ['email'];
          $image = $row ['image'];
          $role = $row ['role'];

          echo "<tr>";
          echo "<td>{$id}</td>";
          echo "<td>{$username}</td>";
          echo "<td>{$firstname}</td>";
          echo "<td>{$lastname}</td>";
          echo "<td>{$email}</td>";
          echo "<td>{$role}</td>";
          echo "<td><a href='users.php?change_to_admin={$id}'>Admin</a></td>";
          echo "<td><a href='users.php?change_to_sub={$id}'>Subscriber</a></td>";
          echo "<td><a href='users.php?source=edit_user&edit_user={$id}'>Edit</a></td>";
          echo "<td><a href='users.php?delete={$id}'>Delete</a></td>";
          echo "</tr>";
        }

        if(isset($_GET['change_to_admin'])) {
          $admin_id = escape($_GET['change_to_admin']);
          $query = "UPDATE users SET role = 'admin' WHERE id = '{$admin_id}'";

          $change_to_admin_query = mysqli_query($connection, $query);
          confirm_query($change_to_admin_query);

          header("Location: users.php");
        }

        if(isset($_GET['change_to_sub'])) {
          $sub_id = escape($_GET['change_to_sub']);
          $query = "UPDATE users SET role = 'subscriber' WHERE id = '{$sub_id}'";

          $change_to_sub_query = mysqli_query($connection, $query);
          confirm_query($change_to_sub_query);

          header("Location: users.php");
        }

        if(isset($_GET['delete'])) {
          if(isset($_SESSION['role'])) {
            if($_SESSION['role'] == 'admin') {
              $delete_id = escape($_GET['delete']);
              $query = "DELETE FROM users WHERE id = '$delete_id'";

              $delete_user_query = mysqli_query($connection, $query);
              confirm_query($delete_user_query);

              header("Location: users.php");
            }
          }
        }
        ?>
        </tbody>
      </table>
    </div>
  </form>
</div>
