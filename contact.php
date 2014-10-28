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
			    		<h1 class="title">CONTACT US</h1>
	    
	    
			    	</div>
			    	
			    	
			    	
			    	
			    	<div class="clearfix"></div>
			    	
			    	<br><br>
			    	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62043.29399010545!2d100.5343600030273!3d13.614767324880468!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2a3de26a4ef1f%3A0x151b98a497ced236!2sThai+Koon+Steel+Co.%2CLTD.!5e0!3m2!1sen!2sth!4v1411673896341" width="100%" height="300" frameborder="0" style="border:0"></iframe>
			    	
			    	<div id="contact-map">
				    	<div class="ct1">
					    	
					    	<div class="ctgroup">
						    	<h2>THAI KOON STEEL GROUP CO.,LTD.</h2>
						    	<span>299-300 Moo 9 Suksawad Rd. Bangchak Phrapradang</span>
								<span>Samutprakarn 10130 Thailand  </span>
								<span><strong>Tel :</strong> 66 2817 5252 - 61 <strong>Fax :</strong> 66 2817 6305</span>
								<span><strong>E-mail :</strong> info@thaikoon.co.th</span>
								
								
								
								
								
								
					    	</div>
					    	
					    	
					    	<div class="ctgroup">
						    	<h2>THAI KOON STEEL GROUP CO.,LTD.</h2>
						    	<span>299-300 Moo 9 Suksawad Rd. Bangchak Phrapradang</span>
								<span>Samutprakarn 10130 Thailand </span> 
								<span><strong>Tel :</strong> 66 2817 5252 - 61 <strong>Fax :</strong> 66 2817 6305</span>
								<span><strong>E-mail :</strong> info@thaikoon.co.th</span>
								
								
								
								
								
								
					    	</div>
					    	
					    	
				    	</div><!--ct1-->
				    	<div class="ct2">
					    	
					    	
					    	
					    	
	<form id="contact-form" data-abide="ajax"  >
     <input type="hidden" name="ModuleAction" value="InsertData">
  <div class="name-field">
    <label>Your name <small>required</small>
      <input id="input_name" name="input_name"  type="text" required >
    </label>
    <small class="error">Name is required and must be a string.</small>
  </div>
  <div class="email-field">
    <label>Email <small>required</small>
      <input id="input_email" name="input_email" type="email" required>
    </label>
    <small class="error">An email address is required.</small>
  </div>
  
  
  <div class="email-field">
    <label>Tel <small>required</small>
      <input  id="input_tel" name="input_tel" type="text" required>
    </label>
     <small class="error">Name is required and must be a string.</small>
  </div>
  
  <div class="message-field">
	  <label>Message
	        <textarea id="input_message" name="input_message" placeholder="Message"></textarea>
	  </label>
  </div>
  
  <button type="submit">Submit</button>
</form>
					    	
					    	
					    	
					    	
					    	
				    	</div><!--ct2-->
			    	</div>
			    	<!--contact-map-->
			    	
			    	
		    	</div>
	    </div>
	    
	    
	    
	    
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
		    $('#contact').addClass('active');
	    });
    </script>
    
    
    
    <script>
      $(document).foundation();
	  
   $(document).ready(function(){
	  $('#contact-form').on('valid.fndtn.abide', function() {
	   
		var Vars=$('#contact-form').serialize();	
	
		$.ajax({
			url : "contact-action.php",
			data : Vars,
			type : "post",
			cache : false ,
			success : function(resp){
				$('#contact-form').hide();
				 alert('Your Send Message Already.');
				 window.location=window.location;
			}
		});
		
		
	});
}); 
	
    </script>
  </body>
</html>
