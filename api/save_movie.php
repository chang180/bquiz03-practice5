<?php
include_once "../base.php";

move_uploaded_file($_FILES['trailer']['tmp_name'],"../img/".$_FILES['trailer']['name']);
$_POST['trailer']=$_FILES['trailer']['name'];
move_uploaded_file($_FILES['poster']['tmp_name'],"../img/".$_FILES['poster']['name']);
$_POST['poster']=$_FILES['poster']['name'];

$_POST['ondate']=$_POST['y']."_".$_POST['m']."_".$_POST['d'];
unset($_POST['y'],$_POST['m'],$_POST['d']);

$_POST['rank']=$Poster->q("SELECT MAX(rank) FROM movie ")[0][0]+1;
$_POST['sh']=1;
// print_r($_POST);
$Movie->save($_POST);
to("../admin.php?do=movie");