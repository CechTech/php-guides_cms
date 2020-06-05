<?php include "includes/db.php"; ?>
<?php include "admin/includes/functions.php"; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description"
        content="This website was built for my learning purposes. Project is written in PHP and uses MySQL database. Bootstrap is used for sake of simplicity."/>
  <meta name="author" content="Jiří Čech"/>
  <meta name="keywords"
        content="cms, php, unsplash, photos, nature, buildings, architecture, space, bootstrap, mysql"/>
  <link rel="icon" href="images/favicon.ico" type="image/x-icon"/>

  <script src="build/public/bundle.js" async></script>

  <title>Guides CMS | Jiří Čech</title>
</head>

<body>
<?php include "views/application/_navigation.php"; ?>
<?php include($view); ?>
<?php include "views/application/_footer.php"; ?>
</body>

</html>