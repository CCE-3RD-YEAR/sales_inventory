<?php

define("BACKUP_PATH", "C:/sql_files/");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "sales_inventory_db");
define("TBL_ATTEMPTS", "loginattempts");
define("DB_SERVER", "localhost");
define("TIME_PERIOD", "5 MINUTE");
define("ATTEMPTS_NUMBER", 3);

$conn= new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE)or die("Could not connect to mysql".mysqli_error($conn));

