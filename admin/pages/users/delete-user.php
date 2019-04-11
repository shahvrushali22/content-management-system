<?php

include_once ("../includes/connection.php");
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $query = "DELETE FROM users WHERE user_id = $user_id";
    mysqli_query($connection, $query);
    if(mysqli_errno($connection)){
        die(mysqli_error($connection));
    }
    header("Location: users.php");
}