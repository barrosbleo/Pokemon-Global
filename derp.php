<?php
include('modules/lib.php');
//require_once 'config.php';
?>

<form action="" method="post">
<?php 

function expToLevel($exp) {

for ($i=10000; $i>0; $i--) {
if ($exp >= levelToExp($i)) {
return $i;
}
}

return 0;
}

function levelToExp($level) {
return ($level*$level)*10;
}
if(isset($_POST['Calculate']))
{
$level = abs((int) $_POST['lvl']);
$level = htmlentities($_POST['lvl']);
$level = $conn->real_escape_string($_POST['lvl']);

if(!isset($level))
{
echo $lang['derp_00'];
}
elseif($level < 5)
{
echo $lang['derp_01'];
}
elseif( $level > 10000)
{
echo $lang['derp_02'];
}
else
{
echo $lang['derp_03']." ".number_format($level)." "." ".$lang['header_submenu_02_10']." ".number_format(levelToExp($level))." ".$lang['derp_05'];
}
}

if(isset($_POST['cal']))
{
$exp = abs((int) $_POST['exp']);
$exp = htmlentities($_POST['exp']);
$exp = $conn->real_escape_string($_POST['exp']);

if(!isset($exp))
{
echo $lang['derp_06'];
}
elseif($exp < 250)
{
echo $lang['derp_07'];
}
else
{
echo $lang['derp_08']." ".number_format($exp).""." ".$lang['derp_09']." ".number_format(expToLevel($exp));
}
}

?>
<fieldset><legend><?php echo $lang['derp_10'];?></legend>
<table border="0" cellspacing="0" cellpadding="4" style="margin: 0 auto 0 auto; text-align: left;">
 <tr><td style="text-align: right;" valign="middle"><?php echo $lang['derp_11'];?></td><td><input name="lvl" type="text" id="lvl" class="button"/></td>
 <td style="text-align: right;" valign="middle"><?php echo $lang['derp_11'];?></td>
 <td><input name="exp" type="text" id="exp" class="button"/></td>
 </tr>
 
 <tr style="text-align: center;" valign="middle">
 <td colspan="2"><input type="submit" name="Calculate" id="Calculate" value="<?php echo $lang['derp_12'];?>">
 </td><td colspan="2"><input type="submit" name="cal" id="cal" value="<?php echo $lang['derp_13'];?>">
 </td>
 </table></fieldset>
 
 
 
</form>