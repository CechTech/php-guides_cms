<div class="container">
  <h1 class="page-header">Categories</h1>
  <div class="row">
    <div class="col-xs-6">
      <?php insert_categories(); ?>
      <form action="categories.php" method="post">
        <div class="form-group">
          <label for="cat_title">Category Title</label>
          <input class="form-control" type="text" name="cat_title">
        </div>

        <div class="form-group">
          <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
        </div>
      </form>
      <?php
      if(isset($_GET['edit'])) {
        $cat_id = escape($_GET['edit']);
        include "includes/update_categories.php";
      }
      ?>
    </div>

    <div class="col-xs-6">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th>ID</th>
          <th>Category Title</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
        </thead>

        <tbody>
        <?php
        show_all_categories();
        delete_categories();
        ?>
        </tbody>
      </table>
    </div>
  </div>
