<tr>
<?php 
session_start();
include("../Connection/Connection.php");

  $i=0;
  $sel = "select * from tbl_product v inner join tbl_category m on v.category_id=m.category_id inner join tbl_supplier s on s.supplier_id=v.supplier_id where v.category_id='".$_GET["id"]."'";
	$rowz = $Conn->query($sel);
	while($data =  $rowz->fetch_assoc())
	{
			
		?>
			<<td style="padding:30px">
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