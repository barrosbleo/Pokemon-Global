<div id="newsPage" style="display:none">
<div class="content">
	<div class="wrap">
		<table>
			<tr>
				<td>
					<div class="welcome">
						<div class="poke two"></div>
						
						<div class="about"><?php echo $lang['welcome_about'];?></div>
						
						<div class="news-title"><?php echo $lang['welcome_news_title'];?></div>
						<?php
							$queryNews = $conn->query("SELECT * FROM news ORDER BY `id` DESC LIMIT 5");
							while ($news = mysqli_fetch_array($queryNews)) {
						?>
						<div class="news">
							<div class="subject"><?php echo $news['title'];?></div>
							
							<div class="post"><?php echo nl2br($news['news']);?></div>
							
							<div class="footer">
								<div class="by"><?php echo $lang['welcome_news_by'];?><?php echo $news['bywho'];?></div>
								<div class="date"><?php echo date('j M Y', $news['date']);?></div>
							</div>
						</div>
						<?php } ?>
					</div>
					
					
				</td>
			</tr>
		</table>
	</div>
</div>
</div>