<?php

date_default_timezone_set('America/Los_Angeles');

function drawStar($img, $x, $y, $r, $g, $b, $radius)
{
	if ($radius == 0) return;

	$minX = max(0, $x - $radius);
	$minY = max(0, $y - $radius);
	$maxX = min(imagesx($img) - 1, $x + $radius);
	$maxY = min(imagesy($img) - 1, $y + $radius);

	for ($cx=$minX;$cx <= $maxX;++$cx)
	{
		for ($cy=$minY;$cy < $maxY;++$cy)
		{
			$dx = abs($cx - $x) / $radius;
			$dy = abs($cy - $y) / $radius;

			$gradient = max(min(1 - (sqrt($dx) + sqrt($dy)), 1), 0);

			$existingColor = imagecolorat($img, $cx, $cy);
			$er = ($existingColor >> 16) & 0xFF;
			$eg = ($existingColor >> 8) & 0xFF;
			$eb = ($existingColor >> 0) & 0xFF;

			imagesetpixel($img, $cx, $cy, imagecolorallocate($img,
				round(min($er + ($r * $gradient), 255)),
				round((int)min($eg + ($g * $gradient), 255)),
				round((int)min($eb + ($b * $gradient), 255))
			));
		}
	}
}

$img = imagecreatetruecolor(2048, 2048);

for ($i=0;$i<4000;++$i)
{
	$starSize = 1;

	while(mt_rand(1,3) == 1) $starSize++;

	drawStar($img, mt_rand(-40, imagesx($img) + 40), mt_rand(-40, imagesy($img) + 40), mt_rand(190, 255), mt_rand(190, 255), mt_rand(190, 255), $starSize);
}

/*for ($i=1;$i<20;++$i)
{
	drawStar($img, $i * 50, 200, 255,255,255, $i);
}*/

@mkdir('out');

imagepng($img, 'out/out_' . preg_replace('/[^A-Za-z0-9]/', '_', date(DATE_W3C)) . '.png');