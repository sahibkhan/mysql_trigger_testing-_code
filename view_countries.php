
<?php
ini_set("display_errors",1);
require_once('config.php');

$result_array_country= array();
$result_country = $pdo->query('CALL GetAllCountry()');

while ($row_country = $result_country->fetch()) 
{
     array_push($result_array_country, $row_country);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Test</title>
  <style>
    .container {
      margin: 0 auto;
      padding: 10px;
    }
    .error {
      width: 100%;
      color: red;
    }
    .success {
      width: 100%;
      color: green;
    }
   
  table {
    border-collapse: collapse;
  }
  table, th, td {
    border: 1px solid black;
  }
  </style>
</head>
<body>
<div class="container">
<p style="color: red;"><?php echo 'LAST INSERT ID '.$_GET['lastId'];?></p>
    
  <table width="90%" >
          <tr>
      <th>#</th>
      <th>Country Name</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  
    <?php for($i=0; $i<count($result_array_country); $i++){ ?>
  
    <tr>
      <td><?php echo $result_array_country[$i]['country_id']; ?></td>
      <td><?php echo $result_array_country[$i]['country_name']; ?></td>
      <td><?php echo $result_array_country[$i]['status']; ?></td>
   
      <td><a href="country_edit.php?id=<?php echo $result_array_country[$i]['country_id'] ?>">Edit</a>
      &nbsp;|&nbsp;<a onclick="return confirm('Are you sure you want to delete this country?');" 
      href="country_del.php?id=<?php echo $result_array_country[$i]['country_id'] ?>">Delete</a>
      </td>
    </tr>
    
    <?php } ?>
    
   </table>
</div>
</body>
</html>
