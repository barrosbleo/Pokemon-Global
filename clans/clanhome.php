<?php
include('../modules/lib.php');

if (!isLoggedIn()) {
	redirect('index.php');
}

include '../_header.php';
printHeader('Clan Home');
include '../bbcode.php';

$sqlUsername = cleanSql($_SESSION['username'], $conn);

$query = "SELECT * FROM `users` WHERE `username` = '{$sqlUsername}'";
$user = fetchArray($query, 2, $conn);
$myclan = $user['clan'];

$clan1 = "SELECT * FROM `clans` WHERE `id` = '{$user['clan']}'";
$clan =fetchArray($clan1, 2, $conn);
$cowner = $clan['owner'];
$u = $user['username'];

if ($user['clan'] == "" || $user['clan'] == "0")
{
 echo "<div class='error'>You're not in a clan</div>.";
 die();
}


/*
this is not needed anymore as we have leaveclan.php
if(isset($_GET['action']) == "leave")
{
    if($clan['owner'] != $user['username'])
    {  
        echo 'You have left your clan.';
        $res = mysql_query("UPDATE `users` SET `clan` = '0', `clanxp` = '0' WHERE `id`= '".$user['id']."'");		
    }
    else 
    {
        //echo "You can't leave a clan if you're the owner.";
        echo 'You have closed your clan!';
        $res = mysql_query("UPDATE `users` SET `clan` = '0', `clanxp` = '0' WHERE `clan`= '".$user['clan']."'");
        mysql_query("DELETE FROM `clans` WHERE `id`= '".$user['clan']."' LIMIT 1");
    }
}
*/


?>
<center>
<?
if ($clan['image'] !== ""){
?>
<img src="<? echo $clan['image']; ?>" style="max-height: 120px; max-width: 120px;" />
<?
} else {
?>
This clan doesn't have an logo/image.
<?
}
?>
<br><br></center>



<center><h1>Welcome to <? echo $clan['name']; ?></h1></center>

<br><br></center>
<table class="pretty-table" class="t" border=0 width="55%" cellpadding="0" cellspacing="0" align="center" border="1" bordercolor="#444444">
<tr><th> Description </th></tr>
<tr>
<td><? echo bbcode($clan['description']); ?> </td>
</tr>
</table>
<?
if ($clan['owner'] = $user['username'])
{
?>
</br></br><table class="pretty-table"  class="t" border=0 width="55%" cellpadding="0" cellspacing="0" align="center" border="1" bordercolor="#444444">
<tr><th colspan="2"> Clan Management  </th></tr>
<tr>

<td >[<a href='/clans/jusers.php'>Manage Applicants</a>] </td>
<td>[<a href='/clans/moderate.php'>Manage Members</a>]</td>

		</tr>
		<tr>
<td colspan="2">[<a href="/clans/editclan.php" target="_parent">Edit Clan</a>]</td>

		</tr>
</table>
<?
}
?>
</br></br><table class="pretty-table"  class="t" border=0 width="55%" cellpadding="0" cellspacing="0" align="center" border="1" bordercolor="#444444">
<tr><th colspan="2"> other:  </th></tr>
<tr>

<td>[<a href='/clans/vclan.php?id=<? echo $clan['id']?>'>View Clan</a>]</td>
<? //<td>[<a href='/clans/cbank.php'>Clan Bank</a>]</td> ?>
</tr>
<tr>

<td colspan="2">[<a href="/clans/leaveclan.php">Leave Clan</a>]</td>

		</tr>
</table>
</br></br></br></br>
<?
/* Set current, prev and next page */
$page = (!isset($_GET['page']))? 1 : $_GET['page'];
$prev = ($page - 1);
$next = ($page + 1);

/* Max results per page */
$max_results = 3000;

/* Calculate the offset */
$from = (($page * $max_results) - $max_results);

/* Query the db for total results. You need to edit the sql to fit your needs */
$result = "SELECT * FROM `users` WHERE `clan` = '".$clan['name']."'";
//echo $result;
$total_results = numRows($result, $conn);
$total_pages = ceil($total_results / $max_results);

$pagination = '';


/* Create a PREV link if there is one */
if($page > 1)
{
$pagination .= '<a href="/shop.php?page='.$prev.'">Previous</a> ';
}

/* Loop through the total pages */
for($i = 1; $i <= $total_pages; $i++)
{
if(($page) == $i)
{
$pagination .= $i;
}
else
{
$pagination .= '<a href="/shop.php?page='.$i.' ">'.$i.'</a>';
}
}
/* Print NEXT link if there is one */
if($page < $total_pages)
{
$pagination .= '<a href="/clans/clanhome.php?page='.$next.'">Next</a>';
}

$uid = (int) $_SESSION['userid'];
$query = "SELECT * FROM `users` WHERE `clan` = '".$clan['id']."' LIMIT $from, $max_results";
$color="1";
echo '<table class="pretty-table"  class="t" border=0 width="55%" cellpadding="0" cellspacing="0" align="center" border="1">
<tr>
<th>Trainer #</th>
<th>Username</th>
<th>Exp</th>
 
</tr>';
$result = $conn->query($query);
while($res1 = $result->fetch_array(MYSQLI_ASSOC)){
$res1 = cleanHtml($res1);

echo "<tr>
<td>".$res1['id']."</td>
<td><a href='/profile.php?id=".$res1['id']."'>".$res1['username']."</a></td>
<td>".$res1['clanxp']."</td>
";

}

echo '</tr></table>';
?>
</fieldset>
<?php include '../_footer.php'; ?>