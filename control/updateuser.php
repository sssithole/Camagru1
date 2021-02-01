<?php
if (isset($_POST['update'])) {
    session_start();
    var_dump($_SESSION);
    include_once('config/setup.php');
    include_once('config/database.php');;
    $username = $_POST['username'];
    $mail = $_POST['email'];
    $passwd = $_POST['password'];

    // if (empty($username) || empty($mail) || empty($passwd)) {
    //     header("Location: updateUSER.php?error=emptyfields&user=" . $username . "&mail=" . $email);
    //     exit();
    // }
    // if (strlen($passwd) < 8) {
    //     header("Location: regform.php?error=pssword_short");
    //     exit();
    // } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    //     header("Location: updateUSER.php?error=invaliduseremail");
    //     exit();
    // } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    //     header("Location: updateUSER.php.php?error=invaliduser&mail=" . $email);
    //     exit();
    // } elseif (!preg_match("#[a-z]+#", $passwd)) {
    //     header("Location: updateUSER.php.php?error=lower_case");
    //     exit();
    //     exit();
    // } elseif (!preg_match("#[A-Z]+#", $passwd)) {
    //     header("Location: updateUSER.php?error=upper_case");
    //     exit();
    //     exit();
    // } else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    //     header("Location: updateUSER.php?error=invalidemail&user=" . $username);
    //     exit();
    // }

    try {
        $passwd = hash('sha1', $passwd);
        $pdo = "UPDATE `users` SET username=?, email=?, `password`= ? WHERE username=? ";
        $stmt = $conn->prepare($pdo);
        $result = $stmt->execute([$username, $mail, $passwd, $_SESSION["username"]]);
        var_dump($stmt);
        if ($result === TRUE) {
            //        $_SESSION['user'] = $name;
            header("location: ../view/home.php");
        } else {
            echo "data not stored";
        }
    } catch (PDOException $e) {

        echo "failed" . $e->getMEssage();
    }
}
