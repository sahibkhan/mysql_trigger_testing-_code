
<?php
require('pdo_connect.php');

$result_array = array();
//$result = $conn->query("select id, fname, email from subscribers");
$result = $conn->query('CALL GetAllStdentRecord()');
while ($row = $result->fetch()) {
   
     array_push($result_array, $row);
}


?>


<body>
<div class="container">

    
  <table width="90%" >
      <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Action</th>
    </tr>
  
    <?php for($i=0; $i<count($result_array); $i++){ ?>
  
    <tr>
      <td><?php echo $i+1 ?></td>
      <td><?php echo $result_array[$i]['name'] ?></td>
      <td><?php echo $result_array[$i]['total'] ?></td>
      <td><?php echo $result_array[$i]['per'] ?></td>
      
      <td><a href="subscriber_edit.php?id=<?php echo $result_array[$i]['id'] ?>" >Edit</a>
      &nbsp;|&nbsp;<a onclick="return confirm('Are you sure you want to delete this subscriber?');" 
      href="subscriber_del.php?id=<?php echo $result_array[$i]['id'] ?>">Delete</a>
      </td>
    </tr>
    
    <?php } 
?>
    
   </table>
</div>

<?php 
require('pdo_connect.php');
$result_array_country= array();
$result_country = $conn->query('CALL GetAllCountry()');

while ($row_country = $result_country->fetch()) 
{
   
     array_push($result_array_country, $row_country);
}
?>
<body>
<div class="container">

    
  <table>
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
   
     <td><a href="" >Edit</a>
      &nbsp;|&nbsp;<a onclick="return confirm('Are you sure you want to delete this subscriber?');" 
      href="">Delete</a>
      </td>
    </tr>
    
    <?php } ?>
    
   </table>
</div>
</body>
</html>
