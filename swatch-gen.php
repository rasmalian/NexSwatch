<?php
set_time_limit(0);
echo $argc;
if($argc!=4)
{
	echo "\r\n-=Swatch Configs Generator=-\r\nUsage: ".$argv[0]." listinput.txt outputfile servername\r\n";
	die();
}
echo "\r\n-=Swatch Configs Generator=-\r\nUsage: $argv[0] listinput.txt outputfile servername\r\n";
$servername=$argv[3];
$output=fopen($argv[2],"w+");
$sensitive=fopen($argv[1],"r");
	while(! feof($sensitive))
	{
	$xpl = rtrim(fgets($sensitive));	
	fwrite($output,"watchfor /$xpl/i\r\n");
	fwrite($output,"pipe /etc/swatch/telebotnginx.sh \"Someone Accessed $xpl Via $servername\"\r\n");
	fwrite($output,"throttle 00:00:10\r\n\r\n");
	echo "$xpl Generated\r\n";
	}
echo "Finish";	
fclose($sensitive);
fclose($output);
?>