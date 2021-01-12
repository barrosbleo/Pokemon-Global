<?php
include('../modules/lib.php');
require_once 'admin_functions.php';

if (!isAdmin()) {
    die('Only admins can access this page.');
}

$handle = fopen('edit_pokemon_log.txt', 'a+');
fwrite($handle, "{$_SESSION['username']} accessed edit_pokemon.php" . PHP_EOL);
fclose($handle);

include '_header.php';
echoHeader('Edit Pokemon');

$pid = (int) $_GET['id'];

echo '
    <form method="get" class="center-text bottom-padded">
        Pokemon ID: <input type="text" name="id" value="'.$pid.'" />
        <input type="submit" value="Find Pokemon" />
    </form>
';

if ($pid == 0) {
    // echo 'Please enter the id of the pokemon you want to edit.';
    include '_footer.php';
    die();
}

$query = mysql_query("SELECT * FROM `user_pokemon` WHERE `id`='{$pid}' LIMIT 1");

if (mysql_num_rows($query) == 0) {
    echo 'This pokemon does not exist!';
    include '_footer.php';
    die();
}

if (isset($_GET['id'])) {
    
    if (isset($_POST['submit'])) {
        $errors = array();
        
        $name = str_replace(array(chr(0), '.', '/', '\\', '?', '<', '>'), '', $_POST['name']);
        if (!file_exists('../images/pokemon/'.$name.'.png')) {
            $errors[] = 'Could not find a picture for that pokemon.';
        }
        
        $level = (int) $_POST['level'];
        $exp   = (int) $_POST['exp'];
        if ($_POST['useExp']) {
            if ($exp <= 0) {
                $errors[] = 'Exp should be more that 0.';
            }
            $level = expToLevel($exp);
        } else {
            if ($level <= 0) {
                $errors[] = 'Level should be more that 0.';
            }
            $exp = levelToExp($level);
        }
        
        $move1Id = $_POST['move1'];
        $move1Name = moveIdToName($move1Id);
        if ($move1Name === false) {
            $errors[] = 'Move 1 was invalid.';
        }
        
        $move2Id = $_POST['move2'];
        $move2Name = moveIdToName($move2Id);
        if ($move2Name === false) {
            $errors[] = 'Move 2 was invalid.';
        }
        
        $move3Id = $_POST['move3'];
        $move3Name = moveIdToName($move3Id);
        if ($move3Name === false) {
            $errors[] = 'Move 1 was invalid.';
        }
        
        $move4Id = $_POST['move4'];
        $move4Name = moveIdToName($move4Id);
        if ($move4Name === false) {
            $errors[] = 'Move 4 was invalid.';
        }
        
        $gender = (int) $_POST['gender'];
        if ($gender != 0 && $gender != 1 && $gender != 2) {
            $errors[] = 'Gender was invalid.';
        }
        
        if (count($errors) >= 1) {
            echo '<div class="error">'.implode('</div><div class="error">', $errors).'</div>';
        } else {
            echo '<div class="notice">The pokemon has been edited.</div>';
            
            $name = cleanSql($name);
            $move1Name = cleanSql($move1Name);
            $move2Name = cleanSql($move2Name);
            $move3Name = cleanSql($move3Name);
            $move4Name = cleanSql($move4Name);

            mysql_query("
                UPDATE `user_pokemon` SET
                    `name`   = '{$name}',
                    `level`  = '{$level}',
                    `exp`    = '{$exp}',
                    `move1`  = '{$move1Name}',
                    `move2`  = '{$move2Name}',
                    `move3`  = '{$move3Name}',
                    `move4`  = '{$move4Name}',
                    `gender` = '{$gender}'
                WHERE `id`='{$pid}'
            ");
            
            $handle = fopen('edit_pokemon_log.txt', 'a+');
            fwrite($handle, "{$_SESSION['username']} edited the pokemon with the id {$pid}" . PHP_EOL);
            fclose($handle);
        }
    }

    $query = mysql_query("SELECT `user_pokemon`.*,`users`.`username` FROM `user_pokemon`, `users` WHERE `user_pokemon`.`id`='{$pid}' AND `user_pokemon`.`uid`=`users`.`id`");
    $pokeInfo = mysql_fetch_assoc($query);
    // print_r($pokeInfo);

    echo '
        <form method="post">
            <table class="center pretty-table">
                <tr>
                    <th colspan="2">Edit Pokemon</th>
                </tr>
                <tr>
                    <td>Pokemon ID:</td>
                    <td>'.$pokeInfo['id'].'</td>
                </tr>
                <tr>
                    <td>Owner ID:</td>
                    <td>'.$pokeInfo['uid'].'</td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><a href="../profile.php?id='.$pokeInfo['uid'].'">'.$pokeInfo['username'].'</a></td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td>
                        <input type="text" name="name" value="'.$pokeInfo['name'].'" onkeyup="document.getElementById(\'pPic\').src = \'../images/pokemon/\'+this.value+\'.png\';" /><br />
                        <img id="pPic" src="../images/pokemon/'.$pokeInfo['name'].'.png" /><br />
                        <span class="small">Pokemon <strong>must</strong> have a picture.</span>
                    </td>
                </tr>
                <tr>
                    <td>Level:</td>
                    <td><input type="text" name="level" value="'.$pokeInfo['level'].'" /></td>
                </tr>
                <tr>
                    <td>Exp:</td>
                    <td><input type="text" name="exp" value="'.$pokeInfo['exp'].'" /> </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        Use Level: <input type="radio" name="useExp" value="0" /><br />
                        <span class="small">Exp will be automatically calculated.</span><br /><br />
                        
                        Use Exp: <input type="radio" checked="checked" name="useExp" value="1" /><br />
                        <span class="small">Level will be automatically calculated.</span>
                    </td>
                </tr>
                <tr>
                    <td>Move 1:</td>
                    <td>'.moveSelectBox('move1', $pokeInfo['move1']).'</td>
                </tr>
                <tr>
                    <td>Move 2:</td>
                    <td>'.moveSelectBox('move2', $pokeInfo['move2']).'</td>
                </tr>
                <tr>
                    <td>Move 3:</td>
                    <td>'.moveSelectBox('move3', $pokeInfo['move3']).'</td>
                </tr>
                <tr>
                    <td>Move 4:</td>
                    <td>'.moveSelectBox('move4', $pokeInfo['move4']).'</td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td>'.genderSelectBox('gender', $pokeInfo['gender']).'</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="submit" value="Edit Pokemon" /></td>
                </tr>
            </table>
        </form>
    ';
}

include '_footer.php';

?>