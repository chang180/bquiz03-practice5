<?php
include_once "../base.php";
$name=$_POST['name'];
$today=date("Y-m-d");
$row=$Movie->find(['name'=>$name]);
$ondate=$row['date'];
for($i=1;$i<=3;$i++){
    // if($ondate<=$today){
        echo "<option>".$ondate."</option>";
        $ondate=date("Y-m-d",strtotime("$ondate + 1 day"));
    // }
}