<?php

include "../../config/db.php";
$id=$_GET["id"];
$sql="select * from admin where id={$id}";
$res=$db->query($sql);
$row=$res->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>网站信息</title>
    <link rel="stylesheet" href="../../asset/admin/css/pintuer.css">
    <link rel="stylesheet" href="../../asset/admin/css/admin.css">
    <script src="../../asset/admin/js/jquery.js"></script>
    <script src="../../asset/admin/js/pintuer.js"></script>
</head>
<body>
<div class="panel admin-panel">
    <div class="panel-head"><strong><span class="icon-pencil-square-o"></span> 修改管理员信息</strong></div>
    <div class="body-content">
        <form method="post" class="form-x" action="action.php?type=edit">

            <div class="form-group">
                <div class="label">
                    <label>管理员姓名：</label>
                </div>
                <div class="field">

                    <input type="text" class="input" name="name" value="<?php echo $row['name']?>" placeholder="请输入用户名" style="width:25%; float:left;" />
                    <input type="hidden"  name="id" value="<?php echo $row['id']?>">
                    <div class="tips"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>管理员密码：</label>
                </div>
                <div class="field">
                    <input type="password" id="url1" name="password" class="input tips" style="width:25%; float:left;" value="<?php echo $row['password']?>" data-toggle="hover" data-place="right"   placeholder="请输入密码" data-validate="required:请输入密码,length#>=6:密码不能小于6位"/>

                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>确认密码：</label>
                </div>
                <div class="field">
                    <input type="password" class="input" name="repassword" value="<?php echo $row['password']?>" style="width:25%; float:left;" placeholder="请再次输入密码"  data-validate="required:请输入密码,repeat#password:两次输入的密码不一致"/>
                </div>
            </div>
            <div class="form-group">
                <div class="label">
                    <label>状态：</label>
                </div>
                <div class="field" style="padding-top:8px;">
                    <?php
                    if($row['status']==0){
                    echo "<label for=\"\">白名单</label>
                    <input type=\"radio\"  name=\"status\" value=\"0\"  style=\"display:inline-block\" checked/>
                    <label for=\"\">黑名单</label>
                    <input type=\"radio\"  name=\"status\" value=\"1\"  style=\"display:inline-block\" />";
                    }else{
                        echo "<label for=\"\">白名单</label>
                    <input type=\"radio\"  name=\"status\" value=\"0\"  style=\"display:inline-block\" />
                    <label for=\"\">黑名单</label>
                    <input type=\"radio\"  name=\"status\" value=\"1\"  style=\"display:inline-block\" checked/>";
                    }
                    ?>
                </div>
            </div>

            <div class="form-group">
                <div class="label">
                    <label></label>
                </div>
                <div class="field">
                    <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body></html>