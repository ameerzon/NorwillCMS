<?php

include ("config/params_main.php");

?>

<?php

if(isset($_POST['widgets']))
{	
	if (isset($_POST['loadWidget']))
	{
		$selectedWidget = $_POST['widgets'];
		
		$showWidget = 1;
	}
	elseif (isset($_POST['removeWidget']))
	{
		$selectedWidget = $_POST['widgets'];
		
		unlink("service/$selectedWidget");
	}
	else
	{
		echo "<br>ERROR<br>";
	}
	
	
}

if(isset($_POST['save']))
{	
	$selectedWidget = $_POST['selectedWidget'];
	$putWidget = $_POST['save'];
	
	$fp = fopen("service/$selectedWidget", 'w');

	fwrite($fp, $putWidget);
	
	fclose($fp);
}

?>

<div>
<table border=<?php echo $tbBorder ?> width=100%>
	<tr>
		<td width=50></td>
		
		<td  valign=top width=30%>
			<br>
			<h3>Please edit your widgets:</h3>
			<br><br>

			<form action=""  method="post" enctype="multipart/form-data">
			<select name="widgets" size=7 style="width: 200px !important;">
				<?php
				
				$files = scandir("service", 0);

				foreach ($files as $entry)
				{
					if ( substr($entry, 0, 7) === 'service'  )
					{
						chop($entry);
						echo "<option value=\"$entry\">$entry</option>";
					}
					
				}

				?>
			</select>

			<br><br>
			<input type="submit" name="loadWidget" id="loadWidget" value="load widget" style="height:35px; width:120px"/>
			<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
			<input type="submit" name="removeWidget" id="removeWidget" value="remove widget" style="height:35px; width:120px"/>

			</form>

		</td>
		<td valign=top>
			<form action=""  method="post" enctype="multipart/form-data">
			<?php 
			
				if (isset($selectedWidget) and (isset($showWidget)) )
				{
					//echo "$selectedWidget";  
					echo "<br>";
					echo "<input type=\"text\" id=\"selectedWidget\" name=\"selectedWidget\" value=\"$selectedWidget\">";
					echo "<br><br>";
					
					echo "<textarea name=\"save\" rows=20 cols=80>";
					
					$fg = fopen("service/$selectedWidget", 'r');
								
					if ($fg) 
					{
						while (($buffer = fgets($fg)) !== false) {
							echo $buffer;
						}
						if (!feof($fg)) {
							echo "Error: unexpected fgets() fail\n";
						}
						fclose($fg);
					}				
					
					echo "</textarea>";
					
					echo "<br><br>";
					echo "<input type=\"submit\" name=\"saveWidget\" id=\"saveWidget\" value=\"save widget\"  style=\"height:35px; width:120px\"/>";
				}
			?>
			</form>
		</td>
	</tr>
	
</table>

<div>
