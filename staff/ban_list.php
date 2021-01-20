<?php
include('../modules/lib.php');
require_once 'admin_functions.php';

if (!isAdmin()) {
    die('Only admins can access this page.');
}

include '_header.php';
echoHeader('Ban List');

echo '
    <table class="center pretty-table center-text" style="width: 750px;">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Reason For Ban</th>
            <th>Options</th>
        </tr>
';

$query = "SELECT * FROM `users` WHERE `banned`='1' ORDER BY `id` ASC";
$result = $conn->query($query);
while ($banRow = $result->fetch_assoc()) {
    $banRow = cleanHtml($banRow);
    echo '
        <tr>
            <td>'.$banRow['id'].'</td>
            <td><a href="../profile.php?id='.$banRow['id'].'">'.$banRow['username'].'</a></td>
            <td>'.$banRow['ban_reason'].'</td>
            <td>[<a href="edit_user.php?id='.$banRow['id'].'">Edit&nbsp;User</a>]</td>
        </tr>
    ';
}

include '_footer.php';

?>