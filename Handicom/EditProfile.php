<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<?php
include("../Assets/Connection/Connection.php");
session_start();
$disid="";
$placeid="";

if(isset($_POST["btn_save"]))
{
	$Name=$_POST["txt_name"];
	$Contact=$_POST["txt_contact"];
	$Email=$_POST["txt_email"];
	$Address=$_POST["txt_address"];
	$Place_id=$_POST["sel_place"];
	$Photo=$_FILES["file_photo"]["name"];
	$temp=$_FILES["file_photo"]["tmp_name"];
	move_uploaded_file($temp,"../Assets/SupplierDocs/".$Photo);
	
	$upQry="update tbl_supplier set supplier_name='".$Name."',supplier_contact='".$Contact."',supplier_email='".$Email."',supplier_address='".$Address."',place_id='".$Place_id."',supplier_photo='".$Photo."' where supplier_id='".$_SESSION["lgid"]."'";
	if($Conn->query($upQry))
	{
		header("Location:MyProfile.php");
	}
}
$selQry="select * from tbl_supplier u inner join tbl_place p on p.place_id=u.place_id inner join tbl_district d on d.district_id=p.district_id where supplier_id='".$_SESSION["lgid"]."'";
$row=$Conn->query($selQry);

if($data=$row->fetch_assoc())
{
	$disid=$data["district_id"];
	$placeid=$data["place_id"];
?>
<?php
include("Head.php");
?>
  <br />
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
 <input type="file" name="file_photo" id="file_photo" onchange="previewFile()" style="visibility:hidden"/>
  <table border="1" cellspacing="1" cellpadding="10" align="center">
  <tr>
  <td colspan="2" align="center">
  	<img onclick="chooseFile()" id="previewImg" src="../Assets/SupplierDocs/<?php echo $data["supplier_photo"]?>" width="120" height="120" style="border-radius:50%" />
  </td>
  </tr>
    <tr>
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" autocomplete="off" required="required" value="<?php echo $data["supplier_name"]?>" /></td>
    </tr>
    <tr>
      <td>Contact</td>
      <td><label for="txt_contact"></label>
      <input type="number" name="txt_contact" id="txt_contact" autocomplete="off" required="required" value="<?php echo $data["supplier_contact"]?>" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="email" name="txt_email" id="txt_email" autocomplete="off" required="required" value="<?php echo $data["supplier_email"]?>" /></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><label for="txt_address"></label>
      <textarea name="txt_address" id="txt_address" cols="45" rows="5" autocomplete="off" required="required"><?php echo $data["supplier_address"]?></textarea></td>
    </tr>
    
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
            <option <?php if($datadis["district_id"]==$disid){echo "selected";}?> value="<?php echo $datadis["district_id"]?>"><?php echo $datadis["district_name"]?></option>
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
        <?php
		$selplc="select * from tbl_place";
		$rowplc=$Conn->query($selplc);
		while($dataplc=$rowplc->fetch_assoc())
		{
			?>
        <option <?php if($dataplc["place_id"]==$placeid){echo "selected";}?> value="<?php echo $dataplc["place_id"]?>"><?php echo $dataplc["place_name"]?></option>
        <?php
		}
		?>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_save" id="btn_save" value="Submit" />&nbsp;
      <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
<?php
}
?>
</body>
<script src="../Assets/JQuery/jQuery.js"></script>
<script>
function chooseFile()
{
    
    $('#file_photo').trigger('click');
}

    function previewFile(input){


        var file = $("#file_photo").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }

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