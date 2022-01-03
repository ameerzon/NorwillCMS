
<?php 

if( isset($loggedIn) and $loggedIn == true )
{
	echo "<font size=+1>";
	echo "<br>";
	echo "<a href=\"./admin.php\">Admin panel</a>";
	echo "<br><br>";
	echo "<hr>";
	echo "</font>";
}
else
{
	echo "";
	
}
	
?>

