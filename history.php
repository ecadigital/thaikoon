<? require("./lib/system_core.php"); ?>
<?
if($_SESSION['FRONT_LANG']=="EN"){
	$parent_id="W010";
}else{
	$parent_id="W001";
}
	
if ($_GET["mid"]==""){
	$sql = "select menu_id  from sysmenu where 1=1 ";
	$sql.= " and parent_id='".$parent_id."'";
	$sql.=" order by order_by limit 0,1 ";
	
	$Conn->query($sql);
	$Content = $Conn->getResult();
	$mid=$Content[0]["menu_id"];
	
}else{
	$mid=$_GET["mid"];
}
	
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
			    		<h1 class="title">ABOUT US</h1>
			    	
                 
			    	<div id="subwrapper">
                       
                    <?
					
			
				$sql = "SELECT * FROM sysmenu ";
				$sql.= " WHERE parent_id='".$parent_id."' ";
				$sql.= " ORDER BY order_by asc";
				
			
				$Conn->query($sql);
			
				$ContentList = $Conn->getResult();
				$CntRecInPage = $Conn->getRowCount();
				$TotalRec= $Conn->getTotalRow();
					for ($i=0;$i<$CntRecInPage;$i++) {
						
						$Row = $ContentList[$i];
				?>
				    	<a id="tab_<?=$Row['menu_id']?>" <? if($Row['menu_id']==$mid){?>class="active"<? } ?> href="#"><?=$Row["name"]?></a>
                      <? } ?>
                      
                      
                      <a id="ourpartner"  href="#">PARTNERS</a>
			    	</div>
                    
                    
			    	<!--subwrapper-->
			    		
			    		
			    		
			    	</div>
			    	<!--titlebar-->
			    	
			    	<div class="clearfix"></div>
                    
                    
                    <?
				$sql = "SELECT * FROM sysmenu m";
				$sql.=" left join webpage p on(p.menu_id=m.menu_id) ";
				$sql.= " WHERE parent_id='".$parent_id."' ";
				$sql.= " ORDER BY m.order_by asc";
				
			
				$Conn->query($sql);
			
				$ContentList = $Conn->getResult();
				$CntRecInPage = $Conn->getRowCount();
				$TotalRec= $Conn->getTotalRow();
					for ($i=0;$i<$CntRecInPage;$i++) {	
						$Row = $ContentList[$i];
	
	?>
			    	
			    	
			    	<div id="ctab_<?=$Row['menu_id']?>" class="animated" <? if($Row['menu_id']!=$mid){?>style="display:none;"<? } ?>> 
			    
				     <?=$Row["content"]?>	
			    	</div><!--animted-area-->
			    	
                    <? } ?>
			    	
			 
			    	
			    	
			    	
			    	
			    	
			    	
			    	<div id="courpartner" class="animated" style="display : none">
			    	
			    	<h2 class="subtitle">K&S STEEL PIPE CO.,LTD.</h2>
			    	<div class="v1">
					    	
				    <div class="vidbg">
					    <img src="images/k&s.jpg">
				    </div>
				    <!--vidbg-->

				    </div><!--v1-->
				    	
				    	<div class="v2">
					    	<p><strong>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi</strong></p>
					    	
					    	<p>Innovative technology is the core of MSI. Due to our incessant commitment and efforts to world-level research and development, we are capable of providing innovative products for individuals and corporations. <br><br>Our clients also enjoy the high-quality solutions with economic synergies. We highly value the mutual relationship among the partner, clients and us over the long run, which also encourages us to continue </p>
				    	</div>
				    	<!--v2-->
				    	
				    	<div class="clearfix"></div>
			    	

			    	<h2 class="subtitle">THAI PREMIUM PIPE CO.,LTD.</h2>
			    	<div class="v1">
					    	
				    <div class="vidbg">
					    <img src="images/tpp.jpg">
				    </div>
				    <!--vidbg-->

				    </div><!--v1-->
				    	
				    	<div class="v2">
					    	<p><strong>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi</strong></p>
					    	
					    	<p>Innovative technology is the core of MSI. Due to our incessant commitment and efforts to world-level research and development, we are capable of providing innovative products for individuals and corporations. <br><br>Our clients also enjoy the high-quality solutions with economic synergies.</p>
				    	<div id="partnerbox">
				    		<ul>
				    			<a class="group2" href="images/tpp1.jpg"><li><img src="images/tpp1.jpg"></li></a>
				    			<a class="group2" href="images/tpp2.jpg"><li><img src="images/tpp2.jpg"></li></a>
				    			<a class="group2" href="images/tpp3.jpg"><li><img src="images/tpp3.jpg"></li></a>
				    			<a class="group2" href="images/tpp4.jpg"><li><img src="images/tpp4.jpg"></li></a>
				    		</ul>
				    	</div>
				    	</div>
				    	<!--v2-->
				    	
				    	<div class="clearfix"></div>
			    	</div><!--animted-area-->
			    	
			    	
			    	
			    	
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


    <!-- color box -->
    <link rel="stylesheet" href="css/colorbox.css" />
    <script src="js/jquery.colorbox.js"></script>
    
    <script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>





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
		    $(this).fixedmenu();
		    $('#about').addClass('active');
	    });
    </script>
    
    
    

    
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
