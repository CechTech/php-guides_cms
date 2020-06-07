<?php
	if(isset($_GET['edit_user'])) {
		$edit_id = $_GET['edit_user'];
		$query = "SELECT * FROM users WHERE id = '$edit_id'";

		$select_users_query = mysqli_query($connection, $query);
		confirmQuery($select_users_query);

		while($row = mysqli_fetch_assoc($select_users_query)) {
			$id = $row ['id'];
			$username = $row ['username'];
			$password = $row ['password'];
			$firstname = $row ['firstname'];
			$lastname = $row ['lastname'];
			$email = $row ['email'];
			$image = $row ['image'];
			$role = $row ['role'];
		}

		if(isset($_POST['edit_user'])) {
			$firstname = ucfirst(escape($_POST['firstname']));
			$lastname = ucfirst(escape($_POST['lastname']));
			$role = escape($_POST['role']);
			$username = ucfirst(escape($_POST['username']));
			$email = escape($_POST['email']);
			$password = escape($_POST['password']);

			if(!empty($password)) {
				$query_password = "SELECT password FROM users WHERE id = $edit_id";

				$get_user_query = mysqli_query($connection, $query_password);
				confirmQuery($get_user_query);

				$row = mysqli_fetch_assoc($get_user_query);
				$db_password = $row['password'];
				$hashed_password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

				$query = "UPDATE users SET ";
				$query .= "firstname = '{$firstname}', ";
				$query .= "lastname = '{$lastname}', ";
				$query .= "role = '{$role}', ";
				$query .= "username = '{$username}', ";
				$query .= "email = '{$email}', ";
				$query .= "password = '{$hashed_password}' ";
				$query .= "WHERE id = '{$edit_id}'";

				$update_user_query = mysqli_query($connection, $query);
				confirmQuery($update_user_query);

				echo "<p class='bg-success'>User Updated<br><a href='users.php'>View All Users</a></p>";
			}
		}
	} else {
		header("Location: users.php");
	}
?>
<h1 class="page-header">Edit User <?php echo $username; ?></h1>

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
			<option value="<?php echo $role; ?>"><?php echo ucfirst($role); ?></option>
			<?php
				if($role == 'admin') {
					echo "<option value='subscriber'>Subscriber</option>";
				} else {
					echo "<option value='admin'>Admin</option>";
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
		<input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
	</div>
</form>
