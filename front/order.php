<form class="order-form">
    <h1 class="ct">線上訂票</h1>
    電影：<select name="name" id="name">
        <?php
        $today = date("Y-m-d");
        $ondate = date("Y-m-d", strtotime("$today - 2 days"));
        // echo $ondate;
        $movies = $Movie->all(['sh' => 1], " && date >= '$ondate' && date <= '$today'");
        foreach ($movies as $m) {
        ?>
            <option><?= $m['name']; ?></option>
        <?php
        }
        ?>
    </select><br>
    日期：<select name="date" id="date">

    </select><br>
    場次：<select name="session" id="session">

    </select><br>
    <button type="button" onclick="booking()">確定</button><button type="reset">重置</button>
</form>
<div class="seat-form" style="display:none;">
    <div id="seat"></div><br>
    您選擇的電影是：<span id="mName"></span><br>
    您選擇的時刻是：<span id="mDate"></span>&nbsp;<span id="mSession"></span><br>
    您已經勾選了<span id="mTicket">0</span>張票，最多可以購買4張票<br>
    <button onclick="prev()">回上一步</button><button id="send">完成訂票</button>
</div>
<script>
    $.post("api/getseat.php", {}, function(res) {

    })

    $("#name").on("change", function() {
        getDate();
        getSession();
    });

    getDate();

    function getDate() {
        $.post("api/getdate.php", {
            "name": $("#name").val()
        }, function(res) {
            $("#date").html(res);
            getSession();
        })
    }

    function getSession() {
        $.post("api/getsession.php", {
            "name": $("#name").val(),
            "date": $("#date").val()
        }, function(res) {
            $("#session").html(res);
        })
    }

    function booking() {
        $.post("api/getseat.php", {
            "name": $("#name").val(),
            "date": $("#date").val(),
            "session": $("#session").val()
        }, function(res) {
            $("#mName").text($("#name").val());
            $("#mDate").text($("#date").val());
            $("#mSession").text($("#session").val());
            $("#seat").html(res);
            let ticket = 0,
                seat = [];
            $(".seat").on("change", function() {
                if (this.checked) {
                    if (ticket > 3) this.checked = false;
                    else {
                        ticket++;
                        seat.push(this.value);
                    }
                } else {
                    ticket--;
                    seat.splice(seat.indexOf(this.value), "1");
                }
                console.log(seat);
                $("#mTicket").text(ticket);
            })
            $("#send").on("click", function() {
                $.post("api/order.php", {
                    "name": $("#name").val(),
                    "date": $("#date").val(),
                    "session": $("#session").val(),
                    seat
                }, function(no) {
                    // console.log(no);
                    location.href=`?do=result&no=${no}`;

                })

            })

        })
        $(".order-form,.seat-form").toggle();
    }

    function prev() {
        $(".order-form,.seat-form").toggle();
        $("#seat").html("");
    }
</script>