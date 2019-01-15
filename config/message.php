<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .box{
            width:300px;
            height:150px;
            position: fixed;
            top:0;bottom:0;left:0;right:0;
            margin:auto;
            border:1px solid #aaaaaa;
        }
        .title{
            width:100%;
            height: 30px;
            text-align: center;
            line-height: 30px;
            background-color: #cccccc;
        }
        .neirong{
            text-align: center;
            line-height: 30px;
        }
        span{
            color: red;
        }
    </style>
    <script>
        window.onload=function () {
            var span=document.querySelector("span");
            var url=document.querySelector("a").getAttribute("href");
            var num=3;
            setInterval(function () {
                num--;
                if(num==0){
                    location.href=url;
                }else{
                    span.innerHTML=num;
                }
            },1000);
        }
    </script>
</head>
<body>
<div class="box">
    <div class="title">提示消息</div>
    <div class="neirong">
        <?php echo $message?>！<br>
        页面将在<span>3</span>后跳转<br>
        没有跳转，请点击 <a href="<?php echo $url?>">这里</a>
    </div>
</div>
</body>
</html>