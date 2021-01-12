<?php
include('../modules/lib.php');
require_once 'admin_functions.php';

if (!isAdmin()) {
    die();
}

include '_header.php';
echoHeader('News List');

$query = mysql_query("SELECT * FROM `news` ORDER BY `id` DESC");

echo '
    <table class="pretty-table" style="margin-left: 10px; margin-right: 10px;">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>News</th>
            <th>Date</th>
            <th>By Who</th>
        </tr>
';
while ($row = mysql_fetch_assoc($query)) {
    $row = cleanHtml($row);
    echo '
        <tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['title'].'</td>
            <td>'.$row['news'].'</td>
            <td>'.$row['date'].'</td>
            <td>'.$row['bywho'].'</td>
        </tr>
    ';
}

echo '
    </table>
';
include '_footer.php';
?>