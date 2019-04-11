<?php

include_once ("admin_functions.php");
if(isset($_GET['cat_id'])){
    $cat_id = $_GET['cat_id'];
    delete("categories", "cat_id = $cat_id");
    header("Location: ../categories.php");
}