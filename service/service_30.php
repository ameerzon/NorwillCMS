
<?php 

if( isset($loggedIn) and $loggedIn == true )
{
	echo "<font size=+1>";
	echo "<br>";

	echo "<a href=\"./TrainingDiary/diary.php?user=" . $_SESSION['user'] . "\">Training diary</a>";
	
	echo "<br><br>";
	echo "<hr>";
	echo "</font>";
}
else
{
	echo "";
	
}
	
?>

