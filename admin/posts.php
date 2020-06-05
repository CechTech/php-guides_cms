<?php
if(isset($_GET['source'])) {
  $source = $_GET['source'];
} else {
  $source = '';
}

switch ($source) {
  case 'add_post';
    $view = '../views/admin/posts/new.php';
    break;

  case 'edit_post';
    $view = '../views/admin/posts/edit.php';
    break;

  default:
    $view = '../views/admin/posts/index.php';
    break;
}

include('../views/layouts/admin.php');
?>