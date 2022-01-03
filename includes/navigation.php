
<?php 

$site = "";
$query = $_SERVER["QUERY_STRING"];
parse_str($query);

?>

<table bgcolor=<?php echo $bgcolor1 ?> width=100% border=<?php echo $tbBorder ?>>
	<tr align=center>
		<td colspan=2> 
			<table bgcolor=<?php echo $bgcolor1 ?> border=<?php echo $tbBorder ?> width=96% >
				<tr align=center>
		
					<?php
					$menus = array();

					$handle = @fopen("./config/menu.txt", "r");
					if ($handle) {
						while (($buffer = fgets($handle)) !== false) {

							$menu = chop($buffer);
																
							if ( strlen($menu) > 2 ) { $menus[] = $menu; }

						}
						if (!feof($handle)) {
							echo "Fehler: unerwarteter fgets() Fehlschlag\n";
						}
						fclose($handle);
					}

					$cntMenu = count($menus);

					if ( $cntMenu == 0 ) { $cntMenu = 1; }

					$widthColumn = round(100 / $cntMenu);

					foreach($menus as $value)
					{
						if (strcmp($value, $site) == 0)
						{
						    $value = "<u>$value</u>";
						}
					    
					    echo "<td width=$widthColumn%><a	href=\"index.php?site=$value&page=1\" 
														style = \" 
														text-decoration: none; 
														color: $bgcolor4; 
														font-size: 20;
														\">
														<b>$value</b></a></td>";
					}

					?>

				</tr>
			</table>
		</td>
	</tr>
</table>


