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

function is_method($method = null){
	if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
		return true;
	}
	return false;
}

function confirmQuery($result) {
	global $connection;

	if(!$result) {
		die("Query Failed: " . mysqli_error($connection));
	}
}

function escape($string) {
	global $connection;

	return mysqli_real_escape_string($connection, trim($string));
}

function insert_categories() {
	global $connection;

	if(isset($_POST['submit'])) {
		$cat_title = escape($_POST['cat_title']);

		if($cat_title == "" || empty($cat_title)) {
			echo "This field should not be empty";
		} else {
			$query = "INSERT INTO categories(cat_title) ";
			$query .= "VALUE('{$cat_title}') ";
			$create_category_query = mysqli_query($connection, $query);
			confirmQuery($create_category_query);
		}
	}
}

function showAllCategories() {
	global $connection;

	$query = "SELECT * FROM categories";
	$select_categories = mysqli_query($connection, $query);
	confirmQuery($select_categories);

	while($row = mysqli_fetch_assoc($select_categories)) {
		$cat_id = $row['cat_id'];
		$cat_title = $row['cat_title'];
		echo "<tr>";
		echo "<td>{$cat_id}</td>";
		echo "<td>{$cat_title}</td>";
		echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
		echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
		echo "</tr>";
	}
}

function deleteCategories() {
	global $connection;

	if(isset($_GET['delete'])) {
		$cat_id_delete = escape($_GET['delete']);
		$query = "DELETE FROM categories WHERE cat_id = '{$cat_id_delete}'";
		$delete_query = mysqli_query($connection, $query);
		confirmQuery($delete_query);

		header("Location: categories.php");
	}
}

function recordCount($table) {
	global $connection;

	$query = "SELECT * FROM " . $table;
	$record_count = mysqli_query($connection, $query);
	confirmQuery($record_count);
	return mysqli_num_rows($record_count);
}

function checkStatus($table, $column, $status) {
	global $connection;

	$query = "SELECT * FROM $table WHERE $column = '$status'";
	$result = mysqli_query($connection, $query);
	confirmQuery($result);
	return mysqli_num_rows($result);
}

function is_admin($username = '') {
	global $connection;

	$query = "SELECT role FROM users WHERE username = '$username'";
	$result = mysqli_query($connection, $query);
	confirmQuery($result);

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
	confirmQuery($result);

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
	confirmQuery($result);

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

	$password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

	$query = "INSERT INTO users (username, email, password, role) ";
	$query .= "VALUES('{$username}','{$email}', '{$password}', 'subscriber' )";
	$register_user_query = mysqli_query($connection, $query);

	confirmQuery($register_user_query);
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
		$db_username = $row['username'];
		$db_password = $row['password'];
		$db_firstname = $row['firstname'];
		$db_lastname = $row['lastname'];
		$db_role = $row['role'];

		if (password_verify($password, $db_password)) {
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
