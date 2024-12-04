<?php 
include("../../../Connection/Connection.php");
include('../../../User/SessionValidator.php');
?>
 <?php


	$selList="select * from tbl_wishlist where labour_id='".$_GET["id"]."' and user_id='".$_SESSION["userid"]."'";
	$RowList=$conn->query($selList);
	if($dataList=$RowList->fetch_assoc())
	{
		$dele="delete from tbl_wishlist where labour_id='".$_GET["id"]."' and user_id='".$_SESSION["userid"]."'";
        
	if($conn->query($dele))
		{
			echo "black";
		}
		else
		{
			echo "red";
		}
	}
	
	else{
	$insqry="insert into tbl_wishlist(labour_id,user_id)values('".$_GET["id"]."','".$_SESSION["userid"]."')";
	if($conn->query($insqry))
		{
			echo "red";
		}
		else
		{
			echo "black";
		}
	}

	
					?>