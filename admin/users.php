<?php
if(isset($_GET['source'])) {
  $source = $_GET['source'];
} else {
  $source = '';
}

switch ($source) {
  case 'add_user';
    $view = "../views/admin/users/new.php";
    break;

  case 'edit_user';
    $view = "../views/admin/users/edit.php";
    break;

  default:
    $view = "../views/admin/users/index.php";
    break;
}

include('../views/layouts/admin.php');
?>
