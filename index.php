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
	    
	    
	    <div id="slider-wrapper">
	    
	    
		    <div class="box_skitter box_skitter_large">
					<ul>
						<li><a href="#cube"><img src="images/b1.jpg" class="cubeShow" /></a></li>
						<li><a href="#cubeRandom"><img src="images/b22.jpg" class="blind" /></a></li>
						<li><a href="#block"><img src="images/b1.jpg" class="cubeShow" /></a></li>
						<li><a href="#cubeStop"><img src="images/b22.jpg" class="paralell" /></a></li>	
					</ul>
			</div><!--box_skitter-->
			
			
			<div id="shape"></div>
			<!--shape-->
			
	    </div>
		<!--slider-wrapper-->
	    
	    
	    <div class="content-wrapper">
		    <div id="phead">
			    <h1>PRODUCTS</h1>
			    <h2>AND CUSTOMIZATION</h2>
			    <p>In publishing and graphic design, lorem ipsum is a filler text commonly </p>
		    </div>
		    <!--phead-->
		    
		    <!--<div id="cat-wrapper">
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
		    
		    
		    
		    
		    
		    
		    
		    <div id="cat-wrapper">
			    <ul>
				    <li>
					    <a id="c1" class="start" href="category1.php">
						    <img src="images/cat1.png">
						    <span>Steel Pipes and Tubes</span>
					    </a>
				    </li>
				    <li>
					    <a id="c2" class="start" href="category1.php">
						    <img src="images/cat2.png">
						    <span>Oxide Primer<br>Coated Pipe</span>
					    </a>
				    </li>
				    <li>
					    <a id="c3" class="start" href="category1.php">
						    <img src="images/cat3.png">
						    <span>Customization</span>
					    </a>
				    </li>
				    <li>
					    <a id="c4" class="start" href="category1.php">
						    <img src="images/cat1.png">
						    <span>Steel Chain and <br>Painted Slotted Angles</span>
					    </a>
				    </li>
			    </ul>
		    </div>
		    <!--cat-wrapper-->
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    
		    <div class="clearfix"></div>
		    
		    
	    </div>
	    <!--content-wrapper-->
	    
	    
	    
	    
	    <div id="twocol-wrapper">
		    <div class="innerwrap">
			    
			    <div id="homeabout">
				    <h1>ABOUT US</h1>
				    <h2>THAIKOON STEEL GROUP</h2>
				    <p>Starting literally from scratch with no capital,
technology, or experience, President Tang Buk
Kung along with 30 employees established Tang
Kung Huat Company in 1975 as such a manu
facturer and distributor for spring, steel desk.</p><br>
<div class="clearfix"></div>
<a href="history.php" class="viewmore">VIEW MORE</a>
			    </div>
			    <!--homeabout-->
			    
			    <div id="homenews">
				    <h1>NEWS & CSR</h1>
				    <h2>LATEST NEWS</h2>
                    
                    <?
					
				if($_SESSION['FRONT_LANG']=="EN"){
					$meun_new="MNE01";
				}else{
					$meun_new="MNT01";
				}
					
				$sql = "SELECT * FROM article_main ";
				$sql.= " WHERE menu_id='".$meun_new."' and flag_display='Y' ";
				$sql.= " ORDER BY createdate desc";
				
			
				$Conn->query($sql,0,2);
			
				$ContentList = $Conn->getResult();
				$CntRecInPage = $Conn->getRowCount();
				$TotalRec= $Conn->getTotalRow();
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
						$date=date("d F, Y",strtotime($Row["createdate"]));		
				?>
				    
				    <div class="block  <? if(($i+1)%2 ==0){?>last<? } ?>">
					    <a href="news-detail.php?did=<?=$Row["id"]?>" >
						    <div class="imgcap"><img src="<?=$physical_name?>"></div>
						    <div class="clearfix"></div>
						    <strong><?=$Row["name"]?></strong>
<div class="clearfix"></div>
<span><?=$date?></span>
					    </a>
				    </div>
				    <!--block-->
                    
                    <? } ?>
				    
			    </div>
			    <!--homenews-->
			    
		    </div>
		    <!--innerwrap-->
	    </div>
	    <!--twocol-wrapper-->
	    
	    
	    
	    
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
		    $('#home').addClass('active');
	    });
    </script>
    
    
    

    
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
