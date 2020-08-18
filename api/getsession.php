<?php
include_once "../base.php";
$name=$_POST['name'];
$date=$_POST['date'];
$today=date("Y-m-d");
$row=$Movie->find(['name'=>$name]);
$ondate=$row['date'];
for($i=1;$i<=5;$i++){
    // if($ondate<=$today){
        echo "<option value='".$session[$i]."'>".$session[$i]."剩餘座位 20</option>";
    // }
}