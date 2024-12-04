<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ViewReview</title>
</head>

<body>
<?php
session_start();
include("../Assets/Connection/Connection.php");

$sum=0;
//$avg=0;


?>


<?php
include("Head.php");
?>
  <br />
  <table border="1"  align="center">
    <tr>
      <td>SI NO.</td>
       <td>Category</td>
      <td>ProductName</td>
      <td>ProductRate</td>
 
      <td>Details</td>
      <td>RewviewDate</td>
      <td>Comment</td>
       <td>ReviewRate</td>
        
    
      <td>Photo</td>
     
      <td>Supplier</td>
      
     
    
          <td>Email</td>
     
      <td>ReviewBy</td>
    </tr>
    <?php
	$i=0;
	
	$selQry="select * from tbl_product p inner join tbl_category d on p.category_id=d.category_id inner join tbl_booking bk on bk.product_id=p.product_id inner join tbl_supplier sp on sp.supplier_id=p.supplier_id inner join tbl_review r on r.booking_id=bk.booking_id inner join tbl_user u on u.user_id=bk.user_id where bk.booking_status='2' and sp.supplier_id='".$_SESSION["supID"]."'";
	$row=$Conn->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
		$sum=$sum+$data["review_rate"];
	?>
    <tr>
      <td><?php echo $i?></td>
       <td><?php echo $data["category_name"]?></td>
      <td><?php echo $data["product_name"]?></td>
      <td><?php echo $data["product_rate"]?></td>
      <td><?php echo $data["product_details"]?></td>
         <td><?php echo $data["review_date"]?></td>
      <td><?php echo $data["review_comment"]?></td>
      <td><?php echo $data["review_rate"]?></td>
    
      <td><img src="../Assets/ProductDocs/<?php echo $data["product_photo"]?>" width="75" height="75" /></td>
      
      
      <td><?php echo $data["supplier_name"]?></td>
       
  
      <td><?php echo $data["supplier_email"]?></td>
      
       <td><?php echo $data["user_name"]?></td>
       
      
     
     
      
      
      
    </tr>
    <?php
	$avg=$sum/$i;
	}
	
	?>
	<p align="center"><b>Average Rating : :: <?php echo $avg?></b></p>
	
  </table>
</form>
</body>
</html>

<?php
include("Foot.php");
?>