'use strict';
        const capture_btn = document.getElementById("capture_btn");
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const Snap = document.getElementById('Snap');
        //const context = canvas.getContext("2d");
        let flag1 = document.getElementById('flag1');
        const flag2 = document.getElementById('flag2');
        // const applyapple = document.getElementById('applyapple');
        // const errorMsgElement = document.getElementById('spanErrorMsg');
        
        const constraints = {
            audio: false,
            video:{
                width:300, height: 300
            }
        };
        //Access webcam
        async function init(){
            try{
                const stream = await navigator.mediaDevices.getUserMedia(constraints);
                handleSuccess(stream);
            }
            catch(e){
                errorMsgElement.innerHTML = 'navigator.getUserMedia.error:${e.toString()}';
            }
        }
        // Success
        function handleSuccess(stream){
            window.stream = stream;
            video.srcObject = stream;
        }
        function sticker(){
            context.drawImage(flag1, 20, 100, 70, 50);
        }
        function stick(){
            context.drawImage(flag2, 20, 150, 70, 50);
        }
        
        // Load init
        init();
        //Draw Image
        var context = canvas.getContext('2d');
        Snap.addEventListener("click", function(){
            context.drawImage(video, 0, 0, 300, 300);
        });
        flag1.addEventListener('click', sticker);
       
        //  function() {
        // context.drawImage(flage1, 20, 100, 50, 60);
        // });
        function handleSuccess(stream){
            window.stream = stream;
            video.srcObject = stream;
        }
        // Load init
        init();
        //Draw Image
        var context = canvas.getContext('2d');
        Snap.addEventListener("click", function(){
            context.drawImage(video, 0, 0, 300, 300);
        });
        flag2.addEventListener('click', stick)
        // function(){
        //     context.drawImage(falg2, 10, 10, 150, 150);
        // });
        function handleSuccess(stream){
            window.stream = stream;
            video.srcObject = stream;
        }
        
    document.getElementById("upload").addEventListener("click", function() {
    var canvas = document.getElementById("canvas");
    var dataURL = canvas.toDataURL("image/png");
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        console.log(xhr.status, xhr.responseText);
    };
    
    xhr.open('POST', '../model/save.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("img=" + dataURL);
 })