<?php
include('../modules/lib.php');
require_once 'admin_functions.php';

if (!isAdmin()) {
    die('Only admins can access this page.');
}

include '_header.php';
echoHeader('Sprites Awaiting Approval');

if (isset($_GET['id'])) {
	$id = (int) $_GET['id'];
	
	$query = "SELECT * FROM `new_images` WHERE `id`='{$id}' LIMIT 1";
	
	if (numRows($query, $conn) == 1) {
		$imgRow = fetchAssoc($query, $conn);
		
		if (isset($_GET['accept'])) {
			$fname = '../images/pokemon/'.$imgRow['image_name'].'.png';
			
			if (file_exists($fname) && false) {
				$i = 1;
				while (true) {
					$bfname = '../images/pokemon/'.$imgRow['image_name'].'_backup'.$i.'.png';
					if (!file_exists($bfname)) {
						rename($fname, $bfname);
						break;
					}
					$i++;
				}
			}
			file_put_contents($fname, base64_decode($imgRow['image_data']));
			
			
			echo '<div class="notice">Image has been added/updated!</div>';
		} else if (isset($_GET['decline'])) {
			echo '<div class="notice">Image has been declined.</div>';
		}
		$conn->query("DELETE FROM `new_images` WHERE `id`='{$id}' LIMIT 1");
	}
}

echo '
    <table class="center pretty-table center-text" style="width: 750px;">
        <tr>
            <th>Submitted By</th>
            <th>Image Name</th>
            <th>Old Image</th>
            <th>New Image</th>
            <th>Comment</th>
            <th>Options</th>
        </tr>
';

$query = "SELECT * FROM `new_images` ORDER BY `id` DESC";
$result = $conn->query($query);
while ($imgRow = $result->fetch_assoc()) {
    $imgRow = cleanHtml($imgRow);
    
    $oldImageHtml = '-';
    if (file_exists('../images/pokemon/'.$imgRow['image_name'].'.png')) {
    	$oldImageHtml = '<img src="../images/pokemon/'.$imgRow['image_name'].'.png" />';
    }
    
    $query2 = "SELECT `username` FROM `users` WHERE `id`='{$imgRow['uid']}'";
    $username = fetchAssoc($query2, $conn);
    $username = $username['username'];
    
    echo '
	<tr>
		<td><a href="../profile.php?id='.$imgRow['uid'].'">'.$username.'</a></td>
		<td>'.$imgRow['image_name'].'</td>
		<td>'.$oldImageHtml.'</td>
		<td><img src="data:image/png;base64,'.$imgRow['image_data'].'" /></td>
		<td>'.$imgRow['comment'].'</td>
		<td>[<a href="?id='.$imgRow['id'].'&accept">Accept</a>]&nbsp;[<a href="?id='.$imgRow['id'].'&decline">Decline</a>]</td>
	</tr>
    ';
}

echo '</table>';

include '_footer.php';

?>