<?php
include '../inventoryDb_connect.php';
$id = $_GET['supplierId'];


$sql = "select * from supplier where supplier_Id = $id";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
$contact_details = $row['contact_details'];
$company_name = $row['company_name'];
$agent_firstname = $row['agent_firstname'];
$agent_middlename = $row['agent_middlename'];
$agent_lastname = $row['agent_lastname'];



if(isset($_POST['submit'])){
    $contact_details = $_POST['contact_details'];
    $company_name = $_POST['company_name'];
    $agent_firstname = $_POST['agent_firstname'];
    $agent_middlename = $_POST['agent_middlename'];
    $agent_lastname = $_POST['agent_lastname'];


    $sql = "UPDATE supplier SET contact_details = '$contact_details', company_name = '$company_name', agent_firstname = '$agent_firstname', 
    agent_middlename = '$agent_middlename', agent_lastname = '$agent_lastname'  where supplier_Id  = $id";
          
    $result = mysqli_query($con, $sql);
    if($result){
        echo "<script>alert('Data inserted successfully!');</script>";
        echo "<script>window.close();</script>";
        exit();
    } else{
        echo 'Error inserting data: ' . mysqli_error($con);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
 
    <title>Update Supplier</title>
</head>


<body>


<form method = "post">
<div class = "container my-5">
<h1>Update Supplier</h1>
<div class="form-group">
    <label>Contact Details</label>
    <input type="text" class="form-control"  placeholder="Enter contact details" name="contact_details" autocomplete = "off"
    value = <?php echo $contact_details;?>>

    <div class="form-group">
    <label>Company Name</label>
    <input type="text" class="form-control"  placeholder="Enter company name" name="company_name" autocomplete = "off"
    value = <?php echo $company_name;?>>

    <div class="form-group">
    <label>Agent First Name</label>
    <input type="text" class="form-control"  placeholder="Enter agent first name" name="agent_firstname" autocomplete = "off"
    value = <?php echo $agent_firstname;?>>

    <div class="form-group">
    <label>Agent Middle Name</label>
    <input type="text" class="form-control"  placeholder="Enter agent middle name" name="agent_middlename" autocomplete = "off"
    value = <?php echo $agent_middlename;?>>

    <div class="form-group">
    <label>Agent Last Name</label>
    <input type="text" class="form-control"  placeholder="Enter agent last name" name="agent_lastname" autocomplete = "off"
    value = <?php echo $agent_lastname;?>>

    

   
  
  <br>
  <button name="submit" class="btn btn-primary">Update</button>
  <button name="cancel" class="btn btn-danger" onclick="closeTab()">Cancel</button>


<script>
function closeTab() {
    window.close();
}
</script>


</form>



</div>
  



 


    
</body>
</html>

