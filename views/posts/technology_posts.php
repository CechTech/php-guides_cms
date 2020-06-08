<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <?php
      if(isset($_GET['technology'])) {
        $post_technology_id = escape($_GET['technology']);

        $query = "SELECT * FROM technologies WHERE cat_id = '{$post_technology_id}'";
        $select_technologies = mysqli_query($connection, $query);
        confirm_query($select_technologies);

        $row = mysqli_fetch_assoc($select_technologies);
        $cat_title = $row['cat_title'];
        ?>
        <h1 class="page-header">
          All Posts In <?php echo $cat_title; ?>
        </h1>
        <?php
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
          $post_query_count = "SELECT * FROM posts WHERE post_technology_id = '{$post_technology_id}'";
        } else {
          $post_query_count = "SELECT * FROM posts WHERE post_technology_id = '{$post_technology_id}' AND post_status = 'published'";
        }

        $find_count = mysqli_query($connection, $post_query_count);
        confirm_query($find_count);

        $per_page = 5;
        $count = mysqli_num_rows($find_count);

        if($count < 1) {
          echo "<h2 class='text-center'>No Posts</h2>";
        }

        $count = ceil($count / $per_page);

        if(isset($_GET['page'])) {
          $page = escape($_GET['page']);
        } else {
          $page = "";
        }

        if($page == "" || $page == 1) {
          $limit = 0;
        } else {
          $limit = ($page * $per_page) - $per_page;
        }

        if(isset($_SESSION['role']) &&  $_SESSION['role'] == 'admin') {
          $query = "SELECT * FROM posts WHERE post_technology_id = '{$post_technology_id}' LIMIT {$limit}, {$per_page}";
        } else {
          $query = "SELECT * FROM posts WHERE post_technology_id = '{$post_technology_id}' AND post_status = 'published' LIMIT {$limit}, {$per_page}";
        }

        $result = mysqli_query($connection, $query);
        confirm_query($result);

        while($row = mysqli_fetch_assoc($result)) {
          $post_id = $row ['post_id'];
          $post_title = $row ['post_title'];
          $post_user = $row ['post_user'];
          $post_date = $row ['post_date'];
          $post_image = $row ['post_image'];
          $post_content = substr($row ['post_content'], 0, 200);
          ?>
          <h2><a href="../post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a></h2>
          <p class="lead">
            by <a href="../user_posts.php?user=<?php echo $post_user ?>&p_id=<?php echo $post_id ?>&page=1"><?php echo $post_user ?></a>
          </p>
          <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
          <hr>
          <a href="../post.php?p_id=<?php echo $post_id; ?>">
            <img class="img-fluid" src="images/<?php echo $post_image;?>" alt="">
          </a>
          <hr>
          <?php
        }
      } else {
        header("Location: index.php");
      }
      ?>
    </div>
  </div>

  <nav aria-label="Page navigation">
    <ul class="pagination">
      <?php
      for($i = 1; $i <= $count; $i++) {
        if($i == $page) {
          echo "<li class='active page-item'><a class='page-link' href='technology.php?technology=$post_technology_id&page={$i}'>{$i}</a></li>";
        } else {
          echo "<li class='page-item'><a class='page-link' href='technology.php?technology=$post_technology_id&page={$i}'>{$i}</a></li>";
        }
      }
      ?>
    </ul>
  </nav>
  <hr>
