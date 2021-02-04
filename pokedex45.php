<?php
include('modules/lib.php');

$_GET['id'] = abs((int) $_GET['id']);
$_GET['id'] = $conn->real_escape_string($_GET['id']);

$pinfo1 = "SELECT * FROM `pokedex` WHERE `id`='".$_GET['id']."'";
$p_class = fetchObj($pinfo1, $conn);


if($p_class->id == ""){
echo "<div class=notice>".$lang['pokedex45_00']."</div>";
include '_footer.php';
die();
}
if($p_class->gender == "1"){$gender="Male";}
if($p_class->gender == "2"){$gender="Female";}
if($p_class->gender == "0"){$gender="Genderless";}

if($p_class->evolution == ""){$p_class->evolution="0";}


?>

<?php
echo'
<center>
   <table class="pretty-table pokedex">
     <tr>
       <td>
         
               <img src="images/pokemon/'.$p_class->name.'.png">
<br><img src="images/dex/'.$p_class->type1.'.png">&nbsp;';
if(!empty($p_class->type2)){
	echo'<img src="images/dex/'.$p_class->type2.'.png">';
}
echo'	       
       </td>
    <td><table class="pretty-table">
	  
	            <tr>
	              <th>'.$lang['pokedex45_01'].'</th>
	              <th>'.$lang['pokedex45_02'].'</th>
	              <th>'.$lang['pokedex45_03'].'</th>
	            </tr>
		    <tr>
		      <td>'.$p_class->hp.'</td>
		      <td>'.$p_class->attack.'</td>
		      <td>'.$p_class->def.'</td>
		    </tr>
		    <tr>
		      <th>'.$lang['pokedex45_04'].'</th>
		      <th>'.$lang['pokedex45_05'].'</th>
		      <th>'.$lang['pokedex45_06'].'</th>
		    </tr>
		    <tr>
		      <td>'.$p_class->spattack.'</td>
		      <td>'.$p_class->spdef.'</td>
		      <td>'.$p_class->speed.'</td>
		    </tr>
	          </table>
	       </div>
	     </td>
	   </tr>
	 </table>
       </td>
     </tr>
   </table>
<br>
	
		<table class="pretty-table">
		  <tr>
		    <td>
		         
		      	   <div><b>'.$p_class->name.'</b></div>
		           <img style="width:110px;" src="images/pokemon/'.$p_class->name.'.png">
		            
		    </td>';
			if(!empty($p_class->evolution)){
			echo'
		    <td>Evolves into<br><br><b>'.$lang['pokedex45_07'].'</b><br>'.$lang['pokedex45_08'].'<b>'.$p_class->level.'</b><br>'.$lang['pokedex45_09'].'</td>
		    <td>  
		      
		      	   <div><b>'.$p_class->evolution.'</b></div>
		           <img style="width:110px;" src="images/pokemon/'.$p_class->evolution.'.png">
		    </td>';
			}
			echo';
		  </tr>
		</table>
</center>';

// asdd stuff
// rarity list
// added 5/26/2013


$name = cleanSql($p_class->name, $conn);

$query = "SELECT `name`, `gender`, count(`id`) as amount FROM `user_pokemon` WHERE `name` LIKE '%{$name}%' GROUP BY `name`, `gender`";
$pokeArray = array();
$genderArray = array('0'=>'genderless', '1'=>'male', '2'=>'female');

$result = $conn->query($query);
while ($r = $result->fetch_assoc()) {
	$pokeArray[ $r['name'] ][ $genderArray[ $r['gender'] ] ] = $r['amount'];
}

echo '
	<br />
	<table class="pretty-table pokedex">
		<tr>
			<th>'.$lang['pokedex45_10'].'</th>
			<th>'.$lang['pokedex45_11'].'</th>
			<th>'.$lang['pokedex45_12'].'</th>
			<th>'.$lang['pokedex45_13'].'</th>
		</tr>
';

foreach ($pokeArray as $pokeName => $genderAmount) {

	$genderAmount['male'] = isset($genderAmount['male']) ? $genderAmount['male'] : 0 ;
	$genderAmount['female'] = isset($genderAmount['female']) ? $genderAmount['female'] : 0 ;
	$genderAmount['genderless'] = isset($genderAmount['genderless']) ? $genderAmount['genderless'] : 0 ;
	
	echo '
		<tr>
			<td>' . $pokeName . '</td>
			<td>' . $genderAmount['male'] . '</td>
			<td>' . $genderAmount['female'] . '</td>
			<td>' . $genderAmount['genderless'] . '</td>
		</tr>
	';
}

echo '
	</table><br />
';
?>