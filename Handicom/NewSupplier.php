<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NewSupplier</title>
</head>

<body>
<?php
include("../Assets/Connection/Connection.php");
if(isset($_POST["btn_save"]))
{
	$Name=$_POST["txt_name"];
	$Contact=$_POST["txt_contact"];
	$Gender=$_POST["gender"];
	$Email=$_POST["txt_email"];
	$Address=$_POST["txt_address"];
	
	$Place_id=$_POST["sel_place"];
	$Password=$_POST["txt_password"];
	
	$Photo=$_FILES["file_photo"]["name"];
	$temp=$_FILES["file_photo"]["tmp_name"];
	move_uploaded_file($temp,"../Assets/SupplierDocs/".$Photo);
	
	
	$proof=$_FILES["file_proof"]["name"];
	$temp=$_FILES["file_proof"]["tmp_name"];
	move_uploaded_file($temp,"../Assets/SupplierDocs/".$proof);
	
	
	
	$insQry="insert into tbl_supplier(supplier_name,supplier_contact,supplier_email,supplier_address,supplier_proof,place_id,supplier_password,supplier_photo,supplier_doj)values('".$Name."','".$Contact."','".$Email."','".$Address."','".$proof."','".$Place_id."','".$Password."','".$Photo."',curdate())";
	if($Conn->query($insQry))
	{
		?>
		<script>
		alert("Data Inserted");
		window.location="NewSupplier.php";
        </script>
		<?php
	}
	else
	{
		?>
		<script>
		alert("Data Insertion Failed");
		window.location="NewSupplier.php";
        </script>
		<?php
	}
}
?>
<?php
include("header.php");
?>
<br />
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table border="1" cellspacing="1" cellpadding="10" align="center">
  
  <tr>
      <td>District</td>
      <td><label for="sel_district"></label>
        <select name="sel_district" id="sel_district" onchange="getPlace(this.value)">
        <option>---select---</option>
        <?php
		$seldis="select * from tbl_district";
		$rowdis=$Conn->query($seldis);
		while($datadis=$rowdis->fetch_assoc())
		{
			?>
            <option value="<?php echo $datadis["district_id"]?>"><?php echo $datadis["district_name"]?></option>
            <?php
		}
		?>
      </select></td>
    </tr>
    <tr>
      <td>Place</td>
      <td><label for="sel_place"></label>
        <select name="sel_place" id="txt_place">
        <option>---select---</option>
      </select></td>
    </tr>
    <tr>
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" autocomplete="off" required="required" /></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txt_contact"></label>
      <input type="number" name="txt_contact" id="txt_contact" autocomplete="off" required="required" /></td>
    </tr>
   
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="email" name="txt_email" id="txt_email" autocomplete="off" required="required" /></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><label for="txt_address"></label>
      <textarea name="txt_address" id="txt_address" cols="23" rows="3" autocomplete="off" required="required"></textarea></td>
    </tr>
   
   
    
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="password" name="txt_password" id="txt_password" autocomplete="off" required="required" /></td>
    </tr>
     <tr>
      <td>Photo</td>
      <td><label for="file_photo"></label>
      <input type="file" name="file_photo" id="file_photo" autocomplete="off" required="required" /></td>
    </tr>
     <tr>
      <td>Proof</td>
      <td><label for="file_proof"></label>
      <input type="file" name="file_proof" id="file_proof" autocomplete="off" required="required" /></td>
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
</html>

<?php
include("footer.php");
?>