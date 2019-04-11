<?php
if(isset($_POST['add_user'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $profession = $_POST['profession'];
    $ratings = $_POST['ratings'];
    $role = $_POST['role'];
    move_uploaded_file($user_image_temp, "images/users/$user_image");


    //INSERTING VALUES
    include_once ("../includes/connection.php");
    $query = "INSERT INTO users (username, password, first_name, last_name, email, image,role) VALUES(?,?,?,?,?,?,?)";
    $ps = mysqli_prepare ($connection, $query);
    mysqli_stmt_bind_param($ps, "sssssss", $username, $password, $first_name, $last_name, $email, $user_image, $role);
    mysqli_stmt_execute($ps);


    $query1 = "INSERT INTO profile (username,email,phone,profession,image,ratings) VALUES(?,?,?,?,?,?)";
    $ps1 = mysqli_prepare ($connection, $query1);
    mysqli_stmt_bind_param($ps1, "ssdssd", $username,  $email,$phone,$profession, $user_image, $ratings);
    mysqli_stmt_execute($ps1);

    if(mysqli_errno($connection)){
        die(mysqli_error($connection));
    }else{
        header("Location: users.php");
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <form action="" method="post" role="form" enctype="multipart/form-data">
            <legend>Add New User</legend>
            <hr>

            <div class="form-group">
                <label for="post_title">Username</label>
                <input type="text" class="form-control" name="username" id="username">
            </div>

            <div class="form-group">
                <label for="post_author">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="post_status">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name">
            </div>
            <div class="form-group">
                <label for="post_status">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name">
            </div>
            <div class="form-group">
                <label for="post_status">Profile Image</label>
                <input type="file" class="form-control-file" name="user_image" id="user_image">
            </div>
            <div class="form-group">
                <label for="post_status">Email</label>
                <input type="text" class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="post_status">Phone No</label>
                <input type="text" class="form-control" name="phone" id="phone">
            </div>
            <div class="form-group">
                <label for="post_status">Profession</label>
                <input type="text" class="form-control" name="profession" id="profession">
            </div>
            <div class="form-group">
                <label for="post_status">Ratings</label>
                <input type="text" class="form-control" name="ratings" id="ratings">
            </div>
            <select name="role" id="role">
                <label for="role">Role</label>
                <option value="0">Select User..</option>
                <option value="admin">Admin</option>
                <option value="subscriber">Subscriber</option>
                <option value="super_admin">Super_Admin</option>
            </select>
            <button type="submit" name="add_user" id="add_user" class="btn btn-primary">Add User</button>
        </form>
    </div>
</div>
<div class="mb-4"></div>