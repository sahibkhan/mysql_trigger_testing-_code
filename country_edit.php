<?php
ini_set("display_errors",1);
require('config.php');


$id      = intval($_GET['id']);

if(isset($_POST['sub'])){

     $country_name = $_POST['country_name'];

      $status = $_POST['status'];

      //update data in database
       $sql = $pdo->query("CALL EditCountry('".$id."','".$country_name."','".$status."')");
       header('Location:view_countries.php');
    

     
   }


//Fetch existing record to edit
   $sql = $pdo->query("CALL GetCountryById('".$id."')");
  $result_country =  $sql->fetch();
  $id  = $result_country['country'];
  $country_name  = $result_country['country_name'];
  $status  = $result_country['status'];

?>
<!DOCTYPE html>

<html>

<head>

  <title>Update using stored procedure</title>

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
  </style>

</head>

<body>

<div class="container">

  <h2>Example  update of a record</h2>

  <form name="form1" method = "post">

    <input type="hidden" name='id' value="<?php echo $id; ?>" >

    <p>

    Country name:<br>
    <input type="text" placeholder='Country Name' name="country_name" value="<?php echo $country_name; ?>" required >
    </p>
    <p>
    Status:<br>
    <input type="text" name="status" value="<?php echo $status; ?>" required >
   </p>
   <p>
    <input type="submit" value="Add Country" name='sub'>
   </p>
  
  </form>

  <p>Upon clicking "Update" button</p>

</div>

</body>

</html>