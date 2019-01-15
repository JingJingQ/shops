<?php
include "../../config/db.php";
//数据总量
$sqlTot="select count(*) tot from admin";
$resTot=$db->query($sqlTot);
$dataTot=$resTot->fetch_assoc();
$tot=$dataTot['tot'];


//规定每页显示的条数
$size=5;
//总页数
$pages=ceil($tot/$size);
//当前页
$p=isset($_GET['p'])?$_GET['p']:1;
//开始
$start=($p-1)*$size;

$sql="select * from admin order by id asc limit $start,$size ";
$res=$db->query($sql);


?>


<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="renderer" content="webkit">
    <title>网站信息</title>
    <link rel="stylesheet" href="../../asset/admin/css/pintuer.css">
    <link rel="stylesheet" href="../../asset/admin/css/admin.css">
    <script src="../../asset/admin/js/jquery.js"></script>
    <script src="../../asset/admin/js/pintuer.js"></script>
</head>
<body>
<div class="panel admin-panel">
    <div class="panel-head"><strong class="icon-reorder"> 管理员列表</strong></div>

    <table class="table table-hover text-center">
        <tr>
            <th width="5%">ID</th>
            <th>管理员姓名</th>
            <th>管理员密码</th>
            <th>管理员状态</th>
            <th>加入时间</th>
            <th width="250">操作</th>
        </tr>
        <?php

            while ($data=$res->fetch_assoc()) {

                ?>
                <tr>
                    <td><?php echo $data['id']?></td>
                    <td><?php echo $data['name']?></td>
                    <td><?php echo $data['password']?></td>
                    <?php
                    if($data['status']==0){
                      echo "<td>
<a href='action.php?type=status&id= $data[id]&status=1' class='button border - green'>白名单</a></td>";

                    }else{
                        echo "<td>
<a href='action.php?type=status&id= $data[id]&status=0' class='button border - green'>黑名单</a></td>";
                    }

                    ?>
                    <td><?php echo $data['time']?></td>

                    <td>
                        <div class="button-group">
                            <a type="button" class="button border-main" href="edit.php?id=<?php echo $data['id']?>"><span class="icon-edit"></span>修改</a>
                            <a class="button border-red" href="action.php?type=del&id=<?php echo $data['id']?>" ><span
                                        class="icon-trash-o"></span> 删除</a>
                        </div>
                    </td>
                </tr>
                <?php
            }
?>


    </table>


    <?php
    $nextPage=$p+1;
    if($nextPage>=$pages){
        $nextPage=$pages;
    }
    $prevPage=$p-1;
    if($prevPage<1){
        $prevPage=1;
    }

    ?>
    <div class="panel-foot" style="text-align: center">
        <a href="?p=1" class="button">首页</a>
        <a href="?p=<?php echo $prevPage?>" class="button">上一页</a>
        <input type="text" class="button" value="<?php echo $p?>" style="width: 50px;text-align: center">
        <a href="?p=<?php echo $nextPage?>" class="button">下一页</a>
        <a href="?p=<?php echo $pages?>" class="button">尾页</a>
    </div>
</div>

</body>
</html>