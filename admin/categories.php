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
                     <form action="">
                       <div class="form-group">
                          <label for="category-title">Category Title</label>
                          <input class="form-control" type="text" name="category-title">
                       </div>
                       <div class="form-group">
                          <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                       </div>
                     </form>
                     </div>
                     <!-- Add categories here -->
                     <div class="col-xs-6">
                        <?php
                        $query = 'SELECT * FROM category ';
                        $select_category = mysqli_query($conection, $query);
                        ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>                       
                                    <?php
                                    while ($row = mysqli_fetch_assoc($select_category)) {
                                        $categ_title =  $row['category_title'];
                                        $categ_id =  $row['category_id'];
                                        echo "<tr>";
                                        echo " <td>{$categ_id}</td>";
                                        echo " <td>{$categ_title}</td>";
                                        echo "</tr>";
                                    }
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