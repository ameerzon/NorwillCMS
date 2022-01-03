
<?php

//include ("config/params_main.php");
//include ("config/params_colors.php");

$userProfile = "";
$userProfile = $_SESSION['admin'];
//echo "userProfile = $userProfile <br>";

if(isset($_POST['saveMe']))
{	
	$newPwd = $_POST['newPwd'];
	
	//echo $saveUser . $newPwd . $newRole . "<br>";
	
	
	if ( strlen($newPwd) >= 3 ) { $users[$userProfile][1] = password_hash($newPwd, PASSWORD_DEFAULT); }
		
	
	$fr = fopen("./config/users.cfg", 'w');

	foreach ( $users as $key => $user )
	{
		if ( strlen($key) > 1 ) { fputs($fr, $users[$key][0] . ";" . $users[$key][1] . ";" . $users[$key][2] . "\n"); }
	}

	fclose($fr);
	
}

?>

<div>
<table border=<?php echo $tbBorder ?> width=100%>
	<tr>
		<td width=50></td>
		
		<td valign=top>
			<form action=""  method="post" enctype="multipart/form-data">
			<?php 
			
			     if (isset($users[$userProfile][0]) )
				{
					//echo $users[$admin][0];  
					echo "<br>";
					echo "<input type=\"text\" id=\"myUser\" name=\"myUser\" value=" . $users[$userProfile][0] . " readonly>";
					echo "<br><br>";
					
					echo "my role:" . "<br>";
					echo "<input type=\"text\" name=\"oldRole\" size=20 value=" . $users[$userProfile][2] . " readonly>";
					echo "<br><br>";

					echo "new password:" . "<br>";
					echo "<input type=\"text\" name=\"newPwd\" size=20>";
					echo "<br><br>";
					
					echo "<input type=\"submit\" name=\"saveMe\" id=\"saveMe\" value=\"save profile\"  style=\"height:35px; width:120px\"/>";
				}
			?>
			</form>
		</td>
	</tr>
	
</table>

<div>