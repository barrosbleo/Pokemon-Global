<?php
include('../modules/lib.php');
require_once 'admin_functions.php';

if (!isAdmin()) {
    die();
}

include '_header.php';
echoHeader('Edit News');

if (isset($_POST['save'])) {
    $errors = array();
        
    $title = trim($_POST['title']);
    if (empty($title)) {
        $errors[] = 'Title can not be empty.';
    }
    
    $content = trim($_POST['content']);
    if (empty($content)) {
        $errors[] = 'Content can not be empty.';
    }
    
    $sqlPoster = cleanSql($_POST['poster']);
    $query = mysql_query("SELECT * FROM `users` WHERE `username`='{$sqlPoster}' AND `admin`='1'");
    if (mysql_num_rows($query) == 0) {
        $errors[] = 'Invalid poster.';
    }
    
    if (count($errors) >= 1) {
        echo '<div class="error">'.implode('</div><div class="error">', $errors).'</div>';
    } else {
        echo '<div class="notice">The news has been edited!</div>';

        $sqlTitle = cleanSql($title);
        $sqlContent = cleanSql($content);
		$time = time();
        mysql_query("UPDATE `news` SET `title`='{$sqlTitle}', `news`='{$sqlContent}', `bywho`='{$sqlPoster}', `date`='{$time}' WHERE `id`='1'");
    }
}

$query = mysql_query("SELECT * FROM `news` ORDER BY `id` DESC LIMIT 1");
$row = mysql_fetch_assoc($query);
$row = cleanHtml($row);

echo '
<form method="post">
    <table class="pretty-table center">
        <tr>
            <th colspan="2">Edit News</th>
        </tr>
        <tr>
            <td>Title:</td>
            <td><input type="text" name="title" size="50" value="'.$row['title'].'" /></td>
        </tr>
        <tr>
            <td>Content:</td>
            <td><textarea name="content" rows="15" cols="50">'.$row['news'].'</textarea></td>
        </tr>
        <tr>
            <td>Poster:</td>
            <td>'.adminUsernameSelectBox('poster', $row['bywho']).'</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="save" value="Save" /></td>
        </tr>
    </table>
</form>
';
include '_footer.php';
?>