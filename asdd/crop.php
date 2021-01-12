<?php
die();
$across = 31;
$down = 21;

$current_image = imagecreatefrompng('sheet.png');

for ($r=0; $r<$down; $r++) {
	for ($i=0; $i<$across; $i++) {
		$canvas = imagecreatetruecolor(96, 96);
	
		$color = imagecolorallocatealpha($canvas, 0, 0, 0, 127);
		imagefill($canvas, 0, 0, $color);
		imagesavealpha($canvas, TRUE);
	
		imagecopy($canvas, $current_image, 0, 0, $i*96, $r*96, 96, 96);
		imagepng($canvas, 'images/' . ($i + 1 + ($r*31)) . '.png');
		imagedestroy($canvas);
	}
}
?>