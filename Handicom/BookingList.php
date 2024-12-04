<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BookingList</title>
</head>

<body>
<?php
session_start();
include("../Assets/Connection/Connection.php");

if(isset($_GET["cid"]))
{
	
	$_SESSION["bookid"]=$_GET["cid"];
	$selA="select * from tbl_booking where booking_id='".$_GET["cid"]."'";
	$rowA=$Conn->query($selA);	
	if($dataA=$rowA->fetch_assoc())
	{
		$_SESSION["pid"]=$dataA["product_id"];
	}
	header("Location:AddCustomization.php");	
}


if(isset($_GET["payid"]))
{
	
	$_SESSION["bookid"]=$_GET["payid"];
	header("Location:PaymentGateway.php");
		
}


if(isset($_GET["did"]))
{
	$delQry="delete from tbl_booking where booking_id='".$_GET["did"]."'";
	if($Conn->query($delQry))
	{
		header("Location:BookingList.php");
	}
	else
	{
		?>
		<script>
		alert("Data Deletion Failed");
		window.location="BookingList.php";
        </script>
		<?php
	}
}

?>


<?php
include("Head.php");
?>
  <br />
  <table border="1"  align="right">
    <tr>
      <td>SI NO.</td>
       <td>Category</td>
      <td>Product</td>
      <td>Rate</td>
 
      <td>Details</td>
      <td>Date</td>
      <td>Qty</td>
       <td>DeliveryAddress</td>
        <td>TotalAmount</td>
    
      <td>Photo</td>
     
      <td>Supplier</td>
      
     
      <td>Contact</td>
          <td>Email</td>
     
      <td align="center" colspan="3">Action</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_product p inner join tbl_category d on p.category_id=d.category_id inner join tbl_booking bk on bk.product_id=p.product_id inner join tbl_supplier sp on sp.supplier_id=p.supplier_id where bk.booking_status='0' and bk.user_id='".$_SESSION["uid"]."'";
	$row=$Conn->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $i?></td>
       <td><?php echo $data["category_name"]?></td>
      <td><?php echo $data["product_name"]?></td>
      <td><?php echo $data["product_rate"]?></td>
      <td><?php echo $data["product_details"]?></td>
         <td><?php echo $data["booking_date"]?></td>
      <td><?php echo $data["booking_nos"]?></td>
      <td><?php echo $data["booking_deliveryaddress"]?></td>
      <td><?php echo $data["booking_totalamt"]?></td>
      <td><img src="../Assets/ProductDocs/<?php echo $data["product_photo"]?>" width="75" height="75" /></td>
      
      
      <td><?php echo $data["supplier_name"]?></td>
       <td><?php echo $data["supplier_contact"]?></td>
  
      <td><?php echo $data["supplier_email"]?></td>
      
     
    
      <td><a href="BookingList.php?cid=<?php echo $data["booking_id"]?>">ADDCustomization</a></td>
      <td><a href="BookingList.php?did=<?php echo $data["booking_id"]?>">Delete</a></td>
      <td><a href="BookingList.php?payid=<?php echo $data["booking_id"]?>">PayNow</a></td>
      
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>
</html>

<?php
include("Foot.php");
?>