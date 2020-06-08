<div class="container">
  <h1 class="page-header">Posts</h1>

  <form method="post">
    <div class="table-responsive" data-controller="checkbox">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th>ID</th>
          <th>Users</th>
          <th>Title</th>
          <th>technology</th>
          <th>Status</th>
          <th>Image</th>
          <th>Tags</th>
          <th>Post Views</th>
          <th>Date</th>
          <th>View</th>
          <th>Edit</th>
          <th>Delete</th>
          <th>Reset Views</th>
        </tr>
        </thead>

        <tbody>
        <?php
        $query = "SELECT * FROM posts LEFT JOIN technologies ";
        $query .= "ON posts.post_technology_id = technologies.id ";
        $query .= "ORDER BY post_id DESC";

        $select_posts = mysqli_query($connection, $query);
        confirm_query($select_posts);

        while($row = mysqli_fetch_assoc($select_posts)) {
          $post_id = $row ['post_id'];
          $post_user = $row ['post_user'];
          $post_title = $row ['post_title'];
          $post_technology_id = $row ['post_technology_id'];
          $post_status = $row ['post_status'];
          $post_image = $row ['post_image'];
          $post_tags = $row ['post_tags'];
          $post_date = $row ['post_date'];
          $post_content = $row ['post_content'];
          $post_view_count = $row ['post_view_count'];
          $title = $row ['title'];

          echo "<tr>";
          echo "<td>{$post_id}</td>";

          if (!empty($post_user)) {
            echo "<td>$post_user</td>";
          }

          echo "<td>{$post_title}</td>";
          echo "<td>{$title}</td>";
          echo "<td>{$post_status}</td>";
          echo "<td><img width='100' src='../images/{$post_image}' alt='Post image' /></td>";
          echo "<td>{$post_tags}</td>";
          echo "<td>{$post_view_count}</td>";
          echo "<td>{$post_date}</td>";
          echo "<td><a href='../post.php?p_id={$post_id}'>View</a></td>";
          echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
          echo "<td><a href='posts.php?delete={$post_id}' class='delete_link'>Delete</a></td>";
          echo "<td><a href='posts.php?reset={$post_id}'>Reset Views</a></td>";
          echo "</tr>";
        }

        if(isset($_GET['delete'])) {
          $delete_post_id = $_GET['delete'];
          $query = "DELETE FROM posts WHERE post_id = '$delete_post_id'";

          $delete_query = mysqli_query($connection, $query);
          confirm_query($delete_query);

          header("Location: posts.php");
        }

        if(isset($_GET['reset'])) {
          $reset_post_views = escape($_GET['reset']);

          $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = '$reset_post_views'";
          $reset_query = mysqli_query($connection, $query);
          confirm_query($reset_query);

          header("Location: posts.php");
        }
        ?>
        </tbody>
      </table>
    </div>
  </form>
</div>
