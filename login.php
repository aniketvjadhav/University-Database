<?php
@session_start(); // this MUST be called prior to any output including whitespaces and line breaks!

if(isset($_SESSION['loginStatus']) && $_SESSION['loginStatus'] == 'success')
{
	$url = 'redirectMe.php';
	header("Location: $url");
	exit;
}
else
{
	$_SESSION['loginStatus'] = 'scrutinize';
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Mumbai University</title>

<link rel="stylesheet" href="css/main.css" type="text/css"/>
</head>

<body>
<p class="heading"> Welcome to Mumbai University<p>
<hr />
<br />
<br />
<br />
<br />

<form action="verify.php" name="login" id="login" method="post">

<fieldset class="loginBox">
<legend class="myText2">Login</legend>
<?php

if( isset($_SESSION['wrongPassword']) && $_SESSION['wrongPassword'] == 1)
{
	echo <<<EOT
	
	<div class="error">
		<p class="failureTitle">Wrong Username or Password</p><br />
		<p class="failureMessage">The password you entered was incorrect. Please check your caps lock is on/off.</p>
	</div>
	
	
EOT;
$_SESSION['wrongPassword'] = 0;
}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="17%" align="right"><label for="user" class="myText1">Username</label></td>
    <td width="3%">:</td>
    <td width="80%"><input autofocus="autofocus" type="text" id="user" name="user" style="inputText" class="text-input"/></td>
  </tr>
  <tr>
    <td align="right"><label for="pass" class="myText1">Password</label></td>
    <td>:</td>
    <td><input type="password" id="pass" name="pass" style="inputText" class="text-input"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><a>Forgot Your password?</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input class="login" type="submit" value="Login"  tabindex="3" /></td>
  </tr>
</table>


</fieldset>

</form>

</body>
</html>