<?php
	if(isset($_POST['create_user'])) {
		$firstname = ucfirst(escape($_POST['firstname']));
		$lastname = ucfirst(escape($_POST['lastname']));
		$role = escape($_POST['role']);
		$username = ucfirst(escape($_POST['username']));
		$email = escape($_POST['email']);
		$password = escape($_POST['password']);
		$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));

		$query = "INSERT INTO users(firstname, lastname, role, username, email, password) ";
		$query .= "VALUES('{$firstname}', '{$lastname}', '{$role}', '{$username}', '{$email}', '{$password}')";

		$create_user_query = mysqli_query($connection, $query);
		confirmQuery($create_user_query);

		echo "User Created: " . "<a href='users.php'>View Users</a>";
	}
?>
<h1 class="page-header">Add User</h1>

<form method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" class="form-control" name="username" id="username">
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label for="firstname">Firstname</label>
				<input type="text" class="form-control" name="firstname" id="firstname">
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label for="lastname">Lastname</label>
				<input type="text" class="form-control" name="lastname" id="lastname">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label for="role">Role</label>
				<select name="role" class="form-control" id="role">
					<option value="admin">Admin</option>
					<option value="subscriber">Subscriber</option>
				</select>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" name="email" id="email">
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" name="password" id="password">
			</div>
		</div>
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="create_user" value="Add user">
	</div>
</form>
