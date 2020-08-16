<h1 class="ct">線上訂票</h1>
<hr>
<form id="order-form">
    電影：<select name="name" id="name">
        <?php
        $today = date("Y-m-d");
        $ondate = date("Y-m-d", strtotime("$today -2 days "));
        $movies = $Movie->all(['sh' => 1], " & ondate >= $ondate & ondate <= $today ");
        foreach ($movies as $m) {
            echo "<option value='" . $m['name'] . "'>" . $m['name'] . "</option>";
        }
        ?>
    </select><br>

    日期：<select name="date" id="date">
    </select><br>

    場次：<select name="session" id="session">
    </select><br>

    <button type="button" onclick="booking()">確定</button><button type="reset">重置</button>
</form>
<form id="seat-form" style="display:none">
    <div id="seat"></div>
    <div id="info">
        您選擇的電影是：<span id="mname"></span><br>
        您選擇的時刻是：<span id="mdate"></span>&nbsp;<span id="msession"></span><br>
        您已經勾選了<span id="tick">0</span>張票，最多可以購買4張票<br>
    </div>
    <button type="button" onclick="prev()">上一步</button><button type="button" id="send">訂購</button>
</form>


<script>
    let name, date, session, ticket = 0;

    function booking() {
        $("#order-form,#seat-form").toggle();
        name = $("#name").val(), date = $("#date").val(), session = $("#session").val(), seat = [];
        $("#mname").text(name);
        $("#mdate").text(date);
        $("#msession").text(session);
        $.post("api/get_seat.php", {
            name,
            date,
            session
        }, function(res) {
            $("#seat").html(res);
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
                $("#tick").text(ticket);
$("#send").on("click",function(){
    $.post("api/order.php",{name,date,session,seat},function(no){
location.href=`?do=result&no=${no}`;
    })
})

            })
        })
    }

    function prev() {
        $("#order-form,#seat-form").toggle();
        $("#seat").html("");
    }

    getdate();
    $("#name").on("change", function() {
        getdate();
    })

    function getdate() {
        $.post("api/get_date.php", {
            "name": $("#name").val()
        }, function(res) {
            $("#date").html(res);
            getsession();
        })
    }

    function getsession() {
        $.post("api/get_session.php", {
            "name": $("#name").val(),
            "date": $("#date").val()
        }, function(res) {
            $("#session").html(res);
        })

    }
</script>