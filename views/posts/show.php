<div class="container">
  <div class="row">
    <div class="col-sm-8 offset-2">
      <?php
      if(isset($_GET['p_id'])) {
        $the_post_id = escape($_GET['p_id']);

        $view_query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = '{$the_post_id}'";
        $send_query = mysqli_query($connection, $view_query);
        confirm_query($send_query);

        if(isset($_SESSION['role']) &&  $_SESSION['role'] == 'admin') {
          $query = "SELECT * FROM posts WHERE post_id = '{$the_post_id}'";
        } else {
          $query = "SELECT * FROM posts WHERE post_id = '{$the_post_id}' AND post_status = 'published'";
        }

        $view_post_query = mysqli_query($connection, $query);
        confirm_query($view_post_query);

        if(mysqli_num_rows($view_post_query) < 1) {
          echo "<h2 class='text-center'>The post is unavailable</h2>";
        } else {
          while($row = mysqli_fetch_assoc($view_post_query)) {
            $post_id = $row ['post_id'];
            $post_title = $row ['post_title'];
            $post_user = $row ['post_user'];
            $post_date = $row ['post_date'];
            $post_image = $row ['post_image'];
            $post_content = $row ['post_content'];
            ?>
            <h2><?php echo $post_title ?></h2>
            <p class="lead">by <a href="../../user_posts.php?user=<?php echo $post_user ?>&p_id=<?php echo $post_id ?>"><?php echo $post_user ?></a></p>
            <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
            <hr>
            <img class="img-fluid" src="images/<?php echo $post_image;?>" alt="">
            <hr>
            <div data-controller="markdown">
                <textarea data-target="markdown.content" style="display: none">
                  <?php echo $post_content; ?>
                </textarea>
              <div class="markdown-view" data-target="markdown.output"></div>
            </div>
            <hr>
            <?php
          }

          if(isset($_POST['create_comment'])) {
            $the_post_id = escape($_GET['p_id']);
            $comment_author = escape($_POST['comment_author']);
            $comment_email = escape($_POST['comment_email']);
            $comment_content = escape($_POST['comment_content']);

            if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
              $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
              $query .= "VALUES('{$the_post_id}', '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
              $create_comment_query = mysqli_query($connection, $query);
              confirm_query($create_comment_query);

              echo "<p>Comment sent for approval</p>";
            } else {
              echo "<p>Fields cannot be empty</p>";
            }
          }
        }
      } else {
        header("Location: index.php");
      }
      ?>
    </div>
  </div>
</div>