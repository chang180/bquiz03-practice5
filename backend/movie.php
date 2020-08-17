<h1 class="ct">院線片管理</h1>
<a href="?do=add_movie"><button>新增電影</button></a>
<hr>
<?php
$movies = $Movie->all([], " ORDER BY rank DESC ");
foreach ($movies as $m) {
?>
    <div class="contain" style="display:flex">
        <div><img src="img/<?= $m['poster']; ?>" style="width:80px;height:100px;"></div>
        <div>分級<img src="icon/<?= $m['level']; ?>.png"></div>
        <div>
            <div style="display:flex">
                <div>片名：<?= $m['name']; ?></div>
                <div>片長：<?= $m['length']; ?></div>
                <div>上映日期：<?= $m['date']; ?></div>
                <div>排序：<?= $m['rank']; ?></div>
            </div>
            <div><a href="?do=edit_movie&id=<?=$m['id'];?>"><button>編輯電影</button></a><a href="api/del_movie.php?id=<?= $m['id']; ?>"><button>刪除電影</button></a> </div>
            <div>劇情介紹：<?= $m['intro']; ?></div>
        </div>
    </div>
    <hr>
<?php } ?>