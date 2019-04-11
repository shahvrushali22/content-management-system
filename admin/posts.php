<?php
ob_start();
$page_title = "Dashboard";
include_once "../includes/functions.php";
startSession();
$user_id = null;
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<?php

$page_title = "Posts";
//include_once ("includes/header.php");
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BLOG A BLOG!</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>

</head>



<body id="page-top">
<div id="wrapper">

      <!-- Sidebar -->
        <?php
        include_once ("includes/sidebar.php");
        include_once "includes/topbar.php"

        ?>



      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active"><?php echo $page_title;?></li>
          </ol>
            <?php
            if(isset($_GET['source'])){
                $source = $_GET['source'];
            }else{
                $source = "";
            }

            switch($source){
                case "add_post":
                    include_once ("pages/posts/add-post.php");
                    break;
                case "edit_post":
                    include_once ("pages/posts/edit-post.php");
                    break;
                case "delete_post":
                    include_once ("pages/posts/delete-post.php");
                    break;
                default:
                    include_once ("pages/posts/view-all-posts.php");
            }

            ?>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->


      </div>
      <!-- /.content-wrapper -->

    </div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
  <?php

  include_once "includes/scripts.php";
  ?>


</body>

</html>
