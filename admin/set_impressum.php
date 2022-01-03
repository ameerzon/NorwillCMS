<?php

include ("config/params_main.php");

?>

<?php

if(isset($_POST['impressum']))
{
	$fp = fopen("service/impressum.html", 'w');
	
	$putImpressum = $_POST['impressum'];
	
	fwrite($fp, $putImpressum);
	
	fclose($fp);
}

?>

<div>
<table width=100% border=<?php echo $tbBorder ?> >

	<tr>
		<td width=50></td>
		<td>
			<br>
			<h3>Please define your impressum:</h3>
			<br>

			<form action=""  method="post" enctype="multipart/form-data">
			<textarea rows=16 cols=60 name="impressum"><?php

			$fg = fopen("service/impressum.html", 'r');
						
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

			<br><br>
			<input type="submit" name="impressumBtn" id="impressumBtn" value="save impressum"  style="height:35px; width:120px"/>

			</form>

		</td>
	</tr>
	
	
	
</table>

<div>
