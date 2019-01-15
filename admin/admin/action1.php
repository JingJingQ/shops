<?php
include "../../config/db.php";
$type=$_GET["type"];
echo $type;
switch ($type){
//    添加到数据库
    case "add":
        $username=$_POST["username"];
        $password=$_POST["password"];
        $repassword=$_POST["repassword"];
//        管理员状态：1：白名单/超级管理员
//                  0：黑名单/普通管理员
        $status=1;
//        用户名是否为空
        if($username){
//            用户名的长度是否<12
            if(strlen($username)<=12){
//                密码是否为空
                if($password){
//                    密码长度是否>6
                    if(strlen($password)<=6){
//                        判断两次输入的密码是否一致
                        if($password===$repassword){
//                            判断数据库中是否已经存在当前的用户名
                            $sql1="SELECT * FROM admin WHERE name='{$username}'";
                            $res1=$db->query($sql1);
                            $row1=$res1->fetch_assoc();
                            if(!$row1){
                                $sql="INSERT INTO admin (name,password,status) VALUES ('{$username}','{$password}',{$status})";
                                $db->query($sql);
                                if($db->affected_rows>0){
                                    $message="插入成功";
                                    $url="select.php";
                                    include "../../config/message.php";
                                }else{
                                    $message="插入失败";
                                    $url="add.php";
                                    include "../../config/message.php";
                                }

                            }else{
                                $message="用户名已经存在";
                                $url="add.php";
                                include "../../config/message.php";
                            }

                        }else{
                            $message="两次输入的密码不一致";
                            $url="add.php";
                            include "../../config/message.php";
                        }
                    }else{
                        $message="密码长度不能小于6位";
                        $url="add.php";
                        include "../../config/message.php";
                    }

                }else{
                    $message="密码不能为空";
                    $url="add.php";
                    include "../../config/message.php";
                }

            }else{
                $message="用户名长度不能超过12位";
                $url="add.php";
                include "../../config/message.php";
            }
        }else{
            $message="用户名不能为空";
            $url="add.php";
            include "../../config/message.php";
        }

        break;
//    从数据库中删除
    case "del":


        break;
//    编辑/修改数据库中的数据
    case "edit":

        break;


}