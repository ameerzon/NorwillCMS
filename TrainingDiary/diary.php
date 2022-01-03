<?php

include ("../config/params_main.php");
include ("../config/params_colors.php");


/***** global variables and constants *****/

$thisStartDate = new DateTime('first day of this month midnight');
$thisStopDate = new DateTime('last day of this month midnight');

$lastStartDate = new DateTime('first day of last month midnight');
$lastStopDate = new DateTime('last day of last month midnight');

$strThisYear = $thisStartDate->format('Y');
$strThisMonth = $thisStartDate->format('F');

$strLastYear = $lastStartDate->format('Y');
$strLastMonth = $lastStartDate->format('F');

$debug = 0;

$cols = 4;

$aggr = [];

$doAggregate = false;

//$dump = print_r($aggr[$strThisYear][$strThisMonth]);

//echo $dump . "<br>";

if ( !isset( $aggr[$strThisYear][$strThisMonth] ) )
{
	$doAggregate = true;	
}

//echo "Aggregation = " . $doAggregate . "<br>";

/***** log file *****/

if ($debug > 0) { file_put_contents("logfile.log", "next try \n", FILE_APPEND); }

/***** hash initialisation from file *****/

$aggr = unserialize(file_get_contents("aggregation.dat")) ;

/***** processing of new values *****/


$query = $_SERVER["QUERY_STRING"];

parse_str($query);

$member = $user;	

?>

<body bgcolor=#<?php echo $bgcolor1 ?> >    

<br><center>


<?php

if (isset($_POST['save']))
{
	$date = new DateTime('first day of this month midnight');
	
	while ( $date <= $thisStopDate )
	{
		$strDate = $date->format('Y-F-d');
		$strYear = $date->format('Y');
		$strMonth = $date->format('F');
		$strDay = $date->format('d');
		
		if ( isset($_POST[$strDate]) )
		{
			if ($debug > 0) { file_put_contents("logfile.log", "save loop for a day started \n", FILE_APPEND); }

			
			for ($c = 1; $c < $cols; $c++)
			{
				if ( isset($_POST["$strDate:$c"]) /*and $_POST["$strDate:$c"] != ""*/ )
				{
					if ($debug > 0) { file_put_contents("logfile.log", $_POST["$strDate:$c"], FILE_APPEND); }
					if ($debug > 0) { file_put_contents("logfile.log", "\n", FILE_APPEND); }
					
					if ($c > 1)
					{
						$aggr[$member][$strYear][$strMonth][$strDay]["ex$c"] = $_POST["$strDate:$c"]; 
						
					}
					else
					{
						$suchmuster = '/(\d+)\,(\d+)/i';
						$ersetzung = '${1}.${2}';
						$pointed = preg_replace($suchmuster, $ersetzung, $_POST["$strDate:$c"]);
						
						if ($_POST["$strDate:$c"] != "") { $aggr[$member][$strYear][$strMonth][$strDay]["ex$c"] = $pointed; }
						else { $aggr[$member][$strYear][$strMonth][$strDay]["ex$c"] = ""; }
						
					}
					

				}
				else
				{
					if ($c > 1)
					{
						$aggr[$member][$strYear][$strMonth][$strDay]["ex$c"] = "off"; 
						
					}
					
				}
			}
		}
		
		$date->add(new DateInterval('P1D'));
	}
	
	file_put_contents("aggregation.dat", serialize($aggr));
	
	//header("Location: http://humanio.net/training/AZH_tagebuch.php"); 
	header("Location: http://localhost/CMS NORWILL/TrainingDiary/diary.php?user=" . $member ); 
	
    exit; 
	
}


/***** presentation of the current month width=" . 80/$cols . "% ******/

echo "<html>";
echo "<header>";
echo "<meta charset=\"utf-8\">";
echo "</header>";
echo "<body>";
echo "<br><form method=\"post\">";
echo "<center>";




echo "<h1>Training Diary - $strThisMonth $strThisYear</h1>";
echo "<table border=1 width=40%>";

echo "<tr align=center><td width=10%><b>Date</b></td>
						<td width=10%><b>Body weight, kg<br></b></td>
						<td width=10%><b>Morning training<br></b></td>
						<td width=10%><b>Evening training<br></b></td>
		</tr>";

$date = new DateTime('first day of this month midnight');


while ( $date <= $thisStopDate )
{
	$base = $date->format('Y-F-d');
	$strYear = $date->format('Y');
	$strMonth = $date->format('F');
	$strDay = $date->format('d');

	echo "<tr>";
	
	echo "<td align=center>";
	
	echo "<input style=\"border:none\" type=text name=$base value=$base readonly size=\"15\">" . "</td>";
	
	for ($c = 1; $c < $cols; $c++)
	{
		echo "<td>";
		
		//echo $c;
		
		if (isset($aggr[$member][$strYear][$strMonth][$strDay]["ex$c"]))
		{
			$value = $aggr[$member][$strYear][$strMonth][$strDay]["ex$c"];
			
			
		}
		else
		{
			$value = "";
		}
		
		if ($c > 1)
		{
			//echo $value;
			
			if ($value === "on")
			{
				echo "<input style=\"border:none\" type=\"checkbox\" name=\"$base:$c\" checked >";
			}
			else
			{
				echo "<input style=\"border:none\" type=\"checkbox\" name=\"$base:$c\" unchecked >";
			}
		}
		else
		{
			echo "<input style=\"border:none\" type=text name=\"$base:$c\" size=\"15\" value=\"$value\" >";
		}
		
		echo "</td>";
	}

	$date->add(new DateInterval('P1D'));
	
	echo "</tr>";
	


}


echo "</table>";

echo "<br><input type=submit name=\"save\" value=\"Speichern\">";

echo "</form><br><br>";




error_reporting(0);

/***** presentation of the current year ******/

	echo "<table border=1  width=20%>";

	echo "<tr align=center><td><b>Month</b></td><td><b>Body weight, average</b></td></tr>";

	foreach ( array_keys($aggr[$member]) as $keyYear )
	{
		
		foreach ( array_keys($aggr[$member][$keyYear]) as $keyMonth )
		{
			if ( isset($aggr[$member][$keyYear][$keyMonth]) and is_array($aggr[$member][$keyYear][$keyMonth]) )
			{
			
				echo "<tr align=center><td>$keyMonth $keyYear</td>";
				
				ksort($aggr[$member][$keyYear][$keyMonth]);
				
				$sumWeight = 0;
				$countWeight = 0;
				
				
				foreach ( array_keys($aggr[$member][$keyYear][$keyMonth]) as $keyDay )
				{
					if ( $aggr[$member][$keyYear][$keyMonth][$keyDay]["ex1"] > 1 ) 	
					{						
						$sumWeight = $sumWeight + (double)$aggr[$member][$keyYear][$keyMonth][$keyDay]["ex1"];
						$countWeight = $countWeight + 1;
					}
					
				}
				
				$middleWeight = number_format($sumWeight / $countWeight, 2);
				echo "<td>$middleWeight</td></tr>";
				
				echo "</tr>";
			}
		}
	}
	
	echo "</table>";
/**/




/***** presentation of the all existing years ******/

// is missing yet...


echo "</body>";
echo "</html>";

?>