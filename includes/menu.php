 <nav class="navbar navbar-light">
          <div class="container-fluid">
            <ul class="nav nav-pills navbar-nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="about.php">About</a></li>
              <li><a href="blog.php">Blog</a></li>
              <li><a href="contact.php">Contact</a></li>
                            <?php
                if (isset($_SESSION['loggedin'])){
                    echo '<li><a href="editor.php">Editor</a></li>';
                    echo '<li><a href="users.php">Users</a></li>';
                    echo '<li><a href="viewBlogs.php">Posts</a></li>';
                    echo '<li><a href="logout.php">Logout</a></li>';
                }
                ?>
            </ul>
          </div>
        </nav>