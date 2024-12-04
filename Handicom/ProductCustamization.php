<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ProductCustomization</title>
</head>

<body>
<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btn_save"]))
{
	$procutname=$_POST["ddlproduct"];
	$cfield=$_POST["txt_name"];
	
	$insQry="insert into tbl_productfield(product_id,field_name)values('".$procutname."','".$cfield."')";
	if($Conn->query($insQry))
	{
		?>
		<script>
		alert("Data Inserted");
		window.location="ProductCustamization.php";
        </script>
		<?php
	}
	else
	{
		?>
		
		<?php
		echo $insQry;
	}
}


if(isset($_GET["did"]))
{
	$delQry="delete from tbl_productfield where field_id='".$_GET["did"]."'";
	if($Conn->query($delQry))
	{
		header("Location:ProductCustamization.php");
	}
	else
	{
		?>
		<script>
		alert("Data Deletion Failed");
		window.location="ProductCustamization.php";
        </script>
		<?php
	}
}


?>
<?php
include("Head.php");
?>
<br />
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table border="1" cellspacing="1" cellpadding="10" align="center">
  
  <tr>
      <td>Product</td>
      <td><label for="ddlproduct"></label>
        <select name="ddlproduct" id="ddlproduct" >
        <option>---select---</option>
        <?php
		$selQry="select * from tbl_product where supplier_id='".$_SESSION["lgid"]."'";
		$rowdis=$Conn->query($selQry);
		while($datadis=$rowdis->fetch_assoc())
		{
			?>
            <option value="<?php echo $datadis["product_id"]?>"><?php echo $datadis["product_name"]?></option>
            <?php
		}
		?>
      </select></td>
    </tr>
   
    <tr>
      <td>Customized Field Name</td>
      <td><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" /></td>
    </tr>
  
    
   
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_save" id="btn_save" value="Submit" />&nbsp;
      <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
</body>

</html>


<table border="1" cellspacing="1" cellpadding="10" align="center">
    <tr>
      <td>SI NO.</td>
      <td>Name</td>
    
       <td>Category</td>
         <td>FieldName</td>
      <td>Photo</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_product p inner join tbl_category c on p.category_id=c.category_id inner join tbl_productfield f on f.product_id=p.product_id where p.supplier_id='".$_SESSION["lgid"]."'";
	$row=$Conn->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $i?></td>
      
      <td><?php echo $data["product_name"]?></td>
      
      <td><?php echo $data["category_name"]?></td>
      <td><?php echo $data["field_name"]?></td>
      <td><img src="../Assets/ProductDocs/<?php echo $data["product_photo"]?>" width="75" height="75" /></td>
     
      <td><a href="ProductCustamization.php?did=<?php echo $data["field_id"]?>">Delete</a></td>
    </tr>
    <?php
	}
	?>
  </table>



<?php
include("Foot.php");
?>