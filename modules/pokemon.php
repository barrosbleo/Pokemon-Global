<?php


//get pokemon max helth points
function maxHp($name, $level, $conn) {
	//if ($_SESSION['admin'] == true || $_SESSION['username'] == 'DarkMaster') {
		$prefixes = array('Snow', 'Shiny', 'Halloween', 'Rainbow', 'Helios', 'Possion', 'Shadow');
		
		$nName = trim(str_replace($prefixes, '', $name));
		
		$query = "SELECT `hp` FROM `pokedex` WHERE `name`='{$nName}'";
		if (numRows($query, $conn) == 1) {
			$pdexRow = fetchAssoc($query, $conn);
			$hp = ((($pdexRow['hp']*2)+110)/100)*$level;
			
			if (strpos($name, 'Shiny ') === 0) {
				$hp = $hp+(($hp/100)*10);
			}	
			
			/*if (strpos($name, 'Helios ') === 0) {
				$hp = $hp+(($hp/100)*20);
			}*/	
				
			if (strpos($name, 'Possion ') === 0) {
				$hp = $hp+(($hp/100)*25);
			}	
			 
			/*if (strpos($name, 'Rainbow ') === 0) {
				$hp = $hp+(($hp/100)*15);
			}*/
			
			return round($hp);
		}
		return $level*3;
	//}
	/*
	if (strpos($name, 'Shiny ') === 0) {
		return $level*5;
	}	
	
	if (strpos($name, 'Helios ') === 0) {
		return $level*6;
	}	
		
	if (strpos($name, 'Possion ') === 0) {
		return $level*6;
	}	
	 
	if (strpos($name, 'Rainbow ') === 0) {
		return $level*7;
	}
	
	return $level*4;
	*/
}


?>