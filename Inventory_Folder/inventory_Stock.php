<?php
 include '../inventoryDb_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the values from POST request
    $updateId = isset($_POST['updateId']) ? $_POST['updateId'] : 'Not provided';
    $stockInOut = isset($_POST['stockInOut']) ? $_POST['stockInOut'] : 'Not provided';
    $stockType = isset($_POST['stockType']) ? $_POST['stockType'] : 'Not provided';

    $stockName = isset($_POST['itemName']) ? $_POST['itemName'] : 'Not provided';
    $stockNumber = isset($_POST['itemNumber']) ? $_POST['itemNumber'] : 'Not provided';
    $stockCode = isset($_POST['itemCode']) ? $_POST['itemCode'] : 'Not provided';
    $stockBrand = isset($_POST['itemBrand']) ? $_POST['itemBrand'] : 'Not provided';
    $stockCategory = isset($_POST['itemCategory']) ? $_POST['itemCategory'] : 'Not provided';
    $stockLocation = isset($_POST['itemLocation']) ? $_POST['itemLocation'] : 'Not provided';
    $stockPrice = isset($_POST['itemPrice']) ? $_POST['itemPrice'] : 'Not provided';
    $stockUnits = isset($_POST['itemUnits']) ? $_POST['itemUnits'] : 'Not provided';

    // Print the values for debugging


    if($stockType === 'Stock Out'){

        $newStock = $stockUnits - $stockInOut;

        if($newStock <= 0){
            echo "<script>alert('Data Empty');</script>";
                    echo "<script>window.close();</script>";
        }

        else{
            $sql = "UPDATE inventory2 SET units = '$newStock' WHERE inventory_Id = $updateId;";

            $result = mysqli_query($con, $sql);
            if ($result) {
                
                $sql2 = "INSERT INTO activity(query, date_performed) VALUES ('" . mysqli_real_escape_string($con, $sql) . "', NOW())";
        
                if (mysqli_query($con, $sql2)) {
                    $sql3 = "INSERT INTO stock_history (
                        date_updated,
                        stock_name,
                        item_number,
                        item_code,
                        brand,
                        category,
                        location,
                        price,
                        units_added,
                        previous_units,
                        transaction_type
                    ) VALUES (
                        NOW(),
                        '".mysqli_real_escape_string($con, $stockName)."',
                        '".mysqli_real_escape_string($con, $stockNumber)."',
                        '".mysqli_real_escape_string($con, $stockCode)."',
                        '".mysqli_real_escape_string($con, $stockBrand)."',
                        '".mysqli_real_escape_string($con, $stockCategory)."',
                        '".mysqli_real_escape_string($con, $stockLocation)."',
                        '".mysqli_real_escape_string($con, $stockPrice)."',
                        '".mysqli_real_escape_string($con, $stockInOut)."',
                          '".mysqli_real_escape_string($con, $stockUnits)."',
                        '".mysqli_real_escape_string($con, $stockType)."'
                    )";
                            
                if (mysqli_query($con, $sql3)) {
                    echo "<script>alert('Data Updated');</script>";
                    echo "<script>window.close();</script>";
                    exit();
                } else {
                    echo 'Error logging activity: ' . mysqli_error($con);
                }
                    exit();
                } else {
                    echo 'Error logging activity: ' . mysqli_error($con);
                }
            } 
            
            else {
                echo 'Error updating data: ' . mysqli_error($con);
            }
        }

    }else{
        $newStock = $stockUnits + $stockInOut;
        $sql = "UPDATE inventory2 SET units = '$newStock' WHERE inventory_Id = $updateId;";

        $result = mysqli_query($con, $sql);
        if ($result) {
            
            $sql2 = "INSERT INTO activity(query, date_performed) VALUES ('" . mysqli_real_escape_string($con, $sql) . "', NOW())";
    
            if (mysqli_query($con, $sql2)) {
                $sql3 = "INSERT INTO stock_history (
                    date_updated,
                    stock_name,
                    item_number,
                    item_code,
                    brand,
                    category,
                    location,
                    price,
                    units_added,
                    previous_units,
                    transaction_type
                ) VALUES (
                    NOW(),
                    '".mysqli_real_escape_string($con, $stockName)."',
                    '".mysqli_real_escape_string($con, $stockNumber)."',
                    '".mysqli_real_escape_string($con, $stockCode)."',
                    '".mysqli_real_escape_string($con, $stockBrand)."',
                    '".mysqli_real_escape_string($con, $stockCategory)."',
                    '".mysqli_real_escape_string($con, $stockLocation)."',
                    '".mysqli_real_escape_string($con, $stockPrice)."',
                    '".mysqli_real_escape_string($con, $stockInOut)."',
                    '".mysqli_real_escape_string($con, $stockUnits)."',
                    '".mysqli_real_escape_string($con, $stockType)."'
                )";    
            if (mysqli_query($con, $sql3)) {
                echo "<script>alert('Data Updated');</script>";
                echo "<script>window.close();</script>";
                exit();
            } else {
                echo 'Error logging activity: ' . mysqli_error($con);
            }
                exit();
            } else {
                echo 'Error logging activity: ' . mysqli_error($con);
            }
        } 
        
        else {
            echo 'Error updating data: ' . mysqli_error($con);
        }
        

    }

}
?>