<?php

ini_set("display_errors",1);
require_once('config.php');


    $date = date('y');
    $text = 'AMN';
    //$qry = "SELECT * FROM `vtiger_cargoinsurancecf` ORDER BY `vtiger_cargoinsurancecf`.`cf_3621` DESC LIMIT 1";
     $qry = "SELECT * FROM `vtiger_cargoinsurancecf` ORDER BY `vtiger_cargoinsurancecf`.`cf_3623` ASC";
    $sql = mysqli_query($con,$qry);
   // $sql = $pdo->query($qry);
    //$ref_no =  mysqli_fetch_array($sql);
    $i=1;
     while ($row =  mysqli_fetch_array($sql)) 
     {
           $CargID = $row['cargoinsuranceid'];

	     	 $arr = explode("-",$row['cf_3621']);
	     	 //echo $arr[0];
	     	 $sql_num=explode("/",$arr[1]);
	     	 $sql_date= $sql_num[1];
	         $sqlNo =  $sql_num[0]+$i;
	     	  
	     	 $ref_no = str_pad($sqlNo, 5, "0", STR_PAD_LEFT);
	        
	         $wis_ref_no = $arr[0].'-'.$ref_no.'/'.$sql_date;
	        //echo $wis_ref_no;
	     	//echo $text.'-'00001.'/'.$date;
	          $i++;
	        $qry_update = "UPDATE `vtiger_cargoinsurancecf` SET cf_3621 = '".$wis_ref_no."' WHERE  cargoinsuranceid = '".$CargID."';";
	         echo $qry_update;
	         echo "<br>";
	         $sql_update = mysqli_query($con,$qry_update);
	        
	         //echo $i;
	         //echo "<br>";
	          
	   
     }
 

?>