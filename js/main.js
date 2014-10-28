$(document).ready(function(){
	
	// intro //
	$.fn.introPage = function () {
			$('#s1').delay(400).fadeIn({queue: false, duration: 800,complete:function(){	
				$('#i1').fadeIn({queue: false, duration: 'medium'});
		    	$('#i1').animate({ right: "156px" },{duration:'medium',easing:'swing',
			    	complete:function(){
				    	$('#i2').fadeIn({queue: false, duration: 'medium'});
			        	$('#i2').animate({ right: "50px" }, {duration:1000,easing:'swing'});
			    	}
		    	});
			}});    	
    };
    
    
    // home category animate //
	$.fn.catanimate = function () {
			
			
			$('#c1')
			  .delay(200)
			  .queue( function(next){ 
			    $(this).css('display','block').removeClass('start'); 
			    next(); 
			});
			
			$('#c2')
			  .delay(300)
			  .queue( function(next){ 
			    $(this).css('display','block').removeClass('start'); 
			    next(); 
			});
			
			$('#c3')
			  .delay(400)
			  .queue( function(next){ 
			    $(this).css('display','block').removeClass('start'); 
			    next(); 
			});
			
			$('#c4')
			  .delay(500)
			  .queue( function(next){ 
			    $(this).css('display','block').removeClass('start'); 
			    next(); 
			});
		
    };
    
    
    
    
    
    
    // home category2 animate //
	$.fn.catanimate2 = function () {
			
			
			$('#c11')
			  .delay(600)
			  .queue( function(next){ 
			    $(this).css('display','block').removeClass('start'); 
			    next(); 
			});
			
			$('#c12')
			  .delay(700)
			  .queue( function(next){ 
			    $(this).css('display','block').removeClass('start'); 
			    next(); 
			});
			
			$('#c13')
			  .delay(800)
			  .queue( function(next){ 
			    $(this).css('display','block').removeClass('start'); 
			    next(); 
			});
			
			$('#c14')
			  .delay(500)
			  .queue( function(next){ 
			    $(this).css('display','block').removeClass('start'); 
			    next(); 
			});
		
    };
	
	
	
	
	
	
	
	// fixed menu //
	// intro //
	$.fn.fixedmenu = function () {
			$(function(){
			
					$('#titlebar a').click(function(e){
						e.preventDefault();
						var curid = $(this).attr('id');
						//alert(curid);
						$('#titlebar a').removeClass('active');
						$(this).addClass('active');
						$('.animated').fadeOut(100);
						$('#c'+curid).fadeIn(400,function(){
							
							$('html, body').animate({
		                        scrollTop: $("#innerpage-detail-wrapper").offset().top
		                    }, 1000);
							
						});
					});
			
			
				    $(window).bind("scroll.alert", function() {
				        var $this = $(this);
				        if ($this.scrollTop() >= 600) {
				            $('#titlebar').addClass('fixed');
				            $('#titlebar').animate({top:0},'slow')
				        }
				    });
			    });
			    
			    $(function(){
				    $(window).bind("scroll.alert", function() {
				        var $this = $(this);
				        if ($this.scrollTop() < 600) {
				            $('#titlebar').removeClass('fixed');
				        }
				    });
			    });
			        	
    };
			    
	
	
	
	
	
});