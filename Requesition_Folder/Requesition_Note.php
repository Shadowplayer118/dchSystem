<?php
include '../inventoryDb_connect.php';
$id = $_GET['ReqId'];

$sql = "SELECT  inventory2.inventory_Id,requisition.requisition_id,inventory2.itemDesc_1, inventory2.itemDesc_2, inventory2.itemDesc_3,inventory2.brand,requisition.units, requisition.status,requisition.note,requisition.prepared_by,requisition.received_by,requisition.date_requested
FROM requisition
INNER JOIN inventory2 ON requisition.inventory_Id = inventory2.inventory_Id
where requisition_id = $id";

$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);

$note = $row['note'];

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
 
    <title>Requisition Note</title>
</head>

<body>
    <div class="container my-5">
        <h1>Requisition Note</h1>

        <?php
        // Check if $note is null
        if ($note === null) {
            $note = "Note is empty";
        }

        // Embed JavaScript to show the alert and close the tab
        echo "<script>
            var confirmation = window.confirm('$note');
            if (confirmation) {
                window.close();
            }
        </script>";
        ?>

        <?php echo $note;?>

        <br>
        <button id="closeButton" class="btn btn-primary">Close</button>

        <script>
            // Add event listener to the button to close the tab
            document.getElementById('closeButton').addEventListener('click', function() {
                window.close();
            });
        </script>
    </div>
</body>
</html>
