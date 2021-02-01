<?php

if(isset($_POST['login'])){
    
    session_start();

    include_once ('../config/setup.php');
    include_once ('../config/database.php');
    $error = array();
    $name = $_POST['username'];
    $passwd = $_POST['password'];
    $passwd = hash('sha1', $passwd);

    if (empty($name) || empty($passwd)) {
        header ("Location: loginform.php?error=emptyfields&user=".$name);
        exit();
   } 

try{
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE username = ? AND `password`= ?");
    $arr = array($name, $passwd);
    $stmt->execute($arr);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result === FALSE){
        echo "INCORRECT username or Password";
        header("location: ../view/loginForm.php");
    }else{
        $_SESSION['username'] =  $result['username'];
        $_SESSION['id'] = $result['id'];
        header("location: ../view/home.php");
    }
}catch(PDOException $e){
        echo "failed".$e->getMessage();
}
} 
