<?php include "header.php"; ?>
<?php
include_once('db-connection.php');
if (isset($_POST['save'])) {
    $category_name = $_POST['category'];
    $add_category = "INSERT INTO `categories`(`category_name`) VALUES ('$category_name')";
    if (mysqli_query($db_connection, $add_category)) {
        echo "category inserted successfully!";
    } else {
        echo "category not inserted successfully!";


    }
}

?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="category" class="form-control" placeholder="Category Name" required>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required/>
                </form>
                <!-- /Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
