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
            $per_page = 5;
        if (isset($_GET['page']))
        {
            $page = $_GET['page'] -1;
            $offset = $page * $per_page;
        }
        else{
            $page = 0;
            $offset = 0;
        }
        $images_pp = 5;
        $stmnt = $conn->prepare("SELECT count(img_id) FROM images ORDER by img_id DESC");
       
        $stmnt->execute();
        $row = $stmnt->fetch();
        
        // *****$total_rows = sizeof($row);
        // *****$total_pages = ceil($total_rows/$images_pp);
        $total_pages = $row[0];

        
        if($total_pages > $per_page){
            $page_total = ceil($total_pages/$per_page);
            $page_up = $page + 2;
            $page_down = $page;
            $display = '';//class to hide page count and buttons in only one page
        }
        else {//Else if there is only one page
            $pages = 1;
            $pages_total = 1;
            $display = ' class="display-none"';//class to hide page count and buttons if only one page
        }

        

        if ($page) {
            echo '<a href="index.php"><button><<</button></a>';//Button for first page [<<]
            echo '<a href="index.php?page='.$page_down.'"><button><</button></a>';//Button for previous page [<]
        }

        for ($i=1;$i<=$pages_total;$i++) {
            if(($i==$page+1)) {
            echo '<a href="index.php?page='.$i.'"><button class="active">'.$i.'</button></a>';//Button for active page, underlined using 'active' class
            }

            if(($i!=$page+1)&&($i<=$page+3)&&($i>=$page-1)) {//This is set for two below and two above the current page
            echo '<a href="index.php?page='.$i.'"><button>'.$i.'</button></a>'; 
        }
        }
         
        if (($page + 1) != $pages_total) {
            echo '<a href="index.php?page='.$page_up.'"><button>></button></a>';//Button for next page [>]
            echo '<a href="index.php?page='.$pages_total.'"><button>>></button></a>';//Button for last page [>>]
        }

        echo "</div>";// #pageNav end
        echo '<div id="gallery">';
        $show = "SELECT * FROM `images` ORDER BY `img_id` DESC LIMIT ?,?";
        $sql = $conn->prepare($show);
        $arr = array($offset,$per_page);
        $sql->execute($arr);
        
        var_dump("it out the while");

        while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
            $image=$row['img_id'];
            var_dump($image + 1);
            var_dump("it in the while");
            echo '<div class="img-container">';
            echo '<div class="img">';

            echo '<a href="../model/uploads/'.$image.'">';
            echo '<img src="../model/uploads/'.$image.'">';
            echo '</a>';

            echo '</div>';
            echo '</div>';// .img-container end
        }

        echo '<h2'.$display.'>'; echo $page + 1 .' of '.$pages_total.'</h2>';//Page out of total pages
        $i = 1;
        echo '<div id="pageNav"'.$display.'>';
    }catch(PDOException $e){
        echo $e->getMessage();
    }  
?>