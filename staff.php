<?php
include('modules/lib.php');

if (!isLoggedIn()) {
	redirect('index.php');
}

include '_header.php';
printHeader($lang['staff_title']);

function getAvatarUrl($uid, $conn) {
    $uid = (int) $uid;
    $defaultAvatar = 'http://localhost/images/trainers/Darkmuj.png';
    
    $query = "SELECT `avatar` FROM `users` WHERE `id`='{$uid}'";
    $userRow = fetchAssoc($query, $conn);
    $avatar = !filter_var($userRow['avatar'], FILTER_VALIDATE_URL) ? $defaultAvatar : cleanHtml($userRow['avatar']) ;
    return $avatar;
}


$fbicon = 'http://icons.iconarchive.com/icons/cute-little-factory/beer-cap-social/32/Beer-Cap-Facebook-icon.png';
?>

<span style="color: orange;">
    
<table class="pretty-table">
    <tr>
        <th><?php echo $lang['staff_00'];?></th>
        <th><?php echo $lang['staff_01'];?></th>
        <th><?php echo $lang['staff_02'];?></th>
        <th><?php echo $lang['staff_03'];?></th>
        <th><?php echo $lang['staff_04'];?></th>
    </tr>
    <tr>
        <td>#1</td>
        <td><img src="<?php echo  getAvatarUrl(1, $conn); ?>" /></td>
        <td><a href="profile.php?id=1">Barrosbleo</a></td>
        <td><font color="red">Owner</font></td>
        <td><img src="<?php echo $fbicon;?>"></td>

    </tr>
<!--    <tr>
        <td>#2</td>
        <td><img src="<?php echo  getAvatarUrl(55369, $conn); ?>" /></td>
        <td><a href="profile.php?id=1854">Meetwow~</a></td>
        <td><font color="orange">Moderator</font></td>
        <td><a href="#"><img src="<?php echo $fbicon;?>"></a></td>
    </tr>
    <tr>
    
        <td>#52017</td>
        <td><img src="<?php echo  getAvatarUrl(52017, $conn); ?>" /></td>
        <td><a href="profile.php?id=52017">Luis</a></td>
        <td><font color="pink">FB/Chat mod</font></td>
        <td><a href="#"><img src="<?php echo $fbicon;?>"></a></td>
            </tr>
    <tr>
        </tr>
        
                <td>#4266</td>
        <td><img src="<?php echo  getAvatarUrl(41513, $conn); ?>" /></td>
        <td><a href="profile.php?id=41513">Rebornz</a></td>
        <td><font color="yellow">GFX spriter</font></td>
        <td><a href="#"><img src="<?php echo $fbicon;?>"></a></td>
            </tr>
    <tr>
        </tr>
        

    <tr>
        <td>#28</td>
        <td><img src="<?php echo  getAvatarUrl(28, $conn); ?>" /></td>
        <td><a href="profile.php?id=28">OVO (Cherreh)</a></td>
        <td><font color="blue">Chat mod</font></td>
        <td><a href="#"><img src="<?php echo $fbicon;?>"></a></td>

    </tr>--!>
</table>

<?php include '_footer.php'; ?>