<?php
include_once "../base.php";
$today = date("Y-m-d");
$ondate = date("Y-m-d", strtotime("$today -2 days "));
$movie=$Movie->find(['name'=>$_POST['name']]);
$nowhour=date("H");
$nowsess=ceil(($nowhour-14)/2)+1;
for($i=1;$i<=5;$i++){
    if($movie['ondate']==$today && $nowsess < $i ){
        echo "<option value='$session[$i]'>$session[$i]</option>";
    }else{
        echo "<option value='$session[$i]'>$session[$i]</option>";
    }
}
