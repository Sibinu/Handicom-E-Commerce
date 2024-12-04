<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BookNow</title>
</head>

<body>
<?php
include("../Assets/Connection/Connection.php");
session_start();

if(isset($_POST["btn_save"]))
{
	//$fromDate=$_POST["txt_fromdate"];
	//$pupose=$_POST["txtpurpose"];
	$address=$_POST["txtadd"];
	$qtys=$_POST["txtqty"];
	$amt=$_SESSION["itemamt"];
	
	$totalamt=$amt*$qtys;
	
	
	$insQry="insert into tbl_booking(product_id,user_id,booking_date,booking_totalamt,booking_nos,booking_deliveryaddress)values('".$_SESSION["vid"]."','".$_SESSION["uid"]."',curdate(),'$totalamt','$qtys','$address')";
	if($Conn->query($insQry))
	{
		?>
		<script>
		alert("Data Inserted");
		window.location="BookingList.php";
        </script>
		<?php
	}
	else
	{
		?>
		<script>
		alert("Data Insertion Failed");
		window.location="BookingList.php";
        </script>
		<?php
	}
}
	
	
 $selQry = "select * from tbl_product v inner join tbl_category m on v.category_id=m.category_id inner join tbl_supplier s on s.supplier_id=v.supplier_id where v.product_id='".$_SESSION["vid"]."'";
$row=$Conn->query($selQry);

if($data=$row->fetch_assoc())
{
	$itemamt=$data["product_rate"];
	$_SESSION["itemamt"]=$itemamt;
?>

<?php
include("Head.php");
?>
  <br />
<form id="form1" name="form1" method="post" action="">
  <table border="4" cellspacing="1" cellpadding="10" align="center">
  <tr>
  <td colspan="2" align="center">
  <img src="../Assets/ProductDocs/<?php echo $data["product_photo"];?>" width="120" height="120" style="border-radius:50%"/>
  </td>
  </tr>
    <tr>
      <td>ProductName</td>
      <td><?php echo $data["product_name"]?></td>
    </tr>
    
    <tr>
      <td>Rate</td>
      <td><?php echo $data["product_rate"]?></td>
    </tr>
    <tr>
      <td>Details</td>
      <td><?php echo $data["product_details"]?></td>
    </tr>
    <tr>
      <td>Category</td>
      <td><?php echo $data["category_name"]?></td>
    </tr>
     
    
     
    

   
   
    <tr>
      <td>DeliveryAddress</td>
      <td><label for="txtadd"></label>
       <textarea name="txtadd" id="txtadd" autocomplete="off" required="required"></textarea></td>
    </tr>
    
      <tr>
      <td>Quantity</td>
      <td><label for="txtqty"></label>
      <input type="number" name="txtqty" id="txtqty" autocomplete="off" required="required" /></td>
    </tr>
     <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_save" id="btn_save" value="Submit" />
      <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
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