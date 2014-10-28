<footer style="background:#222222;">
 <div style="float:right; width:100%; text-align:right; display:inline-block;">
        Developed & Design by Ecadigital
        </div>
</footer>

<script>
var webApp = function () {

	    var n = function () {
        var e = $("#primary-nav > ul > li > a");
        e.filter(function () {
            return $(this).next().is("ul")
        }).each(function (e, t) {
            $(t).append("<span>" + $(t).next("ul").children().length + "</span>")
        });
        e.click(function () {
            var e = $(this);
            if (e.next("ul").length > 0) {
                if (e.parent().hasClass("active") !== true) {
                    if (e.hasClass("open")) {
                        e.removeClass("open").next().slideUp(250)
                    } else {
                        $("#primary-nav li > a.open").removeClass("open").next().slideUp(250);
                        e.addClass("open").next().slideDown(250)
                    }
                }
                return false
            }
            return true
        })
    };
	
	  var u = function () {
		
        var e = 150;
        var t = 250;
        var n = $(".menu-link");
        var r = $(".submenu-link");
        n.each(function (e, t) {
            $(t).append("<span>" + $(t).next("ul").find("a").not(".submenu-link").length + "</span>")
        });
        r.each(function (e, t) {
            $(t).append("<span>" + $(t).next("ul").children().length + "</span>")
        });
        n.click(function () {
            var n = $(this);
			
            if (n.parent().hasClass("active") !== true) {
                if (n.hasClass("open")) {
                    n.removeClass("open").next().slideUp(e)
                } else {
                    $(".menu-link.open").removeClass("open").next().slideUp(e);
                    n.addClass("open").next().slideDown(t)
                }
            }
            return false
        });
        r.click(function () {
            var n = $(this);
			
            if (n.parent().hasClass("active") !== true) {
                if (n.hasClass("open")) {
                    n.removeClass("open").next().slideUp(e)
                } else {
                    n.closest("ul").find(".submenu-link.open").removeClass("open").next().slideUp(e);
                    n.addClass("open").next().slideDown(t)
                }
            }
            return false
        })
    };

	
    return {
        init: function () {
            //n();
			u();
			  $('[data-toggle="tooltip"], .enable-tooltip').tooltip({
            container: "body",
            animation: false
        });
        }
    }
}();

  

$(function () {
    webApp.init();
	
	$('.icheckbox').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square',
		increaseArea: '20%' // optional
	  });
	
	
	$( "#input_search" ).keypress(function( event ) {
	  if ( event.which == 13 ) {
		 event.preventDefault();
		sysListTextSearch();
	  }
	 });
	
})
</script>