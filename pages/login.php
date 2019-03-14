<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bughound</title>
        <link rel="stylesheet" href="../assets/styles/nav_menu_style.css">
        <link rel="stylesheet" href="../assets/styles/vertical_menu_style.css">
        <link rel="stylesheet" href="../assets/styles/form_style.css">
    </head>
    <body>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li style="float:right"><a href="login.php">Login</a></li>
        </ul>

        <h2><center><font color="gray">Bughound Login</font></center></h2>

        <form name="add_functional_area_form"  action="login_post.php" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>Username:</td><td><input type="Text" name="username" /></td></tr>    
				<tr><td>Password:</td><td><input type="Password" name="password" /></td></tr> 
            </table>
            <input type="submit" name="submit" value="Submit" />
            <input class="button" type="button" onclick="window.location.replace('login.php')" value="Cancel" />
        </form>

        <script language=Javascript>
            function validate(theform) {
                if(theform.username.value === ""){
                    alert ("Username field must contain characters");
                    return false;
                }
				if(theform.password.value === ""){
                    alert ("Password field must contain characters");
                    return false;
                }	
				return true;				
            }
        </script>
    </body>
</html>
