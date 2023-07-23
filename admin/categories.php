<?php
include "includes/admin_header.php";
?>

<div id="wrapper">

    <?php
    include "includes/admin_navigation.php";
    ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin Page
                        <small>Author</small>
                    </h1>
                    <div class="col-xs-6">

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="category-title">Add Category</label>
                                <input class="form-control" type="text" name="category-title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

                        <?php
                        //UPDATE AND INCLUDING QUERY 
                        if (isset($_GET['edit'])) {
                            $categ_id_update = $_GET['edit'];
                            include "includes/update_categories.php";
                        }
                        ?>

                    </div>

                    <!-- Add categories here -->
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // FIND ALL CATEGORIES query
                                find_all_categories();
                                ?>
                                <?php
                                delete_categories();
                                ?>

                                <!-- ADD CATEGORY QUERY  -->
                                <?php
                                insert_categories();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php
    include "includes/admin_footer.php";
    ?>