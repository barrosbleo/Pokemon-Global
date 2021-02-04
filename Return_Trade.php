 <?php
 //guess this is for cancel all user trades
 //move this to staff section
die();
include('modules/lib.php');

$query = "select * from `offer_pokemon`";

$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
	$row['gender'] = rand(0, 2);
	$query2 = $conn->query("
		INSERT INTO `user_pokemon` (
		`uid`, `name`, `level`, `exp`, `move1`, `move2`, `move3`, `move4`, `gender`
		) VALUES (
		'{$row['uid']}', '{$row['name']}', '{$row['level']}', '{$row['exp']}', '{$row['move1']}', '{$row['move2']}', '{$row['move3']}', '{$row['move4']}', '{$row['gender']}'
		)
	");

	if ($query2) {
		$conn->query("delete from `offer_pokemon` where `id`='{$row['id']}'");
	}
}   
?>

