<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<?php
session_start();
include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_save"]))
{
	$CurrentPwd=$_POST["txt_pwd"];
	$NewPwd=$_POST["txt_newpwd"];
	$ConfirmPwd=$_POST["txt_confirmpwd"];
	
	$selP="select * from tbl_supplier where supplier_id='".$_SESSION["lgid"]."' and supplier_password='".$CurrentPwd."'";
	$rowP=$Conn->query($selP);
	if($dataP=$rowP->fetch_assoc())
	{
		if($NewPwd==$ConfirmPwd)
		{
			$upQry="update tbl_supplier set supplier_password='".$NewPwd."' where supplier_id='".$_SESSION["lgid"]."'";
			if($Conn->query($upQry))
			{
				header("Location:MyProfile.php");
			}
		}
		else
		{
			?>
            <script>
			alert("Password Mismatch");
			</script>
            <?php
		}
	}
	else
	{
		?>
            <script>
			alert("Password Incorrect");
			</script>
            <?php
	}
}
?>

<?php
include("Head.php");
?>
  <br />
<form id="form1" name="form1" method="post" action="">
  <table border="1" cellspacing="1" cellpadding="10" align="center">
    <tr>
      <td>Current Password</td>
      <td><label for="txt_pwd"></label>
      <input type="password" name="txt_pwd" id="txt_pwd" autocomplete="off" required="required" /></td>
    </tr>
    <tr>
      <td>New Password</td>
      <td><label for="txt_newpwd"></label>
      <input type="password" name="txt_newpwd" id="txt_newpwd" autocomplete="off" required="required"/></td>
    </tr>
    <tr>
      <td>Confirm Password</td>
      <td><label for="txt_confirmpwd"></label>
      <input type="password" name="txt_confirmpwd" id="txt_confirmpwd" autocomplete="off" required="required"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_save" id="btn_save" value="Save" />
      <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
</body>
</html><?php
include("Foot.php");
?>