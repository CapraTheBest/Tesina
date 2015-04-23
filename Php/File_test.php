<?php
$h = "25.05";
$t = "20.00"; 

$connection = mysql_connect("localhost","root","");
if (!$connection) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';

mysql_select_db("pianta",$connection);

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = $h."\n";
fwrite($myfile, $txt);
$txt = $t."\n";
fwrite($myfile, $txt);
fclose($myfile);

// Read file
$myfile = fopen("newfile.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  echo fgets($myfile) . "<br>";
}
fclose($myfile);
$query = "INSERT INTO `pianta`.`pianta` (`id`, `time`, `humidity`, `temperature`) VALUES (NULL, CURRENT_TIMESTAMP, '".$h."', '".$t."')";
  $result = mysql_query($query,$connection);
  echo $result;

?>