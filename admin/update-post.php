<?php include "header.php"; ?>
<?php
$id = $_GET['post_id'];


?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Update Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form for show edit-->
                <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group">
                        <input type="hidden" name="post_id" class="form-control" value="1" placeholder="">
                    </div>
                    <?php
                    include_once('db-connection.php');
                    $get_all_posts = "SELECT * FROM `user_posts` WHERE post_id= '$id'";
                    $process_get_posts = mysqli_query($db_connection, $get_all_posts);
                    if ($process_get_posts) {
                        if ($data = mysqli_fetch_array($process_get_posts)) {

                            ?>
                            <div class="form-group">
                                <label for="exampleInputTile">Title</label>
                                <input type="text" name="post_title" class="form-control" id="exampleInputUsername"
                                       value="<?php echo $data['post_tilte'];
                                       ?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Description</label>
                                <textarea name="postdesc" class="form-control" required rows="5">
                    <?php echo $data['post_description'] ?>
                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputCategory">Category</label>
                                <select class="form-control" name="category">
                                    <?php
                                    include_once('db-connection.php');
                                    $get_all_categories = "SELECT  `category_name` FROM `categories`";
                                    $process_get_categories = mysqli_query($db_connection, $get_all_categories);
                                    if ($process_get_categories) {
                                        while ($cat = mysqli_fetch_array($process_get_categories)) {
                                            echo "<option value='' selected>{$cat['category_name']} </option>";
                                        }
                                    }
                                    ?>


                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Post image</label>
                                <input type="file" name="new-image">
                                <img src="<?php echo $data['post_image'] ?>" height="150px">
                                <input type="hidden" name="old-image" value="">
                            </div>
                            <?php

                        }

                    }
                    ?>

                    <input type="submit" name="submit" class="btn btn-primary" value="Update"/>
                </form>
                <!-- Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
