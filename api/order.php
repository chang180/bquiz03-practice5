<?php
include_once "../base.php";
$_POST['qt']=count($_POST['seat']);
$_POST['seat']=serialize($_POST['seat']);
$mno=$Ord->q("SELECT MAX(id) FROM ord ")[0][0]+1;
$_POST['no']=date("Ymd").sprintf("%04d",$mno);
$Ord->save($_POST);
echo $_POST['no'];
// print_r($_POST);
