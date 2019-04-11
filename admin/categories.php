<?php

$page_title = "Dashboard";
include_once "../includes/functions.php";
startSession();
$user_id = null;
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
?>
<?php

$page_title = "Categories";


include "includes/header.php";
?>



<body id="page-top">
<div id="wrapper">

    <!-- Sidebar -->
    <?php
    include_once ("includes/sidebar.php");
    ?>
    <?php
    include_once "includes/topbar.php"
    ?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">CMS Admin</a>
            </li>
            <li class="breadcrumb-item active"><?php echo  $page_title;?></li>
          </ol>

          <!--MAIN PAGE CONTENT-->
          <div class="row">
            <div class="col-md-6 ">
                <?php
                include_once ("pages/categories/add-category-form.php");
                ?>
            </div>
              <div class="col-md-6">
                  <?php
                  include_once ("pages/categories/edit-category-form.php");
                  ?>
              </div>
          </div>

            <!--row end-->
            <?php
            include_once ("pages/categories/view-all-categories.php");
            ?>
            <!--END OF MAIN PAGE CONTENT-->
        </div>



      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->



<?php
include_once ("includes/scripts.php");
?>

  </body>

</html>
