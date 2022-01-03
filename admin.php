<?php 

session_set_cookie_params(3600);
session_start(['use_only_cookies'=>0]);

?>

<html>
<head>
	<title>CMS Norwill - Admin Settings</title>
	<meta name="description" content="Norwill CMS">
	<meta name="keywords" content="">
	<meta charset="utf-8"/>
</head>
<body>

<?php

include("./includes/users.php");

$adminName = "";
$roleAdmin = false;
$roleAuthor = false;
$correctPwd = false;
$adminLoggedIn = false;


if(isset($_POST['admin']))
{
    //echo "click on login <br>";
    
    $adminLoggedIn = login($users);
}

//echo "adminName = $adminName <br>";

if ( isset($_POST['logout']) )
{   
    //echo "click on logout <br>";
    
    session_destroy();
    
    $roleAdmin = false;
    $roleAuthor = false;
    $correctPwd = false;
    $adminLoggedIn = false;
}

if(isset($_SESSION['adminLoggedIn']))
{
    //echo "adminLoggedIn exists in the session array<br>";
    
    $adminLoggedIn = $_SESSION['adminLoggedIn'];

    $roleAdmin = $_SESSION['roleAdmin'];
    $roleAuthor = $_SESSION['roleAuthor'];
}




/*

if ( isset($_POST['siteNames']) 
	or isset($_POST['siteColors']) 
	or isset($_POST['menuBtn']) 
	or isset($_POST['saveWidget']) 
	or isset($_POST['loadWidget'])
	or isset($_POST['removeWidget'])
	or isset($_POST['impressumBtn']) )
{
	$adminLoggedIn = true;
	
}
*/

?>

<table border = 0 align = center width = 95%>
	<tr>
		<td valign=middle align=center colspan = 2><h2>Admin Panel for the CMS Norwill</h2></td>
	</tr>
	<tr>
		<td width = 20% align = center valign = top>
			
			<img src="images/secret_640.jpg" width=200>
			<br>

			<?php
			if( isset($adminLoggedIn) and ($adminLoggedIn == true) )
			{
				echo "<form action=\"\"  method=\"post\" enctype=\"multipart/form-data\">";
				echo "<input type=\"submit\" name=\"logout\" id=\"logout\" value=\"Logout\"/>";
				echo "</form>";	

			}
			else
			{
				echo "<form action=\"\"  method=\"post\" enctype=\"multipart/form-data\">";
				echo "<input type=\"text\" name=\"admin\" placeholder=\"Username\" size=20 />";
				echo "<br><br>";
				echo "<input type=\"password\" name=\"pwdadmin\" placeholder=\"Password\" size=20 />";
				echo "<br><br>";
				echo "<input type=\"submit\" name=\"login\" id=\"login\" value=\"Login\"/>";
				echo "</form>";	
				
				
			}
			?>
			
			<br>
		</td>
		<td>
			<?php 
			
			if( isset($adminLoggedIn) and ($adminLoggedIn) and isset($roleAdmin) and ($roleAdmin) )
			{
			    include ("admin/set_main.php");
				include ("admin/set_colors.php");
				include ("admin/set_navigation.php");
				include ("admin/set_services.php");
				include ("admin/set_impressum.php");
				include ("admin/set_users.php");
					
				
			}		
			elseif ( isset($adminLoggedIn) and ($adminLoggedIn) and isset($roleAuthor) and ($roleAuthor) )
			{
			    include ("config/params_main.php");
				include ("config/params_colors.php");
				include ("admin/set_profile.php");
			}
			else 
			{
			    echo "Please log in with correct data to administrate!"  .  "<br>";
			}
						
			?>
		</td>
	
	</tr>
</table>

</body>
</html>

<?php 

function login($users)
{
    $adminLoggedIn = false;
    
    if(isset($_POST['admin']) and isset($_POST['pwdadmin']))
    {
        $roleAdmin = false;
        $roleAuthor = false;
        $correctPwd = false;
        
        $adminName = $_POST['admin'];
        
        //echo "adminName = $adminName <br>";
        
        $adminPWD = $_POST['pwdadmin'];
        
        //echo "$adminPWD <br>";
        
        if ( isset($users[$adminName][2]) )   // if that user exists
        {
            //echo "user $adminName found <br>";
            
            if ( strcmp($users[$adminName][2], "admin") == 0 )  // if user has admin role
            {
                $roleAdmin = true;
                
                //echo "user $adminName has admin role <br>";
            }
            elseif ( (strcmp($users[$adminName][2], "author") == 0) or (strcmp($users[$adminName][2], "redactor") == 0) or (strcmp($users[$adminName][2], "trainee") == 0) )   // if user has author role
            {
                $roleAuthor = true;
                
                //echo "user $adminName has author role <br>";
            }
            else  // user has neither admin nor author role
            {
                $roleAdmin = false;
                $roleAuthor = false;
                
                //echo "user $adminName found but may not administrate <br>";
            }
            
            if ( (password_verify($adminPWD, $users[$adminName][1]) == true) or (strcmp($adminPWD, $users[$adminName][1]) == 0) )
            {
                $correctPwd = true;
                
                //echo "user $adminName uses a correct pwd <br>";
            }
            else
            {
                $correctPwd = false;
                
                //echo "user $adminName uses a wrong pwd <br>";
            }
        }
        else
        {
            $roleAdmin = false;
            $roleAuthor = false;
            $correctPwd = false;
            
            //echo "user $adminName NOT found <br>";
        }
        
        
        if ( (($roleAdmin == true) or ($roleAuthor == true)) and ($correctPwd == true) )
        {
            
            $adminLoggedIn = true;
            
            $_SESSION['admin'] = $adminName;
            $_SESSION['adminLoggedIn'] = $adminLoggedIn;
            
            $_SESSION['roleAdmin'] = $roleAdmin;
            $_SESSION['roleAuthor'] = $roleAuthor;
            
            //echo "login check -> true <br>";
            
        }
        else
        {
            $adminLoggedIn = false;
            
            $_SESSION['admin'] = "";
            $_SESSION['adminLoggedIn'] = $adminLoggedIn;
            
            $_SESSION['roleAdmin'] = $roleAdmin;
            $_SESSION['roleAuthor'] = $roleAuthor;
            
            //echo "login check -> false <br>";
        }
    }
    
    return $adminLoggedIn;
}

?>



