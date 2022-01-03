<?php


$writerRole = false;

if(isset($_POST['user']) and isset($_POST['pwduser']))
{
	$user = $_POST['user'];	
	
	$pwduser = $_POST['pwduser'];
	
	if ( isset($users[$user][2]) )
	{
	    if ( (strcmp($users[$user][2], "trainee") == 0) or (strcmp($users[$user][2], "author") == 0) or (strcmp($users[$user][2], "redactor") == 0) or (strcmp($users[$user][2], "admin") == 0) )
		{
			$correctRole = true;
		}
		else
		{
			$correctRole = false;
		}
		
		if ( (strcmp($users[$user][2], "author") == 0) or (strcmp($users[$user][2], "admin") == 0) )
		{
		    $writerRole = true;
		}
		
		if ( (password_verify($pwduser, $users[$user][1]) == true) or (strcmp($pwduser, $users[$user][1]) == 0) )
		{
			$correctPwd = true;
		}
		else
		{
			$correctPwd = false;
		}
	}
	else
	{
		$correctRole = false;	
		$correctPwd = false;
	}
	
	
	if ( ($correctRole == true) and ($correctPwd == true) )
	{	

		//echo "the both true<br>";

		$loggedIn = true;
				
		$_SESSION['user'] = $user; 
		$_SESSION['loggedIn'] = $loggedIn;

	}

}

if(isset( $_SESSION['user']) ) //and isset($_SESSION['pwduser']))
{
	$loggedIn = true;

	$user = $_SESSION['user'];

}

if ( isset($_POST['logout']) )
{
	$user = "";	
	$pwduser = "";

	$loggedIn = false;
		
	session_destroy();

}


if(isset($_POST['edit']))
{
	$rmf = $_POST['edit'];	
	
	echo "$rmf";
	
	ini_set('display_errors','off');
	
	echo "<form method='post' >";
	echo "<textarea rows=10 cols=60 name='content' >";
	include("$rmf");
	echo "</textarea>";
	
	echo "<input type='text' name='ready' value=\"${rmf}\" size=70 readonly><br>";
	
	echo "<input type='submit' name='saveOld' " . " value='save'>";
	echo "</form>";

}

if(isset($_POST['ready']))
{
	$rmf = $_POST['ready'];	
	
	$html = $_POST['content'];
	
	$fp = fopen($rmf, 'w');
	fwrite($fp, $html);
	fclose($fp);

}

if(isset($_POST['remove']))
{
	$rmf = $_POST['remove'];	
	
	if (file_exists($rmf))
	{
		unlink($rmf);
	}

}

if(isset($_POST['readyNew']))
{
	$rmf = $_POST['readyNew'];	
	
	$html = $_POST['content'];
	
	$fp = fopen($rmf, 'w');
	fwrite($fp, $html);
	fclose($fp);

}
	
	
$query = $_SERVER["QUERY_STRING"];

//echo "$query<br>";

$fg = fopen("./config/menu.txt", 'r');
			
if ($fg) 
{
	if (($initMenu = fgets($fg)) !== false) 
	{
		$initMenu = chop($initMenu);
	}
	fclose($fg);
}				

$site = $initMenu;

$url = [];

//parse_str($query, $url);
parse_str($query);

$base = $site;	
//$currentPage = $page;

if (!isset($page) )
{
	$page = 1;
}

if ( strlen($base) == 0 ) { $base = $initMenu; }	

$left = 1;
$right = 2;
$position = 0;

if(is_dir("./text/$base"))
{
	//echo "dir exists<br>";
}
else
{
	//echo "dir not exists<br>";
	mkdir("./text/$base", 0700);
}

$files = array_diff(scandir("./text/$base", $blog), array('..', '.'));

$blocks = [];

$blocksAll = count($files) ;

//echo "blocksAll = $blocksAll <br>";

$pages = [];

if ( $blocksAll > $pageSize )
{
	echo "Pages: <form>";

	for ($i = 0; $i <= ($blocksAll / $pageSize); $i )
	{
		array_push($pages, ++$i);
		
		echo "<a href=\" index.php?site=$base&page=$i\">" . $i . "</a> ";
	}
		
	echo "</form>";
}

$writerRole = false;



