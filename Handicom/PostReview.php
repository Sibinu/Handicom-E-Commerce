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
	$comment=$_POST["txtcomment"];
	$rate=$_POST["txtrate"];
	
	
	
	$insQry="insert into tbl_review(booking_id,user_id,review_date,review_comment,review_rate)values('".$_SESSION["bookid"]."','".$_SESSION["uid"]."',curdate(),'$comment','$rate')";
	if($Conn->query($insQry))
	{
		?>
		<script>
		alert("Data Inserted");
		window.location="PostReview.php";
        </script>
		<?php
	}
	else
	{
		?>
		<script>
		alert("Data Insertion Failed");
		window.location="PostReview.php";
        </script>
		<?php
	}
}
	
	
 $selQry = "select * from tbl_product v inner join tbl_category m on v.category_id=m.category_id inner join tbl_supplier s on s.supplier_id=v.supplier_id inner join tbl_booking bk on bk.product_id=v.product_id where bk.booking_id='".$_SESSION["bookid"]."'";
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
      <td>Review/Comment</td>
      <td><label for="txtcomment"></label>
       <textarea name="txtcomment" id="txtcomment" autocomplete="off" required="required"></textarea></td>
    </tr>
    
      <tr>
      <td>Rating</td>
      <td><label for="txtrate"></label>
      <input type="number" name="txtrate" id="txtrate" autocomplete="off" required="required" min="1" max="5" placeholder="Value Between 1-5" /></td>
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