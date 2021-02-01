<?php 
session_start();
var_dump($_SESSION)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    <nav>
        <a class="links" href="home.php" class="logo">Camagru</a>
    </nav>

    <form action="../control/updateuser.php" method="$_POST">
        username<input type="text" name="username" required><br>
        e-mail<input type="email" name="email" required><br>
        password<input type="password" name="password" required><br>
        <button type="submit" name="update">update</button>
    </form>
</body>
</html>