<?php


$starterCells = array();
foreach($pokemonNames as $name){
	$starterCells[] = 
		$name.'
		<label>
		<img src="images/pokemon/'.$name.'.png" alt="'.$name.'">
		<input type="radio" name="pokemon"  id="regStarter" value="'.$name.'">
		</label></br></br>
	';
}
?>
<div id="pokeName"></div>
<div id="registerPage" style="display:none">
<div class="content">
	<div class="wrap">
		<table>
			<tr>
				<td>
					<div class="poke three"></div>
					<div class="register">
					<p class="error" id="regError" style="display:none"></p>
						<div class="title" align="center"><?php echo $lang['register_title'];?></div>
							<table style=" text-align: left;">
								<tr class="block">
									<th><?php echo $lang['register_username'];?></th>
									<td><input type="text" id="regUser" name="username" autofocus="on" /></td>
								</tr>
								
								<tr class="block">
									<th><?php echo $lang['register_pwd'];?></th>
									<td><input type="password" id="regPass" name="password" /></td>
								</tr>
								
								<tr class="block">
									<th><?php echo $lang['register_pwd_again'];?></th>
									<td><input type="password" id="regRePass" name="password2" /></td>
								</tr>
								
								<tr class="block">
									<th><?php echo $lang['register_email'];?></th>
									<td><input type="text" id="regMail" name="email"/></td>
								</tr>
								
								<tr class="block">
									<th colspan="2" style="vertical-align: top;"></br></br></th>				
								</tr>
								
								<tr class="block">
									<th colspan="2" style="vertical-align: top;"><?php echo $lang['register_starter'];?></th>				
								</tr>
								<tr class="block">
									<td colspan="2">
										<table class="table" style="text-align: center; border: solid 1px">
											<?php echo cellsToRows($starterCells, DEFAULT_STARTER_COLUMNS);?>
										</table></br>
									</td>
								</tr>
								
								<tr class="block">
									<td colspan="2"><center><button id="regBtn" value="register" class="btn" onclick="doRegister()"><?php echo $lang['register_signup'];?></button></center></td>
								</tr>
							</table>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>
</div>