<?php 
$order=$Ord->find(['no'=>$_GET['no']]);
// $order=$Ord->find(2);
?>
感謝您的訂購，您的訂單編號是：<?=$_GET['no'];?><br>
電影名稱：<?=$order['name'];?><br>
日期：<?=$order['date'];?><br>
場次時間：<?=$order['session'];?><br>
座位：<br>
<?php
foreach(unserialize($order['seat']) as $s) echo $s,",";
?>
<br>
共<?=$order['qt'];?>張電影票<br>
<div class="ct"><a href="?"><button>確認</button></a></div>