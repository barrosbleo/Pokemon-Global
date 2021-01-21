<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('login.php');
}

include '_header.php';
printHeader($lang['messages_title']);
echo '
    <div style="text-align: center;">
        <a href="messages.php?p=inbox">'.$lang['messages_01'].'</a> &bull; 
        <a href="messages.php?p=outbox">'.$lang['messages_02'].'</a> &bull; 
        <a href="messages.php?p=new">'.$lang['messages_03'].'</a>
    </div>
';

$uid = (int) $_SESSION['userid'];


switch ($_GET['p']) {
	case 'outbox';
	case 'inbox':

		$column   = $_GET['p'] == 'outbox' ? 'sender_uid' : 'recipient_uid' ;
		$header   = $_GET['p'] == 'outbox' ? 'To'         : 'From'          ;
		$key      = $_GET['p'] == 'outbox' ? 'recipient'  : 'sender'        ;
		$extraSql = $_GET['p'] == 'outbox' ? " `deleted_by_sender`='0' " : " `deleted_by_recipient`='0' " ;
		
		$query = "SELECT * FROM `messages` WHERE `{$column}`='{$uid}' AND {$extraSql} ORDER BY `id` DESC";
		
		if (numRows($query, $conn) == 0) {
			echo '<div class="error">'.$lang['messages_04'].' '.cleanHtml($_GET['p']).'.</div>';
		} else {
			echo '
				<form method="post" action="messages.php?p=delete">
				<table class="pretty-table">
					<tr>
						<th style="width: 30px;">
							<input type="checkbox" onclick="setChecked(\'messages[]\', this.checked)" id="selectionHelper" style="display: none;" />
						</th>
						<th>Subject</th>
						<th style="width: 20%;">'.$header.'</th>
						<th style="width: 30%;">Time Sent</th>
					</tr>
			';
			$result = $conn->query($query);
			while ($row = $result->fetch_assoc()) {
				$row = cleanHtml($row);
				$class = $row['read'] == 0 ? 'unread-message' : '' ;
				echo '
					<tr class="'.$class.'">
						<td><input type="checkbox" name="messages[]" value="'.$row['id'].'" /></td>
						<td><a href="messages.php?p=read&amp;id='.$row['id'].'">'.$row['subject'].'</a></td>
						<td><a href="profile.php?id='.$row['sender_uid'].'">'.$row[$key].'</a></td>
						<td>'.date('F j, Y, g:i a', $row['timestamp']).'</td>
					</tr>
				';
			}
			echo '
				<tr>
					<td colspan="4" class="text-left">
						<input type="submit" value="'.$lang['messages_05'].'" />
					</td>
				</tr>
			';
			echo '
				</table>
				</form>
				<script>
					function setChecked(name, sts) {
						var elems = document.querySelectorAll(\'input[name="\'+name+\'"]\');
						for (var i=0; i<elems.length; i++) {
							elems[i].checked = sts;
						}
					}
					document.getElementById(\'selectionHelper\').style.display = "inline";
				</script>
			';
		}
	break;
	
	case 'read':
		$id = (int) $_GET['id'];
		$query = "SELECT * FROM `messages` WHERE `id`='{$id}' LIMIT 1";
	
		if (numRows($query, $conn) != 1) {
			echo '<div class="error">'.$lang['messages_06'].'</div>';
		} else {
			$message = fetchAssoc($query, $conn);
			
			
			if ($message['recipient_uid'] != $uid && $message['sender_uid'] != $uid) {
				echo '<div class="error">'.$lang['messages_07'].'</div>';
			} else if (
				($message['recipient_uid'] == $uid && $message['deleted_by_recipient'] == 1) ||
				($message['sender_uid'] == $uid && $message['deleted_by_sender'] == 1)
			) {
				echo '<div class="error">'.$lang['messages_08'].'</div>';
			} else {
				if ($message['read'] == 0) {
					$conn->query("UPDATE `messages` SET `read`='1' WHERE `id`='{$id}' LIMIT 1");
					$conn->query("UPDATE `users` SET `unread_messages`=`unread_messages`-1 WHERE `id`='{$uid}' LIMIT 1");
				}
				$message = cleanHtml($message);
				
				$startQuotes = substr_count($message['message'], '[quote]');
				$endQuotes   = substr_count($message['message'], '[/quote]');
				
				if ($startQuotes != 0 && $startQuotes == $endQuotes) {
					$message['message'] = str_replace(array('[quote]', '[/quote]'), array('<div class="quote">', '</div>'), $message['message']);
				}
				
				if ($message['sender_uid'] == $uid) {
					$replyLink = '<a href="messages.php?p=new&uid='.$message['recipient_uid'].'">'.$lang['messages_09'].'</a> &bull; ';
				} else {
					$replyLink = '<a href="messages.php?p=new&reply='.$message['id'].'">'.$lang['messages_10'].'</a> &bull; ';
				}
				
				echo '
					<table class="pretty-table">
						<tr>
							<td style="width: 100px;" class="text-right">'.$lang['messages_11'].': </td>
							<td class="text-left"><a href="profile.php?id='.$message['recipient_uid'].'">'.$message['recipient'].'</a></td>
						</tr>
						<tr>
							<td style="width: 100px;" class="text-right">'.$lang['messages_12'].': </td>
							<td class="text-left"><a href="profile.php?id='.$message['sender_uid'].'">'.$message['sender'].'</a></td>
						</tr>
						<tr>
							<td style="width: 100px;" class="text-right">'.$lang['messages_13'].': </td>
							<td class="text-left">'.$message['subject'].'</td>
						</tr>
						<tr>
							<td style="width: 100px;" class="text-right">'.$lang['messages_14'].': </td>
							<td class="text-left">'.nl2br($message['message']).'</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td class="text-left">
								'.date('F j, Y, g:i a', $message['timestamp']).'<br />
								'.$replyLink.'<a href="messages.php?p=delete&id='.$message['id'].'">'.$lang['messages_15'].'</a>
							</td>
						</tr>
					</table>
				';
			}
		}
	break;
	
	case 'new':
		
		$username = isset($_POST['username']) ? $_POST['username'] : '' ;
		$subject  = isset($_POST['subject'])  ? $_POST['subject']  : '' ;
		$message  = isset($_POST['message'])  ? $_POST['message']  : '' ;
		$outbox   = isset($_POST['saveOutbox']) ? 0 : 1 ;
		
		if (count($_POST) > 0) {
			$sqlUsername = cleanSql($username, $conn);
			$sqlSubject  = cleanSql($subject, $conn);
			$sqlMessage  = cleanSql($message, $conn);
			$errors = array();
			
			$query = "SELECT `id` FROM `users` WHERE `username`='{$sqlUsername}' LIMIT 1";
			if (empty($username)) {
				$errors[] = $lang['messages_16'];
			} elseif (numRows($query, $conn) == 0) {
				$errors[] = $lang['messages_17'];
			} else {
				$userid = fetchAssoc($query, $conn);
				$userid = (int) $userid['id'];
			}
			
			if (empty($subject)) {
				$errors[] = $lang['messages_18'];
			}
			
			if (empty($message)) {
				$errors[] = $lang['messages_19'];
			}
			
			if ($_SESSION['token'] != $_POST['token']) {
				$errors[] = $lang['messages_20'];
				$username = '';
				$subject  = '';
				$message  = '';
			}
			
			if (count($errors) > 0) {
				echo '<div class="error">'.implode('</div><div class="error">', $errors).'</div>';
			} else {
				$sqlSender = cleanSql($_SESSION['username'], $conn);
				$time = time();
				
				$query = $conn->query("
					INSERT INTO `messages` (
						`sender_uid`, `recipient_uid`, `sender`, `recipient`,
						`timestamp`, `subject`, `message`, `read`,
						`deleted_by_sender`, `deleted_by_recipient`
					) VALUES (
						'{$uid}', '{$userid}', '{$sqlSender}', '{$sqlUsername}',
						'{$time}', '{$sqlSubject}', '{$sqlMessage}', '0',
						'{$outbox}', '0'
					)
				");
				$conn->query("UPDATE `users` SET `unread_messages`=`unread_messages`+1, `total_messages`=`total_messages`+1 WHERE `id`='{$userid}' LIMIT 1");
				
				if ($query) {
					echo '<div class="notice">'.$lang['messages_21'].'</div>';
					$username = '';
					$subject  = '';
					$message  = '';
				} else {
					echo '<div class="error">'.$lang['messages_20'].'</div>';
				}
			}
		}
		
		if (isset($_GET['reply'])) {
			$id = (int) $_GET['reply'];
			$query = "SELECT * FROM `messages` WHERE `id`='{$id}' AND `recipient_uid`='{$uid}' LIMIT 1";
			
			if (numRows($query, $conn) == 1) {
				$message  = fetchAssoc($query, $conn);
				$username = $message['sender'];
				$subject  = strpos($message['subject'], 'Re: ') === 0 ? $message['subject'] : 'Re: '.$message['subject'] ;
				$message  = '[quote]'.$message['message'].'[/quote]';
			}
		}
		
		if (isset($_GET['uid'])) {
			$id = (int) $_GET['uid'];
			$query = "SELECT `username` FROM `users` WHERE `id`='{$id}' LIMIT 1";
			
			if (numRows($query, $conn) == 1) {
				$userRow  = fetchAssoc($query, $conn);
				$username = $userRow['username'];
			}
		}
		
		$token = md5(rand());
		$_SESSION['token'] = $token;
		echo '
			<form action="messages.php?p=new" method="post" style="width: 600px; margin: 20px auto;">
				<input type="hidden" name="token" value="'.$token.'" />
				<table class="pretty-table">
					<tr>
						<td class="text-right">'.$lang['messages_11'].':</td>
						<td class="text-left"><input type="text" name="username" size="30" value="'.cleanHtml($username).'" /></td>
					</tr>
					<tr>
						<td class="text-right">'.$lang['messages_13'].':</td>
						<td class="text-left"><input type="text" name="subject" size="50" value="'.cleanHtml($subject).'" /></td>
					</tr>
					<tr>
						<td valign="top" class="text-right">'.$lang['messages_14'].':</td>
						<td class="text-left">
							<textarea name="message" cols="50" rows="5">'.cleanHtml($message).'</textarea>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="checkbox" name="saveOutbox"  /> '.$lang['messages_22'].'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" value="'.$lang['messages_23'].'" /></td>
					</tr>
				</table>
			</form>
		';
	break;
	
	case 'delete':
		$messageIds = array();
		
		if (isset($_GET['id'])) {
			$messageIds = array($_GET['id']);
		}
		
		if (isset($_POST['messages'])) {
			$messageIds = $_POST['messages'];
		}
		
		if (count($messageIds) == 0) {
			echo '<div class="info">'.$lang['messages_24'].'</div>';
		} else {
			foreach ($messageIds as $k => $v) {
				$messageIds[$k] = (int) $v;
			}
			
			$messageIdsSql = implode(', ', $messageIds);
			$query = "SELECT * FROM `messages` WHERE `id` IN ({$messageIdsSql}) AND (`recipient_uid`='{$uid}' OR `sender_uid`='{$uid}')";
			
			if (numRows($query, $conn) != count($messageIds)) {
				echo '<div class="error">'.$lang['messages_25'].'</div>';
			} else {
				$result = $conn->query($query);
				while ($message = $result->fetch_assoc()) {
					if ($message['recipient_uid'] == $uid) {
						$conn->query("UPDATE `messages` SET `deleted_by_recipient`='1' WHERE `id`='{$message['id']}' LIMIT 1");
						
						$extraSql = ($message['read'] == 0) ? ', `unread_messages`=`unread_messages`-1 ' : '' ;
						$conn->query("UPDATE `users` SET `total_messages`=`total_messages`-1 {$extraSql} WHERE `id`='{$uid}' LIMIT 1");
					}
					
					if ($message['sender_uid'] == $uid) {
						$conn->query("UPDATE `messages` SET `deleted_by_sender`='1' WHERE `id`='{$message['id']}' LIMIT 1");
					}
				}
				$conn->query("DELETE FROM `messages` WHERE `deleted_by_sender`='1' AND `deleted_by_recipient`='1'");
				
				if (count($messageIds) == 1) {
					echo '<div class="notice">'.$lang['messages_26'].'</div>';
				} else {
					echo '<div class="notice">'.$lang['messages_27'].'</div>';
				}
			}
		}
	break;
}


include '_footer.php';
?>