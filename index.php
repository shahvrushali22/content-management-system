<?php
ob_start();
include_once "includes/functions.php";
startSession();
$page_title = "Blog | Home";
$active_page = "home";
$post_per_page = 2;
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
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">

    <!--Bootstrap-->
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">

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
<!--	Header Section-->
<header>
    <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div class="wg-nav-wrapper">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#wg-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#home" class="navbar-brand">Blog A Blog!</a>
                </div>
                <div class="collapse navbar-collapse" id="wg-menu">
                    <ul class="nav navbar-nav">
                        <li><a href="#home" class="smooth-scroll">Home</a></li>
                        <li><a href="#blog" class="smooth-scroll">Blogs</a></li>
                        <li><a href="#about" class="smooth-scroll">About</a></li>
<!--                        <li><a href="#work" class="smooth-scroll"></a></li>-->
                        <li><a href="#team" class="smooth-scroll">Team</a></li>
                        <li><a href="#testimonial" class="smooth-scroll">Testimonial</a></li>
                        <li><a href="#pricing" class="smooth-scroll">Pricing</a></li>
                        <li><a href="#stats" class="smooth-scroll">statistical</a></li>
<!--                        <li><a href="#clients" class="smooth-scroll">Client</a></li>-->
                        <li><a href="#contact" class="smooth-scroll">Contact Us</a></li>
                        <li><a href="includes/no-access.php" class="">Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
<!--   END OF HEADER SECTION-->
<!--HOME SECTION-->

<section id="home">
    <div class="home-cover bg-parallax wow animated fadeIn " >
        <div class="home-content-box">
            <div class="home-content-box-inner">
                <div class="home-heading wow animated zoomIn ">
                    <h2>Watch out<br/> Blog A Blog!</h2>
                </div><!--.home-heading-->
                <div class="home-btn wow animated zoomIn ">
                    <a href="#work" class="btn btn-lg btn-general btn-white" role="button" title="View Our Work">View Our Blogs</a>
                </div><!--.home-btn-->
            </div><!--home-content-box-inner-->
        </div><!--.home-content-box-->
    </div><!--.home-cover-->
