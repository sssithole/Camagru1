<?php
session_start();
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" href="../css/style.css">
</head>

    <nav>
        <a class="links" href="home.php" class="logo">Camagru</a>
    </nav>
<?php
       include_once ('../config/setup.php');
       include_once ('../config/database.php');
        
    try{
        if (isset($_GET['pageno']))
        {
            $pageno = $_GET['pageno'];
        }
        else
            $pageno = 0;
        $images_pp = 5;
        $stmnt = $conn->prepare("SELECT * FROM images");
        $stmnt->execute();
        $row = $stmnt->fetch();
        $total_rows = sizeof($row);
        $total_pages = ceil($total_rows/$images_pp);
        
        $sql = $conn->prepare("SELECT * FROM `camagru`.`images` ORDER BY `img_id` DESC LIMIT $pageno, 5");
        
        $sql->execute();
        
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
              
               echo '<A href= "commentsf.php?imgId='.$row['img_id'].'">
                <DIV class="gallery-image" style= "background-image: url(../model/uploads/'.$row['images'].');"></DIV>
                <h3>comments</h3>
                </A>';
             
        }
        echo $total_pages;
        echo $total_rows;
        for ($i=1;$i<= $total_pages;$i++)
        {
            echo '<a href= "gallery.php?pageno='.$i.'"> '.$i.'</a>';
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }  
?>