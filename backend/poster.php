<form action="api/edit_poster.php" method="post">
    <h1 class="ct">預告片管理</h1>
    <table>
        <tr>
            <td>預告片海報</td>
            <td>預告片片名</td>
            <td>預告片排序</td>
            <td>操作</td>
        </tr>
        <?php
        $posters = $Poster->all([], " ORDER BY rank DESC ");
        foreach ($posters as $p) {
        ?>
            <tr>
                <td><img src="img/<?= $p['img']; ?>" style="width:68px;height:80px"></td>
                <td><input type="text" name="name[]" value="<?= $p['name']; ?>"></td>
                <td><input type="number" name="rank[]" value="<?= $p['rank']; ?>"></td>
                <td>
                    <input type="checkbox" name="sh[]" value="<?= $p['id']; ?>" <?=($p['sh']==1)?"checked":"";?>>顯示
                    <input type="checkbox" name="del[]" value="<?= $p['id']; ?>">刪除
                    <input type="hidden" name="id[]" value="<?= $p['id']; ?>">
                </td>
            </tr>
        <?php } ?>
    </table>
    請選擇動畫效果：(1:淡入 2:縮放 3:滑出) <input type="number" name="ani" value="<?=$_SESSION['ani'];?>"><br>
    <button>編輯確定</button><button type="reset">重置</button>
</form>
<form action="api/add_poster.php" method="post" enctype="multipart/form-data">
    <h1 class="ct">新增預告片海報</h1>
    預告片海報：<input type="file" name="img">預告片片名：<input type="text" name="name"><br>
    <button>新增</button><button type="reset">重置</button>
</form>