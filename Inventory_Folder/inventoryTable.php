<?php
include '../inventoryDb_connect.php';


unset($filterValue);

if (isset($_GET['search'])) {   
    $filterValue = $_GET['search'];
    // $sql = "SELECT * FROM inventory2 WHERE CONCAT(brand, category, itemCode, itemNumber, itemDesc_1, itemDesc_2, itemDesc_3) LIKE '%$filterValue%' ORDER BY inventory_Id DESC";
    $sql = "SELECT * FROM inventory2  WHERE CONCAT(itemCode, brand, category, itemCode, itemNumber, itemDesc_1, itemDesc_2, itemDesc_3) LIKE '%FLUIDS%' ORDER BY inventory_Id DESC";
    $sql = "SELECT * FROM inventory2  WHERE CONCAT(itemCode,brand,category,itemCode,itemDesc_1, itemDesc_2) LIKE '%$filterValue%' or '% %' ORDER BY inventory_Id DESC";

    unset($filterValue);
    
   
} 

else {
    $sql = "SELECT * FROM inventory2 ORDER BY inventory_Id DESC";
    unset($filterValue);
   
    
}

$result = mysqli_query($con, $sql); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
          <link rel="stylesheet" type="text/css" href="../uniStyle.css">
          <link rel="stylesheet" type="text/css" href="inventoryDesign.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

 
<title>Inventory Table</title>

    
</head>

<body>

<h2>DCH Inventory </h2>



<div class="header">


    <div class="link-container">
    <a href="../HomePage.php"  class="index-link">Home</a>
    <br>
    </div>

    <div class="link-container">
    <a href="../Inventory_Folder/inventoryTable.php"  class="index-link">Inventory</a>
    <br>
    
    </div>

    <div class="link-container">
    <a href="../Order_Folder/Order_Manager.php" class="index-link">Manage Orders</a>
    <br>

 </div>


    <div class="link-container">
    <a href="../Requesition_Folder/Requesiton_Manager.php"  class="index-link">Requesitions</a>
    <br>
    </div>

    <div class="link-container">
    <a href="../Supplier_Folder/Supplier_Table.php"  class="index-link">Suppliers</a>
    <br>
    </div>

    <div class="link-container">
    <a href="../PriceList_Folder/PriceList_Table.php" class="index-link" >Price List</a>
    <br>
    </div>


    <div class="link-container">
 <a href="../logout.php" class="index-link">Log Out</a>
    </div>

</div>



<div class="controls">
<h3 class='title'></h3> <br> 

<form action="" method="GET" class = "search-bar"> 
    
<button type="submit" class = "searchBtn btn btn-primary search-btn">Search</button>
    <label for="filter"></label>
    <input id = "search" type="text" class = "searchBox form-control" name = "search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>" class = "search-box" placeholder= "Search data"autocomplete="off"> 

    
</form>



<a href="inventory_Add.php" target="_blank" class = "links addBtn">Add New Item</a>
</div>

  

<div class="table-container">
    <table class="">
        <thead class = "table-head">
        <tr>

        <th scope="col">IMAGE</th>
        <th scope="col">ID</th>
        
            <th scope="col">#</th>
            <th scope="col">ITEM CODE</th>
            
            <th scope="col">BRAND</th>
            <th scope="col">CATEGORY</th>
            <th scope="col">ITEM DESCRIPTION</th>
            <th scope="col">PRICE</th>
            <th scope="col">UNITS</th>
            <th scope="col">TOTAL STOCK VALUE</th>
            <th scope="col">REQUESTED</th>
            <th scope="col">ORDERED</th>
            <th scope="col">LOCATION</th>
            <th scope="col">ACTIONS</th>
        </tr>
        </thead>
        
        <tbody id="tableBody">
       <?php
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $image = $row['image'];
        $inventory_Id = $row['inventory_Id'];
        $itemNumber = $row['itemNumber'];
        $itemCode = $row['itemCode'];
        $brand = $row['brand'];
        $category = $row['category'];
        $itemDesc_1 = $row['itemDesc_1'];
        $itemDesc_2 = $row['itemDesc_2'];
        $itemDesc_3 = $row['itemDesc_3'];
        $price = $row['price'];
        $units = $row['units'];
        $totalstockValue = $row['totalstockValue'];
        $requested = $row['requested'];
        $ordered = $row['ordered'];
        $active = $row['active'];
        $location = $row['location'];

        $requestedLink = $requested === "Pending" ? '<a href="../Requesition_Folder/Requesiton_Manager.php"  class = "pend">Pending</a>' : $requested;
        $orderedLink = $ordered === "Pending" ? '<a href="../Order_Folder/Order_Manager.php" class = "pend">Pending</a>' : $ordered;

        echo '
        <tr>
        <th scope="col"> <img src="../Images/'.$image.'" alt="../Images/gear.jpg" style = "width:100px;height:100px;" >  </th>
        <th scope="col">' . $inventory_Id . '</th>
            <th scope="col">' . $itemNumber . '</th>
            <th scope="col">' . $itemCode . '</th>
            <th scope="col">' . $brand . '</th>
            <th scope="col">' . $category . '</th>
            <th scope="col">' . $itemDesc_1 . " " . $itemDesc_2 . " " . $itemDesc_3 . '</th>
            <th scope="col">' . $price . '</th>
            <th scope="col">' . $units . '</th>
            <th scope="col">' . $totalstockValue . '</th>
            <th scope="col" class = "pending">' . $requestedLink . '</th>
            <th scope="col" class = "pending">' . $orderedLink . '</th>
                      <th scope="col" class = "pending">' . $location . '</th>
          
            <td>
              <a href="inventory_Update.php?updateId=' . $inventory_Id . '" target="_blank" class = "links">Update</a>
              <a href="inventory_Delete.php?deleteId=' . $inventory_Id . '" class = "links deleteConfirm" style = "background-color:red;"">Delete</a>
            </td>
        </tr>
        ';
    }
}
?>

        </tbody>
    </table>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="main.js"></script>


<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all links with the class 'confirm-link'
            var links = document.querySelectorAll('a.deleteConfirm');

            // Add click event listeners to all links
            links.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    // Show confirmation dialog
                    if (!confirm("Are you sure you want to proceed?")) {
                        // Prevent the default action of the link
                        event.preventDefault();
                    }
                });
            });
        });
    </script>

<script>
        function closeTab() {
            window.close();
        }
    </script>

<script>
        function confirmRedirect() {
            if (!confirm("Are you sure you want to Delete this data?")) {
        return false;
    }
        }
    </script>

<script>
        function clearSearch() {
            document.getElementById("search").value = "";
        }
    </script>


<script>

</script>


<script>

<?php
        // Check if the search form was submitted
        if (isset($_GET['search'])) {
            // Output JavaScript to clear the search input
            echo 'clearSearch();';
        }
        ?>

    function clearSearch() {
        document.getElementById("search").value = "";
    }
</script>

    
</body>
</html>
