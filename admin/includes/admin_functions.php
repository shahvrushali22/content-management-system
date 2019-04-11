<?php


include_once ("admin_connection.php");
function checkForQueryError($connection){
    if(mysqli_errno($connection)){
        die(mysqli_error($connection));
    }
}
function insert($table_name, $column_list, $values){
    global $connection;
    $query = "INSERT INTO {$table_name}({$column_list}) VALUES({$values})";

    mysqli_query($connection, $query);
    checkForQueryError($connection);
}
function delete($table_name, $condition){
    global $connection;
    $query = "DELETE FROM $table_name WHERE $condition";
    mysqli_query($connection, $query);
    checkForQueryError($connection);
}