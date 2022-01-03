<?php

session_set_cookie_params(3600);

session_start();

//$correctRole = false;
//$correctPwd = false;

include("./includes/globals.php");

include ("./config/params_main.php");
include ("./config/params_colors.php");

include("./includes/users.php");

include("./includes/header.php");



?>

<body bgcolor=#<?php echo $bgcolor1 ?> >    

<br><center>

<table bgcolor=#<?php echo $bgcolor1 ?> width=80% border=<?php echo $tbBorder ?> >

	<tr><td colspan=2 align=middle><font size=<?php echo $mainNameSize ?> color=#<?php echo $bgcolor4 ?>><?php echo $mainName ?></font></td></tr>

	<tr><td colspan=2 align=middle><font size=<?php echo $subNameSize ?> color=#<?php echo $bgcolor4 ?>><?php echo $subName ?></font></td></tr>

	<tr>
		<td colspan=2 align=center>
			<img src=<?php echo "./images/$mainImage" ?> width=<?php echo $mainWidth ?> height=<?php echo $mainHeight ?> >
		</td>
	</tr>
	
	<tr>
		<td colspan=2>
		
			<?php include ("./includes/navigation.php"); ?>
		
		</td>
	</tr>
	
	<tr>
		<?php
		if ($serviceSide == 1)
		{
			echo "<td valign=top>";
			include ("./includes/blog.php"); 		
			echo "</td>";
			echo "<td width=20% valign=top>";
			include ("./includes/service.php"); 
			echo "</td>";
		}
		else
		{
			echo "<td width=20% valign=top>";
			include ("./includes/service.php"); 
			echo "</td>";
			echo "<td valign=top>";
			include ("./includes/blog.php"); 		
			echo "</td>";
			
		}
		
		?>
		
	</tr>
	
	<tr>
		<td colspan=2 align=center>
		
			<?php include ("./includes/footer.php"); ?>
		
		</td>
	</tr>
	
	
	
	
</table>

</body>