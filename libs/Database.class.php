<?php
//require("config.inc.php");
//$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);

class Database {


var $server   = ""; //database server
var $user     = ""; //database login name
var $pass     = ""; //database login password
var $database = ""; //database name
var $pre      = ""; //table prefix

//internal info
var $error = "";
var $errno = 0;

//number of rows affected by SQL query
var $affected_rows = 0;

var $link_id = 0;
var $query_id = 0;

# desc: constructor
function Database($server, $user, $pass, $database, $pre=''){
	$this->server=$server;
	$this->user=$user;
	$this->pass=$pass;
	$this->database=$database;
	$this->pre=$pre;
}#-#constructor()


# Param: $new_link can force connect() to open a new link, even if mysql_connect() was called before with the same parameters
function connect($new_link=false) {

	try {
		$this->link_id = new PDO('mysql:host='.$this->server.';dbname='.$this->database, $this->user, $this->pass, array(
			PDO::ATTR_PERSISTENT=>true));
		$this->link_id->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $this->link_id;
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}

	// unset the data so it can't be dumped
	$this->server='';
	$this->user='';
	$this->pass='';
	$this->database='';
}#-#connect()

function beginTransaction()
{
	 return $this->link_id->beginTransaction();
}

function commit()
{
	return $this->link_id->commit();
}

function rollBack()
{
	return $this->link_id->rollBack();
}

# Desc: executes SQL query to an open connection
# Param: (MySQL query) to execute
# returns: (query_id) for fetching results etc
// function query($sql) {
	
// 	$Result =  $this->link_id->prepare($sql);
// 	// var_dump($Result);
// 	// exit;
// 	try
// 	{
// 		$Result->execute();
// 		$records = $Result->rowCount();
// 		return $records;
		
// 	}
// 	catch(PDOException $e)
// 	{
// 		print "Error !:".$e->getMessage();
// 		die();
// 	}
	
// }#-#query()


# desc: returns all the results (not one row)
# param: (MySQL query) the query to run on server
# returns: assoc array of ALL fetched results
// function fetch_all_array($sql) {
	
// 	$Result =  $this->link_id->prepare($sql);
	
// 	try
// 	{
// 		$Result->execute();
// 		$records = $Result->fetchAll(PDO::FETCH_ASSOC);
// 		return $records;
		
// 	}
// 	catch(PDOException $e)
// 	{
// 		print "Error !:".$e->getMessage();
// 		die();
// 	}
	
// }#-#fetch_all_array()


# desc: returns all the results (not one row)
# param: (MySQL query) the query to run on server
# returns: assoc array of ALL fetched results
// function fetch_array($sql) {
	
// 	$Result =  $this->link_id->prepare($sql);
	
// 	try
// 	{
// 		$Result->execute();
// 		$records = $Result->fetch(PDO::FETCH_ASSOC);
// 		return $records;
		
// 	}
// 	catch(PDOException $e)
// 	{
// 		print "Error !:".$e->getMessage();
// 		die();
// 	}
	
// }#-#fetch_all_array()

# desc: returns all the results (not one row)
# param: (MySQL query) the query to run on server
# returns: assoc array of ALL fetched results
// function query_first($sql) {
	
// 	$Result =  $this->link_id->prepare($sql);
	
// 	try
// 	{
// 		$Result->execute();
// 		$records = $Result->fetch();
// 		return $records;
		
// 	}
// 	catch(PDOException $e)
// 	{
// 		print "Error !:".$e->getMessage();
// 		die();
// 	}
	
// }#-#fetch_all_array()

# desc: does an update query with an array
# param: table (no prefix), assoc array with data (doesn't need escaped), where condition
# returns: (query_id) for fetching results etc
// function query_update($table, $data, $where='1') {
// 	$q="UPDATE `".$this->pre.$table."` SET ";

// 	foreach($data as $key=>$val) {
// 		if(strtolower($val)=='null') $q.= "`$key` = NULL, ";
// 		elseif(strtolower($val)=='now()') $q.= "`$key` = NOW(), ";
//         elseif(preg_match("/^increment\((\-?\d+)\)$/i",$val,$m)) $q.= "`$key` = `$key` + $m[1], "; 
// 		else $q.= "`$key`='".$val."', ";
// 	}

// 	$q = rtrim($q, ', ') . ' WHERE '.$where.';';
	
// 	$Result1 = $this->link_id->prepare($q);
// 	try
// 	{
// 		$sth = $Result1->execute();
// 		if($sth)
// 		{
// 			return $this->link_id->lastInsertId();
// 		}
// 	}
// 	catch(PDOException $e)
// 	{
// 		//echo $q."<br>";
// 		print("Error on line: ".__LINE__." ". $e->getMessage());
// 		//die();
// 	} 
	   

// }#-#query_update()

// # desc: does an insert query with an array
// # param: table (no prefix), assoc array with data
// # returns: id of inserted record, false if error
// function query_insert($table, $data) {
// 	$q="INSERT INTO `".$this->pre.$table."` ";
// 	$v=''; $n='';

// 	foreach($data as $key=>$val) {
// 		$n.="`$key`, ";
// 		if(strtolower($val)=='null') $v.="NULL, ";
// 		elseif(strtolower($val)=='now()') $v.="NOW(), ";
// 		else $v.= "'".$val."', ";
// 	}

// 	$q .= "(". rtrim($n, ', ') .") VALUES (". rtrim($v, ', ') .");";
	
// 	try
// 	{
// 		$Result1 = $this->link_id->prepare($q);
// 		$sth = $Result1->execute();
// 		if($sth)
// 		{
// 			return $this->link_id->lastInsertId();
// 		}
// 	}
// 	catch(PDOException $e)
// 	{
// 	  print("Error on line: ".__LINE__." ". $e->getMessage());
// 	  //exit();
// 	} 

// }#-#query_insert()
// public function lastInsertId(){
	
//         return $this->link_id->lastInsertId();
//     }


}//CLASS Database


?>