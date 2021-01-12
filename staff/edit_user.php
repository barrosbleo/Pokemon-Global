<?php
include('../modules/lib.php');
require_once 'admin_functions.php';

if (!isAdmin()) {
    die('Only admins can access this page.');
}

$handle = fopen('edit_user_log.txt', 'a+');
fwrite($handle, "{$_SESSION['username']} accessed edit_user.php" . PHP_EOL);
fclose($handle);

include '_header.php';
echoHeader('Edit User');

if (isset($_GET['id'])) {
    $_POST['useUsername'] = false;
    $_POST['userid'] = $_GET['id'];
    $_POST['find'] = 'Find User';
}

$userid       = (int) $_POST['userid'];
$username     = $_POST['username'];
$usernameSql  = cleanSql($username);
$usernameHtml = cleanHtml($username);
$foundUser = false;

if (isset($_POST['find'])) {
	$useUsername = (bool) $_POST['useUsername'];
	
	if ($_POST['useUsername'] == true) {
		$whereSql = "WHERE `username`='{$usernameSql}'"; 
		$userid = 0;
	} else {
		$whereSql = "WHERE `id`='{$userid}'";
		$username = '';
	}
	
	$query = mysql_query("SELECT * FROM `users` {$whereSql} LIMIT 1");
	
	if (mysql_num_rows($query) == 1) {
		$userInfo = mysql_fetch_assoc($query);
		
		$userid       = (int) $userInfo['id'];
		$username     = $userInfo['username'];
		$usernameSql  = cleanSql($username);
		$usernameHtml = cleanHtml($username);
		
		$foundUser = true;
	}
		 
}


echo '
    <form method="post" class="bottom-padded">
        <table class="padded-cells center">
	        <tr>
	        	<td>User ID:</td>
	        	<td>
	        		<input type="text" name="userid" value="'.$userid.'" onkeyup="document.getElementById(\'uid\').checked = \'checked\';" />
	        		<input type="radio" name="useUsername" value="0" id="uid" checked="checked" />
	        	</td>
	        	<td rowspan="2">&nbsp;<input type="submit" value="Find User" name="find" /></td>
	        </tr>
	        <tr>
	        	<td>Username:</td>
	        	<td>
	        		<input type="text" name="username" value="'.$usernameHtml.'" onkeyup="document.getElementById(\'uun\').checked = \'checked\';" />
	        		<input type="radio" name="useUsername" value="1" id="uun" />
	        	</td>
	        </tr>
        </table>
    </form>
';

// print_r($userInfo);

if ((isset($_POST['find']) || isset($_GET['id'])) && !$foundUser) {
    if ($_POST['useUsername'] == true) {
        echo '<div class="error">Could not find a user with that username.</div>';
    } else {
        echo '<div class="error">Could not find a user with that ID.</div>';
    }
    include '_footer.php';
    die();
}

