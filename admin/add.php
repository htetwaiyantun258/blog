<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "../config/config.php";

if (empty($_SESSION['user_name'] && $_SESSION['user_id'])) {
    header("Location: login.php");

}
if ($_POST) {
    $file_path = 'img/'.($_FILES['image']['name']);
    $imgType = pathinfo($file_path, PATHINFO_EXTENSION);
  
  

    if ($imgType != 'jpg' && $imgType != 'png' && $imgType != 'jpeg') {
        echo "<script>alert('Image must be png ,jpg,jpeg');</script>";
    } else {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $image =$_FILES['file']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $file_path);

        $stmt = $pdo->prepare("INSERT INTO posts(title, content, image, author_id) VALUES (:title, :content, :image, :author_id)");
        $result = $stmt->execute(
            array(':title' => $title,':content' => $content,':image' => $image, ':author_id' => $_SESSION['user_id'])
        );
        if ($result) {
            echo "<script>alert('Value is added successfully');</script>";
        }
    }
}

?>

<?php include "header.html";?>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">Blog Panel</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['user_name'] ?></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Blog
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <!--table form star start start-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <form action="add.php" method="post" enctype="multipart/form">
                      <div class="form-group">
                        <label for="">Title</label><br>
                        <input type="text" class="form-control" name="title" require>
                      </div>
                      <div class="form-group">
                        <label for="">Content</label><br>
                        <input type="text" class="form-control" name="content" row="8" col="80">
                      </div>
                      <div class="form-group">
                        <label for="">Image</label><br>
                        <input type="file" name="image" require>
                      </div>
                      <div class="form-group">
                        <input type="submit" name="submit" value="Submit" class="btn btn-success">
                        <a href="index.php" class="btn btn-warning">Go Back</a>
                      </div>
                    </form>
                  </div>
                </div>
                <!--table end -->

                  <!-- Control Sidebar -->
                  <aside class="control-sidebar control-sidebar-dark">
                    <!-- Control sidebar content goes here -->
                  </aside>
                  <!-- /.control-sidebar -->
              </div>
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!--footer session start-->

    <?php include "footer.html";?>

    <!--footer session end-->


