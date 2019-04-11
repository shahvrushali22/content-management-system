<?php
$page_title = "Post";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!--META TAGS     -->
    <meta charset="utf-8">

    <meta name="description" content="Building modern responsive websites using HTML5, CSS and Bootstrap">
    <meta name="keywords" content="HTML5, CSS3, jQuery, Responsive Website, Bootstrap">
    <meta name="viewport" content="width=device-width initial-scale=1">
    <!--END OF META TAGS     -->

    <!--TITLE GOES HERE-->
    <title>BLOG A BLOG!</title>


    <!--RESOURCE LINKING-->

    <!--FAVICON-->
    <link rel="shortcut icon" href="img/favicon.png">

    <!--FONT-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">


    <!--plugins-->
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Bootstrap-->
<!--    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="plugins/magnific-popup/magnific-popup.css">

    <link rel="stylesheet" href="plugins/owl-carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="plugins/owl-carousel/assets/owl.theme.blue.css">
    <!--Animate-->
    <link rel="stylesheet" href="plugins/animate/animate.css">
    <!--OUR CSS-->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/custom.css">
</head>


<body data-spy="scroll" data-target="#wg-menu" data-offset="70">

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed-top">
        <a class="navbar-brand" href="#">Blog A Blog!</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse margin-nav" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php#home">Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#blogs">Blogs</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-white  " href="index.php#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-white" href="index.php#team">team</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-white" href="index.php#testimonial">Testimonial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-white" href="index.php#stats">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-white " href="index.php#contact">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-white " href="includes/no-access.php">login</a>
                </li>
            </ul>

        </div>
    </nav>
