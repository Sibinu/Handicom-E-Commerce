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



if(isset($_GET["did"]))
{
	$delQry="update tbl_booking set booking_status='2' where booking_id='".$_GET["did"]."'";
	if($Conn->query($delQry))
	{
		header("Location:BookingListDelivered.php");
	}
	else
	{
		?>
		<script>
		alert("Data Deletion Failed");
		window.location="BookingListDelivered.php";
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
       <td>Category</td>
      <td>Product</td>
      <td>Rate</td>
 
      <td>Details</td>
      <td>Date</td>
      <td>Qty</td>
       <td>DeliveryAddress</td>
        <td>TotalAmount</td>
    
      <td>Photo</td>
     
      <td>User</td>
      
     
      <td>Contact</td>
          <td>Email</td>
     
     
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_product p inner join tbl_category d on p.category_id=d.category_id inner join tbl_booking bk on bk.product_id=p.product_id inner join tbl_user sp on sp.user_id=bk.user_id where bk.booking_status='2' and p.supplier_id='".$_SESSION["lgid"]."'";
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
      
      
      <td><?php echo $data["user_name"]?></td>
       <td><?php echo $data["user_contact"]?></td>
  
      <td><?php echo $data["user_email"]?></td>
      
      
       
     
    
      
      
      
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