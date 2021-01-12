<?php
die();
include('modules/lib.php');
include '_header.php';
?>

<?php
//We check if the user is logged
if(isset($_SESSION['username']))
{
$form = true;
$otitle = '';
$orecip = '';
$omessage = '';
//We check if the form has been sent
if(isset($_POST['title'], $_POST['recip'], $_POST['message']))
{
	$otitle = $_POST['title'];
	$orecip = $_POST['recip'];
	$omessage = $_POST['message'];
	//We remove slashes depending on the configuration
	if(get_magic_quotes_gpc())
	{
		$otitle = stripslashes($otitle);
		$orecip = stripslashes($orecip);
		$omessage = stripslashes($omessage);
	}
	//We check if all the fields are filled
	if($_POST['title']!='' and $_POST['recip']!='' and $_POST['message']!='')
	{
		//We protect the variables
		$title = mysql_real_escape_string($otitle);
		$recip = mysql_real_escape_string($orecip);
		$message = mysql_real_escape_string(nl2br(htmlentities($omessage, ENT_QUOTES, 'UTF-8')));
		//We check if the recipient exists
		$dn1 = mysql_fetch_array(mysql_query('select count(id) as recip, id as recipid, (select count(*) from pm) as npm from users where username="'.$recip.'"'));
		if($dn1['recip']==1)
		{
			//We check if the recipient is not the actual user
			if($dn1['recipid']!=$_SESSION['userid'])
			{
				$id = $dn1['npm']+1;
				//We send the message
				if(mysql_query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "1", "'.$title.'", "'.$_SESSION['userid'].'", "'.$dn1['recipid'].'", "'.$message.'", "'.time().'", "yes", "no")'))
				{
?>
<div class="message"><?php echo $lang['new_pm_00'];?><br />
<a href="list_pm.php"><?php echo $lang['new_pm_01'];?></a></div>
<?php
					$form = false;
				}
				else
				{
					//Otherwise, we say that an error occured
					$error = $lang['new_pm_02'];
				}
			}
			else
			{
				//Otherwise, we say the user cannot send a message to himself
				$error = $lang['new_pm_03'];
			}
		}
		else
		{
			//Otherwise, we say the recipient does not exists
			$error = $lang['new_pm_04'];
		}
	}
	else
	{
		//Otherwise, we say a field is empty
		$error = $lang['new_pm_05'];
	}
}
elseif(isset($_GET['recip']))
{
	//We get the username for the recipient if available
	$orecip = $_GET['recip'];
}
if($form)
{
//We display a message if necessary
if(isset($error))
{
	echo '<div class="message">'.$error.'</div>';
}
//We display the form
?>
<div class="content">
	<h1><?php echo $lang['new_pm_06'];?></h1>
    <form action="new_pm.php" method="post">
		<?php echo $lang['new_pm_07'];?><br />
        <label for="title"><?php echo $lang['new_pm_08'];?></label><input type="text" value="<?php echo htmlentities($otitle, ENT_QUOTES, 'UTF-8'); ?>" id="title" name="title" /><br />
        <label for="recip"><?php echo $lang['new_pm_09'];?><span class="small"><?php echo $lang['new_pm_10'];?></span></label><input type="text" value="<?php echo htmlentities($orecip, ENT_QUOTES, 'UTF-8'); ?>" id="recip" name="recip" /><br />
        <label for="message"><?php echo $lang['new_pm_11'];?></label><textarea cols="40" rows="5" id="message" name="message"><?php echo htmlentities($omessage, ENT_QUOTES, 'UTF-8'); ?></textarea><br />
        <input type="submit" value="Send" />
    </form>
</div>
<?php
}
}
else
{
	echo '<div class="message">'.$lang['new_pm_12'].'</div>';
}
?>
		<div class="foot"><a href="list_pm.php"><?php echo $lang['new_pm_13'];?></a> </div>
	</body>
</html>
<?php include '_footer.php'; ?>