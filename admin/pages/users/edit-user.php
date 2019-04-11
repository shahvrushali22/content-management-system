<?php
//ON PRESS OF EDIT SUBMIT BUTTON

if(isset($_POST['edit_user']) &&isset($_GET['user_id'])) {
    $edit_user_id = $_GET['user_id'];
    $username= $_POST['username'];
   $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email = $_POST['email'];


    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    if($image == ""){
        $image = $old_image;
    }else{
        $image_temp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_temp, "../images/$image");
    }
   $_role = $_POST['role'];


    //INSERTING VALUES

    $query = "UPDATE users SET user_id = ?,username = ?, password = ?, first_name = ?, last_name = ?, email = ?, image = ?, role = ?  WHERE user_id = ?";
    $ps = mysqli_prepare($connection, $query);
    $edit_user_id = $_GET['user_id'];
    mysqli_stmt_bind_param($ps,"dsssssssd", $user_id, $username, $password, $first_name, $last_name, $email, $image,$role, $edit_user_id);

    mysqli_stmt_execute($ps);

    if(mysqli_errno($connection)){
        die(mysqli_error($connection));
    }else{
        header("Location: users.php");
    }
}
//END OF ON PRESS OF EDIT SUBMIT BUTTON

//CODE TO LOAD DATA OF POST WHEN THE PAGE IS LOADED FOR FIRST TIME
if(isset($_GET['user_id'])) {
    $edit_user_id = $_GET['user_id'];

    $query = "SELECT * FROM users WHERE user_id = $edit_user_id";
    $result = mysqli_query($connection, $query);
    if($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['user_id'];
        $image = $row['image'];
        $username  = $row['username'];
        $first_name  = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $role = $row['role'];


        ?>
        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" role="form" enctype="multipart/form-data">
                    <legend>Edit User</legend>
                    <hr>

                    <div class="form-group">
                        <label for="username">UserName</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?php echo $username;?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $first_name;?>">
                    </div>
                    <div class="form-group">
                        <label for="last_name"> Last Name</label>
                        <input type="text"  class="form-control last_name" name="last_name" id="last_name" value="<?php echo $last_name;?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control email" name="email" id="email" value="<?php echo $email;?>">
                    </div>
                    <div class="form-group">
                        <label for="post_image">User Image</label>
                        <input type="hidden" value="<?php echo $old_image;?>" name="old_image" id="old_image">
                        <input type="file" class="form-control-file" name="image" id="image" value="<?php echo $old_image;?>">
                    </div>

                    <div class="form-group">
                        <label for="last_name">Role</label>
                        <select class="form-control" name="role" id="role">
                            <option value="0"><?php echo $role?></option>
                            <option value="admin">Admin</option>
                            <option value="subscriber">Subscriber</option>
                            <option value="super_admin">Super_Admin</option>
                        </select>
                    </div>
                    <button type="submit" name="edit_user" id="edit_user" class="btn btn-primary ">Edit User
                    </button>

                </form>
            </div>
        </div>
        <div class="mb-4"></div>
      <?php
    }
}?>