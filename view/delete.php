<?php

    $email = NULL;
    session_start();
    var_dump($_SESSION['username']);
    include_once ('../config/setup.php');
    include_once ('../config/database.php');
    $id = $_GET['imgId'];
    var_dump($id);

    try{
        $pdo = "DELETE FROM images WHERE img_id = ? AND id = ?";
        $stmt = $conn->prepare($pdo);
        $result = $stmt->execute([$id, $_SESSION['id']]);
        if($result === FALSE){
          //  $_SESSION['user'] = $name;
           // echo "DElet";
           header ("Location: gallery.php");
           exit();
        }else{
            
            $email = "data not stored";
            // header("Location: gallery.php?php echo ".$_GET['imgId'];."");
            header("Location: gallery.php?error=invalid_data=".$email);
        }

    }catch(PDOException $e){
        echo $e->getMessage();

    }

?>