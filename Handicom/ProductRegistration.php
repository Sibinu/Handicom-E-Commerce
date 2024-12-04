<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ProductRegistration</title>
</head>

<body>
<?php
include("../Assets/Connection/Connection.php");
session_start();
if(isset($_POST["btn_save"]))
{
	$procutname=$_POST["txt_name"];
	$amt=$_POST["txt_amount"];
	
	$details=$_POST["txt_details"];
	
	
	$categoryid=$_POST["ddlCategory"];
	
	$Photo=$_FILES["file_photo"]["name"];
	$temp=$_FILES["file_photo"]["tmp_name"];
	move_uploaded_file($temp,"../Assets/ProductDocs/".$Photo);
	

	
	
	
	$insQry="insert into tbl_product(product_name,product_rate,product_details,product_photo,category_id,supplier_id)values('".$procutname."','".$amt."','".$details."','".$Photo."','".$categoryid."','".$_SESSION["lgid"]."')";
	if($Conn->query($insQry))
	{
		?>
		<script>
		alert("Data Inserted");
		window.location="ProductRegistration.php";
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
?>
<?php
include("Head.php");
?>
<br />
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table border="1" cellspacing="1" cellpadding="10" align="center">
  
  <tr>
      <td>Category</td>
      <td><label for="ddlCategory"></label>
        <select name="ddlCategory" id="ddlCategory" >
        <option>---select---</option>
        <?php
		$seldis="select * from tbl_category";
		$rowdis=$Conn->query($seldis);
		while($datadis=$rowdis->fetch_assoc())
		{
			?>
            <option value="<?php echo $datadis["category_id"]?>"><?php echo $datadis["category_name"]?></option>
            <?php
		}
		?>
      </select></td>
    </tr>
   
    <tr>
      <td>Product Name</td>
      <td><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" /></td>
    </tr>
    <tr>
      <td>Rate</td>
      <td><label for="txt_amount"></label>
      <input type="text" name="txt_amount" id="txt_amount" /></td>
    </tr>
    <tr>
      <td>Features</td>
      <td><label for="txt_details"></label>
      <textarea name="txt_details" id="txt_details" cols="23" rows="3"></textarea></td>
    </tr>
   
    <tr>
      <td>Image</td>
      <td><label for="file_photo"></label>
      <input type="file" name="file_photo" id="file_photo" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_save" id="btn_save" value="Submit" />&nbsp;
      <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
</body>
<script src="../Assets/JQuery/jQuery.js"></script>
<script>
function getPlace(did)
{
	
	$.ajax({
		url:"../Assets/AjaxPages/AjaxPlace.php?did="+did,
		success: function(html){
			$("#txt_place").html(html);
		}
	});
}
</script>
</html><?php
include("Foot.php");
?>