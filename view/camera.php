<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Photo js</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav>
        <a class="links" href="home.php" class="logo">Camagru</a>
    </nav>
    
    <video id="video" autoplay></video>
    <canvas id="canvas" width="500" height="400"></canvas>
    <div id="canvasy">
        <img src="../model/stickers/flag1.jpg" alt="USA" id="flag1"/>
        <img src="../model/stickers/flag2.jpg" alt="GER" id="flag2" />
    </div>
    <button id="Snap" onclick="Snap()">Capture</button> 
    <button class ="primary-button" name="UploadImage" id="upload">Upload A Photo</button>

</body>
<script src="../model/main.js"></script>
</html>