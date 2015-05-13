<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>The Smart Greenhouse</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
<!--script src="js/less-1.3.3.min.js"></script-->
<!--append ‘#!watch’ to the browser URL, then refresh the page. -->

<link href="../css/bootstrap.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

<!-- Fav and touch icons -->
<!-- <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png"> -->
<link rel="shortcut icon" href="../img/favicon.ico">
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/scripts.js"></script>
</head>

<body>
<div class="container">
<div class="row clearfix">
  <div class="col-md-12 column">
    <h1 class="text-center"> <a href="/tesina/" style="text-decoration:none;"> Smart Greenhouse </a> </h1>
    <br>
    <!-- <ul class="breadcrumb">
                <li class="active">
                    Home <span class="divider">/</span>
                </li>
                <li>
                    <a href="#">Library</a> <span class="divider">/</span>
                </li>
                <li>
                    <a href="#">Data</a> <span class="divider"></span>
                </li>
            </ul> --> 
  </div>
</div>
<div class="row clearfix">
  <div class="col-md-4 column">
    <h2> Last Data Acquired </h2>
    <p>
      <?php
        $connection = mysql_connect("37.59.123.99","root","boriobello96");
        if (!$connection) {
                die(mysql_error());
        }

        mysql_select_db("pianta",$connection);
        $query = "SELECT time, humidity, temperature FROM pianta ORDER BY id DESC LIMIT 1";
        $dave= mysql_query($query) or die(mysql_error());

        while($row = mysql_fetch_assoc($dave)){
            foreach($row as $cname => $cvalue){
                    echo "$cname: $cvalue\t<br>";
            }
        print "\r\n";
        }
        ?>
    </p>
  </div>
<?php
	$temp_tmin = 0;
	$temp_tmax = 0;
	$temp_hmin = 0;
	$temp_hmax = 0;
	
	$outside = fopen("config.txt", "r") or die("Unable to open file!");
	while(!feof($outside)) {
		$myStr= fgets($outside);
		echo $myStr . "<br>";
	    $temp_tmin = substr($myStr, 8, 9); 
	    if(strpos($myStr, "t_max") !== false){
		    $temp_tmax = substr($myStr, 9, 10);
			echo $temp_tmax;
	    }
	    if(strpos($myStr, "h_min") !== false){
		    $temp_hmin = substr($myStr, 9, 10); 
			echo $temp_hmin;
		}
		if(strpos($myStr, "h_max") !== false){
		    $temp_hmax = substr($myStr, 9, 10); 
			echo $temp_hmax;
		}
	}
	
	echo '<div class="col-md-4 column">
    <form  method="POST" class="form-horizontal">
      <div class="form-group">
        <label for="exampleInputEmail1">Min. Temperature</label>
        <div class="col-xs-3">
          <input type="number" class="form-control" name="temperature_min" min="1" max="100" placeholder="'. $temp_tmin .'°">
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Max. Temperature</label>
        <div class="col-xs-3">
          <input type="number" class="form-control" name="temperature_max" min="1" max="100" placeholder="'. $temp_tmax .'°">
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Min. Humidity</label>
        <div class="col-xs-3">
          <input type="number" class="form-control" name="humidity_min" min="1" max="100" placeholder="'. $temp_hmin .'%">
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Max. Humidity</label>
        <div class="col-xs-3">
          <input type="number" class="form-control" name="humidity_min" min="1" max="100" placeholder="'. $temp_hmax .'%">
        </div>
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
  </div>';
	
    $t_min = $_POST['temperature_min'];
    $t_max = $_POST['temperature_max'];
    $h_min = $_POST['humidity_min'];
    $h_max = $_POST['humidity_min'];
    
    $data = "t_min: " . $t_min . "\nt_max: " . $t_max . "\nh_min: " . $h_min . "\nh_max: " . $h_max;
    
    $myfile = fopen("config.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $data);
    fclose($myfile);
?>
</div>
</body>
</html>
