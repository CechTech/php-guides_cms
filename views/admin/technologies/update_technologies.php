<form action="" method="post">
  <div class="form-group">
    <label for="cat-title">Edit Technology</label>
    <?php

    if(isset($_GET['edit'])){
      $id = escape($_GET['edit']);

      $query = "SELECT * FROM technologies WHERE id = $id ";
      $select_categories_id = mysqli_query($connection,$query);

      while($row = mysqli_fetch_assoc($select_categories_id)) {
        $id = $row['id'];
        $title = $row['title'];

        ?>

        <input value="<?php echo $title; ?>" type="text" class="form-control" name="title">

      <?php }} ?>

    <?php
    if(isset($_POST['update_category'])) {
      $the_title = escape($_POST['title']);
      $stmt = mysqli_prepare($connection, "UPDATE technologies SET title = ? WHERE id = ? ");
      mysqli_stmt_bind_param($stmt, 'si', $the_title, $id);
      mysqli_stmt_execute($stmt);

      if(!$stmt){
        die("QUERY FAILED" . mysqli_error($connection));
      }

      mysqli_stmt_close($stmt);
      redirect("technologies.php");
    }
    ?>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_technology" value="Update Technology">
  </div>
</form>
