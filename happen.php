<?php
include('modules/lib.php');
//i guess its a egg hatching test
?>
<div class="whathapen">
<?php
$query = "SELECT DISTINCT(`message`), `image` FROM `activity` ORDER BY `id` DESC LIMIT 10";

$activityArr = array();
$result = $conn->query($query);
while ($activity = $result->fetch_assoc()) {
	$activityArr[] = cleanHtml($activity);
}


?>

   <p id="me" style="zoom: 1;"></p>
   <p id="me" style="zoom: 1;">
  <?php echo $lang['happen_00'];?>
    </p>

    <script type="text/javascript">
      var element = document.getElementById('me');
      var duration = 1000;  /* 1000 millisecond fade = 1 sec */
      var steps = 20;       /* number of opacity intervals   */
      var delay = 2000;     /* 5 sec delay before fading out */
      
      var activity = <?php echo json_encode($activityArr); ?>;
      var cKey = 0;

      /* set the opacity of the element (between 0.0 and 1.0) */
      function setOpacity(level) {
        element.style.opacity = level;
        element.style.MozOpacity = level;
        element.style.KhtmlOpacity = level;
        element.style.filter = "alpha(opacity=" + (level * 100) + ");";
      }

      function fadeIn(){
      	element.innerHTML = activity[cKey]['message'];
      	
      	if (activity[cKey]['image'] != '') {
      		element.innerHTML += '<br /><img src="'+activity[cKey]['image']+'" />';
      	}
      	
      	cKey = (cKey+1) % activity.length;
      	
        for (i = 0; i <= 1; i += (1 / steps)) {
          setTimeout("setOpacity(" + i + ")", i * duration);
        }
        setTimeout("fadeOut()", delay);
      }

      function fadeOut() {
        for (i = 0; i <= 1; i += (1 / steps)) {
          setTimeout("setOpacity(" + (1 - i) + ")", i * duration);
        }
        setTimeout("fadeIn()", duration);
      }
      /* start the effect */
      fadeIn();
    </script>
</div>
