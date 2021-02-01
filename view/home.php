<?php
session_start();
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
            <a class="links" href="#">Camagru</a>
            <a class="links" href="gallery.php">Gallery</a>
            <a class="links" href="camera.php">Camera</a>
            <a class="links" href="uploadForm.php">upload</a>
                <div class="dropdown-menu">
                    <button class="menu-btn">Open <</button>
                    <div class="menu-content">
                    <a class="links-hidden" href="updateprof.php">update profile</a>
                    <a class="links-hidden" href="../model/logout.php"> logout </a>
                </div>
                </div>
            <a class="hamburger">☰</a>
        </nav>
    <?php
         include_once ('../config/setup.php');
         include_once ('../config/database.php');
        
        try{
            
        $sql = $conn->prepare("SELECT * FROM `images` ORDER BY `img_id` DESC");
      
        $sql->execute();
        // var_dump("kashklhfashf");
        // $row = $sql->fetch(PDO::FETCH_ASSOC);
        // var_dump($row);
        while ($row =  $sql->fetch(PDO::FETCH_ASSOC)){
               echo '<a href= "#">
                <div class="gallery-image" style= "background-image: url(../model/uploads/'.$row['images'].');"></div>
                </a>';     
                // var_dump('echo');
        }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    ?>

    <script>
    var x = document.getElementsByTagName("nav")[0];
    function toggleNav() {
        if (x.className === "") {
            x.className = " openNav";
        } else {
            x.className = "";
        }
    }
    document.querySelector(".hamburger").addEventListener("click", toggleNav);
</script>
</body>
</html>