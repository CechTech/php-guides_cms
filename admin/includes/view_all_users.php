<?php checkBoxesUsers(); ?>
<h1 class="page-header">Users</h1>

<form method="post">
	<div class="row space">
		<div class="col-xs-4 options" id="bulkOptionsContainer">
			<select name="bulk_options" class="form-control">
				<option value="">Select Options</option>
				<option value="admin">Admin</option>
				<option value="subscriber">Subscriber</option>
				<option value="duplicate">Duplicate</option>
				<option value="delete">Delete</option>
			</select>
		</div>

		<div class="col-xs-4">
			<input type="submit" class="btn btn-success" value="Apply" name="submit">
			<a href="users.php?source=add_user" class="btn btn-primary">Add New</a>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th><input id="selectAllBoxes" type="checkbox"></th>
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
  						confirmQuery($select_users);

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
  								echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='$id'></td>";
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
  							confirmQuery($change_to_admin_query);

  							header("Location: users.php");
  						}

  						if(isset($_GET['change_to_sub'])) {
  							$sub_id = escape($_GET['change_to_sub']);
  							$query = "UPDATE users SET role = 'subscriber' WHERE id = '{$sub_id}'";

  							$change_to_sub_query = mysqli_query($connection, $query);
  							confirmQuery($change_to_sub_query);

  							header("Location: users.php");
  						}

  						if(isset($_GET['delete'])) {
  							if(isset($_SESSION['role'])) {
  								if($_SESSION['role'] == 'admin') {
  									$delete_id = escape($_GET['delete']);
  									$query = "DELETE FROM users WHERE id = '$delete_id'";

  									$delete_user_query = mysqli_query($connection, $query);
  									confirmQuery($delete_user_query);

  									header("Location: users.php");
  								}
  							}
  						}
				    ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</form>
