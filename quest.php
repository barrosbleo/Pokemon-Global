<?php
////////////CONSIDERAR ESTAGIO 0 PARA QUEST CONCLUIDA
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('index.php');
}
if(isset($_GET['page'])){
	include ('_header.php');
	printHeader($lang['quest_header']);
	
	echo '
    <div style="text-align: center;">
        <a href="quest.php?page=active">'.$lang['active_quest_btn'].'</a> &bull; 
        <a href="quest.php?page=completed">'.$lang['completed_quest_btn'].'</a> &bull; 
        <a href="quest.php?page=canceled">'.$lang['canceled_quest_btn'].'</a>
    </div>
';
	switch ($_GET['page']){
		case "active":
		$query = "SELECT qid FROM user_quests WHERE uid='".$uid."'";
		$result = $conn->query($query);
		while($return = $result->fetch_array()){
		echo $lang['quest_'.$return[0].'_title'].'</br>';
		}
		break;
		case"completed";
		case"canceled";
	}
	include('_footer.php');
}
elseif(!isset($_GET['npcName']) || $_GET['npcName'] == ""){
	redirect('map.php?map='.base64_encode($_SESSION['player']['map_num']));
}else{
	include ('_header.php');
	printHeader($lang['quest_header']);
	include('quests/'.$_GET['npcName'].'.php');
}
?>

