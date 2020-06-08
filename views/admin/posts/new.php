<?php
if(isset($_POST['create_post'])) {
  $post_title = escape($_POST['post_title']);
  $post_technology_id = escape($_POST['post_technology']);
  $post_user = escape($_POST['post_user']);
  $post_status = escape($_POST['post_status']);
  $post_image = escape($_FILES['post_image'] ['name']);
  $post_image_tmp = escape($_FILES['post_image'] ['tmp_name']);
  $post_tags = escape($_POST['post_tags']);
  $post_content = escape($_POST['post_content']);
  $post_date = date('dd-mm-yyyy');

  move_uploaded_file($post_image_tmp, "../images/$post_image");

  $query = "INSERT INTO posts(post_title, post_technology_id, post_user, post_status, post_image, post_tags, post_content, post_date) ";
  $query .= "VALUES('{$post_title}', '{$post_technology_id}', '{$post_user}', '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}', now())";

  $create_post_query = mysqli_query($connection, $query);
  confirm_query($create_post_query);
  $the_post_id = mysqli_insert_id($connection);

  echo "<p class='bg-success'>Post Created<br><a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";
}
?>

<div class="container">
  <h1 class="page-header">Add Post</h1>

  <form enctype="multipart/form-data">
    <div class="form-group">
      <label for="post_title">Post Title</label>
      <input type="text" class="form-control" name="post_title" id="post_title">
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
            $id = $row ['id'];
            $title = $row ['title'];

            echo "<option value='{$id}'>{$title}</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group col-md-4">
        <label for="post_user">Post User</label>
        <select name="post_user" class="form-control" id="post_user">
          <?php
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
          <option value="draft">Select Options</option>
          <option value="published">Publish</option>
          <option value="draft">Draft</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="post_image">Post Image</label>
      <input type="file" name="post_image" id="post_image">
    </div>

    <div class="form-group">
      <label for="post_tags">Post Tags</label>
      <input type="text" class="form-control" name="post_tags" id="post_tags">
    </div>

    <div data-controller="markdown" class="form-group">
      <div class="row">
        <div class="col-md-6">
          <label for="markdown_content">Markdown Content</label>
          <textarea
            data-target="markdown.content"
            data-action="keyup->markdown#render_markdown"
            type="text"
            class="form-control"
            name="markdown_content"
            id="markdown_content"
            rows="30"></textarea>
        </div>
        <div class="col-md-6">
          <label for="markdown_content">Preview</label>
          <div data-target="markdown.output" class="preview"></div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <input class="btn btn-primary" type="submit" name="create_post" value="Create Post">
    </div>
  </form>
</div>
