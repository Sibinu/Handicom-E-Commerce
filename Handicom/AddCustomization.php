<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ProductCustamization</title>
</head>

<body>
<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btn_save"]))
{
	$procutname=$_POST["ddlfield"];
	$cfield=$_POST["txt_name"];
	
	$insQry="insert into tbl_productfielduser(booking_id,userfield_name,field_id)values('".$_SESSION["bookid"]."','".$cfield."','".$procutname."')";
	if($Conn->query($insQry))
	{
		?>
		<script>
		alert("Data Inserted");
		window.location="AddCustomization.php";
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
	$delQry="delete from tbl_productfielduser where userfield_id='".$_GET["did"]."'";
	if($Conn->query($delQry))
	{
		header("Location:AddCustomization.php");
	}
	else
	{
		?>
		<script>
		alert("Data Deletion Failed");
		window.location="AddCustomization.php";
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
      <td>CustomizeField</td>
      <td><label for="ddlfield"></label>
        <select name="ddlfield" id="ddlfield" >
        <option>---select---</option>
        <?php
		$selQry="select * from tbl_productfield where product_id='".$_SESSION["pid"]."'";
		$rowdis=$Conn->query($selQry);
		while($datadis=$rowdis->fetch_assoc())
		{
			?>
            <option value="<?php echo $datadis["field_id"]?>"><?php echo $datadis["field_name"]?></option>
            <?php
		}
		?>
      </select></td>
    </tr>
   
    <tr>
      <td>CustomerValue</td>
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
    <td>FieldName</td>
       <td>FiledValue</td>
         
      <td>Photo</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_productfielduser pu inner join tbl_productfield pf on pu.field_id=pf.field_id inner join tbl_booking b on b.booking_id=pu.booking_id inner join  tbl_product p on p.product_id=b.product_id where pu.booking_id='".$_SESSION["bookid"]."'";
	$row=$Conn->query($selQry);
	while($data=$row->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $i?></td>
      
      <td><?php echo $data["product_name"]?></td>
      
      
      <td><?php echo $data["field_name"]?></td>
      <td><?php echo $data["userfield_name"]?></td>
      <td><img src="../Assets/ProductDocs/<?php echo $data["product_photo"]?>" width="75" height="75" /></td>
     
      <td><a href="AddCustomization.php?did=<?php echo $data["userfield_id"]?>">Delete</a></td>
    </tr>
    <?php
	}
	?>
  </table>



<?php
include("Foot.php");
?>