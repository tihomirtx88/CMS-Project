<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">cms Front</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->


        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                  $query = 'SELECT * FROM category';
                  $select_all_category_query = mysqli_query($conection, $query);
                  while($row = mysqli_fetch_assoc($select_all_category_query)){
                     $categ_title =  $row['category_title'];
                     echo "<li><a href='#'>{$categ_title}</a></li>";
                  }
                 ?>
                <li>
                    <a href="admin">Admin</a>
                </li>
                <?php
                  if (isset($_SESSION['user_role'])) {
                     echo 'first issset';
                    if (isset($_GET['p_id'])) {
                        echo 'first issset';
                        $the_post_id = $_GET['p_id'];
                       echo  "<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>"; 
                    }
                  }
                ?>            
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
