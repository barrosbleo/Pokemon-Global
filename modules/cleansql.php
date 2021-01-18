<?php
//clean string before sending to mysql(needs to be rewrited)
function cleanSql($input, $conn) {
	if (is_array($input)) {
		foreach ($input as $k => $v) {
			$output[$k] = cleanSql($v);
		}
	} else {
		$output = (string) $input;
		$output = $conn->real_escape_string($output);
	}

	return $output;
}

?>