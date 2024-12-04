<?php
session_start();
include('../Assets/Connection/Connection.php');


if(isset($_GET["bid"]))
{
	
	$_SESSION["vid"]=$_GET["bid"];
	header("location:BookNow.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ENnullhttp://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

</head>

<body>
<?php
include("Head.php");
?>
  <br />
<div align="center" id="tab">
<form id="form1" name="form1" method="post" action=../../User/null>
<h1>Search Product</h1>
<br><br>
  <table width="750" border="1" align="center">
    
		<tr>
  
      <td><label for="sel_type"></label>
        <select name="sel_type" id="sel_category" onChange="getWork(this.value)">
              <option value="">-----Select Category-----</option>
        <?php
         	  $sel ="select * from tbl_category";
	  $row = $Conn->query($sel);
	  while($data =  $row->fetch_assoc())
	  {
     ?>
		 <option value="<?php echo $data['category_id'];?>" 
          ><?php echo $data['category_name']; ?></option >
         
         <?php
         }
		 ?>
		</select>
        </td>
        
        
      
    </tr>
  </table>
  <table style="border-collapse:collapse;" align="center" id="dataT">
  <tr>
  <?php
  $i=0;
  $sel = "select * from tbl_product v inner join tbl_category m on v.category_id=m.category_id inner join tbl_supplier s on s.supplier_id=v.supplier_id";
	$rowz = $Conn->query($sel);
	while($data =  $rowz->fetch_assoc())
	{
			/*$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;

	$query = "
	SELECT * FROM tbl_review where labour_id = '".$data["labour_id"]."' ORDER BY review_id DESC
	";

	$result = $conn->query($query);

	while($row =  $result->fetch_assoc())
	{
		if($row["user_rating"] == '5')
		{
			$five_star_review++;
		}

		if($row["user_rating"] == '4')
		{
			$four_star_review++;
		}

		if($row["user_rating"] == '3')
		{
			$three_star_review++;
		}

		if($row["user_rating"] == '2')
		{
			$two_star_review++;
		}

		if($row["user_rating"] == '1')
		{
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["user_rating"];

	}
if($total_user_rating>0)
{
	$average_rating = $total_user_rating / $total_review;
}

		$i++;*/
		?>
			<td style="padding:30px">
            	<p style="border:1px solid black;padding:20px;text-align:center;color:blue">
                <img src="../Assets/ProductDocs/<?php echo $data["product_photo"];?>" style="border-radius:50%" width="80" height="80"/><br /><br />
                ProductName        :   <?php echo $data["product_name"];?></br><br />
                Rate :  <?php echo $data["product_rate"];?></br><br />
             
                Details          :	<?php echo $data["product_details"];?>
                </br><br />
                 Category          :	<?php echo $data["category_name"];?>
                </br><br />
                 Supplier          :	<?php echo $data["supplier_name"];?>
                </br><br />
                 Contact          :	<?php echo $data["supplier_contact"];?>
                </br><br />
                 Email          :	<?php echo $data["supplier_email"];?>
                </br><br />
				<a href="SearchProduct.php?bid=<?php echo $data["product_id"];?>">BuyNow</a><br>
               
                </p>
			</td>
		<?php
		if($i==4)
		{
			echo "</tr><tr>";
			$i=0;
		}
	}
  
  
  ?>
  </table>
</form>
</div>
<script src="../../Jq/jquery.js"></script>
<script>
function getPlace(did)
{


	$.ajax({
	url: "../AjaxPages/AjaxPlace.php?did="+did,
	  success: function(result){
		$("#sel_place").html(result);
	  }
	});
	
}
function getWork(id)
{
	
		$.ajax({
		url: "../Assets/AjaxPages/AjaxWork.php?id="+id,
		  success: function(result){
			  $("#dataT").html(result);
		  }
		});
}
</script>

</body>
</html><?php
include("Foot.php");
?>
