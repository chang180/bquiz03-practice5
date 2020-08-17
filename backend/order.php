<h1 class="ct">訂單管理</h1>
<form action="api/fastdel.php" method="post" onsubmit="return confirm('確定？')">
快速刪除：<input type="radio" name="mode" value="1">依日期<input type="text" name="date"><input type="radio" name="mode" value="2">依電影
<select name="name" id="name">
<?php
$rows=$Movie->all();
foreach($rows as $row){
    echo "<option>".$row['name']."</option>";
}
?>
</select>
<button>刪除</button>
</form>
<table>
    <tr>
        <td>訂單編號</td>
        <td>電影名稱</td>
        <td>日期</td>
        <td>場次時間</td>
        <td>訂購數量</td>
        <td>訂購位置</td>
        <td>操作</td>
    </tr>
    <?php
$orders=$Ord->all([]," ORDER BY no DESC");
foreach($orders as $row){
    ?>
    <tr>
        <td><?=$row['no'];?></td>
        <td><?=$row['name'];?></td>
        <td><?=$row['date'];?></td>
        <td><?=$row['session'];?></td>
        <td><?=$row['qt'];?></td>
        <td><?php 
        foreach(unserialize($row['seat']) as $s) echo $s,",";
        ?></td>
        <td>
            <a href="api/del_order.php?id=<?=$row['id'];?>"><button>刪除</button></a>
        </td>
    </tr>
<?php }?>
</table>
