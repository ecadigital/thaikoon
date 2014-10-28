<?
require("../lib/system_core.php");
include_once("function.php");
$Sys_Title=_SYSTEM_TITLE_;
$Sys_MainFile[]=array(type=>'javascript',path=>'index.js');
$Sys_MainFile[]=array(type=>'javascript',path=>'../js/ckeditor/ckeditor.js');
$Sys_MainFile[]=array(type=>'javascript',path=>'../js/ajaxupload.js');
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
	
	$Row="";
	
	$Row["site_code"]=$_SESSION["SITE_CODE"];
	
	$showDate=date("d/m/Y");
	
}else{
	$lbl_tab=_Edit_." ".$_sourceMaster["name"];;
	$ModuleAction_Current="UpdateData";
	
	$sql = "select *  from webpage where id = '$ModuleDataID'";
	
	
	
	$Conn->query($sql);
	$Content = $Conn->getResult();
	$Row=$Content[0];
	
	$showDate=SystemDateFormat($Row["date_display"]);
	
	
	$content_html=$Row["content"];
	
}
?>



<form id="frm" name="frm"  method="post" class="form-horizontal" enctype="multipart/form-data" onSubmit="return false;" >

<input type="hidden"   id="SysMenuID" name="SysMenuID" value="<?=$SysMenuID?>" />
<input type="hidden" name="ModuleAction" id="ModuleAction" value="<?=$ModuleAction_Current?>" />
<input type="hidden" name="ModuleDataID" id="ModuleDataID" value="<?=stripslashes($ModuleDataID)?>" />
<input type="hidden"  name="SysModReturnURL" id="SysModReturnURL" value="<?=SystemEncryptURL("SysMenuID=$SysMenuID")?>"/>


<div class="clearfix">
<a href="index.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID&Page=$Page")?>" class="btn" ><i class="icon-chevron-left"></i>Back</a>
<button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
<button type="submit" class="btn btn-success" onClick="submitFormContent();"><i class="icon-ok"></i> <?=_SAVE_?></button>
<div class="line-control-header"></div>
</div>

<div class="block block-themed block-last">
<div class="block-title">
<h4>ข้อมูลเนื้อหา</h4>
</div>
<div class="block-content">
<h4 class="sub-header">ข้อมูลทั่วไป</h4>
<div class="control-group">
<label class="control-label request"  for="title_name">* เรื่อง</label>
<div class="controls">
<input type="text" id="title_name" name="title_name" class="input-xxlarge request " value="<?=$Row["name"]?>" >
</div>
</div>


<h4 class="sub-header">เนื้อหา</h4>
<div class="control-group">
<textarea cols="80" id="input_content" name="input_content" rows="10"><?=$content_html?></textarea>
<script>
//CKEDITOR.replace( 'input_content');

/*
CKEDITOR.stylesSet.add('my_custom_style', [
    { name: 'My Custom Block', element: 'h3', styles: { color: 'blue'} },
    { name: 'My Custom Inline', element: 'span', attributes: {'class': 'mine'} }
  ]);

	var editor=CKEDITOR.replace( 'input_content',{
    uiColor: '#9AB8F3',
    stylesSet: 'my_custom_style'
  });
*/	
var editor=CKEDITOR.replace( 'input_content');
	//alert($('iframe .cke_wysiwyg_frame').height());
	


	
</script>


</div>


<br>

<div style="clear:both;">&nbsp;</div>


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


<div id="datalist-content">
<?
include('index-action.php');
?>
</div>
<? } ?>

</div><!-- page-content -->
<? require("../inc/inc-web-footer.php");?>
</div><!-- inner-container -->
</div>
</body></html>