<div id="loginPage" = style="display:none">
<div class="content">
	<div class="wrap">
		<table>
			<tr>
				<td>
					<div class="poke one"></div>
					<p class="error" id="error" style="display:none"></p>
					<div class="login">
						<div class="form"><!--<center><font color="black">Unfortunately this RPG is closed.</font></center>-->
						<input type="text" id="username" name="username" placeholder="<?php echo $lang['login_username'];?>" autofocus="on">
							<input type="password" id="password" name="password" placeholder="<?php echo $lang['login_password'];?>">
							<button id="submit" value="log in" class="btn" onclick="doLogin()"><?php echo $lang['menu_login'];?></button>
										
							<ul class="nav">
								<li><p onclick="loadPage('password_forgot');"><?php echo $lang['login_forgot'];?></p></li>
								<li><p onclick="loadPage('register');"><?php echo $lang['login_start'];?></p></li>
							</ul>
										
							<div class="footer">
								<?php echo $lang['login_online'];?>- <?php echo number_format($online);?>
								<?php echo $lang['login_total'];?>- <?php echo number_format($usersTotal);?>
							</div>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>
</div>