if ((isset($_POST['find']) || isset($_GET['id'])) && $foundUser) {
    
    if (isset($_POST['submit'])) {
        $errors = array();
        
        // print_r($_POST);
        
        $money = (int) $_POST['money'];
        if ($money < 0) {
            $errors[] = 'Money can not be nagative.';
        }
        
        $bank = (int) $_POST['bank'];
        if ($bank < 0) {
            $errors[] = 'Bank balance can not be negative.';
        }
        
        $tokens = (int) $_POST['tokens'];
        if ($bank < 0) {
            $errors[] = 'Bank balance can not be negative.';
        }
        
        $released = (int) $_POST['released'];
        if ($released < 0) {
            $errors[] = 'Number of released pokemon can not be negative.';
        }
        
        $won = (int) $_POST['won'];
        if ($won < 0) {
            $errors[] = 'Battles won can not be negative.';
        }
        
        $lost = (int) $_POST['lost'];
        if ($lost < 0) {
            $errors[] = 'Battles lost can not be negative.';
        }
        
        $clanexp = (int) $_POST['clanexp'];
        if ($clanexp < 0) {
            $errors[] = 'Clan Exp can not be negative.';
        }
        
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email is invalid.';
        }
        
        $lottery = (int) (bool) $_POST['lottery'];
        $banned  = (int) (bool) $_POST['banned'];
        $premium  = (int) $_POST['premium'];
        $rank = $_POST['rank'];
        $userbar = $_POST['userbar'];
        $signature = $_POST['signature'];
        $banReason = $_POST['ban_reason'];
        
        $clanId = (int) $_POST['clan'];
        if ($clanId != 0) {
            $query = mysql_query("SELECT `id` FROM `clans` WHERE `id`='{$clanId}'");
            if (mysql_num_rows($query) == 0) {
                $errors[] = 'Clan does not exist.';
            }
        }
        
        if (count($errors) >= 1) {
            echo '<div class="error">'.implode('</div><div class="error">', $errors).'</div>';
        } else {
            echo '<div class="notice">You have edited the user.</div>';
            
            $email     = cleanSql($email);
            $signature = cleanSql($signature);
            $banRason = cleanSql($banReason);

            mysql_query("
                UPDATE `users` SET
                    `money`     = '{$money}',
                    `bank`      = '{$bank}',
                    `token`     = '{$tokens}',
                    `released`  = '{$released}',
                    `won`       = '{$won}',
                    `lost`      = '{$lost}',
                    `email`     = '{$email}',
                    `lottery`   = '{$lottery}',
                    `clan`      = '{$clanId}',
                    `clanxp`    = '{$clanexp}',
                    `rank` = '{$rank}',
                    `userbar` = '{$userbar}',
                    `signature` = '{$signature}',
                    `banned`    = '{$banned}',
                    `premium`    = '{$premium}',
                    `ban_reason` = '{$banReason}'
                WHERE `id`='{$userid}'
            ");
            
            $query = mysql_query("SELECT * FROM `users` WHERE `id`='{$userid}' LIMIT 1");
            $userInfo = mysql_fetch_assoc($query);
            
            $handle = fopen('edit_user_log.txt', 'a+');
            fwrite($handle, "{$_SESSION['username']} edited the user with the id {$userid}" . PHP_EOL);
            fclose($handle);
        }
    }
    $userInfo = cleanHtml($userInfo);
    echo '
        <form method="post" action="?id='.$userInfo['id'].'">
            <table class="center pretty-table">
                <tr>
                    <th colspan="2">Edit User</th>
                </tr>
                <tr>
                    <td>User ID:</td>
                    <td>'.$userInfo['id'].'</td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><a href="../profile.php?id='.$userInfo['id'].'">'.$userInfo['username'].'</a></td>
                </tr>
                <tr>
                    <td>IP:</td>
                    <td><a href="user_ip.php?ip='.$userInfo['ip'].'">'.$userInfo['ip'].'</a></td>
                </tr>
                <tr>
                    <td>Money:</td>
                    <td><input type="text" name="money" value="'.$userInfo['money'].'" /></td>
                </tr>
                <tr>
                    <td>Bank Balance:</td>
                    <td><input type="text" name="bank" value="'.$userInfo['bank'].'" /></td>
                </tr>
                <tr>
                    <td>Tokens:</td>
                    <td><input type="text" name="tokens" value="'.$userInfo['token'].'" /></td>
                </tr>
                <tr>
                    <td>Released:</td>
                    <td><input type="text" name="released" value="'.$userInfo['released'].'" /></td>
                </tr>
                <tr>
                    <td>Won:</td>
                    <td><input type="text" name="won" value="'.$userInfo['won'].'" /></td>
                </tr>
                <tr>
                    <td>Lost:</td>
                    <td><input type="text" name="lost" value="'.$userInfo['lost'].'" /></td>
                </tr>
				<tr>
                    <td>Premium:</td>
                    <td>
                        <input type="radio" name="premium" value="2" '.($userInfo['premium'] == 2 ? 'checked="checked"' : '' ).' /> Yes<br />
                        <input type="radio" name="premium" value="1" '.($userInfo['premium'] == 1 ? 'checked="checked"' : '' ).' /> No<br /><br />
                        <span class="small">Make Premium user also change a userbar to premium!</span>
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="email" value="'.$userInfo['email'].'" /></td>
                </tr>
                <tr>
                    <td>Entered Lottery:</td>
                    <td>
                        <input type="radio" name="lottery" value="1" '.($userInfo['lottery'] == 1 ? 'checked="checked"' : '' ).' /> Yes<br />
                        <input type="radio" name="lottery" value="0" '.($userInfo['lottery'] == 0 ? 'checked="checked"' : '' ).' /> No
                    </td>
                </tr>
                <tr>
                    <td>Clan:</td>
                    <td>'.clanSelectBox('clan', $userInfo['clan']).'</td>
                </tr>
                <tr>
                    <td>Clan Exp:</td>
                    <td><input type="text" name="clanexp" value="'.$userInfo['clanxp'].'" /></td>
                </tr>
                <tr>
                    <td>Signature:</td>
                    <td><textarea name="signature" cols="20" rows="3">'.$userInfo['signature'].'</textarea></td>
                </tr>           
				<tr>
                    <td>User bar:</td>
                    <td><input name="userbar" cols="20" value="'.$userInfo['userbar'].'" /></td>
                </tr>			
				<tr>
                    <td>Rank:</td>
                    <td><input name="rank" value="'.$userInfo['rank'].'" /></td>
                </tr>
                <tr>
                    <td>Banned:</td>
                    <td>
                        <input type="radio" name="banned" value="1" '.($userInfo['banned'] == 1 ? 'checked="checked"' : '' ).' /> Yes<br />
                        <input type="radio" name="banned" value="0" '.($userInfo['banned'] == 0 ? 'checked="checked"' : '' ).' /> No<br /><br />
                        <span class="small">This will not delte any pokemon.<br />It just stops them from logging in.</span>
                    </td>
                </tr>                
                <tr>
                    <td>Ban Reason:</td>
                    <td><textarea name="ban_reason" cols="20" rows="3">'.$userInfo['ban_reason'].'</textarea></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="submit" value="Edit User" /></td>
                </tr>
            </table>
        </form>
    ';
}

include '_footer.php';

?>