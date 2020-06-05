<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="index.php?page=1">Guides</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="navbar-nav mr-auto">
            <?php
            $query = "SELECT * FROM categories";
            $category_menu = mysqli_query($connection, $query);
            confirmQuery($category_menu);

            while ($row = mysqli_fetch_assoc($category_menu)) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];

                $category_class = '';
                $registration_class = '';
                $contact_class = '';

                $page_name = basename($_SERVER['PHP_SELF']);
                $registration = 'registration.php';
                $contact = 'contact.php';

                if (isset($_GET['category']) && $_GET['category'] == $cat_id) {
                    $category_class = 'active';
                } else if ($page_name == $registration) {
                    $registration_class = 'active';
                } else if ($page_name == $contact) {
                    $contact_class = 'active';
                }

                echo "<li class='nav-item $category_class'><a class='nav-link' href='category.php?category=$cat_id&page=1'>$cat_title</a></li>";
            }
            ?>
            <?php
            if (!isset($_SESSION['role'])) {
                echo "<li class='nav-item $registration_class'><a class='nav-link' href='registration.php'>Registration</a></li>";
            }

            if (isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 'admin') {
                    echo "<li class='nav-item'><a class='nav-link' href='admin'>Admin</a></li>";
                }
            }

            if (isset($_SESSION['role'])) {
                if (isset($_GET['p_id'])) {
                    $the_post_id = escape($_GET['p_id']);
                    echo "<li class='nav-item'><a class='nav-link' href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                }
            }
            ?>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="search.php" method="post">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" name="submit_search" type="submit">Search</button>
        </form>
    </div>
</nav>
