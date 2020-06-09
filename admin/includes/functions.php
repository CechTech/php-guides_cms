<?php

function redirect($location) {
	header("Location:" . $location);
	exit;
}

function is_logged_in() {
	if(isset($_SESSION['role'])) {
		return true;
	}
	return false;
}

function is_logged_in_and_redirect($location = null) {
	if(is_logged_in()) {
		redirect($location);
	}
}

function is_method($method = null) {
	if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
		return true;
	}
	return false;
}

function confirm_query($result) {
	global $connection;

	if(!$result) {
		die("Query Failed: " . mysqli_error($connection));
	}
}

function escape($string) {
	global $connection;

	return mysqli_real_escape_string($connection, trim($string));
}

function insert_technologies() {
	global $connection;

	if(isset($_POST['submit'])) {
		$title = escape($_POST['title']);

		if($title == "" || empty($title)) {
			echo "This field should not be empty";
		} else {
			$query = "INSERT INTO technologies(title) ";
			$query .= "VALUE('{$title}') ";
			$create_technology_query = mysqli_query($connection, $query);
			confirm_query($create_technology_query);
		}
	}
}

function show_all_technologies() {
	global $connection;

	$query = "SELECT * FROM technologies";
	$select_technologies = mysqli_query($connection, $query);
	confirm_query($select_technologies);

	while($row = mysqli_fetch_assoc($select_technologies)) {
		$id = $row['id'];
		$title = htmlspecialchars($row['title']);

		echo "<tr>";
		echo "<td>{$id}</td>";
		echo "<td>{$title}</td>";
		echo "<td><a href='technologies.php?edit={$id}'>Edit</a></td>";
		echo "<td><a href='technologies.php?delete={$id}'>Delete</a></td>";
		echo "</tr>";
	}
}

function delete_technologies() {
	global $connection;

	if(isset($_GET['delete'])) {
		$id_delete = escape($_GET['delete']);
		$query = "DELETE FROM technologies WHERE id = '{$id_delete}'";
		$delete_query = mysqli_query($connection, $query);
		confirm_query($delete_query);

		header("Location: technologies.php");
	}
}

function record_count($table) {
	global $connection;

	$query = "SELECT * FROM " . $table;
	$record_count = mysqli_query($connection, $query);
	confirm_query($record_count);

	return mysqli_num_rows($record_count);
}

function check_status($table, $column, $status) {
	global $connection;

	$query = "SELECT * FROM $table WHERE $column = '$status'";
	$result = mysqli_query($connection, $query);
	confirm_query($result);

	return mysqli_num_rows($result);
}

function is_admin($username = '') {
	global $connection;

	$query = "SELECT role FROM users WHERE username = '$username'";
	$result = mysqli_query($connection, $query);
	confirm_query($result);

	$row = mysqli_fetch_array($result);

	if ($row['role'] == 'admin') {
		return true;
	} else {
		return false;
	}
}

function username_exists($username) {
	global $connection;

	$query = "SELECT username FROM users WHERE username = '$username'";
	$result = mysqli_query($connection, $query);
	confirm_query($result);

	if(mysqli_num_rows($result) > 0) {
		return true;
	} else {
		return false;
	}
}

function email_exists($email){
	global $connection;

	$query = "SELECT email FROM users WHERE email = '$email'";
	$result = mysqli_query($connection, $query);
	confirm_query($result);

	if(mysqli_num_rows($result) > 0) {
		return true;
	} else {
		return false;
	}
}

function register_user($username, $email, $password){
	global $connection;

	$username = escape($username);
	$email = escape($email);

	$password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

	$query = "INSERT INTO users (username, email, password, role) ";
	$query .= "VALUES('{$username}','{$email}', '{$password}', 'subscriber' )";
	$register_user_query = mysqli_query($connection, $query);

	confirm_query($register_user_query);
}

function login_user($username, $password) {
	global $connection;

	$username = escape($username);

	$query = "SELECT * FROM users WHERE username = '{$username}' ";
	$select_user_query = mysqli_query($connection, $query);

	if (!$select_user_query) {
		die("QUERY FAILED" . mysqli_error($connection));
	}

	while ($row = mysqli_fetch_array($select_user_query)) {
		$db_id = $row['id'];
		$db_username = $row['username'];
		$db_password = $row['password'];
		$db_firstname = $row['firstname'];
		$db_lastname = $row['lastname'];
		$db_role = $row['role'];

		if (password_verify($password, $db_password)) {
			$_SESSION['id'] = $db_id;
			$_SESSION['username'] = $db_username;
			$_SESSION['firstname'] = $db_firstname;
			$_SESSION['lastname'] = $db_lastname;
			$_SESSION['role'] = $db_role;

			redirect("/admin");
		} else {
			return false;
		}
	}
	return true;
}
?>
