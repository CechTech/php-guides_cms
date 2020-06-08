<div class="container">
  <h1 class="page-header">Technologies</h1>
  <div class="row">
    <div class="col-sm-4">
      <?php insert_technologies(); ?>
      <form action="technologies.php" method="post">
        <div class="form-group">
          <label for="title">Technology Title</label>
          <input class="form-control" type="text" name="title" id="title">
        </div>

        <div class="form-group">
          <input class="btn btn-primary" type="submit" name="submit" value="Add technology">
        </div>
      </form>
      <?php
      if(isset($_GET['edit'])) {
        $id = escape($_GET['edit']);
        include "../views/admin/technologies/update_technologies.php";
      }
      ?>
    </div>

    <div class="col-sm-8">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th>ID</th>
          <th>Technology Title</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
        </thead>

        <tbody>
        <?php
        show_all_technologies();
        delete_technologies();
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
