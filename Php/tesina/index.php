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

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

<!-- Fav and touch icons -->
<!-- <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png"> -->
<link rel="shortcut icon" href="img/favicon.ico">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>
<div class="container">
  <div class="row clearfix">
    <div class="col-md-12 column">
      <h1 class="text-center"> <a href="#" style="text-decoration:none;"> Smart Greenhouse </a> </h1>
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
      <div class="jumbotron well">
        <h1> Giant Button for stuff! :D </h1>
        <p> Actually I'm keeping it because it's cool, and if I press it I can load the data from Log to the sql database </p>
        <p> <a class="btn btn-primary btn-large" href="/tesina/sql_load/">Learn more</a> </p>
      </div>
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
    <div class="col-md-4 column">
      <h2> Graphs </h2>
      <p> A list of some graphs that helps me to check the daily temperature and humidity. </p>
      <p> <a class="btn" href="/tesina/graph/">View details »</a> </p>
    </div>
    <div class="col-md-4 column">
      <h2> Configure </h2>
      <p> Configure some parameters for the plant </p>
      <p> <a class="btn" href="/tesina/config/">View details »</a> </p>
    </div>
  </div>
</div>
</body>
</html>