if( isset($loggedIn) and ($loggedIn) and ($writerRole) )
{
	echo "<div style = \"align: center;
									font-size: 16px; 
									background-color: #ffffff;
									color: #000000; 
									padding: 20px; 
									margin-top: 30px;
									margin-bottom: 40px;
									margin-left: 30px;
									margin-right: 100px; 
									line-height: 18px; 
									border: 2px solid;
										\">";
		echo "Neuer Blogbeitrag:<br>";
	echo "<form method='post' >";
	echo "<textarea rows=10 cols=60 name='content' >";
	echo "</textarea>";
	$nameNew = $base . '_' . date('Y-m-d') . '_' . time() . '_' . $user . '_.txt';
	echo "<input type='text' name='readyNew' value=\"./text/$base/$nameNew\" size=60>";
	echo "<input type='submit' name='saveNew' " . " value='create'>";
	echo "</form>";
	echo "</div>";
		
}

$fileNumber = 0;
	
foreach ($files as $entry)
{
if ( file_exists("./text/$base/$entry") )
{	
	if ( substr($entry, -3) === 'txt'  )
	{

		$fileNumber++;
		
		if ( $fileNumber > $pageSize * ($page - 1) and $fileNumber <= $pageSize * $page )
		{
		
			if ( $position == 0 )
			{
				$position = $left;
			}
			elseif ( $position == $left )
			{
				$position = $right;
			}
			elseif ( $position == $right )
			{
				$position = $left;
			}
			else
			{
				$position = $left;
			}
		
		
		
			if ($position == $left)
			{
				echo "<div style = \" width: 600px;
										font-size: 16px; 
										background-color: #$bgcolor2;
										color: #$bgcolor3; 
										padding: 20px; 
										margin-top: 30px;
										margin-bottom: 40px;
										margin-left: 30px;
										margin-right: 100px; 
										line-height: 18px; 
										border: 2px solid;  \">";
			}
			else
			{
				echo "<div style = \" width: 600px;
										font-size: 16px; 
										background-color: #$bgcolor2;
										color: #$bgcolor3; 
										padding: 20px; 
										margin-top: 30px;
										margin-bottom: 40px;
										margin-left: 110px;
										margin-right: 20px; 
										line-height: 18px; 
										border: 2px solid;  \">";
			}
								
								
			$insertData = explode("_", $entry);
			echo "<font size=-3 color=#$bgcolor4>";
			echo "Hinzugefügt am ". $insertData[1] . " von " . $insertData[3];

			if( isset($loggedIn) and 
				($loggedIn == true) and 
				((strcmp($insertData[3], $user) == 0) or (strcmp($users[$user][2], "redactor") == 0)  or (strcmp($users[$user][2], "admin") == 0)) )
			{	
					echo "<table width=100% border=0><tr><td>";
					
					echo "<form method='post' >";
					echo "<input type='hidden' name='edit' value='./text/${base}/${entry}' >";
					echo "<input type='submit' name='button1' " . " value='edit'>";
					echo "</form>";
					
					echo "</td><td width=90%></td><td>";
					
					echo "<form method='post' >";
					echo "<input type='hidden' name='remove' value='./text/$base/$entry' >";
					echo "<input type='submit' name='button2' " . " value='x'>";
					echo "</form>";
					
					echo "</td></tr></table>";
			}
			else
			{
				echo "<br><br>";
			}		

			echo "</font>";
			echo "<font color=#$bgcolor4>";
			
			$fh = fopen("./text/$base/$entry", 'r');
			
			while (!feof($fh))
			{
				echo fgets($fh) . "<br>";
			}
			fclose($fh);
			
			//include("text/$base/$entry");
			
			echo "</font>";
			echo "</div>";
		
			array_push($blocks, 1);
		
		}

	}	
	
	
} 
}

$amount = count($blocks);

if ( 
		($blocksAll == 0) 
		and 
		(
			(isset($loggedIn) == false) 
			or 
			(
				(isset($loggedIn) == true) 
				and 
				($loggedIn == false)
			) 
		)
	)
{
		echo "<div style = \" width: 600px;
						font-size: 14px; 
						background-color: #$bgcolor2;
						color: #$bgcolor3; 
						padding: 20px; 
						margin-top: 30px;
						margin-bottom: 40px;
						margin-left: 30px;
						margin-right: 100px; 
						line-height: 18px; 
						border: 2px solid;  \">";
		echo "<font color=#$bgcolor4>";
		echo "There is no entry for this subject";
		echo "</font>";
		echo "</div>";
	
}

?>