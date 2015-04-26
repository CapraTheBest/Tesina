<?php

$h = "0";
$t = "0";
$date = "00/01/01 00:00:00";
$query = "";

$connection = mysql_connect("localhost","root","");
if (!$connection) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';

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
  echo $myStr;
  echo "<br>";
  if(strpos($myStr, "h") !== false){
	  $h = substr($myStr, 1, 6); 
  }
  if(strpos($myStr, "t") !== false){
	  $t = substr($myStr, 1, 6);
  }
  if(strpos($myStr, "/") !== false){
	  $date = substr($myStr, 0, 17); 
  }
  echo $h ."<br>"; 
  echo $t ."<br>";  
  echo $date ."<br>"; 
  echo "END OF STUFF <br>";
  
  if($h != "0" && $t != "0" && $date != "00/01/01 00:00:00"){
	$query = "INSERT INTO `pianta`.`pianta` (`id`, `time`, `humidity`, `temperature`) VALUES (NULL, '".$date."', '".$h."', '".$t."')";
	$h = "0";
	$t = "0";
	$date = "00/01/01 00:00:00";
}
}
$result = mysql_query($query,$connection);
echo ($result == 1) ? "Succesfully executed mysql query!" : "Error while executing mysql query!";
fclose($myfile);
?>