<?php

$error = NULL;

if(isset($_POST['register'])){
    session_start();

    include_once ('../config/setup.php');
    include_once ('../config/database.php');

    $error = array('email'=>'','username'=>'','password'=>'');
    $username = $_POST['username'];
    $mail = $_POST['email'];
    $passwd = $_POST['password'];
    
    $exists = FALSE;
    // if (!preg_match("#.^(?=.{8,20})(?=.[a-z])(?=.[A-Z])(?=.[0-9]).*$#", $password)){
    //     header("Location: regform.php?error=no-Upper/Lower-or-Number");
    //     exit();
    // }
     if (empty($username) || empty($mail) || empty($passwd)) {
         		header ("Location: regform.php?error=emptyfields&user=".$username."&mail=".$email);
         		exit();
            } 
    else if(strlen($passwd) < 8){
        $error['password'] = 'password to short'; 
        header ("Location: regform.php?error=pssword_short");
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username) && !filter_var($mail, FILTER_VALIDATE_EMAIL)){
            header ("Location: ../register.php?error=invaliduseremail");
           	exit();
            } 
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            header ("Location: regform.php?error=invaliduser&mail=".$email);
            exit();
          	} 
             //Check if input email & password are valid characters 
    // else if (!preg_match("/^[a-zA-Z0-9]*$/", $passwd)){
    //         header ("Location: regform.php?error=invalidpassword");
    //         exit();
    //         } 
            //Check if email is valid
    elseif(!preg_match("#[a-z]+#",$passwd)) {
        header ("Location: regform.php?error=lower_case");
        exit();
            }
    elseif(!preg_match("#[A-Z]+#",$passwd)) {
        header ("Location: regform.php?error=upper_case");
        exit();
            }
    else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            header ("Location: regform.php?error=invalidemail&user=".$username);
            exit();
            }
    
         
try{
    
    $passwd = hash('sha1', $passwd);
    $pdo = "SELECT * FROM `users` WHERE username = ?";
    $stmt = $conn->prepare($pdo);
    $stmt->execute([$username]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if($result){
        $exists = TRUE;
        echo "Username already exists<br>";
        header("Location: ../view/loginForm.php");
    }else{
        echo "account created<br>";
        $verification_code = hash('sha1', $username);
    }

}catch(PDOException $e){
    echo $e->getMessage();
}


if(!$exists){
    try{
        $pdo = "INSERT INTO `camagru`.`users` (username, email, `password`, ver_code, ver) VALUES
        (?,?,?,?,?)";
        $stmt = $conn->prepare($pdo);
        $arr = array($username, $mail, $passwd, $verification_code, '1');
        $stmt->execute($arr);

        // $msg = "click the link verifiy your account : <a href='http://localhost:8082/camagru/index.php?ver_code=$verification_code'>verifiy</a>";

        // //http://127.0.0.1:8082/cam2/abc.php?ver_code=$verification_code;
    
        // $headers = array('From: noreply');

        // mail($mail, "Verificatin email", $msg, implode("\r\n", $headers));
        // $error = "Check your email<br>";
        // header("Location: ../view/registerForm.php?error=check+your+email".$username);
        $subject = "Camargru Verification mail";
         
        $message = "<b>This is HTML message.</b>";
        $message .= "<h1>This is headline.</h1>";
        
        $header = "From:abc@somedomain.com \r\n";
        $header .= "Cc:afgh@somedomain.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $retval = mail ($mail,$subject,$message,$header);
         
        if( $retval == true ) {
           echo "Message sent successfully...";
           header("Location: ../view/loginForm.php?error=check+your+email".$username);
        }else {
           echo "Message could not be sent...";
           header("Location: ../view/registerForm.php?error=check+your+email".$username);
        }

    
    }catch(PDOException $e){
        echo "<br>". $e->getMessage();
    }
    }

}
?>