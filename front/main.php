<div id="mm">
    <div class="half" style="vertical-align:top;">
        <h1>預告片介紹</h1>
        <div class="rb tab" style="width:95%;">
            <div style="height:300px;">
                <div class="contain" style="position:relative;">
                    <img style="width:200px;height:280px;" id="showpost"><br><span id="showlist"></span>
                </div>
            </div>
            <div style="height:100px;display:flex;">
                <button onclick="pp(1)">&#9664;</button>
                <?php
                $posters = $Poster->all(['sh' => 1], " ORDER BY rank DESC");
                foreach ($posters as $key => $p) {
                ?>
                    <div id="ssaa<?= $key; ?>" class="im"><img onclick="change(<?= $key; ?>)" src="img/<?= $p['img']; ?>" style="width:68px;height:80px;"><br><span><?= $p['name']; ?></span></div>
                <?php
                }
                ?>
                <button onclick="pp(2)">&#9654;</button>
            </div>
        </div>
    </div>
    <div class="half">
        <h1>院線片清單</h1>
        <div class="rb tab" style="width:95%;">
           <div style="display:flex;flex-wrap:wrap">
        <?php
$total=$Movie->count(['sh'=>1]);
$div=4;
$pages=ceil($total/$div);
$now=$_GET['p']??1;
$start=($now-1)*$div;
$movies=$Movie->all(['sh'=>1]," ORDER BY rank DESC LIMIT $start,$div");
foreach($movies as $m){
?>
<div style="width:48%;border:1px solid black">
<div style="display:flex;">
<div><img src="img/<?=$m['poster'];?>" style="width:76px;height:100px"></div>
<div>
<div>片名：<?=$m['name'];?></div>
    <div>分級：<img src="icon/<?=$m['level'];?>.png"><?=$level[$m['level']];?></div>
    <div>上映日期：<br><?=$m['date'];?></div>
</div>
</div>
<a href="?do=intro&id=<?=$m['id'];?>"><button>劇情簡介</button></a><a href="?do=order&id=<?=$m['id'];?>"><button>線上訂票</button></a>
</div>
<?php
}
        ?>
        </div>
            <div class="ct"> 
<?php
for($i=1;$i<=$pages;$i++){
    $font=($now==$i)?"32px":"20px";
    echo "<a href='?p=$i' style='font-size:$font'>$i</a>";
}
?>
            </div>
        </div>
    </div>
</div>
<script>
    var nowpage = 0,
        num = <?= count($posters); ?>,
        po = 0,
        anim = <?= $_SESSION['ani']; ?>;

    function ani() {
        switch (anim) {
            case 1:
                $(".contain").fadeOut();
                change(po);
                $(".contain").fadeIn();
                break;
            case 2:
                $(".contain").slideToggle();
                change(po);
                $(".contain").slideToggle();
                break;
            default:
                $(".contain").animate({
                    left: "-=200px",
                    opacity: "0"
                });
                change(po);
                $(".contain").animate({
                    left: "+=200px",
                    opacity: "1"
                });
                break;
        }
    }

    setInterval(() => {
        po++;
        if (po == num) po = 0;
        ani();
    }, 3000);
    change(0);

    function change(post) {
        $("#showpost").attr("src", $("#ssaa" + post).find("img").attr("src"));
        $("#showlist").text($("#ssaa" + post).find("span").text());
        po = post;
    }


    function pp(x) {
        var s, t;
        if (x == 1 && nowpage - 1 >= 0) {
            nowpage--;
        }
        if (x == 2 && (nowpage + 1) <= num * 1 - 4) {
            nowpage++;
        }
        $(".im").hide()
        for (s = 0; s <= 3; s++) {
            t = s * 1 + nowpage * 1;
            $("#ssaa" + t).show()
        }
    }
    pp(1)
</script>