<? require("./lib/system_core.php"); ?>
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
				    	<div id="cat-wrapper">
				    	
				    		<h5>CHOOSE BY CATEGORY</h5>
				    	
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
								    <a id="c<?=($i+1)?>" class="start" href="category.php?cid=<?=$Row["cate_id"]?>">
									    <img src="<?=$physical_name?>">
									    <span><?=$Row["name"]?></span>
								    </a>
							    </li>
                                <? } ?>
							    
							 
						    </ul>
						    
					    </div>
					    <!--cat-wrapper-->
					    <div class="clearfix"></div>
			    	</div>
			    	<!--category-list-wrapper-->
			    	
			    	
			    	
			    	
			    	
			    	<div id="category-list-wrapper2" class="use">
				    	<div id="cat-wrapper2">
				    	
				    		<h5>CHOOSE BY USING TYPE</h5>
				    	
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
								    <a id="c1<?=($i+1)?>" class="start" href="category.php?tid=<?=$Row["cate_id"]?>">
									    <img src="<?=$physical_name?>">
									    <span><?=$Row["name"]?></span>
								    </a>
							    </li>
                                <? } ?>
							
						</ul>
						    
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
    
    
    <!-- Skitter JS -->
	<script type="text/javascript" language="javascript" src="js/jquery.skitter.min.js"></script>
	<!-- Skitter Styles -->
	<link href="css/skitter.styles.css" type="text/css" media="all" rel="stylesheet" />
	<!-- Init Skitter -->
	<script type="text/javascript" language="javascript">
		$(document).ready(function() {
			$('.box_skitter_large').skitter({
				theme: 'clean',
				numbers_align: 'center',
				progressbar: false, 
				dots: false, 
				navigation:true,
				preview: false
			});
		});
	</script>
    
    <script>
	    $(document).ready(function(){
		    $(this).catanimate();
		    $(this).catanimate2();
		    $('#product').addClass('active');
	    });
    </script>
    
    
    

    
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
