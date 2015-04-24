<?php
$h = "25.05";
$t = "20.00";
$date = date('Y/m/d h:i:s', time());

$connection = mysql_connect("localhost","root","");
if (!$connection) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';

mysql_select_db("pianta",$connection);

$handle = @fopen("newfile.txt", "r");
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        echo $buffer;
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}

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
$myfile = fopen("newfile.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  echo fgets($myfile) . "<br>";
}
fclose($myfile);
$query = "INSERT INTO `pianta`.`pianta` (`id`, `time`, `humidity`, `temperature`) VALUES (NULL, '".$date."', '".$h."', '".$t."')";
  $result = mysql_query($query,$connection);
  echo $result;

?>