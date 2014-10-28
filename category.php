<? require("./lib/system_core.php"); ?>
<?
$cid=$_REQUEST["cid"];
$tid=$_REQUEST["tid"];

if($cid>0){
	$sql = "SELECT * FROM products_category ";
	$sql.= " WHERE 1=1 ";
	$sql.= " AND  cate_id='".$cid."' ";
	$sql.= " ORDER BY order_by asc";
}

if($tid>0){
	$sql = "SELECT * FROM products_type ";
	$sql.= " WHERE 1=1 ";
	$sql.= " AND  cate_id='".$tid."' ";
	$sql.= " ORDER BY order_by asc";
}

$Conn->query($sql);
$Content = $Conn->getResult();
$CntRec = $Conn->getRowCount();

if($CntRec<1){
	header('Location:./product.php');	
}

$RowHead=$Content[0];
$CateID	=$RowHead["cate_id"];
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=1400">
    <title>Thaikoon Steel Group</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/layout.css" />
    <script src="js/vendor/modernizr.js"></script>
    
    
    
	
	
  </head>
  <body>
        
    <div id="wrapper">
	    <div class="warp">
		    <?php include('inc-topmenu.php');?>
		    		    
	    </div>
	    <!--warp-->
	    
	    
	    <div id="slider-wrapper-inner">
	    
	    
	    <div class="innerbanner">
		    <img src="images/abanner_01.jpg">
	    </div>
	    <!--innerbanner-->
			
			
			<div id="bshape"></div>
			<!--shape-->
			
	    </div>
		<!--slider-wrapper-->
	    
	    
	    	<div id="innerpage-wrapper">
		    	<div id="innerpage-detail-wrapper">
			    	<div id="titlebar">
			    		<h1 class="title">PRODUCTS</h1>
			    		
			    		
			    		
			    		
			    		
			    	
			    		
			    	</div>
			    	<!--titlebar-->
			    	
			    	<div class="clearfix"></div>
			    	
			    	
			    	
			    	<div id="category-list-wrapper" class="use">
				    	<div class="productdetail" id="cat-wrapper">
				    	
				    		<h6><?=$RowHead["name"]?> </h6>
				    		<div class="clearfix"></div>	    
						    <!--begin hotspot-->
						    
						      <!-- <div class="container" id="container1">-->
                               <?=$RowHead["content"]?> 
                               <!--</div>-->

						    <!--end hotspot container-->
						    
						    
						    
						    
						    
					    </div>
					    <!--cat-wrapper-->
					    <div class="clearfix"></div>
			    	</div>
			    	<!--category-list-wrapper-->
			    	
			    	
			    	
			    	
			    	
			    	<div id="category-list-wrapper2" class="other">
				    	<div id="cat-wrapper2">
				    	
				    		
				    	<div class="blockarea">	
				    		
				    		<div class="b1">
					    		<h6>CHOOSE BY CATEGORY</h6>
					    		<ul>
                                <?
								if($_SESSION['FRONT_LANG']=="EN"){
									$mid="SPCE01";
								}else{
									$mid="SPCT01";
								}
							
								$sql = "SELECT * FROM products_category ";
								$sql.= " WHERE 1=1 ";
								$sql.= " AND  menu_id='".$mid."' ";
								$sql.= " ORDER BY order_by asc";
							
									
								$Conn->query($sql);
								$ContentList = $Conn->getResult();
								$CntRecInPage = $Conn->getRowCount();
								$TotalRec= $Conn->getTotalRow();
									
									
								for ($i=0;$i<$CntRecInPage;$i++) {
									
									$Row = $ContentList[$i];
									$physical_name="./uploads/product_cate/".$Row["filepic"];
									if (!(is_file($physical_name) && file_exists($physical_name) )) {
										$physical_name="./images/photo_not_available.jpg";
									}
									?> 
								    <li>
									    <a <? if($cid==$Row["cate_id"]){ ?> class="active" <? } ?> href="category.php?cid=<?=$Row["cate_id"]?>">
										    <img src="<?=$physical_name?>">
										      <span><?=$Row["name"]?></span>
									    </a>
								    </li>
                                    <? } ?>
							
							
							    </ul>
				    		</div>
				    		<!--b1-->
				    		
				    		<div class="b2">
					    		<h6>CHOOSE BY USING TYPE</h6>
					    		<ul>
                                 	<?
									$sql = "SELECT * FROM products_type ";
									$sql.= " WHERE 1=1 ";
									$sql.= " AND  menu_id='".$mid."' ";
									$sql.= " ORDER BY order_by asc";
								
										
									$Conn->query($sql);
									$ContentList = $Conn->getResult();
									$CntRecInPage = $Conn->getRowCount();
									$TotalRec= $Conn->getTotalRow();
										
										
									for ($i=0;$i<$CntRecInPage;$i++) {
										
										$Row = $ContentList[$i];
										$physical_name="./uploads/product_type/".$Row["filepic"];
										if (!(is_file($physical_name) && file_exists($physical_name) )) {
											$physical_name="./images/photo_not_available.jpg";
										}
										?>
								    <li>
									    <a href="category.php?tid=<?=$Row["cate_id"]?>">
										  <img src="<?=$physical_name?>">
									    <span><?=$Row["name"]?></span>
									    </a>
								    </li>
                                    <? } ?>
						
							    </ul>
				    		</div>
				    		<!--b2-->
				    		
				    		<div class="clearfix"></div>
				    	</div>
				    	<!--blockarea-->
				    							    
					    </div>
					    <!--cat-wrapper-->
					    <div class="clearfix"></div>
			    	</div>
			    	<!--category-list-wrapper-->			    	
			    	
			    				    	
			    	
			    	
			    	
			    	
		    	</div>
		    	<!--innerpage-detail-wrapper-->
	    	</div>
	    	<!--innerpage-wrapper-->
	    
	    
	    
	    
	    <?php include('inc-footer.php');?>	    
	    
	    
	    
	    
	    
    </div>
    <!--wrapper-->
        
        
        
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/easing.js"></script>
    <script src="js/main.js"></script>
    
    
  <!--hotspot-->  
  <link rel="stylesheet" href="css/hotspot.css">
  <script src="js/hotspot.js"></script>
    
    
    <script>
	    $(document).ready(function(){
		    $(this).catanimate();
		    $(this).catanimate2();
		    $('#product').addClass('active');
		    
		    
		    
		    
		    $('#container1').hotSpot();
	        var _pop2 = $('#container2').hotSpot({
	            slideshow : false,
	            triggerBy : 'click',
	            autoHide : false
	        });
	
	        $('#image2').on('click', function(event) {
	            _pop2.hideCurrentPop();
	        });
		    
		    
		    
	    });
    </script>
    
    
    

    
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
