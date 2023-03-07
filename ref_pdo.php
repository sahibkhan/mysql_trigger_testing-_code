<?php
ini_set("display_errors",1);
require_once('configpdo.php');


    $date = date('y');
    $text = 'AMN';
    //$qry = "SELECT * FROM `vtiger_cargoinsurancecf` ORDER BY `vtiger_cargoinsurancecf`.`cf_3621` DESC LIMIT 1";
     $qry = "SELECT * FROM `vtiger_cargoinsurancecf` ORDER BY `vtiger_cargoinsurancecf`.`cf_3623` ASC ";

    $sql = $pdo->query($qry);
    $i=1;
     while ($row =  $sql->fetch()) 
     {
             $CargID = $row['cargoinsuranceid'];
            // echo "<br>";
	     	 $arr = explode("-",$row['cf_3621']);
	     	 //echo $arr[0];
	     	 $sql_num=explode("/",$arr[1]);
	     	 $sql_date= $sql_num[1];
	     	 //$sqlNo =  $sql_num[0]+$i;
	     	 $sqlNo = $i;
	     	 $ref_no = str_pad($sqlNo, 5, "0", STR_PAD_LEFT);
	        
	         $wis_ref_no = $arr[0].'-'.$ref_no.'/'.$sql_date;
	        //echo $wis_ref_no;
	     	//echo $text.'-'00001.'/'.$date;
	         
	         $qry_update = "UPDATE `vtiger_cargoinsurancecf` SET cf_3621 = '".$wis_ref_no."' WHERE  cargoinsuranceid = '".$CargID."'";
	         //echo $qry_update;
	         
	        $sql_update = $pdo->query($qry_update);
	        //exit;
	         echo "<br>";
	          
	    $i++;
     }
 

?>