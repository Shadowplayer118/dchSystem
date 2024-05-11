<?php
echo '<script>
if(confirm("Are you sure you want to Logout?")){
    window.location.href = "logoutUser.php";
} else {
    window.location.href = "Inventory_Folder/inventoryTable.php";
}
</script>';
exit();
?>
