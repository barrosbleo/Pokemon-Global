<?php
include('modules/lib.php');

$query = mysql_query("SELECT * FROM users WHERE id='".$uid."'");
$user = mysql_fetch_assoc($query);
$query = mysql_query("SELECT * FROM chat WHERE map='".$user['map_num']."' ORDER BY msg_id DESC LIMIT 0,20");


while($msg = mysql_fetch_array($query)){
	echo "<div class='msgby'>".$msg['username'].":</div> <div class='messages'>".$msg['message']."</div> <div class='date'>".$msg['sent_on']."</div></br>";
}
?>

<head>
<META HTTP-EQUIV="Refresh" CONTENT="2;URL=chatframe.php">
<link rel="stylesheet" type="text/css" href="css/style-chat.css">
</head>
<body onLoad="pageScroll()">
<script>
function pageScroll() {
                window.scrollBy(0,-1000000); // horizontal and vertical scroll increments
                //scrolldelay = setTimeout('pageScroll()',100); // scrolls every 100 milliseconds
}
</script>
