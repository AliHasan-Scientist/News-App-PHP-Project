<?php include "header.php"; ?>
<?php
session_start();
/*
 *
 */
$author_name = $_SESSION['username'];
$author_fonded = '';
include_once('db-connection.php');
if (isset($author_name)) {
    echo "login";
} else {
    echo 'user not login';
}

if (isset($_POST['submit']) && $author_name) {
    $post_title = $_POST['post_title'];
    $post_description = $_POST['post_description'];
    $category = $_POST['category'];
    $image_c = $_FILES['fileToUpload'];
    $image_name = $image_c['name'];
    $image_temp_name = $image_c['tmp_name'];
    $image_error = $image_c['error'];
    $image_destination = null;
    if ($image_error === 0) {
        $image_destination = "upload/" . $image_name;
        move_uploaded_file($image_temp_name, $image_destination);
        echo "image uploaded successfully";
    } else {
        echo "images not uploaded successfully";
    }
    $get_user_role = "SELECT `role` FROM `user` WHERE username='$author_name'";
    $process_user_role = mysqli_query($db_connection, $get_user_role);
    while ($row = mysqli_fetch_array($process_user_role)) {
        $author_fonded = $row['role'];
    }
    $insert_post_query = "INSERT INTO `user_posts`(`post_tilte`, `post_description`, `post_category`, `post_image` ,`author`) VALUES ('$post_title','$post_description','$category','$image_destination','$author_fonded')";
    $process_insert_post_query = mysqli_query($db_connection, $insert_post_query);
    if ($process_insert_post_query) {
        echo "post inserted successfully 😀";
    } else {
        echo "post not inserted successfully";
    }

}


?>


<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Post</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->


                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_title">Title</label>
                        <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="post_description" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Category</label>
                        <select name="category" class="form-control">
                            <option value="" selected> Select Category</option>
                            <?php
                            include_once('db-connection.php');
                            $get_categories = "SELECT  `category_name` FROM `categories` ";
                            $process_get_categories = mysqli_query($db_connection, $get_categories);
                            if ($process_get_categories) {
                                echo "category get successfully";
                                while ($row = mysqli_fetch_array($process_get_categories)) {
                                    echo "<option value={$row['category_name']} >{$row['category_name']}</option>";
                                }
                            } else {
                                echo "category not get successfully";

                            }

                            ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Post image</label>
                        <input type="file" name="fileToUpload" required>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" required/>
                </form>
                <!--/Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
