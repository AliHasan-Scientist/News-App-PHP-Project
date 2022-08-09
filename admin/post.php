<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Author</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </thead>
                    <tbody>
                    <?php
                    include_once('db-connection.php');
                    $get_all_posts = "SELECT * FROM `user_posts`";
                    $process_all_posts = mysqli_query($db_connection, $get_all_posts);
                    if ($process_all_posts) {
                        echo "posts found successfully";
                        while ($row = mysqli_fetch_array($process_all_posts)) {
                            ?>
                            <tr>
                                <td class='id'><?php echo $row['post_id']; ?></td>
                                <td><?php echo $row['post_tilte']; ?></td>
                                <td><?php echo $row['post_category']; ?></td>
                                <td><?php echo $row['create_time']; ?></td>
                                <td><?php echo $author = $row['author'] ? 'Admin' : 'Normal'; ?></td>
                                <td class='edit'><a href='update-post.php?post_id=<?php echo $row["post_id"] ?>'><i
                                                class='fa fa-edit'></i></a></td>
                                <td class='delete'><a href='delete-post.php'><i class='fa fa-trash-o'></i></a></td>
                            </tr>
                            <?php
                        }

                    }
                    ?>

                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <li class="active"><a>1</a></li>
                    <li><a>2</a></li>
                    <li><a>3</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
