

<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form><!-- form search -->
        <!-- /.input-group -->
    </div>

        <!-- LOGIN FORM  -->
        <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter Your Username">              
            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Enter Your Password">
                <span class="input-group-btn">
                   <button class="btn btn-primary" name="login" type="submit"> Submit </button>
                </span>             
            </div>
        </form>
    </div>


    <!-- Blog Categories Well -->
    <div class="well">
        <?php
        $query = 'SELECT * FROM category ';
        $select_category_sidebar = mysqli_query($conection, $query);
        ?>
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">              
                <ul class="list-unstyled">
                <?php
                  while ($row = mysqli_fetch_assoc($select_category_sidebar)) {
                    $categ_title =  $row['category_title'];
                    $categ_id=  $row['category_id'];
                    echo "<li><a href='category.php?category=$categ_id'>{$categ_title}</a></li>";
                  } 
                ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
   <?php
     include "widget.php";
   ?>

</div>


