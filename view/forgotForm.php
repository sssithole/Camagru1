<?php
 $errors = NULL;
if(isset($_POST['forgot'])){
    include_once ('../config/setup.php');
    include_once ('../config/database.php');

    $mail = $_POST['email'];
    // $errors = '';

    try{

        $stmt = $conn->prepare("SELECT * FROM `camagru`.`users` WHERE email = ?");
        $stmt->execute([$mail]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo $result;
        if($result === TRUE){
            echo "incorrect email or email does not exists";
        }else{

                $msg = "click the link to reset your password : <a href='http://localhost:8082/camagru/restpass.php?email=$mail'>reset_password</a>";
                
            
                $headers = array('From: noreply');
        
                mail($mail, "Verificatin email", $msg, implode("\r\n", $headers));
                $errors = "Check your email and change password <br>";
        
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
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
    <!-- ?php include('forgotForm.php/header.php'); ? -->
   <form action="forgotForm.php" method="POST">
       <h1>forgot password</h1>
       email<input type="email" name="email"><br>
       <div class="red-text">
            <?php echo ($errors !== null)?'<p> ' . $errors . '</p>':null;?>
       </div>
       <button type="submit" name="forgot">submit</button>
   </form>
</body>
</html>