<?php
include('modules/lib.php');

if (!isLoggedIn()) {
die();
}

include '_header.php';
printHeader($lang['bank_title']);

logs($uid, $lang['bank_00']);
?>
<?php
// other stuff
$user1 = "SELECT * FROM `users` WHERE `id`='" . $_SESSION['userid'] . "'";
$user = fetchObj($user1, $conn);

//QUICK DRAW
if($_GET['d'] == 1){
$_POST['deposit'] = 1;
$_POST['damount'] = $user->money;
}elseif($_GET['w'] == 1){
$_POST['withdraw'] = 1;
$_POST['wamount'] = $user->bank;
}

if($_POST['deposit'] != ""){
$_POST['withdraw'] = "";

if(strtolower(substr($_POST['damount'], -1)) == "k"){
$_POST['damount'] = $_POST['damount'] * 1000;
}
if(strtolower(substr($_POST['damount'], -1)) == "m"){
$_POST['damount'] = $_POST['damount'] * 1000000;
}


$_POST['damount'] = $conn->real_escape_string($_POST['damount']);

$dontlike = array(',', '$', '+', '-');
$yoyo   = array('', '', '', '');
$_POST['damount'] = str_replace($dontlike, $yoyo, $_POST['damount']);

    if ($user->money < 1){
        echo $lang['bank_01'];
  include "_footer.php";
  die();
    }

    if ($_POST['damount'] > $user->money) {
        echo $lang['bank_02'];
    }

if (!preg_match('~^[a-z0-9 ]+$~i', $_POST['damount'])){
  echo $lang['bank_03'];
  include "_footer.php";
  die();
}

    if ($_POST['damount'] <= $user->money && $_POST['damount'] > 0) {
        echo $lang['bank_04'];
        $user->bank = $_POST['damount'] + $user->bank;
        $user->money = $user->money - $_POST['damount'];
        $result = $conn->query("UPDATE `users` SET `bank` = '".$user->bank."', `money` = '".$user->money."' WHERE `id`='".$_SESSION['userid']."'");

}


    }

?>
<?php
if($_POST['withdraw'] != ""){


$_POST['wamount'] = $conn->real_escape_string($_POST['wamount']);

$dontlike = array(',', '$', '+', '-');
$yoyo   = array('', '', '', '');
$_POST['wamount'] = str_replace($dontlike, $yoyo, $_POST['wamount']);


if(strtolower(substr($_POST['wamount'], -1)) == "k"){
$_POST['wamount'] = $_POST['wamount'] * 1000;
}
if(strtolower(substr($_POST['wamount'], -1)) == "m"){
$_POST['wamount'] = $_POST['wamount'] * 1000000;
}

    if ($_POST['wamount'] > $user->bank) {
        echo $lang['bank_05'];
    }
if (!preg_match('~^[a-z0-9 ]+$~i', $_POST['wamount'])){
  echo $lang['bank_06'];
  include "_footer.php";
  die();
}

    if ($_POST['wamount'] <= $user->bank && $_POST['wamount'] > 0) {
        echo $lang['bank_07'];
        $user->bank = $user->bank - $_POST['wamount'];
        $user->money = $user->money + $_POST['wamount'];
        $result = $conn->query("UPDATE `users` SET `bank` = '".$user->bank."', `money` = '".$user->money."' WHERE `id`='".$_SESSION['userid']."'");
logs($uid, $lang['bank_08']." $".$_POST['wamount']." !");
    }
}

?>


<center>
<table class="pretty-table"><tr>
<th>
<?php echo$lang['bank_09'];?>
</th>
</tr><tr>
<td>
<br><br>

<form method='post'>
<input type='text' name='wamount' value='$<?php echo number_format($user->bank);?>' size='15' maxlength='20'> &nbsp;
<br>
<input type='submit' name='withdraw' value='<?php echo $lang['bank_10'];?>' id='button'>
</form><br><br>
</td></tr></table>

<br/>

<table class="pretty-table"><tr><th><?php echo $lang['bank_11'];?></th></tr>
<tr><td>
<br><br>
<form method='post'>
<input type='text' name='damount' value='$<?php echo number_format($user->money);?>' size='15' maxlength='20'> &nbsp;
<br>
<input type='submit' name='deposit' value='<?php echo $lang['bank_12'];?>' id='button'>
</form><br><br>
</td></tr></table>
</center>
<?php include '_footer.php';?>
