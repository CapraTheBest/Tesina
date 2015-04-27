<?php
	include("../class/pData.class.php"); 
 	include("../class/pDraw.class.php"); 
 	include("../class/pImage.class.php"); 
	
	$time = "";
	$temperature = "";
	$connection = mysql_connect("localhost","root","");
	if (!$connection) {
   		die(mysql_error());
	}

	mysql_select_db("pianta",$connection);
	$query = "SELECT ROUND(avg(temperature),2) AS 'temperature', DATE(time) AS 'time' FROM `pianta` GROUP BY DATE(time)";
	$dave= mysql_query($query) or die(mysql_error());

	while($row = mysql_fetch_assoc($dave)){
		$time[] = $row["time"];
		$temperature[] = $row["temperature"];
	}

	/* Create and populate the pData object */ 
	$MyData = new pData();   
	$MyData->addPoints($temperature,"Temperature");  
	$MyData->setSerieWeight("Temperature",1); 
	$MyData->setAxisName(0,"Temperatures"); 
	$MyData->addPoints($time,"Labels"); 
	$MyData->setSerieDescription("Labels","Time"); 
	$MyData->setAbscissa("Labels"); 
	/* Create the pChart object */ 
	$myPicture = new pImage(700,230,$MyData); 
	/* Turn of Antialiasing */ 
	$myPicture->Antialias = FALSE; 
	/* Add a border to the picture */ 
	$myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0)); 
	/* Write the chart title */  
	$myPicture->setFontProperties(array("FontName"=>"../fonts/Forgotte.ttf","FontSize"=>11)); 
	$myPicture->drawText(150,35,"Average temperature",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE)); 
	/* Set the default font */ 
	$myPicture->setFontProperties(array("FontName"=>"../fonts/pf_arma_five.ttf","FontSize"=>6)); 
	/* Define the chart area */ 
	$myPicture->setGraphArea(60,40,650,200); 
	/* Draw the scale */ 
	$scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE); 
	$myPicture->drawScale($scaleSettings); 
	/* Turn on Antialiasing */ 
	$myPicture->Antialias = TRUE; 	 
	/* Draw the line chart */ 
	$myPicture->drawLineChart(); 
	/* Write the chart legend */ 
	$myPicture->drawLegend(540,20,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL)); 
	/* Render the picture (choose the best way) */ 
	$myPicture->autoOutput("pictures/example.drawLineChart.simple.png"); 
?>