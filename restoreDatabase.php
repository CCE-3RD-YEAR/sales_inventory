<?php include('db_connect.php'); 

$path = $_POST['file'];

try{

    $path = "C:/" . $path;
    $username      = "root";
    $database_name = "sales_inventory_db";

    $cmd = "C:/xampp/mysql/bin/mysql -u {$username} {$database_name} < $path";
    exec($cmd);
      Header("Location: index.php?page=backupandrestore");
  } catch(Throwable $e){
      die($e);
  }

?>
