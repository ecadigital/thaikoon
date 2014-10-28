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
			    		<h1 class="title">NEWS & CSR</h1>
			    		<div class="clearfix"></div>
			    		
			    		
			    		
			    	
			    		
			    	</div>
			    	<!--titlebar-->
			    	
			    	<div class="clearfix"></div>
			    	
			    
			    	<div class="article-list-wrapper">
				    		 <ul>
                             
                             
               <?
				$page=$_REQUEST["page"];
				if($page<1) $page=1;	
				$pagesize=6;	
				
				if($_SESSION['FRONT_LANG']=="EN"){
					$meun_new="MNE01";
				}else{
					$meun_new="MNT01";
				}
					
				$sql = "SELECT * FROM article_main ";
				$sql.= " WHERE menu_id='".$meun_new."' and flag_display='Y' ";
				$sql.= " ORDER BY order_by asc";
				
			
				$Conn->query($sql);
			
				$ContentList = $Conn->getResult();
				$CntRecInPage = $Conn->getRowCount();
				$TotalRec= $Conn->getTotalRow();
				
				?>
                <?
					for ($i=0;$i<$CntRecInPage;$i++) {
						
						$Row = $ContentList[$i];
						
						$physical_name="./uploads/news/".$Row["filepic"];
						
						if (!(is_file($physical_name) && file_exists($physical_name) )) {
							$physical_name="./images/photo_not_available.jpg";
						}
						
						$content_html=$Row["content"];							
						$content_html = preg_replace("/<img[^>]+\>/i", " ", $content_html); 
						$content_html=strip_tags($content_html);
						$content_html = SystemSubString($content_html,700,'..');
						$date=date("d-m-y",strtotime($Row["createdate"]));		
						?>
                             
					    		 <li>
					    		   <div class="bl1">
					    		     <div class="plus"></div>
					    		     <a href="news-detail.php?did=<?=$Row["id"]?>"> <img src="<?=$physical_name?>"></a> </div>
					    		   <!--bl1-->
							    		 
							    		 
						    		   <div class="bl2">
								    		 <span><?=$date?></span>
								    		 <strong><a href="news-detail.php?did=<?=$Row["id"]?>"><?=$Row["name"]?></a></strong>
								    		 <p><?=$content_html?></p>
							    		 </div>
							    		 <!--bl2-->
							    		 
						    		 </a>
						    		 
						    		 <div class="clearfix"></div>
					    		 </li>
                                 
                                 <? } ?>   		 
					    		 
				    		 </ul>
	    		  </div>
			    		<!--article-list-wrapper-->
			    			    	
			    	
			    	
			    	
			    	
			    	
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
    
    
       
    <script>
	    $(document).ready(function(){
		    $(this).catanimate();
		    $('#news').addClass('active');
	    });
    </script>
    
    
    

    
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
