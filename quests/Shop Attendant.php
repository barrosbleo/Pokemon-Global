<?php
//progr
//0 = pt1 to accept
//1 = pt1 progress
//2 = pt1 ended
//3 = pt2 to accept
//4 = pt2 progress
//5 = pt2 ended

//$query = "SELECT * FROM user_quests WHERE qid='1' AND uid='".$uid."'";
//$result = $conn->query($query);
//$return = $result->fetch_assoc();

//check if objectives are done
//$objectives = 0;
?>
<div class="quest">
<div class="quest_title">
<?php echo $lang['quest_0_title'];?>
</div>
<div class="quest_text">
<?php echo $lang['quest_0_text'];?>
</div>

</br>
<table class="tableBtn">
<tr>
<td class="td" id="backBtn"><?php echo $lang['back_btn'];?></td>
</tr>
</table>
</br>
</div>

<script>
//backBtn
var link = "../shop.php";
var backBtn = document.getElementById("backBtn");
window.addEventListener('load', function(){location.replace(link);}, false);
</script>

<?php include('_footer.php');?>