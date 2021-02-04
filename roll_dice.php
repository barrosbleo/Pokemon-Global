<?php
include('modules/lib.php');
include '_header.php';
?>
<div class="header"><h2><?php echo $lang['roll_dice_00'];?></h2></div>
<?php


$rand1 = rand(1, 6);
$rand2 = rand(1, 6);
$rand3 = $rand1 + $rand2;


if(isset($_POST['slot']))
{

echo '<center><img src="/images/dice'.$rand1.'.png" /><img src="/images/dice'.$rand2.'.png" /></center>';

if($rand3 == 7)
{

$money = rand(300, 350);

echo $lang['roll_dice_01'] . $money;

$update = $conn->query("UPDATE users SET money = money + {$money} WHERE id = '{$uid}'");
}

else
{
$updatepay = $conn->query("UPDATE users SET money = money - 50 WHERE id = '{$uid}'");

echo $lang['roll_dice_02'];
}
}

?>
<br />
<form action="" method="post">
<input type="submit" class="smallbutton" name="slot" value="Roll The Dice">
<br /><?php 

$query = "SELECT * FROM users WHERE id = '{$uid}'";
$view = fetchAssoc($query, $conn);

$moneycheck = $view["money"];

if($moneycheck <= 0)
{
$fixmgpoints = $conn->query("UPDATE users SET money = 0 WHERE id = '{$uid}'");
echo $lang['roll_dice_03'];
}
else
{
echo $lang['roll_dice_04'];
echo "$";
echo $view["money"]; 
echo $lang['roll_dice_05'];
}
?>
<?php
include('_footer.php');
?>

