

<?php
include '../inventoryDb_connect.php';

unset($filterValue);



if (isset($_GET['search'])) {   
    $filterValue = $_GET['search'];
    // Example: Adjust this query to match your requirements
    $sql = "SELECT * FROM activity WHERE date_performed LIKE '%$filterValue%'";
    unset($filterValue);
} else {
    $sql = "SELECT * FROM activity WHERE date_performed = CURDATE();";

    unset($filterValue);
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
    <title>Activity</title>
</head>

<body>
    <!------Side----->
    <!-- <div class="link-container">
<a href="../HomePage.php"  class="index-link">Home</a>
<br>
</div> -->

<button onClick = "Close();">Close</button>

    <div class="whole-container">
        <h2>DCH Inventory</h2>

        <!------Top----->
        <div class="controls">
            <form action="" method="GET" class="search-bar"> 
                <button type="submit" class="searchBtn btn btn-primary search-btn links">Search</button>
                <label for="filter"></label>
                <input id="search" type="date" class="searchBox" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>" class="search-box" placeholder="Search data" autocomplete="off" required> 
            </form>
            <button onClick="Hide()">Format to Copy</button>
            <button onClick="copyTable()">Copy Table</button>
        </div>

        <!------Center----->
        <div class="act-container">
            <table class="inventory-table" id = "inventory-table">
                <thead class="table-head">
                    <tr>
                        <th scope="col">/*---Query--*/</th>
                        <th scope="col" id="date_col">Date</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <?php
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $query = $row['query'];
                            $date_performed = $row['date_performed'];
                            echo '
                            <tr>
                                <td>' . $query . '</td>
                                <td class="date-col">' . $date_performed . '</td>
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






</div>
</body>
</html>
