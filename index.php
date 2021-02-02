<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Camagru</title>
</head>
<body>
    <nav>
        <a class="links" href="home.php" class="logo">Camagru</a>
    </nav>
    <div class="index">
        <div class="child">
            <a href='./view/loginForm.php'><button type="button" >login</button></a>
            <a href='./view/registerForm.php'><button type="button" >signup</button></a>
        </div>
    </form>
    </div>
    <?php
         include_once ('config/setup.php');
         include_once ('config/database.php');
        
        try{
            
        $sql = $conn->prepare("SELECT * FROM `images` ORDER BY `img_id` DESC");
        $sql->execute();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
          
               echo '<a href= "#">
                <div class="gallery-image" style= "background-image: url(model/uploads/'.$row['images'].');"></div>
                </a>';     
                
        }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    ?>
</body>
</html>
