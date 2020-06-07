<?php
function is_admin() {
  global $connection;

  $query = "SELECT role FROM users WHERE username = '$username'";
  $result = mysqli_query($query);
  confirm_query($result);

  $row = mysqli_fetch_array($result);

  if($row['role'] == 'admin') {
    return true;
  } else {
    return false;
  }
}
?>