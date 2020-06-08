<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        Welcome to Dashboard <?php echo $_SESSION['username']; ?>
      </h1>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="card-header">
          <i class="fa fa-file-text fa-3x"></i>

          <span><?php echo $post_count = record_count('posts'); ?></span>
          <span>Posts</span>
        </div>

        <a href="posts.php">
          <div class="card-body">
            <span class="pull-left">View Details</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="card-header">
          <i class="fa fa-user fa-3x"></i>

          <span><?php echo $user_count = record_count('users'); ?></span>
          <span> Users</span>
        </div>

        <a href="users.php">
          <div class="card-body">
            <span class="pull-left">View Details</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-md-6">
      <div class="card">
        <div class="card-header">
          <i class="fa fa-list fa-3x"></i>

          <span class='huge'><?php echo $technology_count = record_count('technologies'); ?></span>
          <span>Technologies</span>
        </div>

        <a href="technologies.php">
          <div class="card-body">
            <span class="pull-left">View Details</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>
  </div>

  <?php
  $post_published_counts = check_status('posts', 'post_status', 'published');
  $post_draft_counts = check_status('posts', 'post_status', 'draft');
  $subscriber_count = check_status('users', 'role', 'subscriber');
  ?>

  <div class="row graph">
    <div class="col-sm-12">
      <script>
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Date', 'Count'],
            <?php
            $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Users', 'Subscribers', 'technologies'];
            $element_count = [$post_count, $post_published_counts, $post_draft_counts, $user_count, $subscriber_count, $technology_count];

            for($i = 0; $i < 6; $i++) {
              echo "['{$element_text[$i]}'" . ", " . "{$element_count[$i]}],";
            }
            ?>
          ]);

          var options = {
            chart: {
              title: '',
              subtitle: '',
            }
          };

          var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
          chart.draw(data, options);
        }
      </script>
      <div id="columnchart_material" style="width: auto; height: 500px;"></div>
    </div>
  </div>
</div>
