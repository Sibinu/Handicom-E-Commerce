<tr>
<?php 
include("../Connection/Connection.php");

  $i=0;
  $sel = "select * from tbl_model v inner join tbl_company m on v.company_id=m.company_id where v.model_type='Second' and m.company_id='".$_GET["id"]."'";
	$rowz = $Conn->query($sel);
	while($data =  $rowz->fetch_assoc())
	{
			
		?>
			<td style="padding:30px">
            	<p style="border:1px solid black;padding:20px;text-align:center;color:blue">
                <img src="../Assets/ProductDocs/<?php echo $data["model_photo"];?>" style="border-radius:50%" width="80" height="80"/><br /><br />
                ModelName        :   <?php echo $data["model_name"];?></br><br />
                Rate             :   <?php echo $data["model_rate"];?></br><br />
				
				
                Memeory          :	<?php echo $data["model_memory"];?>
                </br><br />
                 Disply          :	<?php echo $data["model_disply"];?>
                </br><br />
                 Camera          :	<?php echo $data["model_camera"];?>
                </br><br />
				<a href="../../../Assets/AjaxPages/SearchModelSecond.php?bid=<?php echo $data["model_id"];?>">BuyNow</a><br>
               
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