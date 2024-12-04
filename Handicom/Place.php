<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Place</title>
</head>

<body>
<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_save"]))
{
	$District_id=$_POST["sel_district"];
	$Place=$_POST["txt_place"];
	$Pincode=$_POST["txt_pincode"];
	$hid=$_POST["txt_id"];
	if($hid!="")
	{
		$upQry="update tbl_place set place_name='".$Place."',place_pincode='".$Pincode."',district_id='".$District_id."' where place_id='".$hid."'";
		if($Conn->query($upQry))
		{
			header("Location:Place.php");
		}
	}
	else
	{
	$insQry="insert into tbl_place(place_name,place_pincode,district_id)values('".$Place."','".$Pincode."','".$District_id."')";
	if($Conn->query($insQry))
	{
		?>
		<script>
		alert("Data Inserted");
		window.location="Place.php";
        </script>
		<?php
	}
	else
	{
		?>
		<script>
		alert("Data Insertion Failed");
		window.location="Place.php";
        </script>
		<?php
	}
	}
}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_place where place_id='".$_GET["did"]."'";
	if($Conn->query($delQry))
	{
		header("Location:Place.php");
	}
	else
	{
		?>
		<script>
		alert("Data Deletion Failed");
		window.location="Place.php";
        </script>
		<?php
	}
}
$pid="";
$pname="";
$pincode="";
$disid="";
if(isset($_GET["eid"]))
{
	$selQry1="select * from tbl_place where place_id='".$_GET["eid"]."'";
	$row1=$Conn->query($selQry1);
	$data1=$row1->fetch_assoc();
	$pid=$data1["place_id"];
	$pname=$data1["place_name"];
	$pincode=$data1["place_pincode"];	
	$disid=$data1["district_id"];
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
      <td><label for="sel_district"></label>
        <select name="sel_district" id="sel_district">
        <option>---select---</option>
        <?php
		$seldis="select * from tbl_district";
		$rowdis=$Conn->query($seldis);
		while($datadis=$rowdis->fetch_assoc())
		{
			?>
            <option <?php if($datadis["district_id"]==$disid){echo "selected";}?> value="<?php echo $datadis["district_id"]?>"><?php echo $datadis["district_name"]?></option>
            <?php
		}
		?>
      </select></td>
    </tr>
    <tr>
      <td>Place</td>
      <td><label for="txt_place"></label>
      <input type="hidden" name="txt_id" value="<?php echo $pid?>" />
      <input type="text" name="txt_place" id="txt_place" value="<?php echo $pname?>" autocomplete="off" required="required" /></td>
    </tr>
    <tr>
      <td>Pincode</td>
      <td><label for="txt_pincode"></label>
      <input type="text" name="txt_pincode" id="txt_pincode" value="<?php echo $pincode?>" /></td>
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
      <td>Place</td>
      <td>Pincode</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_place p inner join tbl_district d on p.district_id=d.district_id";
	$row=$Conn->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $data["district_name"]?></td>
      <td><?php echo $data["place_name"]?></td>
      <td><?php echo $data["place_pincode"]?></td>
      <td><a href="Place.php?did=<?php echo $data["place_id"]?>">Delete</a>/<a href="Place.php?eid=<?php echo $data["place_id"]?>">Edit</a></td>
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