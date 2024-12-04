<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Profile</title>
</head>

<body>
<?php
include("../Assets/Connection/Connection.php");
session_start();

$selQry="select * from tbl_supplier u inner join tbl_place p on p.place_id=u.place_id inner join tbl_district d on d.district_id=p.district_id where supplier_id='".$_SESSION["lgid"]."'";
$row=$Conn->query($selQry);

if($data=$row->fetch_assoc())
{
?>
<?php
include("Head.php");
?>
  <br />
<form id="form1" name="form1" method="post" action="">
  <table border="4" cellspacing="1" cellpadding="10" align="center">
  <tr>
  <td colspan="2" align="center">
  <img src="../Assets/SupplierDocs/<?php echo $data["supplier_photo"];?>" width="120" height="120" style="border-radius:50%"/>
  </td>
  </tr>
    <tr>
      <td>Name</td>
      <td><?php echo $data["supplier_name"]?></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><?php echo $data["supplier_contact"]?></td>
    </tr>
    
    <tr>
      <td>Email</td>
      <td><?php echo $data["supplier_email"]?></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><?php echo $data["supplier_address"]?></td>
    </tr>
    <tr>
      <td>District</td>
      <td><?php echo $data["district_name"]?></td>
    </tr>
    <tr>
      <td>Place</td>
      <td><?php echo $data["place_name"]?></td>
    </tr>
    <tr>
    <td colspan="2"><a href="EditProfile.php">Edit Profile</a>&nbsp;&nbsp;
    <a href="ChangePassword.php">Change Password</a></td>
    </tr>
  </table>
</form>
<?php
}
?>
</body>
</html><?php
include("Foot.php");
?>