<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "../includes/db.php"; ?>
<?php include "../admin/includes/functions.php"; ?>
<?php
if(!isset($_SESSION['role'])) {
  header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Administration layout for CMS." />
  <meta name="author" content="Jiří Čech" />
  <meta name="keywords" content="cms, php, bootstrap, mysql, admin" />
  <link rel="icon" href="../../images/favicon.ico" type="image/x-icon" />

  <script src="https://use.fontawesome.com/81ebd77a72.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.7/styles/darkula.min.css">
  
  <script src="../build/public/bundle.js" async></script>

  <title>Guides CMS Admin | Jiří Čech</title>
</head>

<body>
<?php include "../views/admin/application/_navigation.php"; ?>
<?php include($view); ?>
<?php include "../views/application/_footer.php"; ?>
</body>

</html>