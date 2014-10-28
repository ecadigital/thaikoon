
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="description" content="a jquery hotspot with auto delay slideshow">
  <meta name="keywords" content="jquery, hotspot, slideshow">
  <meta name="author" content="sike">

  <title>jQuery Hotspot Plugin with Slideshow</title>
  <link rel="stylesheet" href="css/hotspot.css">
  <script src="js/vendor/jquery.js"></script>
  <script src="js/vendor/modernizr.js"></script>
  <script src="js/hotspot.js"></script>

  <script>
    jQuery(document).ready(function($) {
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
</head>
<body>

<div class="container" id="container1">
  <h2>Example with auto delay slideshow, paused when hover</h2>
  <div class="popover right pop1" data-easein="cardInRight" data-easeout="cardOutRight" id="pop1">
    <div class="arrow"></div>
    <div class="popover-inner">
      <h3 class="popover-title">Embed a image as youu like</h3>
      <div class="popover-content">
        <img src="https://0.s3.envato.com/files/52772426/img/flower_small.jpg" alt="small" />
        <p>HTML content here. Change the position and size via CSS.</p>
        <p><a href="http://codecanyon.net/user/sike/portfolio">Visit my portfolio</a></p>
      </div>
    </div>
  </div>

 <div class="popover top pop2" data-easein="cardInTop" data-easeout="cardOutTop" id="pop2">
    <div class="arrow"></div>
    <div class="popover-inner">
      <h3 class="popover-title"><a href="http://codecanyon.net/user/sike">Visit my profile</a></h3>
      <div class="popover-content">
        <p>Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
      </div>
    </div>
  </div>

  <div class="popover left pop3" data-easein="cardInLeft" data-easeout="cardOutLeft" id="pop3">
    <div class="arrow"></div>
    <div class="popover-inner">
      <h3 class="popover-title">Popover title</h3>
      <div class="popover-content">
        <p>Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
      </div>
    </div>
  </div>

  <div class="popover bottom pop4" data-easein="cardInBottom" data-easeout="cardOutBottom" id="pop4">
    <div class="arrow"></div>
    <div class="popover-inner">
      <h3 class="popover-title">Yet another title</h3>
      <div class="popover-content">
        <p>Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
      </div>
    </div>
  </div>

  <img src="https://0.s3.envato.com/files/52772426/img/arrow1.png" alt="info" class="info-icon info-icon1" data-target="pop1"  />
  <img src="https://0.s3.envato.com/files/52772426/img/arrow1.png" alt="info" class="info-icon info-icon2" data-target="pop2"  />
  <img src="https://0.s3.envato.com/files/52772426/img/arrow1.png" alt="info" class="info-icon info-icon3" data-target="pop3"  />
  <img src="https://0.s3.envato.com/files/52772426/img/arrow1.png" alt="info" class="info-icon info-icon4" data-target="pop4"  />
  <img src="https://0.s3.envato.com/files/52772426/img/flower.jpg" alt="" class="largeimage">

</div>


<div class="container" id="container2">
  <h2>Trigger when user click, auto hidden feature is disabled, click the image to close the popover.</h2>
  <div class="popover top" data-easein="cardInTop" data-easeout="cardOutTop" id="pop5">
    <div class="arrow"></div>
    <div class="popover-inner">
      <h3 class="popover-title">Click outside to close</h3>
      <div class="popover-content">
        <p>Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
      </div>
    </div>
  </div>

 <div class="popover right" data-easein="cardInRight" data-easeout="cardOutRight" id="pop6">
    <div class="arrow"></div>
    <div class="popover-inner">
      <h3 class="popover-title"><a href="http://codecanyon.net/user/sike">Visit my profile</a></h3>
      <div class="popover-content">
        <p>Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
      </div>
    </div>
  </div>

  <div class="popover left" data-easein="cardInLeft" data-easeout="cardOutLeft" id="pop7">
    <div class="arrow"></div>
    <div class="popover-inner">
      <h3 class="popover-title">Just another title</h3>
      <div class="popover-content">
        <p>Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
      </div>
    </div>
  </div>

  <div class="popover bottom" data-easein="cardInBottom" data-easeout="cardOutBottom" id="pop8">
    <div class="arrow"></div>
    <div class="popover-inner">
      <div class="popover-content">
        <p>Without title. And click the image to close the popover. Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
      </div>
    </div>
  </div>

  <img src="https://0.s3.envato.com/files/52772426/img/arrow1.png" alt="info" class="info-icon info-icon1" data-target="pop5"  />
  <img src="https://0.s3.envato.com/files/52772426/img/arrow1.png" alt="info" class="info-icon info-icon2" data-target="pop6"  />
  <img src="https://0.s3.envato.com/files/52772426/img/arrow1.png" alt="info" class="info-icon info-icon3" data-target="pop7"  />
  <img src="https://0.s3.envato.com/files/52772426/img/arrow1.png" alt="info" class="info-icon info-icon4" data-target="pop8"  />
  <img src="https://0.s3.envato.com/files/52772426/img/moo06.jpg" alt="" class="largeimage" id="image2">
</div>

</body>
</html>
