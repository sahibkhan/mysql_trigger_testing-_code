<?php 
   ini_set("display_errors",1);
   require_once('config.php');
      $rs = $pdo->query("CALL UPDATE_LAST_INSERT_ID(@LAST_ID)");
      
      var_dump($rs);
      exit;
      $rs_last_id = $pdo->query("SELECT @LAST_ID as LAST_INSERT_ID");
      $row = $rs_last_id->fetchObject();
      echo $row->LAST_INSERT_ID;
      $lastID = $pdo->query("CALL Insertlast_insert('".$row->LAST_INSERT_ID."')");
      if($lastID==true){
         echo "vtiger_crmentity is upated successfully";
      }else{ echo 'Entry value failed';}

 ?>
	