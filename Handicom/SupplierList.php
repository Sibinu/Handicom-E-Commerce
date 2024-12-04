<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SupplierList</title>
</head>

<body>
<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_GET["acid"]))
{
	
	$_SESSION["supID"]=$_GET["acid"];
	header("location:ViewReview.php");
}




if(isset($_GET["rejid"]))
{
	$delQry="update tbl_supplier set supplier_status='2' where supplier_id='".$_GET["rejid"]."'";
	if($Conn->query($delQry))
	{
		header("Location:SupplierList.php");
	}
	else
	{
		?>
		<script>
		alert("Data Deletion Failed");
		window.location="SupplierList.php";
        </script>
		<?php
	}
}



?>


<?php
include("Head.php");
?>
<br />
  <table border="1"  align="center">
    <tr>
      <td>SI NO.</td>
      <td>District</td>
      <td>Place</td>
      <td>Name</td>
      <td>Contact</td>
      <td>Email</td>
      <td>Address</td>
    
      <td>Photo</td>
      <td>Proof</td>
      <td colspan="2">Action</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_supplier p inner join tbl_place d on p.place_id=d.place_id inner join tbl_district t on t.district_id=d.district_id where p.supplier_status='1'";
	$row=$Conn->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $data["district_name"]?></td>
      <td><?php echo $data["place_name"]?></td>
      <td><?php echo $data["supplier_name"]?></td>
      <td><?php echo $data["supplier_contact"]?></td>
      <td><?php echo $data["supplier_email"]?></td>
         <td><?php echo $data["supplier_address"]?></td>
    
      <td><img src="../Assets/SupplierDocs/<?php echo $data["supplier_photo"]?>" width="75" height="75" /></td>
      <td><img src="../Assets/SupplierDocs/<?php echo $data["supplier_proof"]?>" width="75" height="75" /></td>
      <td><a href="SupplierList.php?acid=<?php echo $data["supplier_id"]?>">Review</a></td>
      <td><a href="SupplierList.php?rejid=<?php echo $data["supplier_id"]?>">Block</a></td>
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