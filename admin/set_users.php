
<?php

if(isset($_POST['listUser']))
{	
	if (isset($_POST['loadUser']))
	{
		$selectedUser = $_POST['listUser'];
		
		$showUser = 1;
	}
	elseif (isset($_POST['removeUser']))
	{
		$selectedUser = $_POST['listUser'];
		
		unset ($users[$selectedUser]);
		
		$fr = fopen("./config/users.cfg", "w");
		
		foreach ( $users as $key => $user )
		{
			if ( strlen($key) > 1 ) { fputs($fr, $users[$key][0] . ";" . $users[$key][1] . ";" . $users[$key][2] . "\n"); }
		}

		fclose($fr);
	}
	else
	{
		echo "<br>ERROR<br>";
	}
	
} 

if(isset($_POST['saveUser']))
{	
	$saveUser = $_POST['selectedUser'];
	$newPwd = $_POST['newPwd'];
	$newRole = $_POST['listRole'];
	
	//echo $saveUser . $newPwd . $newRole . "<br>";
	
	$users[$saveUser][0] = $saveUser;
	if ( strlen($newPwd) >= 3 ) { $users[$saveUser][1] = password_hash($newPwd, PASSWORD_DEFAULT); }
	$users[$saveUser][2] = $newRole;
	
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
		
		<td  valign=top width=30%>
			<br>
			<h3>Please edit your authors:</h3>
			<br><br>

			<form action=""  method="post" enctype="multipart/form-data">
			<select name="listUser" size=7 style="width: 200px !important;">
				<?php
				
				foreach ($users as $user)
				{
					echo "<option value=\"$user[0]\">$user[0]</option>";
				}

				?>
			</select>

			<br><br>
			<input type="submit" name="loadUser" id="loadUser" value="load user" style="height:35px; width:120px"/>
			<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
			<input type="submit" name="removeUser" id="removeUser" value="remove user" style="height:35px; width:120px"/>

			</form>

		</td>
		<td valign=top>
			<form action=""  method="post" enctype="multipart/form-data">
			<?php 
			
				if (isset($selectedUser) and (isset($showUser)) )
				{
					//echo "$selectedUser";  
					echo "<br>";
					echo "<input type=\"text\" id=\"selectedUser\" name=\"selectedUser\" value=\"$selectedUser\">";
					echo "<br><br>";
					
					echo "new password:" . "<br>";
					echo "<input type=\"text\" name=\"newPwd\" size=20>";
					echo "<br><br>";
					
					echo "old role:" . "<br>";
					echo "<input type=\"text\" name=\"oldRole\" size=20 value=" . $users[$selectedUser][2] . " readonly>";
					echo "<br><br>";

					echo "new role:" . "<br>";
					
					if ( strcmp($users[$selectedUser][2], "author") == 0 )
					{
						echo "<select name=\"listRole\" size=1 style=\"width: 200px !important;\" >";
							echo "<option selected value=\"author\">author</option>";
							echo "<option value=\"redactor\">redactor</option>";
							echo "<option value=\"admin\">admin</option>";
							echo "<option value=\"trainee\">trainee</option>";
						echo "</select>";
					}
					elseif ( strcmp($users[$selectedUser][2], "redactor") == 0 )
					{
					    echo "<select name=\"listRole\" size=1 style=\"width: 200px !important;\" >";
					    echo "<option value=\"author\">author</option>";
					    echo "<option selected value=\"redactor\">redactor</option>";
					    echo "<option value=\"admin\">admin</option>";
					    echo "<option value=\"trainee\">trainee</option>";
					    echo "</select>";
					}
					elseif ( strcmp($users[$selectedUser][2], "trainee") == 0 )
					{
					    echo "<select name=\"listRole\" size=1 style=\"width: 200px !important;\" >";
					    echo "<option value=\"author\">author</option>";
					    echo "<option value=\"redactor\">redactor</option>";
					    echo "<option value=\"admin\">admin</option>";
					    echo "<option selected value=\"trainee\">trainee</option>";
					    echo "</select>";
					}
					else
					{
						echo "<select name=\"listRole\" size=1 style=\"width: 200px !important;\" >";
							echo "<option value=\"author\">author</option>";
							echo "<option value=\"redactor\">redactor</option>";
							echo "<option selected value=\"admin\">admin</option>";
							echo "<option value=\"trainee\">trainee</option>";
						echo "</select>";
					}
					echo "<br><br>";
					
					echo "<input type=\"submit\" name=\"saveUser\" id=\"saveUser\" value=\"save user\"  style=\"height:35px; width:120px\"/>";
				}
			?>
			</form>
		</td>
	</tr>
	
</table>

<div>