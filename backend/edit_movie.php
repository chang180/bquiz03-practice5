<form action="api/save_movie.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$_GET['id'];?>">
    <h1 class="ct">編輯電影</h1>
    <?php $row=$Movie->find($_GET['id']);?>
    片名：<input type="text" name="name" value="<?=$row['name'];?>"><br>
    排序：<input type="text" name="rank" value="<?=$row['rank'];?>"><br>
    顯示：<input type="checkbox" name="sh" value="1" <?=($row['sh']==1)?"checked":"";?>><br>
    分級：<select name="level">
<?php
foreach($level as $key=>$l){
    echo "<option value='$key'>$l</option>";
}
?>
    </select><br>
片長：<input type="text" name="length" value="<?=$row['length'];?>"><br>
上映日期：<select name="y">
    <?php
for($i=2020;$i<=2021;$i++){
    echo "<option value='$i'>$i</option>";
}
    ?>
</select>年<select name="m">
<?php
for($i=1;$i<=12;$i++){
    echo "<option value='$i'>$i</option>";
}
    ?>
</select>月<select name="d">
<?php
for($i=1;$i<=31;$i++){
    echo "<option value='$i'>$i</option>";
}
    ?>
</select>日<br>

發行商：<input type="text" name="publish" value="<?=$row['publish'];?>"><br>
導演：<input type="text" name="director" value="<?=$row['director'];?>"><br>
預告影片：<input type="file" name="trailer"><br>
電影海報：<input type="file" name="poster"><br>
劇情簡介：<textarea name="intro" style="width:600px;height:200px;"><?=$row['intro'];?></textarea><br>
    <button>確定修改</button><button type="reset">重置</button>
</form>