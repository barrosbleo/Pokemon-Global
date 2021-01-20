<?php
include('../modules/lib.php');

if (!isLoggedIn()) {
	redirect('index.php');
}

include '../_header.php';
printHeader('Edit Clan');
include '../bbcode.php';

$result = "SELECT * FROM `users` WHERE `id` = '$uid'";
$user = fetchArray($result, 2, $conn);
$uclan = $user['clan'] ;

$clan1 = "SELECT * FROM `clans` WHERE `id`='$uclan'";
$clan = fetchArray($clan1, 2, $conn);

if ($clan['owner'] != $user['username']){
	echo "<div class='error'>You do not have authorization to be here.</div>";
	
	die();
}
if(isset($_POST['name']) != "")
{ 
$description = strip_tags($_POST['description']);
$description = $conn->real_escape_string($_POST['description']);
$cname = $conn->real_escape_string($_POST['name']);
$img = str_replace("php", "", $_POST['image']);
$img = str_replace(">", "", $_POST['image']);
$img = str_replace("<", "", $_POST['image']);
$img = $conn->real_escape_string($_POST['image']);
$check = "SELECT * FROM `clans` WHERE `name`='".$cname."'";
$exist = numRows($check, $conn);    
if (!preg_match('~^[a-z0-9 ]+$~i', $cname) && $cname != "")
{
    echo "<div class='error'>Special characters aren't allowed in clan names.</div>";
}
elseif (strlen($cname) < 4)
{
    echo "<div class='error'>Your clan's name has to be at least 4 characters long.</div>";
}
elseif (strlen($cname) > 21)
{
    echo "<div class='error'>Your clan's name can only be a max of 20 characters long.</div>";
}
elseif ($exist > 0)
{
  echo "<div class='error'>Clan name wasn't changed or clan name already taken.</div>";  
}
else
{
    $result = $conn->query("UPDATE `clans` SET `name` = '".strip_tags($cname)."' WHERE `id`='".$clan['id']."'");
}
}
if(isset($_POST['rank']) != "")
{ 
$rank = $conn->real_escape_string($_POST['rank']);
if(strlen($rank) < 4)
{
    echo "<div class='error'>Your rank's name has to be at least 4 characters long.</div>";
}
elseif (strlen($rank) > 21)
{
    echo "<div class='error'>Your rank's name can only be a max of 20 characters long.</div>";
}
elseif (!preg_match('~^[a-z0-9 ]+$~i', $rank) && $rank != "")
{
    "<div class='error'>Special characters aren't allowed in rank names.</div>";
}
else
{
$upaddrankz = $conn->query("UPDATE `clans` SET `rank`='".$rank."' WHERE `id`='".$user->clan ."'");
}
} 
if(isset($_POST['description']) != "") 
{
    $result = $conn->query("UPDATE `clans` SET `description` = '".strip_tags($description)."', `image` = '".strip_tags($img)."' WHERE `id`='".$clan['id']."'");
    echo "<div class='success'>You've successfully edited your clan description.</div>";
}  
?>
<center><form method='post'>
Clan Name:<br>
<input name='name' type='text' size='22'<? if($clan['name'] != ""){echo ' value="'.$clan['name'].'"';}?>>
<br><br>


Clan Image:<br>
<input name='image' type='text' size='22'<? if($clan['image'] != ""){echo ' value="'.$clan['image'].'"';}?>>
<br><br>


Clan Description:<br>
<textarea name='description' cols='50' rows='10' id='message'><? $clan['description'] = stripslashes($clan['description']); echo $clan['description']; ?></textarea>
<br><br>

<input type='submit' name='submit' value='Update' class='button'>
</form>

<?php include '../_footer.php'; ?>