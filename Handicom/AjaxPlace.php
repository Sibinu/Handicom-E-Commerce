<?php 
include("../Connection/Connection.php");
?>
 <option value="" style="text-align:center">Select Place</option> 
         <?php
		 				
						
							$did=$_GET["did"];
						
		 				$sel="select * from  tbl_place  where  district_id='".$did."'";
						
						$row=$Conn->query($sel);
						
						while($data=$row->fetch_assoc())
						{
						
					
						
						  $d=$data['place_id'];
							$dname=$data['place_name'] ; 
								
		  ?>
           <option style="text-align:center" value="<?php echo $d;?>"  ><?php  echo $dname; ?></option>
                    <?php 
						}
					?>