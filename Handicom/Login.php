<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>

<body>
<?php
session_start();
include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_login"]))
{
	$Email=$_POST["txt_email"];
	$Password=$_POST["txt_password"];
	
	$selA="select * from tbl_admin where admin_email='".$Email."' and admin_password='".$Password."'";
	$rowA=$Conn->query($selA);	
	
	$selU="select * from tbl_user where user_email='".$Email."' and user_password='".$Password."'";
	$rowU=$Conn->query($selU);
	
	$selS="select * from tbl_supplier where supplier_email='".$Email."' and supplier_password='".$Password."' and supplier_status='1'";
	$rowS=$Conn->query($selS);
	
	
	
	if($dataA=$rowA->fetch_assoc())
	{
		$_SESSION["aid"]=$dataA["admin_id"];
		$_SESSION["aname"]=$dataA["admin_name"];
		header("Location:../Admin/HomePage.php");
	}
	else if($dataU=$rowU->fetch_assoc())
	{
		
		$_SESSION["uid"]=$dataU["user_id"];
		$_SESSION["lgid"]=$dataU["user_id"];
		$_SESSION["uname"]=$dataU["user_name"];
		header("Location:../User/HomePage.php");
	}
	else if($dataS=$rowS->fetch_assoc())
	{
		$_SESSION["lgid"]=$dataS["supplier_id"];
		$_SESSION["lgname"]=$dataS["supplier_name"];
		header("Location:../Supplier/HomePage.php");
	}
	
	else
	{
			?>
            <script>
			alert('Invalid Credentials !!!');
			window.location="Login.php";
			</script>
            <?php
	}
}
?>

<?php
include("header.php");
?>
<br />
<form id="form1" name="form1" method="post" action="">
  <table border="1" cellspacing="1" cellpadding="10">
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="email" name="txt_email" id="txt_email" autocomplete="off" required="required" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="password" name="txt_password" id="txt_password" autocomplete="off" required="required" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_login" id="btn_login" value="Login" /></td>
    </tr>
  </table>
</form>
</body>
</html>

<?php
include("footer.php");
?>