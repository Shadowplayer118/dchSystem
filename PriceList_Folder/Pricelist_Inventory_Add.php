<?php
include '../inventoryDb_connect.php';

$id = $_GET['ItemId'];

$sql = "SELECT * FROM inventory2 WHERE inventory_Id = $id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$inventory_Id = $row['inventory_Id'];
$itemNumber = $row['itemNumber'];
$itemCode = $row['itemCode'];
$brand = $row['brand'];
$category = $row['category'];
$itemDesc_1 = $row['itemDesc_1'];
$itemDesc_2 = $row['itemDesc_2'];
$itemDesc_3 = $row['itemDesc_3'];
$price = $row['price'];

$totalstockValue = $row['totalstockValue'];

if (isset($_POST['submit'])) {
  
   
    $recieved_by = $_POST['recieved_by'];


    foreach ($_POST['selected_supplier'] as $selected_supplier) {
        if(isset($_POST['selected_price'][$selected_supplier])) {
            $selected_price = $_POST['selected_price'][$selected_supplier];
            $total_price = floatval($selected_price) * intval($units);

            // Insert into price_list table
            $sql3 = "INSERT INTO price_list (inventory_Id, supplier_Id, dealer_price) 
            VALUES ($id, '$selected_supplier', '$selected_price')";

            $result = mysqli_query($con, $sql3);
            if (!$result) {
                echo 'Error inserting data into price_list: ' . mysqli_error($con);
            }
        }
    }

    echo "<script>alert('Data inserted successfully!');</script>";
    echo "<script>window.close();</script>";
 
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <title>Add Inventory Price List</title>
</head>

<body>

    <form method="post">
        <div class="container my-5">
            <h1>Add Suppliers Price for:</h1>
            <h1><?php echo $brand . ' ' . $itemDesc_1 . ' ' . $itemDesc_2 . ' ' . $itemDesc_3; ?></h1>

            <button name="submit" class="btn btn-primary">Add</button>
            <button name="cancel" class="btn btn-danger" onclick="closeTab()">Cancel</button>

            <div class="form-group">
                <label>Filter</label>
                <input type="text" class="form-control" placeholder="Enter Company Name or Supplier Name" name="total_price" autocomplete="off"
                    style = "width:50%;">
                    <button>Filter</button>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Supplier Id</th>
                        <th scope="col">Image</th>
                        <th scope="col">Contact Details</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Agent Name</th>
                        <th scope="col">Select</th>
                        <th scope="col">Agent Price</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php
                    $sql = "SELECT * FROM supplier";
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $supplier_Id = $row['supplier_Id'];
                            $contact_details = $row['contact_details'];
                            $comapny_name = $row['company_name'];
                            $agent_firstname = $row['agent_firstname'];
                            $agent_middlename = $row['agent_middlename'];
                            $agent_lastname = $row['agent_lastname'];

                            echo '
                            <tr>
                                <td>' . $supplier_Id . '</td>
                                <td>image</td>
                                <td>' . $contact_details . '</td>
                                <td>' . $comapny_name . '</td>
                                <td>' . $agent_firstname . ' ' . substr($agent_middlename, 0, 1) . '. ' . $agent_lastname . '</td>
                                <td><input type="checkbox" name="selected_supplier[]" value="' . $supplier_Id . '"></td>
                                <td><input type="text" class="form-control agent-price" placeholder="Enter Price" name="selected_price['.$supplier_Id.']" autocomplete="off" disabled></td>
                            </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const input = this.parentElement.nextElementSibling.querySelector('input.agent-price');
                    input.disabled = !this.checked;
                    if (!this.checked) {
                        input.value = '';
                    }
                });
            });
        });

        function closeTab() {
            window.close();
        }
    </script>

</body>

</html>
