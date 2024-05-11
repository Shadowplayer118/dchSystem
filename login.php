<?php
session_start();
include 'inventoryDb_connect.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the statement
    $stmt = $con->prepare("SELECT id, userType FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $userType); // Bind the result to variables
        $stmt->fetch(); // Fetch the result
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['userType'] = $userType; // Store the userType in the session

        if($userType =='Admin'){
            header('Location: HomePage.php');
            exit();
        }
        else{
            header('Location: d.php');
            exit();

        }
       
    } else {
        echo "<script>alert('This is an alert message!');</script>";
    }

    $stmt->close();
}
?>
