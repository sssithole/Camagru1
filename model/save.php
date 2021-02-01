<?php

   session_start();

   include_once ('../config/setup.php');
   include_once ('../config/database.php');

//    $user = $_SESSION['username'];
   $id = $_SESSION['id'];
   var_dump($id);
  
   $img = $_POST['img'];
//    var_dump($img);

    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $upload = imagecreatefromstring($data);
    $file = "camagru".uniqid().".png";
    $filedest = "uploads/".$file;
    $success = imagepng($upload, $filedest);
    
   
        try{
        
            $sql = "INSERT INTO `camagru`.`images` (id ,images) VALUES (?,?)";
       
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id,$file]);
        if($stmt){
            echo "Post added successful";
            // header("location: ../view/home.php");
        }else
            echo "Failed to add a post";
        }catch(PDOException $e){
            echo $e->getMessage();
        }

?>