<?php
$exp = explode('/', $_SERVER["SCRIPT_NAME"]);
$filename = end($exp);
if ($filename != 'map.php'){header("Location: membersarea.php");}
/*
if ($_GET['p'] == "local"){
	
}
*/
?>

<center>
<div id="chatError" class="chatError">
</div>
<div id="chatMsg">

</div>
<textarea id="chatbox" class="chatbox">
</textarea>
<input class="button" class="button" type="submit" onclick="sendMsg()" value="<?php echo $lang["chat_send_btn"];?>">
</center>
<script>
function sendMsg(){
	var msg = document.getElementById("chatbox");
	var errMsg = document.getElementById("chatError");
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			if(this.responseText == "success"){
				errMsg.style.display = "none";
				msg.value = "";
				//alert(this.responseText);
			}else{
				errMsg.style.display = "block";
				errMsg.innerHTML = this.responseText;
				//alert(this.responseText);
			}
		}
	};
	xhttp.open("GET", "modules/chatfunc.php?func=send&msg="+msg.value+"&map=<?php echo $map;?>", true);
	xhttp.send();
}
function loadMsg(){
	var chatMsg = document.getElementById('chatMsg');
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			chatMsg.innerHTML = this.responseText;
			//alert(this.responseText);
		}
	};
	xhttp.open("GET", "modules/chatfunc.php?func=load&map=<?php echo $map;?>", true);
	xhttp.send();
}
setInterval(loadMsg, 100);
</script>