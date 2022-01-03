
<br><br>
<div  align=center style = "border: 2px solid; background-color: #<?php echo $bgcolor2 ?>; color: #<?php echo $bgcolor3 ?>;">
<table bgcolor=#<?php echo $bgcolor2 ?> border=<?php echo $tbBorder ?> >

<?php

if(is_dir("./service"))
{
	echo "";
}
else
{
	echo "service dir not exists<br>";
}

$serviceFiles = scandir("./service", 0);

foreach ($serviceFiles as $serviceFile)
{
	if ( (strlen($serviceFile) > 2) and (substr($serviceFile, 0, 7) == "service") )
	{
		echo "<tr align=center>";
		echo "<td>";
		echo "<div style = \"
						font-size: 14px; 
						background-color: #$bgcolor2;
						color: #$bgcolor4; \"
				>";
		include ("./service/$serviceFile");
		echo "</div>";
		echo "</td>";
		echo "</tr>";
	}
}

?>

</table>

<div  class=service align=center>
<?php
if( isset($loggedIn) and $loggedIn == true )
{
	echo "<form action=\"\"  method=\"post\" enctype=\"multipart/form-data\">";
	echo "<input type=\"submit\" name=\"logout\" id=\"logout\" value=\"Logout\"/>";
	echo "</form>";	

}
else
{
	echo "<form action=\"\"  method=\"post\" enctype=\"multipart/form-data\">";
	echo "<input type=\"text\" name=\"user\" placeholder=\"Username\" size=20 />";
	echo "<br><br>";
	echo "<input type=\"password\" name=\"pwduser\" placeholder=\"Password\" size=20 />";
	echo "<br><br>";
	echo "<input type=\"submit\" name=\"login\" id=\"login\" value=\"Login\"/>";
	echo "</form>";	
	
	
}
?>
</div>

</div>



