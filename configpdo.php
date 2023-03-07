<?php

ini_set("display_errors",1);
define('DB_SERVER', "localhost");

//database login name
define('DB_USER', "root");
//database login password
define('DB_PASS', "");

//database name
define('DB_DATABASE', "test");
require_once('libs/Database.class.php');

$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
// connect to the DB server

try {
      $pdo = $db->connect();
  // set the PDO error mode to exception
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


?>