</header>
<!--    <div class="clearfix"></div>-->
    <!-- Page Content -->
    <div class="container">

      <div class="row">
        <!-- Post Content Column -->
        <div class="col-lg-8">

          <!-- Title -->
            <?php
            if(isset($_GET['post_id'])) {
                include_once ("includes/connection.php");
                include_once "includes/functions.php";
                $post_id = $_GET['post_id'];
                $query_all_posts = "SELECT * FROM posts WHERE post_id = $post_id";
                $all_posts_result = mysqli_query($connection, $query_all_posts);
                if($post = mysqli_fetch_assoc($all_posts_result)) {
                    $post_id = $post['post_id'];
                    $post_title = $post['post_title'];
                    $post_author = $post['post_author'];
                    $post_date = $post['post_date'];
                    $post_content = $post['post_content'];
                    $post_tags = $post['post_tags'];
                    $post_image = $post['post_image'];

                    $query_all_users = "SELECT * FROM users where user_id = $post_author";
                    $all_user_result = mysqli_query($connection,$query_all_users);
                    if ($user = mysqli_fetch_assoc($all_user_result)) {
                        $user_id = $user['user_id'];
                        $username = $user['username'];

                        ?>

                        <h1 class="mt-4 post-title-bold" style="margin-top: 100px;"><?php echo $post_title; ?></h1>
                        <!-- Author -->
                        <p class="lead">
                            by
                            <a href="#"><?php echo $username; ?></a>
                        </p>

                        <hr>

                        <!-- Date/Time -->
                        <p class="post-date"><?php echo $post_date; ?></p>

                        <hr>

                        <!-- Preview Image -->
                        <img class="img-fluid rounded" style="width: 1000px" src="images/<?php echo $post_image; ?>" alt="">



                        <!-- Post Content -->
                        <p class="post-content" ">
                            <?php
                            echo $post_content;
                            ?>
                        </p>
                        

                        </hr>
                        <button type="submit" class=" btn-lg btn-general btn-blue wow  fadeInUp animated" name="post_comment">Subscribe</button>
                        <a class="  fadeInUp animated"style="color: green; margin: 10px;" name="post_comment"><i class="far fa-thumbs-up fa-2x"></i></a>
                        <a  class="  fadeInUp animated"style="color: red" name="post_comment"><i class="far fa-thumbs-down fa-2x"></i></a>




                        <?php
                        if (isset($_POST['post_comment'])) {
                            $comment_author = $_POST['comment_author'];
                            $comment_email = $_POST['comment_email'];
                            $comment_content = $_POST['comment_content'];
                            $comment_date = date("Y-m-d");
                            $query_insert_comment = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_date) VALUES($post_id,'$comment_author','$comment_email','$comment_content','$comment_date')";
                            mysqli_query($connection, $query_insert_comment);
                            if (mysqli_errno($connection)) {
                                die("Problem while inserting comment" . mysqli_error($connection));
                            }



                        }
                        ?>

                        <div class="card my-4">
                            <h5 class="card-header" style="color:#41464B; font-size: 25px; font-weight: 600; margin-top: 25px; margin-bottom: 25px;">Leave a Comment:</h5>
                            <div class="card-body">
                                <form method="post" action="">

                                    <div class="form-group">
<!--                                        <label for="comment_author" style="font-size: 20px; font-weight: 500;">Name</label>-->
                                        <input type="text" class="form-control" placeholder="Enter your Name" name="comment_author"
                                               id="comment_author">
                                    </div>

                                    <div class="form-group">
<!--                                        <label for="email" style="font-size: 25px;">Email</label>-->
                                        <input type="text" class="form-control" placeholder="Enter your email address" name="comment_email" id="comment_email">
                                    </div>

                                    <div class="form-group">
<!--                                        <label for="" style="font-size: 25px;">Your Comment</label>-->
                                        <textarea class="form-control" placeholder="Your comment goes here.." row="3" name="comment_content"
                                                  id="comment_content"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-lg btn-general btn-blue wow  fadeInUp animated" name="post_comment">Submit</button>


                                </form>
                            </div>
                        </div>



                        <!-- Single Comment -->
                        <h5 class="card-header" style="color:#41464B; font-size: 25px; font-weight: 600; margin-top: 25px; margin-bottom: 25px;">Comments</h5>
                        <?php
                        $condition = "comment_post_id = $post_id and comment_status='approved'";
                        $comments_resultset = getAllComments($condition);
                        while ($comment = mysqli_fetch_assoc($comments_resultset)) {
                            $comment_author = $comment['comment_author'];
                            $comment_date = $comment['comment_date'];
                            $comment_content = $comment['comment_content'];

                            ?>
                                        <div class="media mb-4">
                                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                                <div class="media-body">
                                    <h5 class="mt-0" style="font-size: 20px;"><?php echo $comment_author; ?></h5>
                                    <small class="small"><?php echo $comment_date; ?></small>
                                    <h5 style="font-size: 20px;"><?php
                                        echo $comment_content;
                                        ?></h5>

                                </div>
                            </div>

                            <?php

                        }
                    }
                }
        }
    ?>
        </div>

          <div class="col-md-4">
              <div class="card my-4">
                  <h5 class="card-header">Login</h5>
                  <div class="card-body">
                      <form action="includes/process-login.php" method="post">
                          <div class="form-group">
                              <label for="username">Username</label>
                              <input type="text" class="form-control" id="username" name="username">
                          </div>
                          <div class="form-group">
                              <label for="password">Password</label>
                              <input type="password" class="form-control" id="password" name="password">
                          </div>
                          <input type="submit" class="btn btn-primary" name="login" id="login" value="Login">
                          <br><a href="admin/forgot-password.php?forgot=<?php echo uniqid(true);?>">Forgot Password</a>
                      </form>
                  </div>
              </div>
              <div class="card my-4">
                  <h5 class="card-header">Search</h5>
                  <div class="card-body">
                      <form action="index.php" method="get">
                          <div class="input-group">
                              <input type="text" name="search" class="form-control" placeholder="Search for...">
                              <span class="input-group-btn">
                  <button class="btn btn-secondary" type="submit" value="search">Go!</button>
                </span>
                          </div>
                      </form>
                  </div>
              </div>
              <!-- Categories Widget -->
              <div class="card my-4">
                  <h5 class="card-header">Categories</h5>
                  <div class="card-body">
                      <div class="row">
                          <?php
                          include_once ("includes/functions.php");
                          $categories = getAllCategories();
                          $categories_count = count($categories);

                          ?>
                          <div class="col-lg-6">
                              <ul class="list-unstyled mb-0">
                                  <?php
                                  for($i=0; $i<ceil($categories_count/2); $i++){
                                      echo <<<LINK
                        <li>
                            <a href="index.php?cat_id={$categories[$i]['cat_id']}">{$categories[$i]['cat_title']}</a>
                        </li>
LINK;
                                  }
                                  ?>
                              </ul>
                          </div>
                          <div class="col-lg-6">
                              <ul class="list-unstyled mb-0">
                                  <?php
                                  for($i=ceil($categories_count/2); $i<$categories_count; $i++){
                                      echo <<<LINK
                        <li>
                            <a href="index.php?cat_id={$categories[$i]['cat_id']}">{$categories[$i]['cat_title']}</a>
                        </li>
LINK;
                                  }
                                  ?>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Side Widget -->
              <div class="card my-4">
                  <h5 class="card-header">Side Widget</h5>
                  <div class="card-body">
                      You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                  </div>
              </div>
          </div>
        <!-- Sidebar Widgets Column -->
          <?php
            //include_once ("includes/sidebar.php");
          ?>

      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->

    <!-- Footer -->

    <!-- Bootstrap core JavaScript -->
    <?php
    include_once ("includes/scripts.php");
    ?>

  </body>

</html>
