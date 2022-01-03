<?php

include ("config/params_main.php");

?>

<?php

if(isset($_POST['bgcolor1']))
{
	$bgcolor1	  = $_POST['bgcolor1'];
	$bgcolor2	  = $_POST['bgcolor2'];
	$bgcolor3	  = $_POST['bgcolor3'];
	$bgcolor4	  = $_POST['bgcolor4'];
	
	$globalsFile = "config/params_colors.php";

	$fp = fopen($globalsFile, 'w');
	
	
	fwrite($fp, '<?php ' . "\n");
	fwrite($fp, '$bgcolor1=' . "\"$bgcolor1\";\n");
	fwrite($fp, '$bgcolor2=' . "\"$bgcolor2\";\n");
	fwrite($fp, '$bgcolor3=' . "\"$bgcolor3\";\n");
	fwrite($fp, '$bgcolor4=' . "\"$bgcolor4\";\n");

	fwrite($fp, '?>');
	
	fclose($fp);

}

?>

<div>
<table border=<?php echo $tbBorder ?> width=100%>
	<tr>
		<td width=50></td>

		<td>
			<br>
			<h3>Please set and save the following color parameters:</h3>
			<br>


			<?php

			$globalsFile = "config/params_colors.php";

			$fg = fopen($globalsFile, 'r');

			$line = fgets($fg); // for the <?php first line 

			$line = fgets($fg);
			$array = explode("=", $line);
			$bgcolor1 = $array[1];
			$bgcolor1 = substr($bgcolor1, 0, strlen($bgcolor1)-2 );
			
			$line = fgets($fg);
			$array = explode("=", $line);
			$bgcolor2 = $array[1];
			$bgcolor2 = substr($bgcolor2, 0, strlen($bgcolor2)-2 );
			
			$line = fgets($fg);
			$array = explode("=", $line);
			$bgcolor3 = $array[1];
			$bgcolor3 = substr($bgcolor3, 0, strlen($bgcolor3)-2 );
			
			$line = fgets($fg);
			$array = explode("=", $line);
			$bgcolor4 = $array[1];
			$bgcolor4 = substr($bgcolor4, 0, strlen($bgcolor4)-2 );
			
			fclose($fg);

			?>

			<form method='post' >

			<table border=0 valign=top>

				<tr height=50>
					<td valign=middle>Global Backgroung:</td>
					<td valign=middle>#<input type='text' name='bgcolor1' value=<?php echo $bgcolor1; ?> size=6> (a hex string for color, 6 characters without a router)</td>
				</tr>
	
				<tr height=50>
					<td valign=middle>Blog & Service Backgroung:</td>
					<td valign=middle>#<input type='text' name='bgcolor2' value=<?php echo $bgcolor2; ?> size=6> (a hex string for color, 6 characters without a router)</td>
				</tr>
	
				<tr height=50>
					<td valign=middle>Border Color:</td>
					<td valign=middle>#<input type='text' name='bgcolor3' value=<?php echo $bgcolor3; ?> size=6> (a hex string for color, 6 characters without a router)</td>
				</tr>
	
				<tr height=50>
					<td valign=middle>Text Color:</td>
					<td valign=middle>#<input type='text' name='bgcolor4' value=<?php echo $bgcolor4; ?> size=6> (a hex string for color, 6 characters without a router)</td>
				</tr>
	
				</table>

			<br>
			<input type='submit' name='siteColors' value='save' style="height:35px; width:120px">
			</form>
		</td>
	</tr>
		
	
	
</table>

<div>
