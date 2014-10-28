<?
require("../lib/system_core.php");
$Sys_Title=_SYSTEM_TITLE_;
$Sys_MainFile[]=array(type=>'javascript',path=>'index.js');
$Sys_MainFile[]=array(type=>'javascript',path=>'../js/ckeditor/ckeditor.js');
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

<? if ($ModuleAction == "AddForm" || $ModuleAction == "EditForm") { ?>

<?
if($ModuleAction == "AddForm"){
	$lbl_tab=_Add_." ".$_sourceMaster["name"];
	$ModuleAction_Current="InsertNewData";
	$v_status=1;
	
	$Row["site_code"]=$_SESSION["SITE_CODE"];
	
}else{
	$lbl_tab=_Edit_." ".$_sourceMaster["name"];;
	$ModuleAction_Current="UpdateData";
	
	$sql = "select *  from webpage where menu_id = '$SysMenuID'";
	
	$Conn->query($sql);
	$Content = $Conn->getResult();
	$Row=$Content[0];
	
	$content_html=$Row["content"];
	
}
?>

<form id="frm" name="frm"  method="post" class="form-horizontal" onSubmit="return false;">
<input type="hidden"   id="SysMenuID" name="SysMenuID" value="<?=$SysMenuID?>" />
<input type="hidden" name="ModuleAction" id="ModuleAction" value="<?=$ModuleAction_Current?>" />
<input type="hidden" name="ModuleDataID" id="ModuleDataID" value="<?=stripslashes($ModuleDataID)?>" />
<input type="hidden"  name="SysModReturnURL" id="SysModReturnURL" value="<?=SystemGetReturnURL()?>"/>
<div class="clearfix">
<a href="index.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID")?>" class="btn" ><i class="icon-chevron-left"></i>Back</a>
<button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
<button type="submit" class="btn btn-success" onClick="submitFormContent();"><i class="icon-ok"></i> <?=_SAVE_?></button>
<div class="line-control-header"></div>
</div>



<div class="block block-themed block-last">
<div class="block-title">
<h4><?=_Store_Product_AddNew_?></h4>
</div>
<div class="block-content">








<h4 class="sub-header">เนื้อหา</h4>
<div class="control-group"  >

<textarea cols="80" id="input_content" name="input_content" rows="10"><?=$content_html?></textarea>
<script>

//CKEDITOR.replace( 'input_content');

	
var editor=CKEDITOR.replace( 'input_content');
	editor.config.filebrowserBrowseUrl = '../obj/editor-link.php?SysMenuID=<?=$SysMenuID?>';
	editor.config.filebrowserUploadUrl = '../obj/editor-link.php?SysMenuID=<?=$SysMenuID?>';
</script>

<script type="text/javascript">
/*
   
   var editor = CKEDITOR.replace("input_content", { 
      on : {
         'instanceReady' : function( evt ) {
            evt.editor.resize("100%", 700);
         }
      }
   });
   */
</script>

</div>
<!--
<h4 class="sub-header">ข้อมูลทั่วไปของสินค้า</h4>
<div class="control-group">
<label class="control-label" for="product_name">ชื่อสินค้า</label>
<div class="controls">
<input type="text" id="product_name" name="product_name" value="<?=$Row["name"]?>" >
</div>
</div>
-->

</div>
</div>


<div class="clearfix">
<div class="line-control-footer"></div>
<a href="index.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID")?>" class="btn" ><i class="icon-chevron-left"></i>Back</a>
<button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
<button type="submit" class="btn btn-success" onClick="submitFormContent();"><i class="icon-ok"></i> <?=_SAVE_?></button>

</div>

</form>

<? }else{ ?>

<div class="clearfix">
<a href="index.php?<?=SystemEncryptURL("ModuleAction=EditForm&SysMenuID=$SysMenuID")?>" class="btn btn-success" ><i class="icon-plus"></i> Edit</a>
<div class="line-control-header"></div>
</div>
<div id="content_html" style="min-height:300px; margin-top:10px; display:none;">

</div>
<iframe id="iframe" src="content.php?SysMenuID=<?=$SysMenuID?>" width="100%" height="600" scrolling="yes" frameborder="0"></iframe>


<script>





$(document).ready(function () {
  
     //   $('#content_html').append('<link rel="stylesheet" href="../../css/main.css" type="text/css" />');
		//$("#content_html").loadCSS( "../../css/main.css" );
		
	
  
});
</script>
<div style="clear:both"></div>
<div class="clearfix">
<div class="line-control-footer"></div>
<a href="index.php?<?=SystemEncryptURL("ModuleAction=EditForm&SysMenuID=$SysMenuID")?>" class="btn btn-success" ><i class="icon-plus"></i> Edit</a>

</div>

<? } ?>

</div><!-- page-content -->
<script type="text/javascript">


</script>
<? require("../inc/inc-web-footer.php");?>
</div><!-- inner-container -->
</div>
</body></html>