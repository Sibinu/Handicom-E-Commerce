<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ProductList</title>
</head>

<body>
<?php
include("../Assets/Connection/Connection.php");
session_start();

if(isset($_GET["did"]))
{
	$delQry="delete from tbl_product where product_id='".$_GET["did"]."'";
	if($Conn->query($delQry))
	{
		header("Location:ProductList.php");
	}
	else
	{
		?>
		<script>
		alert("Data Deletion Failed");
		window.location="ProductList.php";
        </script>
		<?php
	}
}

?>

<?php
include("Head.php");
?>
<br />
  <table border="1" cellspacing="1" cellpadding="10" align="center">
    <tr>
      <td>SI NO.</td>
      <td>Name</td>
      <td>Rate</td>

      <td>Details</td>
       <td>Category</td>
      <td>Photo</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_product p inner join tbl_category c on p.category_id=c.category_id where p.supplier_id='".$_SESSION["lgid"]."'";
	$row=$Conn->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $i?></td>
      
      <td><?php echo $data["product_name"]?></td>
      <td><?php echo $data["product_rate"]?></td>
      <td><?php echo $data["product_details"]?></td>
      <td><?php echo $data["category_name"]?></td>
      <td><img src="../Assets/ProductDocs/<?php echo $data["product_photo"]?>" width="75" height="75" /></td>
     
      <td><a href="ProductList.php?did=<?php echo $data["product_id"]?>">Delete</a></td>
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