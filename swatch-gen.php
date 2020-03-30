<?php
set_time_limit(0);

if ($argc != 4) {
	die("\r\n\033[0;36m-= Swatch Configs Generator =-\r\nUsage: " . $argv[0] . " listinput.txt outputfile servername\033[0;39m\r\n\n");
}

echo "\r\n\033[0;36m-=Swatch Config Generator=-\033[0;39m\r\n\n";

$servername = $argv[3];
$output = fopen($argv[2], "w+");
$sensitive = fopen($argv[1], "r");

while (!feof($sensitive)) {
	$xpl = rtrim(fgets($sensitive));
	fwrite($output, "watchfor /$xpl/i\r\n");
	fwrite($output, "pipe /etc/swatch/telebotnginx.sh \"Someone Accessed $xpl Via $servername\"\r\n");
	fwrite($output, "throttle 00:00:10\r\n\r\n");
	echo "\033[0;33m$xpl Generated\033[0;39m\r\n";
}

echo "\033[0;32m\nAll patterns successfully generated\033[0;39m";
fclose($sensitive);
fclose($output);