</section>
<section id="blog">
    <div class="content-box">
        <div class="content-title wow animated fadeInDown" data-wow-duration="1s" data-wow-delay=".2s" >
            <h3>BLOGS</h3>
            <div class="content-title-underline"></div>
        </div>


        <?php
        include_once ("includes/connection.php");
        if(isset($_GET['search'])){
            $key = $_GET['search'];
            $conditional_stmt = "post_title like '%{$key}%' or post_tags like '%{$key}%' or CONCAT(users.first_name, users.last_name) like '%{$key}%'";
            //$conditional_stmt= 1;
        }else if(isset($_GET['cat_id'])){
            $cat_id  = $_GET['cat_id'];
            $conditional_stmt = " post_cat_id = $cat_id";


        }else{
            $conditional_stmt = 1;
        }
        //FETCH TOTAL NO OF ROWS TO BE DISPLAYED
        $query_count_posts = "SELECT posts.post_id, CONCAT(users.first_name, CONCAT(\" \",users.last_name)) as author FROM posts, users WHERE posts.post_author = users.user_id AND $conditional_stmt";

        $count_post_result = mysqli_query($connection,$query_count_posts);
        $count = mysqli_num_rows($count_post_result);
        $total_pages = ceil($count/$post_per_page);

        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else{
            $page = 1;
        }
        $start = ($page-1)*$post_per_page;

        $query_all_posts = "SELECT posts.post_id, posts.post_cat_id, posts.post_title,posts.post_author, posts.post_date,posts.post_image, posts.post_content, posts.post_tags,posts.post_comment_count,posts.post_status, posts.post_views_count, CONCAT(users.first_name, CONCAT(\" \",users.last_name)) as author FROM posts, users WHERE posts.post_author = users.user_id AND $conditional_stmt";
        $all_posts_result = mysqli_query($connection, $query_all_posts);
        while($post = mysqli_fetch_assoc($all_posts_result)) {
        $post_id = $post['post_id'];
        $post_title = $post['post_title'];
        $author = $post['author'];
        $post_date = $post['post_date'];
        $post_content = substr(strip_tags($post['post_content']),0,100)."...";
        $post_tags = $post['post_tags'];
        $post_image = $post['post_image'];

        ?>

    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="post-preview">
                    <a href="post.php?post_id=<?php echo $post_id;?>">
                        <h2 class="post-title">
                            <?php echo $post_title;?>
                        </h2>
                    </a>
                    <p>
                        <?php echo $post_content;?>
                    </p>



                    <p class="post-meta">Posted by
                        <a href="#"><?php echo $author;?></a>
                        on <?php echo $post_date;?></p>
                    <a href="post.php?post_id=<?php echo $post_id;?>" class="btn btn-lg btn-general btn-blue wow  fadeInUp animated " style="margin-bottom: 10px;">Read More &rarr;</a>
                    <div class="card-footer-tags text-muted">
                        <ul>
                            <?php
                            $tags = explode(",", $post_tags);
                            for($i=0; $i<count($tags); $i++) {
                                $tag = trim($tags[$i]);
                                echo "<li>$tag</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <hr><?php } ?>
                <ul class="pagination justify-content-center mb-4">
                    <li class="page-item" <?php echo $page==1?"disabled":"";?>">
                    <a class="page-link" href="<?php echo "index.php?page=".($page-1);?>">&laquo;</a>
                    </li>
                    <?php
                    for($i=1;$i<=$total_pages;$i++){
                        echo<<<PAGE
                    <li class="page-item">
                        <a class="page-link" href="index.php?page={$i}">{$i}</a>
                    </li>
PAGE;
                    }
                    ?>
                    <li class="page-item <?php echo $page==$total_pages?"disabled":"";?>">
                        <a class="page-link" href="<?php echo "index.php?page=".($page+1);?>">&raquo;</a>
                    </li>
                </ul>

                <!-- Pager -->
                <div class="clearfix">
                </div>
            </div>
        </div>


    </div>

</section>


<!--ABOUT SECTION-->

<section id="about">
    <!--      RIGHT HAND IMAGE PARt    -->
    <div class="about-bg-diagonal bg-parallax"></div>
    <!-- LEFT HAND SIDE ABOUT CONTENT-->
    <div class="container">
        <div class="row">
            <div class="col-md-4 ">
                <div class="content-box">
                    <div class="content-box-outer">
                        <div class="content-box-inner">
                            <div class="content-title wow animated fadeInDown" data-wow-duration="1s" data-wow-delay=".2s">
                                <h3>About Blog A Blog!</h3>
                                <div class="content-title-underline"></div>
                            </div>
                            <div class="about-desc wow animated fadeInDown" data-wow-duration="1s" data-wow-delay=".2s">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum debitis consequatur dolorem, a nemo omnis tempore consectetur exercitationem expedita maiores eligendi unde eum nostrum reprehenderit, ut sapiente distinctio illum, officia.</p>
                            </div><!--description-->
                            <div class="about-btn">
                                <a href="#work" title="Our Work" class="btn btn-lg btn-general btn-blue wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">Our Work</a>
                            </div>
                        </div> <!--inner box -->
                    </div><!--outer box-->
                </div><!--.content box-->
            </div><!--.col-md-4-->
        </div><!--.row-->
    </div>

</section>


<!--TEAM SECTION-->
<section id="team">
    <div class="content-box">
        <div class="content-title  wow animated fadeInDown">
            <h3>our team</h3>
            <div class="content-title-underline"></div>
        </div>

        <div class="container">
            <div class="row wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                <div class="col-md-12">
                    <div class="team-members owl-carousel owl-theme">

                        <div class="team-member">
                            <img src="img/team/team-1.jpg" alt="Team Member 1" class="img-responsive">
                            <div class="team-member-info">
                                <h4 class="team-member-name">Daniel Watrous</h4>
                                <h4 class="team-member-designation">Founder</h4>
                                <ul class="social-list">
                                    <li><a href="" class="social-icon icon-gray"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="" class="social-icon icon-gray"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="" class="social-icon icon-gray"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div><!--team-member-->

                        <div class="team-member">
                            <img src="img/team/team-2.jpg" alt="Team Member 2" class="img-responsive">
                            <div class="team-member-info">
                                <h4 class="team-member-name">Sakshi Sheth</h4>
                                <h4 class="team-member-designation">Food Blogger</h4>
                                <ul class="social-list">
                                    <li><a href="" class="social-icon icon-gray"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="" class="social-icon icon-gray"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="" class="social-icon icon-gray"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div><!--team-member-->

                        <div class="team-member">
                            <img src="img/team/team-3.jpg" alt="Team Member 3" class="img-responsive">
                            <div class="team-member-info">
                                <h4 class="team-member-name">Steve Mike</h4>
                                <h4 class="team-member-designation">Lifestyle blogger</h4>
                                <ul class="social-list">
                                    <li><a href="" class="social-icon icon-gray"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="" class="social-icon icon-gray"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="" class="social-icon icon-gray"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div><!--team-member-->

                        <div class="team-member">
                            <img src="img/team/team-4.jpg" alt="Team Member 4" class="img-responsive">
                            <div class="team-member-info">
                                <h4 class="team-member-name">Michael Jackson</h4>
                                <h4 class="team-member-designation">Sports Blogger</h4>
                                <ul class="social-list">
                                    <li><a href="" class="social-icon icon-gray"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="" class="social-icon icon-gray"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="" class="social-icon icon-gray"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div><!--team-member-->

                        <div class="team-member">
                            <img src="img/team/team-5.jpg" alt="Team Member 5" class="img-responsive">
                            <div class="team-member-info">
                                <h4 class="team-member-name">Kirti Motwani</h4>
                                <h4 class="team-member-designation">Education Blogger</h4>
                                <ul class="social-list">
                                    <li><a href="" class="social-icon icon-gray"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="" class="social-icon icon-gray"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="" class="social-icon icon-gray"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div><!--team-member-->
                    </div>
                </div>

            </div><!--row-->
        </div><!--container-->
    </div><!--content-box-->
</section>

<!--END OF OUR TEAM SECTION-->
<!--END OF TEAM SECTION-->
<!--      SECTION-->
<section id="testimonial">
    <div class="testimonial-cover bg-parallax">
        <div class="content-box">
            <div class="content-title  wow animated fadeInDown" data-wow-duration="1s" data-wow-delay=".2s">
                <h3 class="content-title-white">What Our Viewes Say</h3>
                <div class="content-title-underline"></div>
            </div>
            <div class="container">
                <div class="row wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">

                    <div class="customers-testimonials text-center owl-carousel owl-theme">
                        <div class="testimonial">
                            <img src="img/client/client-1.jpg" alt="testimonial" class="img-responsive img-circle">
                            <blockquote class="text-center">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta consequatur perspiciatis accusamus dolor nisi sunt ducimus nulla fugiat rem molestias laborum excepturi assumenda eligendi deserunt vitae sint, autem, cum pariatur?</p>
                            </blockquote>
                            <div class="testimonial-author">
                                <p>
                                    <strong>
                                        Daniel Watrous
                                    </strong>
                                    <span>CEO &amp; Founder - Google</span>
                                </p>
                            </div>
                        </div>
                        <div class="testimonial">
                            <img src="img/client/client-2.jpg" alt="testimonial" class="img-responsive img-circle">
                            <blockquote class="text-center">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta consequatur perspiciatis accusamus dolor nisi sunt ducimus nulla fugiat rem molestias laborum excepturi assumenda eligendi deserunt vitae sint, autem, cum pariatur?</p>
                            </blockquote>
                            <div class="testimonial-author">
                                <p>
                                    <strong>
                                        Daniel Watrous
                                    </strong>
                                    <span>CEO &amp; Founder - Google</span>
                                </p>
                            </div>
                        </div>

                        <div class="testimonial">
                            <img src="img/client/client-3.jpg" alt="testimonial" class="img-responsive img-circle">
                            <blockquote class="text-center">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta consequatur perspiciatis accusamus dolor nisi sunt ducimus nulla fugiat rem molestias laborum excepturi assumenda eligendi deserunt vitae sint, autem, cum pariatur?</p>
                            </blockquote>
                            <div class="testimonial-author">
                                <p>
                                    <strong>
                                        Daniel Watrous
                                    </strong>
                                    <span>CEO &amp; Founder - Google</span>
                                </p>
                            </div>
                        </div>

                    </div>
                </div><!--row-->
            </div><!--container-->
        </div><!--content-box-->


    </div>
</section>
<!--END OF OUR TEAM SECTION-->

<!--PRICING SECTION-->
<section id="pricing">
    <div class="content-box">
        <div class="content-title  wow animated fadeInDown">
            <h3>Our Pricing</h3>
            <div class="content-title-underline"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 animated wow zoomIn" data-wow-duration="1s" data-wow-delay=".3s">
                    <div class="pricing-box">
                        <h4 class="pricing-title">Food Blogs</h4>
                        <h3 class="pricing-value">49<sup>$</sup></h3>
                        <ul class="pricing-spec">
                            <li>
                                <p>50 Blogs</p>
                            </li>
                            <li>
                                <p>50 letters</p>
                            </li>
                            <li>
                                <p>Unlimited comments</p>
                            </li>
                            <li>
                                <p>Only Food Blogs</p>
                            </li>
                        </ul>
                        <div class="pricing-btn">
                            <a href="#" role="button" class="btn btn-lg btn-general btn-blue">Purchase</a>
                        </div>
                    </div><!--pricing-box-->
                </div><!--col-->

                <div class="col-md-4 animated wow bounceInUp" data-wow-duration="1s" data-wow-delay=".3s">
                    <div class="pricing-box pricing-box-lg">
                        <h4 class="pricing-title">LifeStyle Blogs</h4>
                        <h3 class="pricing-value">89<sup>$</sup></h3>
                        <ul class="pricing-spec">
                            <li>
                                <p>100 blogs</p>
                            </li>
                            <li>
                                <p>100 letters</p>
                            </li>
                            <li>
                                <p>Unlimited comments </p>
                            </li>
                            <li>
                                <p>Only Lifestyle Blogs</p>
                            </li>
                        </ul>
                        <div class="pricing-btn">
                            <a href="#" role="button" class="btn btn-lg btn-general btn-white">Purchase</a>
                        </div>
                    </div><!--pricing-box-->
                </div><!--col-->


                <div class="col-md-4 animated wow zoomIn" data-wow-duration="1s" data-wow-delay=".3s">
                    <div class="pricing-box">
                        <h4 class="pricing-title">Sports Blogs</h4>
                        <h3 class="pricing-value">69<sup>$</sup></h3>
                        <ul class="pricing-spec">
                            <li>
                                <p>100 Blogs</p>
                            </li>
                            <li>
                                <p>100 newsletters</p>
                            </li>
                            <li>
                                <p>Unlimuted Comments</p>
                            </li>
                            <li>
                                <p>Unlimited Sports Blogs</p>
                            </li>
                        </ul>
                        <div class="pricing-btn">
                            <a href="#" role="button" class="btn btn-lg btn-general btn-blue">Purchase</a>
                        </div>
                    </div><!--pricing-box-->
                </div><!--col-->
            </div><!--row-->
        </div><!--container-->
    </div><!--content-box-->
</section>
<!--END OF OUR PRICING SECTION-->



<!--STATISTICS SECTION-->
<section id="stats">
    <div class="stats-cover bg-parallax">
        <div class="content-box">
            <div class="content-title  wow animated fadeInDown" data-wow-duration="1s" data-wow-delay=".3s">
                <h3 class="content-title-white">we never stop improving</h3>
                <div class="content-title-underline"></div>
            </div>
            <div class="container">
                <div class="row wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
                    <div class="col-md-3 col-sm-6">
                        <div class="stats-item">
                            <i class="fa fa-cloud-download fa-5x"></i>
                            <h2><span class="counter">1590</span>+</h2>
                            <p>Blogs</p>
                        </div><!--stats-item-->
                    </div><!--col-->

                    <div class="col-md-3 col-sm-6">
                        <div class="stats-item">
                            <i class="fa fa-star-o fa-5x"></i>
                            <h2><span class="counter">3500</span>+</h2>
                            <p>Views</p>
                        </div><!--stats-item-->
                    </div><!--col-->

                    <div class="col-md-3 col-sm-6">
                        <div class="stats-item">
                            <i class="fa fa-heart-o fa-5x"></i>
                            <h2><span class="counter">1199</span>+</h2>
                            <p>Likes</p>
                        </div><!--stats-item-->
                    </div><!--col-->

                    <div class="col-md-3 col-sm-6">
                        <div class="stats-item">
                            <i class="fa fa-check fa-5x"></i>
                            <h2><span class="counter">2000</span>+</h2>
                            <p>Recommends</p>
                        </div><!--stats-item-->
                    </div><!--col-->
                </div><!--row-->
            </div><!--container-->
        </div><!--content-box-->
    </div><!--cover-->
</section>
<!--END OF STATICTIS SECTION-->


<!--CLIENT SECTION-->
<!--<section id="clients">-->
<!--    <div class="content-box">-->
<!--        <div class="content-title  wow animated fadeInDown">-->
<!--            <h3>clients</h3>-->
<!--            <div class="content-title-underline"></div>-->
<!--        </div>-->
<!--        <div class="container">-->
<!--            <div class="row wow animated fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">-->
<!--                <div class="col-md-12">-->
<!--                    <div class="clients-list owl-carousel owl-theme">-->
<!--                        <div class="client"><img src="img/client/logos/logo-1.jpg" alt="" class="img-responsive"></div>-->
<!--                        <div class="client"><img src="img/client/logos/logo-2.jpg" alt="" class="img-responsive"></div>-->
<!--                        <div class="client"><img src="img/client/logos/logo-3.jpg" alt="" class="img-responsive"></div>-->
<!--                        <div class="client"><img src="img/client/logos/logo-4.jpg" alt="" class="img-responsive"></div>-->
<!--                        <div class="client"><img src="img/client/logos/logo-5.jpg" alt="" class="img-responsive"></div>-->
<!--                        <div class="client"><img src="img/client/logos/logo-6.jpg" alt="" class="img-responsive"></div>-->
<!--                        <div class="client"><img src="img/client/logos/logo-7.jpg" alt="" class="img-responsive"></div>-->
<!--                        <div class="client"><img src="img/client/logos/logo-8.jpg" alt="" class="img-responsive"></div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>row-->
<!--        </div>container-->
<!--    </div>content-box-->
<!--</section>-->
<!--END OF   SECTION-->

<!--Footer-->
<footer id="contact">
    <div class="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">

                    <div class="contact-left">
                        <h3>Blog A Blog</h3>
                        <p>We believe in <strong>Simple</strong>, <strong>Clean</strong> &amp; <strong>Modern</strong>Design Standars with responsive approach of our company.</p>
                    </div><!--contact-left-->

                    <div class="contact-info">
                        <address>
                            <strong>Headquarters:</strong>
                            <p>313,Evergreen CHS.<br>
                                Airoli Sector 15,<br>
                                New Bombay,<br>
                                Mumbai-55.</p>
                        </address>

                        <div class="phone-fax-email">
                            <p>
                                <strong>Phone:</strong><span>(719)-778-8804</span>
                                <br/>

                                <strong>Fax:</strong><span>(719)-778-8804 8890</span>
                                <br/>

                                <strong>Phone:</strong><span>info@blogablog.in</span>
                                <br/>
                            </p>
                        </div>

                        <ul class="social-list">
                            <li><a href="" class="social-icon icon-white"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="" class="social-icon icon-white"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="" class="social-icon icon-white"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="" class="social-icon icon-white"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div><!--col-->
                </div>

                <?php

                if (isset($_POST['post_message'])) {
                    $messenger_name = $_POST['messenger_name'];
                    $messenger_email = $_POST['messenger_email'];
                    $message_content = $_POST['message_content'];
                    $message_date = date("Y-m-d");
                    $query_insert_message = "INSERT INTO messages(messenger_name,messenger_email,message_content,message_date) VALUES('$messenger_name','$messenger_email','$message_content','$message_date')";
                    mysqli_query($connection, $query_insert_message);
                    if (mysqli_errno($connection)) {
                        die("Problem while inserting message" . mysqli_error($connection));
                    }
                    else{
                        header("Location: index.php");
                    }




                }
                ?>

                <div class="col-md-6">
                    <div class="contact-right">
                        <h3>Contact us</h3>
                        <form action="" method="post">
                            <input type="text" name="messenger_name" placeholder="Full Name" class="form-control form-controls">
                            <input type="email" name="messenger_email" placeholder="Email Address" class="form-control form-controls">
                            <textarea type="message" row="3" placeholder="Your Message.."name="message_content" class="form-control form-controls"></textarea>


                                <button type="submit"  class="btn btn-lg btn-general btn-white send-btn" name= "post_message">Send</button>

                        </form>
                    </div>
                </div>
            </div>
        </div><!--Contact-->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-copyrights">
                            <p>Copyrights &copy; 2018 All Rights Reserved by Blog A Blog Inc.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-menu">
                            <ul>
                                <li><a href="#home">Home</a>|</li>
                                <li><a href="#services">Services</a>|</li>
                                <li><a href="#about">About</a>|</li>
                                <li><a href="#work">Work</a>|</li>
                                <li><a href="#team">Team</a>|</li>
                                <li><a href="#testimonial">Testimonial</a>|</li>
                                <li><a href="#pricing">Pricing</a>|</li>
                                <li><a href="#stats">Stats</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <a href="#home" class="btn btn-sm btn-general btn-blue btn-back-to-top smooth-scroll" role="button" title="home"><i class="fa fa-angle-up"></i></a>
</footer>
<!--End of footer-->

<script src="js/jquery-3.2.1.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/easing/easing.min.js"></script>
<script src="plugins/waypoints/jquery.waypoints.min.js"></script>
<script src="plugins/counterup/jquery.counterup.min.js"></script>
<script src="plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="plugins/owl-carousel/owl.carousel.min.js"></script>
<script src="plugins/wow/wow.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>




























