 <?php
die();
include('modules/lib.php');
    //include 'config.php';
     
    $query = mysql_query("select * from `offer_pokemon`");
     
    while ($row = mysql_fetch_assoc($query)) {
        $row['gender'] = rand(0, 2);
        $query2 = mysql_query("
           INSERT INTO `user_pokemon` (
               `uid`, `name`, `level`, `exp`, `move1`, `move2`, `move3`, `move4`, `gender`
           ) VALUES (
               '{$row['uid']}', '{$row['name']}', '{$row['level']}', '{$row['exp']}', '{$row['move1']}', '{$row['move2']}', '{$row['move3']}', '{$row['move4']}', '{$row['gender']}'
           )
       ");
     
        if ($query2) {
            mysql_query("delete from `offer_pokemon` where `id`='{$row['id']}'");
        }
    }
     
?>

