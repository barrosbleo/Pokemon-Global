<?php
include('../modules/lib.php');
require_once('mod_functions.php');

if (!isMod()) {
    die('Only mods can access this page.');
}

include('_header.php');
echoHeader('Planning a new quest');

if(isset($_POST['submit'])){
	$error = 0;
	
	$questName = $_POST['questName'];
	$npcImg = $_POST['npcImg'];
	$intro = $_POST['intro'];
	$intro2 = $_POST['intro2'];
	$requirements = $_POST['requirements'];
	$requirements2 = $_POST['requirements2'];
	$acompTxt = $_POST['acompTxt'];
	$acompTxt2 = $_POST['acompTxt2'];
	
	$sqlQuestName = cleanSql(trim($questName), $conn);
	$sqlNpcImg = cleanSql(trim($npcImg), $conn);
	$sqlIntro = cleanSql(trim($intro), $conn);
	$sqlIntro2 = cleanSql(trim($intro2), $conn);
	$sqlRequirements = cleanSql(trim($requirements), $conn);
	$sqlRequirements2 = cleanSql(trim($requirements2), $conn);
	$sqlAcompTxt = cleanSql(trim($acompTxt), $conn);
	$sqlAcompTxt2 = cleanSql(trim($acompTxt2), $conn);
	
	if($questName == ""){$error = 1; echo'<script>alert("Please: Fill in a quest name!");</script>';}
	if($npcImg == ""){$error = 1; echo'<script>alert("Please: select the npc image!");</script>';}
	if($intro == ""){$error = 1; echo'<script>alert("Please: Fill in an intro for the quest!");</script>';}
	if($requirements == ""){$error = 1; echo'<script>alert("Please: Fill in the quest requirements!");</script>';}
	if($acompTxt == ""){$error = 1; echo'<script>alert("Please: Fill in a quest accomplishment text!");</script>';}
	//if($_POST[''] == ""){$error = 1; echo'<script>alert("");</script>';}
	
	if($error != 1){
		$conn->query("INSERT INTO `quest_planner` (`creator`, `name`, `npc_img`, `intro`, `requirements`, `accompTxt`, `intro2`, `requirements2`, `accompTxt2`)
			VALUES
			('{$uid}', '{$sqlQuestName}', '{$sqlNpcImg}', '{$sqlIntro}', '{$sqlRequirements}', '{$sqlAcompTxt}', '{$sqlIntro2}', '{$sqlRequirements2}', '{$sqlAcompTxt2}')");
		
		echo "success";
		
	}
}

echo '
    <form method="post">
        <table class="pretty-table center">
            <tr>
                <th colspan="2">Request a new quest</th>
            </tr>
            <tr>
                <td>Quest Name:</td>
        	<td>
        		<input type="text" name="questName" value="Let\'s Catch\'em All"/><br/>
            		<span class="small">
            			This is what the quest will be named.
            		</span>
        	</td>
	    </tr>
            <tr>
                <td>Npc Image:</td>
            	<td>
				<select name="npcImg" id="npcId">';
				for($i = 1; $i <=27; $i++){
					echo'
					<option value="'.$i.'">'.$i.'</option>
					';
				}
				echo'</select>
				<img id="npcImg" src="../images/sprites/1.png"/>
				</td>
	    </tr>
	    <tr>
                <td>Introduction:<br /><span class="small">(This is what the npc will say to player)</span></td>
            	<td><textarea name="intro" rows="5" cols="50"></textarea></td>
	    </tr>
		<tr>
                <td>Requirements:<br /><span class="small">(Tell what player will have to do<br>
				to accomplish the quest</br>
				Pick some itens, catch a pokemon, etc...)</span></td>
            	<td><textarea name="requirements" rows="5" cols="50"></textarea></td>
	    </tr>
	    <tr>
                <td>Accomplishment Text:<br /><span class="small">(This is what the npc will say to player</br>
				after the end of the quest)</span></td>
            	<td><textarea name="acompTxt" rows="5" cols="50"></textarea></td>
	    </tr>
		<tr>
                <td>Second stage:<br /><span class="small">(Not required</br>
				Fill in these fields only</br>
				if the NPC will ask one more task)</span></td>
            	<td></td>
	    </tr>
		<tr>
                <td>Introduction 2:<br /><span class="small">(This is what the npc will say to player)</span></td>
            	<td><textarea name="intro2" rows="5" cols="50"></textarea></td>
	    </tr>
		<tr>
                <td>Requirements 2:<br /><span class="small">(Tell what player will have to do<br>
				to accomplish the quest</br>
				Pick some itens, catch a pokemon, etc...)</span></td>
            	<td><textarea name="requirements2" rows="5" cols="50"></textarea></td>
	    </tr>
	    <tr>
                <td>Accomplishment Text 2:<br /><span class="small">(This is what the npc will say to player</br>
				after the end of the quest)</span></td>
            	<td><textarea name="acompTxt2" rows="5" cols="50"></textarea></td>
	    </tr>
            <tr>
	        <tr>
	        	<td>&nbsp;</td>
	        	<td>
		        	<span class="small">The admin will notify you if it\'s approved or denied.</span><br/><br/>
		        	<input type="submit" name="submit" value="Submit"/>
	        	</td>
	        </tr>
        </table>
    </form>
';
?>
<script>
function showNpcImg(){
	var npcId = document.getElementById("npcId");
	//alert(npcId.value);
	var npcImg = document.getElementById("npcImg");
	npcImg.src = "../images/sprites/"+npcId.value+".png";
}
setInterval(function(){showNpcImg();}, 100);
</script>
<?php
include '_footer.php';

?>
