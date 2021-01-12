<?php
include('../modules/lib.php');
require_once 'admin_functions.php';

if (!isAdmin()) {
    die('Only admins can access this page.');
}

include '_header.php';
echoHeader('Edit Referral Shop');

if (isset($_POST['addPoke'])) {
    $errors = array();
        
        $price = (int) str_replace(array(',', '.', '$'), '', $_POST['price']);
        if ($price < 0) {
            $errors[] = 'Price can not be negative.';
        }
        
        $name = str_replace(array(chr(0), '.', '/', '\\', '?', '<', '>'), '', $_POST['name']);
        if (!file_exists('../images/pokemon/'.$name.'.png')) {
            $errors[] = 'Could not find a picture for that pokemon.';
        }
        
        if (count($errors) >= 1) {
            echo '<div class="error">'.implode('</div><div class="error">', $errors).'</div>';
        } else {
        
            $name    = cleanSql($name);
            $price   = cleanSql($price);

            $query = mysql_query("
                INSERT INTO `shop_ref` (
                	`name`, `price`
                ) VALUES (
                    '{$name}', '{$price}'
                )
            ");
            
            if ($query) {
            	echo '<div class="notice">The pokemon has been added to the shop.</div>';
            } else {
            	echo '<div class="error">There was an error.</div>';
            }
         }
}
?>
	<form method="post">
		<table class="pretty-table center">
			<tr>
                <th colspan="2">
                    Add Pokemon To The Shop
                </th>
            </tr>
			<tr>
				<td>Name:</td>
				<?='
				<td>
					<input type="text" name="name" value="Snow Pinsir" onkeyup="document.getElementById(\'pPic\').src = \'../images/pokemon/\'+this.value+\'.png\';" /><br />
		            <img alt="No Picture" id="pPic" src="../images/pokemon/Snow Pinsir.png" /><br />
		            <span class="small">Pokemon <strong>must</strong> have a picture.</span>
		        </td>
				'?>
			</tr>
			<tr>
				<td>Price:</td>
				<td>&nbsp;<input type="text" name="price" value="10" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="addPoke" value="Add Pokemon" /></td>
			</tr>
		</table>
	</form>
<?
$errorPokeIds = array();
$deletedPokemon = false;
if (isset($_POST['save'])) {
    foreach ($_POST['pid'] as $pnum => $pid) {
        
        $pid = (int) $pid;
        $errors = array();
        
        $price = (int) str_replace(array(',', '.', '$'), '', $_POST['price'][$pnum]);
        if ($price < 0) {
            $errors[] = 'Price can not be negative.';
        }
        
        $name = str_replace(array(chr(0), '.', '/', '\\', '?', '<', '>'), '', $_POST['name'][$pnum]);
        
        if (trim($name) == '') {
            $deletedPokemon = true;
            mysql_query("DELETE FROM `shop_ref` WHERE `id`='{$pid}' LIMIT 1");
            continue;
        } else if (!file_exists('../images/pokemon/'.$name.'.png')) {
            $errors[] = 'Could not find a picture for that pokemon.';
        }
     
        if (count($errors) >= 1) {
            // we don't actually use the $errors array...
            // echo '<div class="error">'.implode('</div><div class="error">', $errors).'</div>';
            
            $errorPokeIds[] = $pid;
        } else {
            $name    = cleanSql($name);
            $price   = cleanSql($price);
            $catName = cleanSql($catName);
            
            mysql_query("UPDATE `shop_ref` SET `name`='{$name}', `price`='{$price}' WHERE `id`='{$pid}'") or die(mysql_error());
        }
    }
}

if (!empty($errorPokeIds)) {
    echo '
        <div class="error">
            Could not update all of the pokemon!
            <div class="small">Please check the pokemon below.</div>
        </div>
    ';
} else if (isset($_POST['save']) && empty($errorPokeIds)) {
    echo '
        <div class="notice">
            The pokemon shop has been updated!
        </div>
    ';
}

if (isset($_POST['save']) && $deletedPokemon == true) {
    echo '
        <div class="notice">
            Some pokemon were deleted!
        </div>
    ';
}



$query = mysql_query("SELECT * FROM `shop_ref` ORDER BY `price` ASC");
?>
    <br /><br />
<form method="post" style="padding: 0 10px;">
    <table class="pretty-table center center-text" style="width: 750px;">
<?
$category = '';
$i=0;
while ($pokeInfo = mysql_fetch_assoc($query)) {
    $style = '';
    if (in_array($pokeInfo['id'], $errorPokeIds)) {
        $style = ' style="background: rgb(255, 0, 0); background: rgba(255, 0, 0, 0.5);" ';
    }
	echo '
		<tr '.$style.'>
			<td style="width: 100px;">
                <input type="hidden" name="pid['.$i.']" value="'.$pokeInfo['id'].'" />
				<img id="pic'.$i.'" src="../images/pokemon/'.$pokeInfo['name'].'.png" alt="'.$pokeInfo['name'].'" />
			</td>
			<td>
                <input type="text" name="name['.$i.']" id="name'.$i.'" value="'.$pokeInfo['name'].'" onkeyup="document.getElementById(\'pic'.$i.'\').alt = this.value; document.getElementById(\'pic'.$i.'\').src = \'../images/pokemon/\'+this.value+\'.png\';"  />
                <div class="small">Pokemon must have a picture.</div>
            </td>
			<td>
                &nbsp;<input type="text"  name="price['.$i.']" value="'.number_format($pokeInfo['price']).'" />
                <div class="small">Price must be 0 or more.</div>
            </td>
		</tr>
	';
    $i++;
}
echo '
        	<tr>
        		<td colspan="4"><input type="submit" value="Save" name="save" /></td>
        	</tr>
        </table>
        <div class="small center-text" style="padding-top: 10px;">To delete a pokemon, you simply have to remove its name and save.</div>
    </form>
';

include '_footer.php';
?>