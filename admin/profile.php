<?php
/**
 * Created by PhpStorm.
 * User: shahv
 * Date: 30-03-2019
 * Time: 20:59
 */


    $page_title = "Dashboard";
    include_once "../includes/functions.php";
    startSession();
    $user_id = null;
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

    }
?>
<?php
    $page_title = "profile";
    include_once ("includes/header.php");
?>
<link rel="stylesheet" href="css/style.css">

<!DOCTYPE html>
<html lang="en">
<body id="page-top" class="sidebar-toggled">



<div id="wrapper">

    <!-- Sidebar -->
    <?php
    include_once ("includes/sidebar.php");
    ?>
    <?php
    include_once ("includes/topbar.php");
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
                include_once "../includes/functions.php";
                include_once "../includes/connection.php";

            $sql = "SELECT profile.username,profile.email,profile.phone,profile.profession,profile.image,profile.ratings FROM profile where profile.userid = $user_id";
            $result = mysqli_query($connection, $sql);

            while($row = mysqli_fetch_assoc($result)){

                $username = $row['username'];
                $email = $row['email'];
                $phone = $row['phone'];
                $profession = $row['profession'];
                $image = $row['image'];
                $ratings = $row['ratings'];

            ?>
            <!------ Include the above in your HEAD tag ---------->

            <div class="container emp-profile">
                <form method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-img">
                                <img style="width: 210px; height: 180px; margin-bottom: 20px;" " src="images/users/<?php echo $image;?>" alt=""/>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-head">

                                <h6>
                                    <?php echo $profession;?>
                                </h6>
                                <p class="proile-rating">RANKINGS : <span><?php echo $ratings ?>/10</span></p>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Timeline</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
<!--                        <div class="col-md-2">-->
<!--                            <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>-->
<!--                        </div>-->
                    </div>
                    <div class="row">

                        <div class="col-md-8">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>User Id</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $_SESSION['user_id'];?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Name</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $username;?> </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Email</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p> <?php echo $email;?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Phone</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $phone;?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Profession</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $profession;?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Experience</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Expert</p>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>English Level</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Expert</p>
                                        </div>
                                    </div>


                                </div>
                            </div>

        </div>
    </div>
</div>
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>
            <?php }?>
</body>
</html>
