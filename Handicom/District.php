<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>District</title>
</head>

<body>
<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_save"]))
{
	$District=$_POST["txt_district"];
	$hid=$_POST["txt_id"];
	if($hid!="")
	{
		$upQry="update tbl_district set district_name='".$District."' where district_id='".$hid."'";
		if($Conn->query($upQry))
		{
			header("Location:District.php");
		}
	}
	else
	{
	$insQry="insert into tbl_district(district_name)values('".$District."')";
	if($Conn->query($insQry))
	{
		?>
		<script>
		alert("Data Inserted");
		window.location="District.php";
        </script>
		<?php
	}
	else
	{
		?>
		<script>
		alert("Data Insertion Failed");
		window.location="District.php";
        </script>
		<?php
	}
	}
}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_district where district_id='".$_GET["did"]."'";
	if($Conn->query($delQry))
	{
		header("Location:District.php");
	}
	else
	{
		?>
		<script>
		alert("Data Deletion Failed");
		window.location="District.php";
        </script>
		<?php
	}
}
$did="";
$dname="";
if(isset($_GET["eid"]))
{
	$selQry1="select * from tbl_district where district_id='".$_GET["eid"]."'";
	$row1=$Conn->query($selQry1);
	$data1=$row1->fetch_assoc();
	$did=$data1["district_id"];
	$dname=$data1["district_name"];	
}
?>
<?php
include("Head.php");
?>
<br />
<form id="form1" name="form1" method="post" action="">
  <table border="1" cellspacing="1" cellpadding="10" align="center">
    <tr>
      <td>District</td>
      <td><label for="txt_district"></label>
      <input type="hidden" name="txt_id" value="<?php echo $did?>" />
      <input type="text" name="txt_district" id="txt_district" value="<?php echo $dname?>" autocomplete="off" required="required" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_save" id="btn_save" value="Save" />
      <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
  <br />
  <br />
  <br />
  <table border="1" cellspacing="1" cellpadding="10" align="center">
    <tr>
      <td>SI NO.</td>
      <td>District</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_district";
	$row=$Conn->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $data["district_name"]?></td>
      <td><a href="District.php?did=<?php echo $data["district_id"]?>">Delete</a>/<a href="District.php?eid=<?php echo $data["district_id"]?>">Edit</a></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>
</html><?php
include("Foot.php");
?>