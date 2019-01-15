<?php
include "../../config/db.php";
function tip($mess,$url){
    echo "<script>alert($mess);location.href=$url</script>";
}
$username=$_POST["username"];
$pass=$_POST["password"];
$repass=$_POST["repassword"];
var_dump($username);
//用户名是否为空
if($username){
//    用户名的长度是不是在6-8之间
    if(strlen($username)>=6&&strlen($username)<=8){
//        密码是否为空
//        两次输入的密码是否一致
        if($pass===$repass){
//            密码长度是否>=6
            if(strlen($pass)>=6){
                $sql="insert into admin (name,password) VALUES ('{$username}','{$pass}')";
                $db->query($sql);
                if($db->affected_rows>0){
                    echo "<script>alert('插入成功');location.href='select.php'</script>";
                }
            }else{
                echo "<script>alert('密码长度<6位');location.href='add.php'</script>";
            }
        }else{
            echo "<script>alert('两次输入的密码不一致');location.href='add.php'</script>";
        }

    }else{
        echo "<script>alert('用户名的长度必须是6-8位');location.href='add.php'</script>";
    }
}else{
    echo "<script>alert('用户名不能为空');location.href='add.php'</script>";
}



?>