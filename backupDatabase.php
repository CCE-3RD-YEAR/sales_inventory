<?php
include('db_connect.php');

try{
    $date_string   = date("m-d-Y");

    $cmd = "cmd.exe /C mysqldump --host=" . DB_SERVER . " --user=" . DB_USERNAME . " " . DB_DATABASE . " > " . BACKUP_PATH . "{$date_string}_" . DB_DATABASE . ".sql";

    exec($cmd);

    Header("Location: index.php?page=backupandrestore");
} catch(Exception $e){
    die($e);
}