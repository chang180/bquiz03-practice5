<?php
include_once "../base.php";
if($_POST['acc']=='admin' && $_POST['pw']=='1234'){
    $_SESSION['login']=$_POST['acc'];
    to("../admin.php");
}else{
    to("../index.php?do=login");
}