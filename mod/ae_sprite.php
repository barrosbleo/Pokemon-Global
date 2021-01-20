<?php
include('../modules/lib.php');
require_once 'mod_functions.php';

if (!isMod()) {
    die('Only mods can access this page.');
}

include '_header.php';
echoHeader('Add New Sprite');

if (isset($_POST['submit'], $_POST['img_name'], $_POST['comment'])) {
	if ($_FILES['file']['error'] > 0) {
		// echo $_FILES["file"]["error"] . '<br />';
		echo '<div class="error">There was an error!</div>';
	} else if ($_FILES['file']['size'] > 1048576) {
		echo '<div class="error">The file size it too large!</div>';
	} else {
		$imageData = file_get_contents($_FILES['file']['tmp_name']);
		$im = imagecreatefromstring($imageData);
		
		if ($im == false) {
			echo '<div class="error">There was an error creating the image!</div>';
		} else {
			$base64Image = cleanSql(base64_encode($imageData), $conn);
			$imgName     = cleanSql(trim(str_replace(array(chr(0),'<','>','.','/','\\'), '' , $_POST['img_name'])), $conn);
			$comment     = cleanSql($_POST['comment'], $conn);
			$uid         = (int) $_SESSION['userid'];
			
			if (empty($imgName)) { 
				echo '<div class="error">Image name was empty!</div>';
			} else {
				$conn->query("
					INSERT INTO `new_images` (
						`uid`, `image_data`, `image_name`, `comment`
					) VALUES (
						'{$uid}', '{$base64Image}', '{$imgName}', '{$comment}'
					)
				");
				echo '<div class="notice">Image was submitted for admin approval!</div>';
			}
		}
	}
}

echo '
    <form method="post" enctype="multipart/form-data">
        <table class="pretty-table center">
            <tr>
                <th colspan="2">Add New Pokemon Sprite</th>
            </tr>
            <tr>
                <td>Image Name:</td>
        	<td>
        		<input type="text" name="img_name" value="Mew" onkeyup="document.getElementById(\'pPic\').src = \'../images/pokemon/\'+this.value+\'.png\';" /><br />
            		<img id="pPic" src="../images/pokemon/Mew.png" /><br />
            		<span class="small">
            			This is what the image will be named.<br />
            			No file extension required.<br />
            			<, >, ., / and \ will be removed.
            		</span>
        	</td>
	    </tr>
            <tr>
                <td>Image:</td>
            	<td><input type="file" name="file" /></td>
	    </tr>
	    <tr>
                <td>Comment:<br /><span class="small">(optional)</span></td>
            	<td><textarea name="comment" rows="5" cols="50"></textarea></td>
	    </tr>
            <tr>
	        <tr>
	        	<td>&nbsp;</td>
	        	<td>
		        	<span class="small">Images will be updated when an admin approves it.</span><br /><br />
		        	<input type="submit" name="submit" value="Submit" />
	        	</td>
	        </tr>
        </table>
    </form>
';

include '_footer.php';

?>