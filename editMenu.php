<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

$error = $_SESSION['ERROR'];

require("modelClass.php");

$id = $_GET['id'];

$database->query('SELECT * FROM menus WHERE id = :id;');
$database->bind(':id',$id);
$database->execute();
$row = $database->single();

$_SESSION['id'] = $id;


?>

<!DOCTYPE html>
<html lang="en">


<!-- create-post.html  21 Nov 2019 04:05:02 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard Template</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/bundles/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="assets/bundles/jquery-selectric/selectric.css">
    <link rel="stylesheet" href="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <!-- NAVBAR SECTION  -->
            <?php
            include("components/navbar.php");
            ?>

            <?php
            include("components/main-sidebar.php");
            ?>
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Edit menu item</h4>
                                    </div>
                                    <form id="#" action="controllers/menuController.php" method="POST">
                                        <div class="card-body">
                                            <div class="form-group row mb-4">
                                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Menu name</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input name="title" value="<?= $row['title'] ?>" type="text" class="form-control">
                                                    <div><?= $_SESSION['title_error']; ?></div>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Link</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input name="link" value="<?= $row['link'] ?>" type="" class="form-control">
                                                    <div><?= $_SESSION['link_error']; ?></div>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                                <div class="col-sm-12 col-md-7">
                                                    <button type="submit" name="submit" id="swal-2" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- SETTING SIDEBAR SECTION  -->

                <?php
                include("components/setting-sidebar.php");
                ?>
            </div>
            <!-- FOOTER SECTION  -->
            <?php
            include("components/main-footer.php");
            ?>
        </div>

        <?php
        unset($_SESSION['title_error']);
        unset($_SESSION['link_error']);


        ?>
    </div>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/sweetalert2.all.min.js"></script>
    <script src="assets/js/editnav.js"></script>
    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <script src="assets/bundles/summernote/summernote-bs4.js"></script>
    <script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="assets/bundles/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
    <script src="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <!-- Page Specific JS File -->
    <script src="assets/js/page/create-post.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
</body>


<!-- create-post.html  21 Nov 2019 04:05:03 GMT -->

</html>