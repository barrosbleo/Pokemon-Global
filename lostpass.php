<?php
die();
include('modules/lib.php');
include "_header.php";


 if(isset($_POST['lostpassword'])) {
 $email = $_POST['email'];
 if($email == NULL) {
 $final_report.=$lang['lostpass_00'];
 }else{
 $query_data = mysql_query("SELECT * FROM `users` WHERE `email`='".$email."'");
 if(mysql_num_rows($query_data) == 0){
 $final_report.=$lang['lostpass_01'];
 }else{
 $query_data = mysql_query("SELECT * FROM `users` WHERE `email`='".$email."'");
 $final_report.=$lang['lostpass_02'];
 $get_data = mysql_fetch_array($query_data);
 $subject = $lang['lostpass_03']; 
 $message = $lang['lostpass_04']." ".$get_data['username'].", 
 
".$lang['lostpass_05']." ".pack("H*", sha1($get_data['password']));" ".$lang['lostpass_06'];  
mail($get_data['email'], $subject, $message, $lang['lostpass_07']); 
header( 'refresh: 3; url=index.php');
}}}
?>

<form method="post">
  <table>

    <tr>
      <td><?php if(!isset($_POST['lostpassword'])){?>
        <?php echo $lang['lostpass_08'];?>
        <?php }else{ echo "".$final_report."";}?></td>
    </tr>
    <tr>
      <td width="37%"><?php echo $lang['lostpass_09'];?></td>
      <td width="63%"><input name="email" type="text" id="email" size="30" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="lostpassword" type="submit" value="Lost Password" /></td>
    </tr>
 
  </table>
</form>
<?php
include "_footer.php";
?>
