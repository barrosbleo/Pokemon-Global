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

function adminUsernameSelectBox($name = '', $selectUsername = '', $conn) {
    $query = "SELECT * FROM `users` WHERE `admin`='1'";
    
    $sbox = '<select name="'.$name.'">';
	$result = $conn->query($query);
    while ($user = $result->fetch_assoc()) {
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

function shopCatSelectBox($name = '', $selectCat = '', $attrs = '', $conn) {
    $query = "SELECT DISTINCT(`category`) AS `cat`, `id` FROM `shop_pokemon` GROUP BY `cat`";
    
    $sbox = '<select name="'.$name.'" '.$attrs.'>';
	$result = $conn->query($query);
    while ($catInfo = $result->fetch_assoc()) {
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


function getAdminProfileList($conn) {
	$query = "SELECT `id`, `username` FROM `users` WHERE `admin`='1'";

	$adminLinks = array();
$result = $conn->query($query);
	while ($row = $result->fetch_assoc()) {
		$row = cleanHtml($row);
		$adminLinks[] = '<a href="../profile.php?id='.$row['id'].'">'.$row['username'].'</a>';
	}

	return implode(' &bull; ', $adminLinks);
}

function moveSelectBox($name = '', $selectMove = '', $conn) {
    $query = "SELECT * FROM `moves` ORDER BY `name` ASC";
    
    $sbox = '<select name="'.$name.'">';
	$result = $conn->query($query);
    while ($moveInfo = $result->fetch_assoc()) {
        $sbox .= '<option value="'.$moveInfo['id'].'"';
        
        if ($moveInfo['name'] == $selectMove) {
            $sbox .= ' selected="selected"';
        }
        
        $sbox .= '>'.$moveInfo['name'].'</option>';
    }
    $sbox .= '</select>';
    
    return $sbox;
}

function clanSelectBox($name = '', $selectClan = '', $conn) {
    $query = "SELECT * FROM `clans` ORDER BY `name` ASC";
    
    $sbox = '
        <select name="'.$name.'">
            <option value="'.$clanInfo['id'].'"
    ';
    
    if ($clanInfo['name'] == $selectClan) {
        $sbox .= ' selected="selected"';
    }
    
    $sbox .= '></option>';
    $result = $conn->query($query);
    while ($clanInfo = $result->fetch_assoc()) {
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

function moveIdToName($id, $conn) {
    $id = (int) $id;
    
    $query = "SELECT * FROM `moves` WHERE `id`='{$id}'";
    
    if (numRows($query, $conn) == 0) {
        return false;
    }
    
    $moveInfo = fetchAssoc($query, $conn);
    return $moveInfo['name'];
}

?>