<?php
include('db_connect.php');

try{
    define("BACKUP_PATH", "C:/");

    $server_name   = "localhost";
    $username      = "root";
    $database_name = "sales_inventory_db";
    $date_string   = date("m-d-Y");

    $cmd = "C:/xampp/mysql/bin/mysqldump --routines -h {$server_name} -u {$username} {$database_name} > " . BACKUP_PATH . "{$date_string}_{$database_name}.sql";

    exec($cmd);

    Header("Location: index.php?page=backupandrestore");
} catch(throwable $e){
    die($e);
}

?>