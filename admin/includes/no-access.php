<?php
$page_title = "Dashboard";
include_once "../includes/functions.php";
startSession();
$user_id = null;
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Forgot Password</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>
<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">LOGIN!</div>
        <div class="card-body">
            <div class="text-center mb-4">
                <h4>Forgot to Login?</h4>
                <p>Please provide your credentialas to proceed further.</p>
            </div>
            <form action="../includes/process-login.php" method="post">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter email address" required="required" autofocus="autofocus">
                        <label for="username">Enter Username</label>
                    </div>
                </div>

            <div class="form-group">
                <div class="form-label-group">
                    <input type="password" id="password" name="password" class="form-control" required="required" >
                    <label for="password">Enter Password</label>
                </div>
            </div>
                <button type="submit" name="login" class="btn btn-primary btn-block">LOGIN</button>
            </form>
            <div class="text-center">
                <a class="d-block small mt-3" href="register.html">Register an Account</a>
                <a class="d-block small" href="../index.php">Home Page</a>
                <a class="d-block small" href="forgot-password.php?forgot=<?php echo uniqid(true);?>">Forgot Password</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>


</body>