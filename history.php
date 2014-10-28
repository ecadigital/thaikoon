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
			    	
			 
			    	
			    	
			    	
			    	
			    	
			    	
			    	<div id="courpartner" class="animated">
			    	
			    	<h2 class="subtitle">sadsads</h2>
			    	<div class="v1">
					    	
				    <div class="vidbg">
					    <iframe width="560" height="315" src="//www.youtube.com/embed/6qjOs7ovYkM" frameborder="0" allowfullscreen></iframe>
				    </div>
				    <!--vidbg-->

				    </div><!--v1-->
				    	
				    	<div class="v2">
					    	<p><strong>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi</strong></p>
					    	
					    	<p>Innovative technology is the core of MSI. Due to our incessant commitment and efforts to world-level research and development, we are capable of providing innovative products for individuals and corporations. <br><br>Our clients also enjoy the high-quality solutions with economic synergies. We highly value the mutual relationship among the partner, clients and us over the long run, which also encourages us to continue </p>
				    	</div>
				    	<!--v2-->
				    	
				    	<div class="clearfix"></div>
			    	
			    	<h2 class="subtitle">COMPANY HISTORY</h2>
				    	<p>Starting literally from scratch with no capital, technology, or experience, President  Tang Buk Kung along with 30 employees established Tang  Kung Huat Company
in 1975 as such a manufacturer and distributor for spring, steel desk and cabinet, steel chain and painted slotted angle</p>

						<img src="images/about_03.gif">	
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
