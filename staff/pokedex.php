<?php
include('../modules/lib.php');
require_once 'admin_functions.php';

if (!isAdmin()) {
    die('Only admins can access this page.');
}

include '_header.php';
echoHeader('Pokedex Long View');

echo '
	<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script> 
	<script type="text/javascript" src="js/__jquery.tablesorter.min.js"></script>
	<script>
	$(document).ready(function()  { 
		$("#myTable").tablesorter();
		
		$("input:checkbox:not(:checked)").each(function() {
		    var column = "table ." + $(this).attr("name");
		    $(column).hide();
		});
		
		$("input:checkbox").click(function(){
		    var column = "table ." + $(this).attr("name");
		    $(column).toggle();
		});
	});
	</script>
';

$query = mysql_query("SELECT * FROM `pokedex` ORDER BY `num` ASC");

echo '
	<div style="text-align: center;">
		Show Moves: <input type="checkbox" name="move" checked="checked" />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Show Stats: <input type="checkbox" name="stat" checked="checked" />
	</div>
	<br /><br />
	<table id="myTable" class="pretty-table center tablesorter">
		<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th class="stat">HP</th>
			<th class="stat">Atk</th>
			<th class="stat">Sp&nbsp;Atk</th>
			<th class="stat">Def</th>
			<th class="stat">Sp&nbsp;Def</th>
			<th class="stat">Spd</th>
			<th class="move">Move&nbsp;1</th>
			<th class="move">Move&nbsp;2</th>
			<th class="move">Move&nbsp;3</th>
			<th class="move">Move&nbsp;4</th>
			<th>Type&nbsp;1</th>
			<th>Type&nbsp;2</th>
		</tr>
		</thead>
		<tbody>
';

while ($pokeRow = mysql_fetch_assoc($query)) {
echo '
	<tr>
		<td>'.$pokeRow['num'].'</td>
		<td>
			<a href="edit_pokedex.php?id='.$pokeRow['id'].'">'.str_replace(' ', '&nbsp;', $pokeRow['name']).'</a>
		</td>
		<td class="stat">'.$pokeRow['hp'] . '</td>
		<td class="stat">'.$pokeRow['attack'] . '</td>
		<td class="stat">'.$pokeRow['spattack'] . '</td>
		<td class="stat">'.$pokeRow['def'] . '</td>
		<td class="stat">'.$pokeRow['spdef'] . '</td>
		<td class="stat">'.$pokeRow['speed'] . '</td>
		<td class="move">'.str_replace(' ', '&nbsp;', $pokeRow['move1']).'</td>
		<td class="move">'.str_replace(' ', '&nbsp;', $pokeRow['move2']).'</td>
		<td class="move">'.str_replace(' ', '&nbsp;', $pokeRow['move3']).'</td>
		<td class="move">'.str_replace(' ', '&nbsp;', $pokeRow['move4']).'</td>
		<td>'.$pokeRow['type1'] . '</td>
		<td>'.$pokeRow['type2'] . '</td>
	</tr>
';
}

echo '</tbody></table>';






include '_footer.php';

?>