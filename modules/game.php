<?php



//maintenance switches
if ($maintenance == 1) { redirect('updates.php'); }



//cleans string to pure html format(needs to be rewrited)
function cleanHtml($input) {
	if (is_array($input)) {
		foreach ($input as $k => $v) {
			$output[$k] = cleanHtml($v);
		}
	} else {
		$output = (string) $input;
		$output = htmlentities($output, ENT_QUOTES, 'UTF-8');
	}

	return $output;
}

//load configuration value
function getConfigValue($name, $conn) {
	$query = "SELECT `value` FROM `config` WHERE `name`='{$name}'";
	
	if ($query) {
		$row = fetchAssoc($query, $conn);
		return $row['value'];
	}
	
	return false;
}

//set configuration value
function setConfigValue($name, $value, $conn) {
	$query = $conn->query("UPDATE `config` SET `value`='{$value}' WHERE `name`='{$name}'");
	return $query ? true : false ;
}

//convert seconds to minutes, days and hours
function secondsToTimeSince($seconds) {
	$seconds    = (int) $seconds;
	$timeString = '';
	
	$days = floor($seconds / (60*60*24));
	$dStr = $days == 1 ? ' day ' : ' days ' ;
	
	$hours = floor(($seconds / (60*60)) % 24);
	$hStr  = $hours == 1 ? ' hour ' : ' hours ' ;
	
	$mins = floor(($seconds / 60) % 60);
	$mStr = $mins == 1 ? ' minute ' : ' minutes ' ;
	
	$seconds = $seconds % 60;
	
	$timeString .= $days  > 0 ? $days  . $dStr : '' ;
	$timeString .= $hours > 0 ? $hours . $hStr : '' ;
	$timeString .= $mins  > 0 ? $mins  . $mStr : '' ;
	$timeString .= $seconds . ' seconds';
	
	return $timeString; 
}

//calculate exp to level
function expToLevel($exp) {
	for ($i = 10000; $i > 0; $i--) {
		if ($exp >= levelToExp($i)) {
			return $i;
		}
	}
	
	return 0;
}

//calculate level to exp
function levelToExp($level) {
	return ($level * $level) * 10;
	//return floor(pow($level,1*3));
}

//this "if" will prevent double definition of GOT_CONFIG(i dont know what is this)
if(!defined('GOT_CONFIG')){
	define('GOT_CONFIG', true);
}
?>