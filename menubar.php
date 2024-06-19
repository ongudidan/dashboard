<?php
require('modelClass.php');


$database->query('SELECT * FROM menus');
$database->execute();
$data = $database->resultset();




?>

<!DOCTYPE html>
<html lang="en">


<!-- posts.html  21 Nov 2019 04:05:03 GMT -->

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Otika - Admin Dashboard Template</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/jquery-selectric/selectric.css">
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
      <?php
      include('components/navbar.php');
      ?>
      <?php
      include('components/main-sidebar.php');
      ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row mt-4">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>ALL MENU ITEMS</h4>
                  </div>
                  <div class="card-body">
                    <div class="float-right">
                      <a href="editMenu.php" class="btn btn-success">ADD MENU ITEM</a>

                    </div>
                    <div class="clearfix mb-3"></div>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tr>
                          <th></th>
                          <th>Title</th>
                          <th>Link</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                        <?php
                        foreach ($data as $row) {
                        ?>
                          <tr>
                            <td>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['link'] ?></td>
                            <td>
                              <a href="editMenu.php?id=<?=$row['id']?>">
                                <div class="badge badge-warning">Edit</div>
                              </a>
                            </td>
                            <td>
                              <a href="controllers/menuDeleteController.php?id=<?=$row['id']?>">
                                <div class="badge badge-danger">Delete</div>
                              </a>
                            </td>
                          </tr>
                        <?php } ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <?php
        include('components/setting-sidebar.php');
        ?>

      </div>
      <?php
      include('components/main-sidebar.php');
      ?>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/posts.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>


<!-- posts.html  21 Nov 2019 04:05:04 GMT -->

</html>