<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="uniStyle.css">
</head>
<body>
    <div class="loginForm">

    <div class="formContent">

    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="username" class="log log-label">Username:</label><br>
        <input type="text" id="username" name="username" class="log txtBox" required><br>
        <label for="password" class="log log-label">Password:</label><br>
        <input type="password" id="password" name="password" required class="log txtBox"><br>
        <button type="submit" class="log log-btn">Login</button>
    </form>

    </div>
    
    </div>
    
</body>
</html>
