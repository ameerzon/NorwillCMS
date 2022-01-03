<?php

include ("config/params_main.php");

?>

<?php

if(isset($_POST['mainName']))
{
	$mainName     = $_POST['mainName'];	
	$subName      = $_POST['subName'];	
	$mainImage    = $_POST['mainImage'];	
	$imageScaling = $_POST['imageScaling'];	
	$blog         = $_POST['blog'];	
	$serviceSide  = $_POST['serviceSide'];
	$tbBorder	  = $_POST['tbBorder'];
	$mainNameSize	  = $_POST['mainNameSize'];
	$subNameSize	  = $_POST['subNameSize'];
	$pageSize	  = $_POST['pageSize'];

	$keyWords      = $_POST['keyWords'];	
	
	$globalsFile = "config/params_main.php";

	$fp = fopen($globalsFile, 'w');
	
	fwrite($fp, '<?php ' . "\n");
	fwrite($fp, '$mainName=' . "\"$mainName\";\n");
	fwrite($fp, '$subName=' . "\"$subName\";\n");
	fwrite($fp, '$mainImage=' . "\"$mainImage\";\n");
	fwrite($fp, '$imageScaling=' . "$imageScaling;\n");
	fwrite($fp, '$blog=' . "$blog;\n");
	fwrite($fp, '$serviceSide=' . "$serviceSide;\n");
	fwrite($fp, '$tbBorder=' . "$tbBorder;\n");
	fwrite($fp, '$mainNameSize=' . "$mainNameSize;\n");
	fwrite($fp, '$subNameSize=' . "$subNameSize;\n");
	fwrite($fp, '$pageSize=' . "$pageSize;\n");
	fwrite($fp, '$keyWords=' . "\"$keyWords\";\n");

	$size = getimagesize( "images/$mainImage");
    $mainWidth = $size[0] * $imageScaling;
    $mainHeight = $size[1] * $imageScaling;

	fwrite($fp, '$mainWidth=' . "$mainWidth;\n");
	fwrite($fp, '$mainHeight=' . "$mainHeight;\n");

	fwrite($fp, '?>');
		
	fclose($fp);
	
	$loggedIn = true;
}

?>

<div>
<table border=<?php echo $tbBorder ?> width=100%>
	<tr>
		<td width=50></td>

		<td>
			<br>
			<h3>Please set and save the following main parameters:</h3>
			<br>


			<?php

			$globalsFile = "config/params_main.php";

			$fg = fopen($globalsFile, 'r');

			$line = fgets($fg); // for the <?php first line 

			$line = fgets($fg);
			$array = explode("=", $line);
			$mainName = $array[1];
			$mainName = substr($mainName, 0, strlen($mainName)-2 );

			$line = fgets($fg);
			$array = explode("=", $line);
			$subName = $array[1];
			$subName = substr($subName, 0, strlen($subName)-2 );

			$line = fgets($fg);
			$array = explode("=", $line);
			$mainImage = $array[1];
			$mainImage = substr($mainImage, 0, strlen($mainImage)-2 );

			$line = fgets($fg);
			$array = explode("=", $line);
			$imageScaling = $array[1];
			$imageScaling = substr($imageScaling, 0, strlen($imageScaling)-2 );

			$line = fgets($fg);
			$array = explode("=", $line);
			$blog = $array[1];
			$blog = substr($blog, 0, strlen($blog)-2 );

			$line = fgets($fg);
			$array = explode("=", $line);
			$serviceSide = $array[1];
			$serviceSide = substr($serviceSide, 0, strlen($serviceSide)-2 );

			$line = fgets($fg);
			$array = explode("=", $line);
			$tbBorder = $array[1];
			$tbBorder = substr($tbBorder, 0, strlen($tbBorder)-2 );

			$line = fgets($fg);
			$array = explode("=", $line);
			$mainNameSize = $array[1];
			$mainNameSize = substr($mainNameSize, 0, strlen($mainNameSize)-2 );

			$line = fgets($fg);
			$array = explode("=", $line);
			$subNameSize = $array[1];
			$subNameSize = substr($subNameSize, 0, strlen($subNameSize)-2 );
			
			$line = fgets($fg);
			$array = explode("=", $line);
			$pageSize = $array[1];
			$pageSize = substr($pageSize, 0, strlen($pageSize)-2 );
			
			$line = fgets($fg);
			$array = explode("=", $line);
			$keyWords = $array[1];
			$keyWords = substr($keyWords, 0, strlen($keyWords)-2 );

			fclose($fg);

			?>

			<form method='post' >

			<table border=0 valign=top>
				<tr height=50>
					<td valign=middle>Main Title:</td>
					<td valign=middle><input type='text' name='mainName' value=<?php echo $mainName; ?> size=40></td>
				</tr>
	
				<tr height=50>
					<td valign=middle>Sub Title:</td>
					<td valign=middle><input type='text' name='subName' value=<?php echo $subName; ?> size=60></td>
				</tr>

				<tr height=50>
					<td valign=middle>Main Image:</td>
					<td valign=middle>
						<input list="images" name="mainImage" value=<?php echo $mainImage; ?> size=40>
							<datalist id="images">

								<?php

								$files = scandir("../images", 0);
								foreach ($files as $entry)
								{
									if (strlen($entry)>2)
									{
										echo "<option value=\"" . $entry . "\">";
									}
								}
									
								?>		

							</datalist>		
							(Note: a name in the box works like filter. Remove the name to see all images.)
					
					</td>
				</tr>
	
				<tr height=50>
					<td valign=middle>Image Scaling:</td>
					<td valign=middle><input type='text' name='imageScaling' value=<?php echo $imageScaling; ?> size=4> (float number, point as a decimal separator, e.g. 0.35)</td>
				</tr>

				<tr height=50>
					<td valign=middle>Blog Direction:</td>
					<td valign=middle><input type='number' name='blog' value=<?php echo $blog; ?> min="0" max="1" > (0 = oldest on top; 1 = newest on top)</td>
				</tr>

				<tr height=50>
					<td valign=middle>Service Place:</td>
					<td valign=middle><input type='number' name='serviceSide' value=<?php echo $serviceSide; ?> min="0" max="1" > (0 = service left; 1 = service right)</td>
				</tr>

				<tr height=50>
					<td valign=middle>Table Borders:</td>
					<td valign=middle><input type='number' name='tbBorder' value=<?php echo $tbBorder; ?>  min="0" max="1"> (0 = without borders; 1 = with borders, for debug only)</td>
				</tr>

				<tr height=50>
					<td valign=middle>Main Name Font Size:</td>
					<td valign=middle><input type='number' name='mainNameSize' value=<?php echo $mainNameSize; ?>  min="1" max="20"> (...)</td>
				</tr>

				<tr height=50>
					<td valign=middle>Sub Name Font Size:</td>
					<td valign=middle><input type='number' name='subNameSize' value=<?php echo $subNameSize; ?>  min="1" max="20"> (...)</td>
				</tr>

				<tr height=50>
					<td valign=middle>Page Size:</td>
					<td valign=middle><input type='number' name='pageSize' value=<?php echo $pageSize; ?>  min="10" max="100"> (amount of articles per page)</td>
				</tr>

				<tr height=50>
					<td valign=middle>Keywords for search engine:</td>
					<td valign=middle><input type='text' name='keyWords' value=<?php echo $keyWords; ?> size=60> (comma separated list)</td>
				</tr>

				</table>

			<br>
			<input type='submit' name='siteNames' value='save' style="height:35px; width:120px">
			</form>
		</td>
	</tr>
	
	
</table>

<div>

