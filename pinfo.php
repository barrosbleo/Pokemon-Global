<?php
include('modules/lib.php');

if (!isLoggedIn()) {
    redirect('login.php');
}

include '_header.php';
printHeader($lang['pinfo_title']);


$pokeId = (int) $_GET['id'];
$userId = (int) $_SESSION['userid'];

$query = mysql_query("SELECT * FROM `user_pokemon` WHERE `id`='{$pokeId}'");

// check that the pokemon actually exists
if(mysql_num_rows($query) == 0){
    echo '<div class="error">'.$lang['pinfo_00'].'</div>';
    include '_footer.php';
    die();
}

$pokeRow   = mysql_fetch_assoc($query);
$query     = mysql_query("SELECT * FROM `users` WHERE `id`='{$pokeRow['uid']}' LIMIT 1");
$ownerRow  = mysql_fetch_assoc($query);

$query     = mysql_query("SELECT * FROM `user_items` WHERE `uid`='{$uid}' LIMIT 1");
$itemsRow  = mysql_fetch_assoc($query);


if(isset($_POST['update'])) {
    
    // check that this is their pokemon
    if ($ownerRow['id'] != $userId) {
        echo '<div class="error">'.$lang['pinfo_01'];
        
    // check that they have at least one rare candy
    } else if ($itemsRow['rare_candy'] <= 0) {
        echo '<div class="error">'.$lang['pinfo_02'].'</div>';
    } else {
        $newLevel = $pokeRow['level']+1;
        $newExp   = levelToExp($newLevel);
        
        $pokeRow['level'] = $newLevel;
        $pokeRow['exp']   = $newExp;
        
        $itemsRow['rare_candy'] -= 1;
        
        mysql_query("UPDATE `user_pokemon` SET `level`='{$newLevel}', `exp`='{$newExp}' WHERE `id`='{$pokeId}'");
        mysql_query("UPDATE `user_items` SET `rare_candy`=`rare_candy`-1 WHERE `uid`='{$userId}'");
        
    	echo '<div class="notice">'.$lang['pinfo_03'].'</div>';
    }
    
}

if($pokeRow['gender'] == "1"){$gender="Male";}
if($pokeRow['gender'] == "2"){$gender="Female";}
if($pokeRow['gender'] == "0"){$gender="Genderless";}

echo'
    <table class="pretty-table" style="width: 400px;">
        <tr>
            <th>'.$lang['pinfo_04'].'</th>
        </tr>
        <tr>
            <td><img src="images/pokemon/'.$pokeRow['name'].'.png"><br>'.$pokeRow['name'].'</td>
        </tr>
    </table>
    <br />
    <table class="pretty-table" style="width: 400px;">
        <tr>
            <th>'.$lang['pinfo_05'].'</th>
            <td>'.cleanHtml($ownerRow['username']).'</td>
        </tr>
        <tr>
            <th>'.$lang['pinfo_06'].'</th>
            <td>'.$pokeRow['level'].'</td>
        </tr>
        <tr>
            <th>'.$lang['pinfo_07'].'</th>
            <td>'.number_format($pokeRow['exp']).'</td>
        </tr>
        <tr>
            <th>'.$lang['pinfo_08'].'</th>
            <td>'.$gender.'</td>
        </tr>
        <tr>
            <th>'.$lang['pinfo_09'].'</th>
            <td>
                '.$pokeRow['move1'].'<br />
                '.$pokeRow['move2'].'<br />
                '.$pokeRow['move3'].'<br />
                '.$pokeRow['move4'].'<br />
            </td>
        </tr>
    </table>
    <br />
';


if ($pokeRow['uid'] == $userId){
    echo'
        <table class="pretty-table" style="width: 400px;">
            <tr>
                <th colspan=2>'.$lang['pinfo_10'].'</th>
            </tr>
            <tr>
                <th>'.$lang['pinfo_11'].'</th>
                <td>
                    '.$lang['pinfo_12'].''.$itemsRow['rare_candy'].' '.$lang['pinfo_13'].'
                    <form method=post>
                        <input type="submit" name="update" value="'.$lang['pinfo_14'].'"/>
                    </form>
                </td>
            </tr>
        </table>
    ';
}


include '_footer.php';
?>