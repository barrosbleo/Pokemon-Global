<?php
include('modules/lib.php');
        
if (!isLoggedin()) {
    redirect('login.php');
}
        
include("_header.php");
$uid = (int) $_SESSION['userid'];
        
        /*
        // why is this here? i can not see where it is used!
        // also mysql_select_db should be mysql_fetch_assoc ;-)
        // - asdd
        //
	$user = cleanSql($_SESSION['username'], $conn);
	$info = mysql_select_db(mysql_query("SELECT * FROM `users` WHERE `username` = '$user'"));      
	$user = $info['username'];
        $userid = $info['id'];
	$password2 = $info['password'];
	*/
?>
<center>

<?php

if(isset($_POST['update'], $_POST['avatar'])) {
	$avatar = cleanSql('http://localhost/'.$_POST['avatar'], $conn);
	$update = $conn->query("UPDATE `users` SET `avatar`= '$avatar' WHERE `id`='$uid'");
	echo $lang['avatar_updated'];
}
?>

<form method="post">
 <?php echo $lang['choose_avatar'];?> <br><?php     echo '<img id=avatarchange src=images/trainers/000.png />'; ?>
                   <?php
     echo '<select name=avatar id= Avatar onChange=changeAvi()>';
      $sql6="SELECT * FROM avatars";
	  $result = $conn->query($sql6);
     while ($row6 = $result->fetch_array(MYSQLI_ASSOC)){
     echo "<option value='".$row6['Image']."'>".$row6['Name']."</option>";
      }
     echo '</select>';   
   ?> 
 <script type="text/javascript">
 function changeAvi(){
     var image = document.getElementById('avatarchange');
     var dropd = document.getElementById('Avatar');
   image.src = dropd.value;
     };
 </script> 

<br>
 <input type="submit" name="update" id="button"/> </form>

<script type="text/javascript">
 function changeAvi(){
     var image = document.getElementById('avatarchange');
     var dropd = document.getElementById('Avatar');
   image.src = dropd.value;
     };
 </script> 


<?php
        include("_footer.php");
?>


 





