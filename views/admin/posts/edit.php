<?php
if(isset($_GET['p_id'])) {
  $the_post_id = escape($_GET['p_id']);
  $query = "SELECT * FROM posts WHERE post_id = '$the_post_id'";

  $select_posts_by_id = mysqli_query($connection, $query);
  confirm_query($select_posts_by_id);

  while($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = $row ['post_id'];
    $post_user = $row ['post_user'];
    $post_title = $row ['post_title'];
    $post_technology_id = $row ['post_technology_id'];
    $post_status = $row ['post_status'];
    $post_image = $row ['post_image'];
    $post_tags = $row ['post_tags'];
    $post_content = $row ['post_content'];
    $post_comment_count = $row ['post_comment_count'];
    $post_date = $row ['post_date'];
  }

  if(isset($_POST['update_post'])) {
    $post_title = escape($_POST['post_title']);
    $post_technology_id = escape($_POST['post_technology']);
    $post_user = escape($_POST['post_user']);
    $post_status = escape($_POST['post_status']);
    $post_image = escape($_FILES['post_image'] ['name']);
    $post_image_tmp = escape($_FILES['post_image'] ['tmp_name']);
    $post_tags = escape($_POST['post_tags']);
    $post_content = $_POST['post_content'];

    move_uploaded_file($post_image_tmp, "../images/$post_image");

    if(empty($post_image)) {
      $query = "SELECT * FROM posts WHERE post_id = '{$the_post_id}'";

      $select_image = mysqli_query($connection, $query);
      confirm_query($select_image);

      while($row = mysqli_fetch_assoc($select_image)) {
        $post_image = $row ['post_image'];
      }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_technology_id = '{$post_technology_id}', ";
    $query .= "post_user = '{$post_user}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_date = now() ";
    $query .= "WHERE post_id = '{$the_post_id}'";

    $update_query = mysqli_query($connection, $query);
    confirm_query($update_query);

    echo "<p class='bg-success'>Post Updated<br><a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";
  }
}
?>

<div class="container">
  <h1 class="page-header">Edit Post</h1>

  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="post_title">Post Title</label>
      <input value="<?php echo $post_title; ?>" type="text" class="form-control" id="post_title" name="post_title">
    </div>

    <div class="row">
      <div class="form-group col-md-4">
        <label for="post_technology">Post technology</label>
        <select name="post_technology" class="form-control" id="post_technology">
          <?php
          $query = "SELECT * FROM technologies";

          $select_technologies = mysqli_query($connection, $query);
          confirm_query($select_technologies);

          while($row = mysqli_fetch_assoc($select_technologies)) {
            $cat_id = $row ['cat_id'];
            $cat_title = $row ['cat_title'];

            if($cat_id == $post_technology_id) {
              echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
            } else {
              echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
          }
          ?>
        </select>
      </div>

      <div class="form-group col-md-4">
        <label for="post_user">Post User</label>
        <select name="post_user" class="form-control" id="post_user">
          <?php
          echo "<option value='{$post_user}'>{$post_user}</option>";
          $users_query = "SELECT * FROM users";

          $select_users = mysqli_query($connection, $users_query);
          confirm_query($select_users);

          while($row = mysqli_fetch_assoc($select_users)) {
            $id = $row ['id'];
            $username = $row ['username'];
            echo "<option value='{$username}'>{$username}</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group col-md-4">
        <label for="post_status">Post Status</label>
        <select name="post_status" class="form-control" id="post_status">
          <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
          <?php
          if($post_status == 'published') {
            echo "<option value='draft'>Draft</option>";
          } else {
            echo "<option value='published'>Published</option>";
          }
          ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="post_image">Post Image</label>
      <img src="../images/<?php echo $post_image; ?>" width="100" alt="Post image">
      <input type="file" name="post_image" id="post_image">
    </div>

    <div class="form-group">
      <label for="post_tags">Post Tags</label>
      <input value="<?php echo $post_tags; ?>" type="text" class="form-control" id="post_tags" name="post_tags">
    </div>

    <div data-controller="markdown" class="form-group">
      <div class="row">
        <div class="col-md-6">
          <label for="post_content">Markdown Content</label>
          <textarea
            data-target="markdown.content"
            data-action="keyup->markdown#render_markdown"
            class="form-control"
            name="post_content"
            id="post_content"
            rows="30"><?php echo str_replace('\r\n', '&#013;&#010;', $post_content); ?></textarea>
        </div>
        <div class="col-md-6">
          <label for="post_content">Preview</label>
          <div data-target="markdown.output"></div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <input class="btn btn-primary" type="submit" name="update_post" value="Edit Post">
    </div>
  </form>
</div>
