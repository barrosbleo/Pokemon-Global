<?php
include('modules/lib.php');
include '_header.php';
?>
<div class="content">
	<div class="wrap">
		<table>
			<tr>
				<td>
					<div class="poke two"></div>
					<div class="legalinfo">
						<h1><?php echo $lang['footer_legal'];?></h1>

						<?php echo $lang['legal_01'];?>
						<p>
							<a rel="license" href="http://creativecommons.org/licenses/by/2.0/uk/deed.en_US">
								<img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by/2.0/uk/88x31.png" />
							</a>
							<br>
							<span xmlns:dct="http://purl.org/dc/terms/" property="dct:title"><?php echo $lang['footer_cr_title'];?></span> 
							by <a xmlns:cc="http://creativecommons.org/ns#" href="http://pokeglobal.com" property="cc:attributionName" rel="cc:attributionURL">Luke</a> 	
							is licensed under a 
							<a rel="license" href="http://creativecommons.org/licenses/by/2.0/uk/deed.en_US">Creative Commons Attribution 2.0 UK: England &amp; Wales License</a>.
							<br>
							Based on a work at 					
							<a xmlns:dct="http://purl.org/dc/terms/" href="http://pkmnhelios" rel="dct:source">http://pkmnhelios.net</a>.
							<br>
							Permissions beyond the scope of this license may be available at 
							<a xmlns:cc="http://creativecommons.org/ns#" href="http://pokeglobal.com/legalinfo.php" rel="cc:morePermissions">http://pokeglobal.com/legalinfo.php</a>.
						</p>
						<p>If you have any inquires please contact the owner on contato@pokeglobal.com</p>
					</div>
					
					<?php include '_footer.php'; ?>
				</td>
			</tr>
		</table>
	</div>
</div>