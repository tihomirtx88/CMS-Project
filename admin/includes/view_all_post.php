<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Post Category Id</th>
            <th>Title</th>
            <th>Author</th>
            <th>Status</th>
            <th>Date</th>
            <th>Image</th>
            <th>Comments</th>
            <th>Tags</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = 'SELECT * FROM posts ';
        $select_posts = mysqli_query($conection, $query);
        while ($row = mysqli_fetch_assoc($select_posts)) {
            $post_id =  $row['post_id'];
            $post_category_id =  $row['post_category_id'];
            $post_title =  $row['post_title'];
            $post_author =  $row['post_author'];
            $post_date =  $row['post_date'];
            $post_image =  $row['post_image'];
            $post_content =  $row['post_content'];
            $post_tags =  $row['post_tags'];
            $post_comments_count =  $row['post_comment_count'];
            $post_status =  $row['post_status'];

            echo "<tr>";
            echo "<td>$post_id</td>";
            echo "<td>$post_category_id</td>";
            echo "<td>$post_title</td>";
            echo "<td>$post_author</td>";
            echo "<td>$post_status</td>";
            echo "<td>$post_date</td>";
            echo "<td><img width='100' height='auto' src='../images/$post_image' alt='images''></td>";
            echo "<td>$post_content</td>";
            echo "<td>$post_tags</td>";
            echo "<td>$post_comments_count</td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>