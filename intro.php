<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=1400">
    <title>Thaikoon Steel Group</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/layout.css" />
    <link rel="stylesheet" href="css/jquery.parallax.css" />
    <script src="js/vendor/modernizr.js"></script>
    
    
    <style type="text/css" media="screen, projection">
		#port {
			background: none;
			margin: 0px;
			overflow: visible;
			position: relative;
			height: 350px;
			top:300px;
			width: 500px;
		}
	</style>
	
	
  </head>
  <body>
        
        <div id="intro-wrapper">
        
        
        	<div id="inner-intro">
        	
        		<img id="i1" src="images/i1.png">
        		<img id="i2" src="images/i2.png">
        		
        		<div id="s1">
	        		<img src="images/s1.png">
        		</div>
        	
		        <div id="enter-wrapper">
			        <div>
				        <a href="index.php">
					        <img src="images/enter.gif">
				        </a>
			        </div>
			        
			        		        <div>
				        <a href="index.php">
					        <img src="images/enterth.gif">
				        </a>
			        </div>
		        </div>
		        
		        
		        
		        
		        
		        
		        
		        
		        
		        
		        
		     <div id="port">
			<!-- Seven image layers, each layer slightly bigger than the one behind, making 'closer' layers move faster. -->
			<img class="ar" id="a1" src="images/sq1.png" alt="" style="width:45px; height:49px;"/>
			<img class="ar"   id="a2"  src="images/sq2.png" alt="" style="width:97px; height:104px;"/>
			<img class="ar"  id="a3"  src="images/sq3.png" alt="" style="width:97px; height:104px;"/>
						
			
		</div>
		        
		        
		        
		        
		        
		        
		        
		        
        	</div>
        	<!--inner-intro-->
	        
        </div>
        <!--intro--wrapper-->
        
        
        
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/easing.js"></script>
    <script src="js/jquery.parallax.js"></script>
    <script src="js/main.js"></script>
    
    <script>
	    $(document).ready(function(){
		    $(this).introPage();
	    });
    </script>
    
    
    <script type="text/javascript">
	
		jQuery(document).ready(function(){
			// Declare parallax on layers
			jQuery('.parallax-layer').parallax({
				mouseport: jQuery("#port")
			});
		});
	</script>
    
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
