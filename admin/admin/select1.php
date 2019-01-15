<?php
include "../../config/db.php";
//分页  首页  上一页  当前页码  下一页  尾页
//条件：总数据$tot  每页显示几条数据$size  开始的值$start=($p-1)*$size
//     总页数/向上取整ceil($tot/$size)   当前的页数/变化$p

//0 1 2   1p     0*3
//3 4 5   2p     1*3
//6 7 8   3p     2*3
//9 10 11 4p     3*3

//总数据       总行数    变量名
$sql1="select count(*) tot from admin";
$res1=$db->query($sql1);
$row1=$res1->fetch_assoc();
$tot=$row1["tot"];

//每页显示几条数据--自定义
$size=3;

//总页数
$page=ceil($tot/$size);

//当前页数,默认是1
//判断p=$_GET["P"]是否有值  isset($_GET["P"])?$_GET["P"]:1;
$p=isset($_GET["p"])?$_GET["p"]:1;

//每页开始的数据
$start=($p-1)*$size;

$sql = "SELECT * FROM admin ORDER BY id ASC LIMIT $start,$size";
$res = $db->query($sql);

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
            <th>密码</th>
            <th>状态</th>
            <th>时间</th>
            <th width="250">操作</th>
        </tr>
        <?php
        while ($row = $res->fetch_assoc()) {

            ?>
            <tr>
                <td><?php echo $row["id"]?></td>
                <td><?php echo $row["name"]?></td>
                <td><?php echo $row["password"]?></td>
                <?php
                if($row["status"]==="1"){
//              点击白名单/黑名单按钮：切换
//               a的跳转  href="action.php?type=status&id={$row[id]}&status=0;

//从数据库中更改掉---修改数据库中对应字段的status状态
//更改成功--页面自动跳转(header("location:select.php"))
                    echo " <td>
                    <a href=\"action1.php?type=status&id={$row['id']}&status=0\" class=\"button bg-blue \">白名单</a>
                </td>";
                }else{
                    echo " <td>
                    <a href=\"action1.php?type=status&id={$row['id']}&status=1\" class=\"button bg-red \">黑名单</a>
                </td>";
                }

                ?>

                <td><?php echo $row["time"]?></td>

                <td>
                    <div class="button-group">
                        <a type="button" class="button border-main" href="#"><span class="icon-edit"></span>修改</a>
                        <a class="button border-red" href="javascript:void(0)" onclick="return del(17)"><span
                                    class="icon-trash-o"></span> 删除</a>
                    </div>
                </td>
            </tr>
            <?php
        }
        ?>


    </table>
    <div class="panel-foot" style="text-align: center">
        <?php
        $prevpage=$p-1;
        if($prevpage<1){
            $prevpage=1;
        }
        $nextpage=$p+1;
        if($nextpage>$page){
            $nextpage=$page;
        }

        ?>
        <a href="?p=1" class="button">首页</a>
        <a href="?p=<?php echo $prevpage?>" class="button">上一页</a>
<!--        当前的页码-->
        <input type="text" class="button" value="<?php echo $p?>" style="width: 50px;text-align: center">
        <a href="?p=<?php echo $nextpage?>" class="button">下一页</a>
        <a href="?p=<?php echo $page?>" class="button">尾页</a>
    </div>

<script>
    function del(id) {
        if (confirm("您确定要删除吗?")) {

        }
    }
</script>

</body>
</html>