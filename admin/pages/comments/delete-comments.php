<?php


ob_start();

include_once ("../includes/connection.php");
if(isset($_GET['comment_id'])){
    $comment_id = $_GET['comment_id'];
    $query = "DELETE FROM comments WHERE comment_id = $comment_id";
    mysqli_query($connection, $query);
    if(mysqli_errno($connection)){
        die(mysqli_error($connection));
    }
    header("Location: comments.php");
}