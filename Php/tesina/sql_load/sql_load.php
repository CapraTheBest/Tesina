<?php

//$i = 0;
//$f = 0;
//$g = 0;
$h = 0;
$t = 0;
$date = "00/00/00 00:00:00";

$connection = mysql_connect("37.59.123.99","root","boriobello96");

if (!$connection) {
    die('Could not connect: ' . mysql_error());
}
echo '<br>Connected successfully<br>';

mysql_select_db("pianta",$connection);

/* write shit yoh
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = $h."\n";
fwrite($myfile, $txt);
$txt = $t."\n";
fwrite($myfile, $txt);
$txt = $date."\n";
fwrite($myfile, $txt);
fclose($myfile);*/

// Read file
$myfile = fopen("Log.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  $myStr= fgets($myfile);
  //echo $myStr;
  echo "<br>";
  if(strpos($myStr, "h") !== false){
	  $h = substr($myStr, 1, 6); 
	  //$i++;
  }
  if(strpos($myStr, "t") !== false){
	  $t = substr($myStr, 1, 6);
	  //$f++;
  }
  if(strpos($myStr, "/") !== false){
	  $date = substr($myStr, 0, 17); 
	  //$g++;
  }
  //echo $h ."<br>"; 
  //echo $t ."<br>";  
  //echo $date ."<br>"; 
  //echo "END OF STUFF <br>";
  
  if(($h != "0") && ($t != "0") && ($date != "00/00/00 00:00:00")){
	$query = "INSERT INTO pianta (id, time, humidity, temperature) 
		SELECT * FROM (SELECT NULL, '".$date."', '".$h."', '".$t."') AS tmp 
		WHERE NOT EXISTS ( SELECT time FROM pianta WHERE time = '".$date."') LIMIT 1";
	//$query = "INSERT INTO `pianta`.`pianta` (`id`, `time`, `humidity`, `temperature`) VALUES (NULL, '".$date."', '".$h."', '".$t."')";
	$h = "0";
	$t = "0";
	$date = "00/00/00 00:00:00";
	//mysql_query($query,$connection);
	$result = mysql_query($query,$connection);
	echo ($result == 1) ? "<br>Succesfully executed mysql query!<br>" : "<br>Error while executing mysql query! ".mysql_error()."<br>";
}
}
echo "Everything's fine";
fclose($myfile);

$path="Log.txt";
if(@unlink($path)) {echo "<br>Deleted file <br>"; }
else{echo "<br>File can't be deleted<br>";}
?>