<?php $error = NULL;
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
    <div class="login"> 
    <div class="child">
        <form action="../control/register.php" method="POST">
        username<input type="text" name="username"><br>
        <!-- <div class="red-text">?php echo $error['password']; ?></div> -->
        e-mail<input type="email" name="email"><br>
        password<input type="password" name="password"><br>
        <div class="red-text">
            <?php echo ($errors !== null)?'<p> ' . $errors . '</p>':null; ?>
        </div>
        <button type="submit" name="register">REGISTER</button><br>
        <br>if already have an account<a href='loginForm.php'><button type="button" >login</button></a> 
        </form>
    </div>
    </div>
</body>
</html>