<?php
ini_set("display_errors",1);
require_once('config.php');
$id  = intval($_GET['id']);

if($id){
  $sql = $pdo->query("CALL DelCountry($id)");

  header("Location: view_countries.php");

  exit;
}