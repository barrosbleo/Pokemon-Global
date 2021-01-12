<?php
//progr
//0 = pt1 to accept
//1 = pt1 progress
//2 = pt1 ended
//3 = pt2 to accept
//4 = pt2 progress
//5 = pt2 ended

$query = "SELECT * FROM user_quests WHERE qid='1' AND uid='".$uid."'";
$result = $conn->query($query);
$return = $result->fetch_assoc();

//check if objectives are done
$objectives = 0;

if($return['progr'] == 0){
?>
<div class="quest">
<div class="quest_title">
<?php echo $lang['quest_1_title'];?>
</div>
<div class="quest_text">
<?php echo $lang['quest_1_text'];?>
</div>

<table class="table">
<tr>
<td class="title_td"><?php echo $lang['quest_table_title1'];?></td>
<td class="title_td"><?php echo $lang['quest_table_title2'];?></td>
</tr>
<tr>
<td class="td"><?php echo $lang['quest_1_rewards'];?></td>
<td class="td"><?php echo $lang['quest_1_objectives'];?></td>
</tr>
</table>
</br>
<table class="tableBtn">
<tr>
<td class="td" id="acceptBtn"><?php echo $lang['accept_btn'];?></td>
<td class="td" id="backBtn"><?php echo $lang['back_btn'];?></td>
</tr>
</table>
</br>
</div>
<?php
}elseif($return['progr'] == 1){
?>
<div class="quest">
<div class="quest_title">
<?php echo $lang['quest_1_title_'];?>
</div>
<div class="quest_text">
<?php echo $lang['quest_1_text_stage2'];?>
</div>

<table class="table">
<tr>
<td class="title_td"><?php echo $lang['quest_table_title1'];?></td>
<td class="title_td"><?php echo $lang['quest_table_title2'];?></td>
</tr>
<tr>
<td class="td"><?php echo $lang['quest_1_rewards'];?></td>
<td class="td"><?php echo $lang['quest_1_objectives'];?></td>
</tr>
</table>
</br>
<table class="tableBtn">
<tr>
<td class="td" id="<?php if($objectives == 1){echo "acceptBtn";}else{echo "backBtn";}?>"><?php if($objectives == 0){echo $lang['notyet_btn'];}else{echo $lang['completed_btn'];}?></td>
<?php if($objectives == 1){?><td class="td" id="backBtn"><?php echo $lang['back_btn'];?></td><?php }?>
</tr>
</table>
</br>
</div>
<?php
}elseif($return['progr'] == 3){
?>
<div class="quest">
<div class="quest_title">
<?php echo $lang['quest_1_title'];?>
</div>
<div class="quest_text">
<?php echo $lang['quest_1_text'];?>
</div>

<table class="table">
<tr>
<td class="title_td"><?php echo $lang['quest_table_title1'];?></td>
<td class="title_td"><?php echo $lang['quest_table_title2'];?></td>
</tr>
<tr>
<td class="td"><?php echo $lang['quest_1_rewards'];?></td>
<td class="td" id="backBtn"><?php echo $lang['quest_1_objectives'];?></td>
</tr>
</table>
</br>
<table class="tableBtn">
<tr>
<td class="td"><?php echo $lang['accept_btn'];?></td>
<td class="td" id="backBtn"><?php echo $lang['back_btn'];?></td>
</tr>
</table>
</br>
</div>
<?php
}
?>
<script>
//backBtn
var link = "../map.php?map=<?php echo base64_encode($_SESSION['player']['map_num']);?>";
var backBtn = document.getElementById("backBtn");
backBtn.onclick = function(){location.replace(link);}

//acceptBtn
var acceptBtn = document.getElementById("acceptBtn");
function acceptQuest(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			alert(this.responseText);
			location.replace(link);
		}
	};
	xhttp.open("GET", "quests/questUpdt.php?action=1&qid=1&qprogr=<?php echo $return['progr']+1;?>", true);
	xhttp.send();
}
acceptBtn.onclick = function(){acceptQuest()};

</script>

<?php include('_footer.php');?>