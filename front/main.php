<div id="mm">
    <div class="half" style="vertical-align:top;">
        <h1>預告片介紹</h1>
        <div class="rb tab" style="width:95%;">
            <div style="height:300px" id="abgne-block-20111227">
                <div style="position:relative" id="list">
                    <img id="showpost" style="width:150px;height:250px;"><br>
                    <div id="showlist"></div>
                </div>
            </div>
            <div style="height:100px">
                <div style="display:flex">
                    <div onclick="pp(1)">&#9664;</div>
                    <?php
                    $rows = $Poster->all(['sh' => 1], " ORDER BY rank DESC ");
                    foreach ($rows as $key => $row) {
                    ?>
                        <div class='im' id="ssaa<?= $key; ?>">
                            <img onclick="change(<?= $key; ?>)" src="img/<?= $row['img']; ?>" style="width:68px;height:80px"><br><span><?= $row['name']; ?></span>
                        </div>
                    <?php
                    }
                    ?>
                    <div onclick="pp(2)">&#9654;</div>
                </div>
            </div>
        </div>
    </div>
    <div class="half">
        <h1>院線片清單</h1>
        <div class="rb tab" style="width:95%;">
            <div class="contain" style="display:flex;flex-wrap:wrap">
                <?php
                $total = $Movie->count(['sh' => 1]);
                $div = 4;
                $pages = ceil($total / $div);
                $now = $_GET['p'] ?? "1";
                $start = ($now - 1) * $div;
                // $prev=(($now-1)>0)?($now-1):1;
                // $next=(($now+1)<=$pages)?($now+1):$pages;

                $movies = $Movie->all(['sh' => 1], " ORDER BY rank DESC LIMIT $start,$div");
                foreach ($movies as $m) {
                ?>
                    <div style="width:48%;border:1px solid black;">
                        <div style="display:flex;">
                            <div><img src="img/<?= $m['poster']; ?>" style="width:80px;height:120px;"></div>
                            <div style="display:block">
                                <div><?= $m['name']; ?></div>
                                <div>分級：<img src="icon/<?= $m['level']; ?>.png"><?= $level[$m['level']]; ?></div>
                                <div>上映日期：<?= $m['ondate']; ?></div>
                            </div>
                        </div>
                        <div><a href="?do=intro&id=<?= $m['id']; ?>"><button>劇情簡介</button></a><a href="?do=order&id=<?= $m['id']; ?>"><button>線上訂票</button></a></div>
                    </div>
                <?php } ?>
            </div>
            <div class="ct">
                <?php
                for ($i = 1; $i <= $pages; $i++) {
                    $font = ($now == $i) ? "32px" : "20px";
                    echo "<a href='?p=$i' style='font-size:$font'>$i</a>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    var nowpage = 0,
        num = <?= count($rows); ?>,
        anim = <?= $_SESSION['ani']; ?>,
        po = 0;

    change(0)

    function change(post) {
        $("#showpost").attr("src", $("#ssaa" + post).find("img").attr("src"));
        $("#showlist").text($("#ssaa" + post).find("span").text());
        po = post;
    }

    function ani() {
        switch (anim) {
            case 1:
                $("#list").fadeOut();
                change(po);
                $("#list").fadeIn();
                break;
            case 2:
                $("#list").slideToggle();
                change(po);
                $("#list").slideToggle();
                break;
            default:
                $("#list").animate({
                    left: "-=200px",
                    opaciton: "0"
                })
                change(po);
                $("#list").animate({
                    left: "+=200px",
                    opaciton: "1"
                })
                break;
        }
    }


    setInterval(() => {
        ani();
        po++;
        if (po >= num) po = 0;
    }, 3000);



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