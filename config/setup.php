<?php
    include_once('database.php');
    try{

        $conn = new PDO('mysql:host='.$dbHost, $dbUsername, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE IF NOT EXISTS `$dbName`";
        $conn->exec($sql);
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
    $conn = NULL;
    try{
        $conn = new PDO($dbServername, $dbUsername, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("CREATE TABLE IF NOT EXISTS `users` ( 
		`id` INT NOT NULL AUTO_INCREMENT , 
		`username` VARCHAR(50) NOT NULL , 
		`email` VARCHAR(50) NOT NULL , 
		`password` VARCHAR(250) NOT NULL , 
		`notifications` BOOLEAN NOT NULL DEFAULT TRUE , 
		`ver_code` VARCHAR(250) NOT NULL , 
		`ver` BOOLEAN NOT NULL DEFAULT FALSE , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
        $stmt->execute();

    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }

    try{
        $conn = new PDO($dbServername, $dbUsername, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("CREATE TABLE IF NOT EXISTS `gallery` (
			`user_id` INT NOT NULL AUTO_INCREMENT ,
			`id` INT NOT NULL ,
			`comments` VARCHAR(250) NOT NULL ,
			`likes` BOOLEAN NOT NULL DEFAULT FALSE ,
			`images` VARCHAR(250) NOT NULL , PRIMARY KEY (`user_id`)) ENGINE = InnoDB;");
        $stmt->execute();


    }catch(PDOException $e){
        $e->getMessage();
    }
    try{

        $conn = new PDO($dbServername, $dbUsername, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("CREATE TABLE  IF NOT EXISTS `images` (
			`img_id` INT NOT NULL AUTO_INCREMENT ,
			`id` INT NOT NULL ,
			`images` VARCHAR(250) NOT NULL , PRIMARY KEY (`img_id`)) ENGINE = InnoDB;");
        $stmt->execute();

    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
    try{
        $conn = new PDO($dbServername, $dbUsername, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("CREATE TABLE IF NOT EXISTS `comments` (
			`com_id` INT NOT NULL AUTO_INCREMENT ,
			`comments` VARCHAR(258) NOT NULL ,
			`username` VARCHAR(30) NOT NULL ,
			`img_id` INT NOT NULL , PRIMARY KEY (`com_id`)) ENGINE = InnoDB;;");
        $stmt->execute();

    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
    try{
        $conn = new PDO($dbServername, $dbUsername, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("CREATE TABLE  IF NOT EXISTS `likes` (
			`likes_id` INT NOT NULL AUTO_INCREMENT ,
			`likes` BOOLEAN NOT NULL DEFAULT FALSE ,
			`username` VARCHAR(30) NOT NULL ,
			`img_id` INT NOT NULL , PRIMARY KEY (`likes_id`)) ENGINE = InnoDB;");
        $stmt->execute();
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }

