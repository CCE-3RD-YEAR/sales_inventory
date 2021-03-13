<?php include('db_connect.php'); 

$path = $_POST['file'];

try{
    $cmd = "cmd.exe /C mysql --user=" . DB_USERNAME . " " . DB_DATABASE . " < " . BACKUP_PATH . $path;
    exec($cmd);
      Header("Location: index.php?page=backupandrestore");
  } catch(Exception $e){
      die($e);
  }
