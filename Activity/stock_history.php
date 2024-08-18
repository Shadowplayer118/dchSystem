

<?php
include '../inventoryDb_connect.php';
$conditions = [];
$filterValue = isset($_GET['search']) ? $_GET['search'] : null;
$dateValue = isset($_GET['date']) ? $_GET['date'] : null;

if ($filterValue) {
    $conditions[] = "transaction_type LIKE '%$filterValue%'";
}

if ($dateValue) {
    $conditions[] = "DATE(date_updated) = '$dateValue'";
}

if (count($conditions) > 0) {
    $sql = "SELECT * FROM stock_history WHERE " . implode(' AND ', $conditions);
} else {
    $sql = "SELECT * FROM stock_history";
}

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../uniStyle.css">
    <link rel="stylesheet" type="text/css" href="inventoryDesign.css">
    <link rel="stylesheet" type="text/css" href="activity_design.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

    <title>Stock History</title>
</head>

<body>
    <!------Side----->
    <!-- <div class="link-container">
<a href="../HomePage.php"  class="index-link">Home</a>
<br>
</div> -->
<button onClick = "Close();" style="background-color:red; color:white;" >Close</button>

    <div class="whole-container">
        <h2>DCH Inventory</h2>
        <!------Top----->
        <div class="controls">
        <form action="" method="GET" class="search-bar">
                <label for="filter"></label>
                <select id="search" name="search" class="searchBox">
            
                    <option value="Stock In" <?php if($filterValue == 'Stock In') echo 'selected'; ?>>Stock In</option>
                    <option value="Stock Out" <?php if($filterValue == 'Stock Out') echo 'selected'; ?>>Stock Out</option>
                </select>

                <input type="date" name="date" value="<?php if(isset($_GET['date'])) { echo $_GET['date']; } ?>">
                <button type="submit" class="searchBtn btn btn-primary">Search</button>
            </form>
            <button onClick="resetToToday()" style="background-color:blue; color:white;">Today</button>
            <button onClick="checkInternet()" style="background-color:green; color:white;">Convert to Excel</button>
            <button onClick="copyTable()" style="background-color:orange; color:white;">Copy Table</button>
<div class="infoCont">
<div class="activitiesPer">Activities performed on:__</div>
<div class="calendar" data-filtervalue="<?php echo isset($calValue) ? $calValue : ''; ?>"></div>

</div>
           
        </div>


        <!------Center----->
        <div class="act-container">
            <table class="inventory-table" id = "inventory-table">
                <thead class="table-head">
                    <tr>
                        <th scope="col">Stock Name</th>
                        <th scope="col" id="date_col">Date Updated</th>
                        <th scope="col" id="date_col">Transaction Type</th>
                        <th scope="col" id="date_col">Units Added</th>
                        <th scope="col" id="date_col">Current Stocks</th>
                        <th scope="col" id="date_col">Previous Stock</th>


                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $stock_name = $row['stock_name'];
                            $date_updated = $row['date_updated'];
                            $transaction_type = $row['transaction_type'];
                            $units_added = $row['units_added'];
                            $current_stock = $row['current_stock'];
                            $previous_stock = $row['previous_units'];

                            echo '
                            <tr>
                                <td>' . $stock_name . '</td>
                                <td class="date-col">' . $date_updated . '</td>
                                <td>' . $transaction_type . '</td>
                                <td>' . $units_added . '</td>  
                                <td>' . $current_stock . '</td>  
                                <td>' . $previous_stock . '</td>  



                            </tr>
                            ';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="main.js"></script>

        <script>
            function Hide() {
                var dateCols = document.querySelectorAll('.date-col');
                dateCols.forEach(function(cell) {
                    cell.style.display = 'none';
                });
                var dateHeader = document.getElementById('date_col');
                dateHeader.style.display = 'none';
            }
        </script>
    


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


        function copyTable() {
                var table = document.getElementById("inventory-table");
                var range, sel;
                if (document.createRange) { // modern browsers
                    range = document.createRange();
                    range.selectNode(table);
                    sel = window.getSelection();
                    sel.removeAllRanges();
                    sel.addRange(range);
                    document.execCommand('copy');
                } else if (document.selection) { // IE
                    range = document.body.createTextRange();
                    range.moveToElementText(table);
                    range.select();
                    document.execCommand('copy');
                }
                alert('Table copied to clipboard!');
            }

            function Close(){
                window.close();
            }
    </script>

<script>
  function checkInternet() {
    if (navigator.onLine) {
      exportTableToExcel();  // If online, proceed with export
    } else {
      alert("You are offline. Please connect to the internet to download the Excel file.");
    }
  }

  function exportTableToExcel() {
    var table = document.getElementById("inventory-table");
    var wb = XLSX.utils.table_to_book(table, {sheet: "Sheet1"});
    XLSX.writeFile(wb, "table.xlsx");
  }
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Get the calendar element
    var calendar = document.querySelector('.calendar');
    
    // Get the filterValue from the data attribute
    var filterValue = calendar.getAttribute('data-filtervalue');
    
    // If filterValue is set, update the calendar content
    if (filterValue) {
        calendar.textContent = filterValue;
    } else {
        // If no filterValue, display the current date
        var today = new Date().toLocaleDateString();
        calendar.textContent = today;
    }
});

</script>

<script>
         function resetToToday() {
                var today = new Date().toISOString().split('T')[0];
                window.location.href = "?search=" + today;
            }
</script>






</div>
</body>
</html>
