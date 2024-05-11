<?php
include '../inventoryDb_connect.php';


if(isset($_POST['submit'])){
    $contact_details = $_POST['contact_details'];
    $company_name = $_POST['company_name'];
    $agent_firstname = $_POST['agent_firstname'];
    $agent_middlename = $_POST['agent_middlename'];
    $agent_lastname = $_POST['agent_lastname'];
    
    $totalstockValue = floatval($price) * intval($units);

    $sql = "INSERT INTO supplier (contact_details, company_name, agent_firstname, agent_middlename, agent_lastname)
            VALUES ('$contact_details', '$company_name', '$agent_firstname', '$agent_middlename', '$agent_lastname')";

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
 
    <title>Add New Supplier</title>
</head>


<body>


<form method = "post">
<div class = "container my-5">
<h1>Add New Supplier</h1>
<div class="form-group">
    <label>Contact Details</label>
    <input type="text" class="form-control"  placeholder="Enter contact details" name="contact_details" autocomplete = "off">

    <div class="form-group">
    <label>Company Name</label>
    <input type="text" class="form-control"  placeholder="Enter company name" name="company_name" autocomplete = "off">

    <div class="form-group">
    <label>Agent First Name</label>
    <input type="text" class="form-control"  placeholder="Enter agent firstname" name="agent_firstname" autocomplete = "off">

    <div class="form-group">
    <label>Agent Middle Name</label>
    <input type="text" class="form-control"  placeholder="Enter agent middlename" name="agent_middlename" autocomplete = "off">

    <div class="form-group">
    <label>Agent Last Name</label>
    <input type="text" class="form-control"  placeholder="Enter agent lastname" name="agent_lastname" autocomplete = "off">

   
  
  <br>
  <button name="submit" class="btn btn-primary">Submit</button>  <button name="cancel" class="btn btn-danger" onclick="closeTab()">Cancel</button>


<script>
function closeTab() {
    window.close();
}
</script>
</form>



</div>
    
</body>
</html>