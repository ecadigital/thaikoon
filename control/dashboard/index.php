<?
require("../lib/system_core.php");
$Sys_Title=_SYSTEM_TITLE_;
$Sys_MainFile[]=array(type=>'javascript',path=>'index.js');
if ($ModuleAction=="") $ModuleAction="Datalist";
?>
<? require("../inc/inc-mainfile.php");?>
<body >
<div id="page-container">
<? require("../inc/inc-web-head.php");?>
<div id="inner-container"  >
<? require("../inc/inc-web-menu.php");?>
<div style="min-height: 726px;" id="page-content"  >
<? require("../inc/inc-web-navigator.php");?>


<div id="datalist-content">

<h1 style="margin:0 auto; text-align:center; margin-top:100px;"> Web Management System. </h1>

</div>


</div><!-- page-content -->
<? require("../inc/inc-web-footer.php");?>
</div><!-- inner-container -->
</div>
</body></html>