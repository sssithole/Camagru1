<?php
if (isset($_POST['update'])) {
    session_start();
    
    include_once('../config/setup.php');
    include_once('../config/database.php');
    $username = $_POST['username'];
    $mail = $_POST['email'];
    $passwd = $_POST['password'];

    try {
        $passwd = hash('sha1', $passwd);
        $pdo = "UPDATE `users` SET username=?, email=?, `password`= ? WHERE username=? ";
        $stmt = $conn->prepare($pdo);

        $arr = array($username, $mail, $passwd, $_SESSION["username"]);

        $result = $stmt->execute($arr);
       
        if ($result === TRUE) {
            
            header("location: ../view/home.php");
        } else {
            echo "data not stored";
        }
    } catch (PDOException $e) {

        echo "failed" . $e->getMEssage();
    }
}
