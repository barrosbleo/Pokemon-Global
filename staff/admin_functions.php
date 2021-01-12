<?php
$types = array('', 'Normal', 'Fire', 'Water', 'Electric', 'Grass', 'Ice', 'Fighting', 'Poison', 'Ground', 'Flying', 'Psychic', 'Bug', 'Rock', 'Ghost', 'Dragon', 'Dark', 'Steel');

function validType($type) {
	global $types;
	return in_array($type, $types);
}

function typeSelectBox($name = '', $selectType = '') {
    global $types;
    
    $sbox = '<select name="'.$name.'">';
    foreach ($types as $type) {
        $sbox .= '<option value="'.$type.'"';
        
        if ($type == $selectType) {
            $sbox .= ' selected="selected"';
        }
        
        $sbox .= '>'.$type.'</option>';
    }
    $sbox .= '</select>';
    
    return $sbox;
}

function adminUsernameSelectBox($name = '', $selectUsername = '') {
    $query = mysql_query("SELECT * FROM `users` WHERE `admin`='1'");
    
    $sbox = '<select name="'.$name.'">';
    while ($user = mysql_fetch_assoc($query)) {
        $sbox .= '<option value="'.$user['username'].'"';
        
        if ($user['username'] == $selectUsername) {
            $sbox .= ' selected="selected"';
        }
        
        $sbox .= '>'.$user['username'].'</option>';
    }
    $sbox .= '</select>';
    
    return $sbox;
}

function numSelectBox($name = '', $selectNum = '', $start = 1, $end = 100, $attrs = '') {
    if ($end < $start) return;
    
    $sbox = '<select name="'.$name.'" '.$attrs.'>';
    for ($i=$start; $i<=$end; $i++) {
        $sbox .= '<option value="'.$i.'"';
        
        if ($i == $selectNum) {
            $sbox .= ' selected="selected"';
        }
        
        $sbox .= '>'.$i.'</option>';
    }
    $sbox .= '</select>';
    
    return $sbox;
}

function shopCatSelectBox($name = '', $selectCat = '', $attrs = '') {
    $query = mysql_query("SELECT DISTINCT(`category`) AS `cat`, `id` FROM `shop_pokemon` GROUP BY `cat`");
    
    $sbox = '<select name="'.$name.'" '.$attrs.'>';
    while ($catInfo = mysql_fetch_assoc($query)) {
        $sbox .= '<option value="'.$catInfo['cat'].'"';
        
        if ($catInfo['cat'] == $selectCat) {
            $sbox .= ' selected="selected"';
        }
        
        $sbox .= '>'.$catInfo['cat'].'</option>';
    }
    $sbox .= '</select>';
    
    return $sbox;
}

function echoHeader($header) {
	echo '<div class="sub-content-header"><h3>'.$header.'</h3></div>';
}


function getAdminProfileList() {
	$query = mysql_query("SELECT `id`, `username` FROM `users` WHERE `admin`='1'");

	$adminLinks = array();

	while ($row = mysql_fetch_assoc($query)) {
		$row = cleanHtml($row);
		$adminLinks[] = '<a href="../profile.php?id='.$row['id'].'">'.$row['username'].'</a>';
	}

	return implode(' &bull; ', $adminLinks);
}

function moveSelectBox($name = '', $selectMove = '') {
    $query = mysql_query("SELECT * FROM `moves` ORDER BY `name` ASC");
    
    $sbox = '<select name="'.$name.'">';
    while ($moveInfo = mysql_fetch_assoc($query)) {
        $sbox .= '<option value="'.$moveInfo['id'].'"';
        
        if ($moveInfo['name'] == $selectMove) {
            $sbox .= ' selected="selected"';
        }
        
        $sbox .= '>'.$moveInfo['name'].'</option>';
    }
    $sbox .= '</select>';
    
    return $sbox;
}

function clanSelectBox($name = '', $selectClan = '') {
    $query = mysql_query("SELECT * FROM `clans` ORDER BY `name` ASC");
    
    $sbox = '
        <select name="'.$name.'">
            <option value="'.$clanInfo['id'].'"
    ';
    
    if ($clanInfo['name'] == $selectClan) {
        $sbox .= ' selected="selected"';
    }
    
    $sbox .= '></option>';
    
    while ($clanInfo = mysql_fetch_assoc($query)) {
        $sbox .= '<option value="'.$clanInfo['id'].'"';
        
        if ($clanInfo['id'] == $selectClan) {
            $sbox .= ' selected="selected"';
        }
        
        $sbox .= '>'.$clanInfo['name'].'</option>';
    }
    $sbox .= '</select>';
    
    return $sbox;
}

function genderSelectBox($name = '', $selectGender = '') {
    
    $genders = array(0 => 'Genderless', 1 => 'Male', 2 => 'Female');
    
    $sbox = '<select name="'.$name.'">';
    foreach ($genders as $genderKey => $gender) {
        $sbox .= '<option value="'.$genderKey.'"';
        
        if ($genderKey == $selectGender) {
            $sbox .= ' selected="selected"';
        }
        
        $sbox .= '>'.$gender.'</option>';
    }
    $sbox .= '</select>';
    
    return $sbox;
}

function moveIdToName($id) {
    $id = (int) $id;
    
    $query = mysql_query("SELECT * FROM `moves` WHERE `id`='{$id}'");
    
    if (mysql_num_rows($query) == 0) {
        return false;
    }
    
    $moveInfo = mysql_fetch_assoc($query);
    return $moveInfo['name'];
}

?>