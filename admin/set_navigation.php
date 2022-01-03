<?php

include ("./config/params_main.php");

?>

<?php

if(isset($_POST['menu']))
{
	$fp = fopen("./config/menu.txt", 'w');
	
	$putMenu = $_POST['menu'];
	
	fwrite($fp, $putMenu);
	
	fclose($fp);
}

if(isset($_POST['defaultMenu']))
{
	$fp = fopen("./config/menu.txt", 'w');
	
	$putMenu = $_POST['menu'];
	
	fwrite($fp, $putMenu);
	
	fclose($fp);
}

?>

<div>
<table border=<?php echo $tbBorder ?> width=100%>
	<tr>
		<td width=50></td>
		
		<td>
			<br>
			<h3>Please define your navigation bar, one item a line:</h3>
			<br>

			<form action=""  method="post" enctype="multipart/form-data">
			<textarea rows=8 cols=40 name="menu"><?php

			$fg = fopen("./config/menu.txt", 'r');
						
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
			?></textarea>

			<br>Note, the first item is a default one.<br><br>
			<input type="submit" name="menuBtn" id="menuBtn" value="save navigation" style="height:35px; width:120px"/>

			</form>

		</td>
	</tr>
	
	
	
</table>

<div>
