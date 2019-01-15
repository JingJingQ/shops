<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/1/15
 * Time: 14:19
 */
include "../../config/db.php";
include "../../config/function.php";
$type = $_GET["type"];
var_dump($type);
switch ($type) {
//    添加
    case "add":
        $username = $_POST["username"];
        $pass = $_POST["password"];
        $repass = $_POST["repassword"];
        $status = 0;
        if ($username) {
            if (strlen($username) >= 6 && strlen($pass) <= 12) {
                if ($pass) {
                    if (strlen($pass) >= 6 && strlen($pass) <= 12) {
                        if ($pass === $repass) {
                            $sql1 = "select * from admin where name='{$username}'";
                            $res1 = $db->query($sql1);
                            $row1 = $res1->fetch_all();
                            if (!$row1) {
                                $sql = "INSERT INTO admin (name,password,status) VALUES ('{$username}','{$pass}',$status)";
                                $db->query($sql);
                                if ($db->affected_rows > 0) {
                                    $message = "插入成功";
                                    $url = "select.php";
                                    include "../../config/message.html";
                                } else {
                                    $message = "插入失败";
                                    $url = "add.php";
                                    include "../../config/message.html";
                                }
                            } else {
                                $message = "用户名已经存在，请重新输入";
                                $url = "add.php";
                                include "../../config/message.html";
                            }
                        } else {
                            $message = "两次输入的密码不一致";
                            $url = "add.php";
                            include "../../config/message.html";
                        }
                    } else {
                        $message = "密码必须在6-12位之间";
                        $url = "add.php";
                        include "../../config/message.html";
                    }
                } else {
                    $message = "密码不能为空";
                    $url = "add.php";
                    include "../../config/message.html";
                }
            } else {
                $message = "用户名长度应该在6-12位之间";
                $url = "add.php";
                include "../../config/message.html";
            }
        } else {
            $message = "用户名不能为空";
            $url = "add.php";
            include "../../config/message.html";
        }
        break;
//   删除
    case "del":
        $id = $_GET['id'];
        $sql = "delete from admin where id={$id}";

        $db->query($sql);
        if ($db->affected_rows > 0) {
            $message = "删除成功";
            $url = "select.php";
            include "../../config/message.html";
        } else {
            $message = "删除失败";
            $url = "select.php";
            include "../../config/message.html";
        }

        break;
    case "status":
        $status = $_GET["status"];
        $id = $_GET["id"];
        $sql = "update admin set status={$status} where id={$id}";
        $db->query($sql);
        if ($db->affected_rows > 0) {
            header("location:select.php");
        } else {
            header("location:select.php");
        }
        break;

    case "edit":
        $id=$_POST["id"];
        $name=$_POST["name"];
        $pass=$_POST["password"];
        $repass=$_POST["repassword"];
        $status=$_POST["status"];

        if($name){
            if($pass){
                $sql="update admin set name='{$name}',password='{$pass}',status={$status} where id={$id}";
                $db->query($sql);
                if($db->affected_rows>0){
                    $message="修改成功";
                    $url="select.php";
                    include "../../config/message.html";
                }else{
                    $message="修改失败";
                    $url="edit.php?id={$id}";
                    include "../../config/message.html";
                }

            }else{
                $message="密码不能为空";
                $url="edit.php?id={$id}";
                include "../../config/message.html";
            }
        }else{
            $message="用户名不能为空";
            $url="edit.php?id={$id}";
            include "../../config/message.html";
        }


}
