<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    
</head>
<body>
    <div class="container">
        <form class="form" action="process.php" method="POST">
            <label>Username</label>
            <input type="text" name="username" id="username" class="user" required>

            <label>Email</label>
            <input type="email" name="email" id="email" class="email" required>

            <label>Password</label>
            <input type="password" name="password" id="password" class="pass" required>

            <label>Submit</label>
            <input type="submit" name="submit" id="submit" class="submit">

        </form>
    </div>
</body>
</html>
