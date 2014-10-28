<?
require("../lib/system_core.php");
include_once("function.php");
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
	
	$sql = "select *  from store_main where id = '$ModuleDataID'";
	
	$Conn->query($sql);
	$Content = $Conn->getResult();
	$Row=$Content[0];
	
	
	
}
?>


<form id="frm" name="frm"  method="post" class="form-horizontal" onSubmit="return false;">
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
<h4><?=_Store_Product_AddNew_?></h4>
</div>
<div class="block-content">


<h4 class="sub-header">ข้อมูลทั่วไปของสินค้า</h4>
<div class="control-group">
<label class="control-label" for="general-text">หมวดหมู่สินค้า</label>
<div class="controls">
<select id="general-text" name="cate_id" required>
<option value="0" data-level="0" >-</option>
<? my_loadTreeCatSelect(0,$Row["cate_id"]); ?>
</select>

</div>
</div>



<div class="control-group">
<label class="control-label" for="product_display">เปิด/ปิดการแสดงผล</label>
<div class="controls">
<select id="product_display" name="product_display">
<?=SystemArraySelect($source_status,$Row["flag_display"]); ?>
</select>

</div>
</div>


<div class="control-group">
<label class="control-label" for="product_name">ชื่อสินค้า</label>
<div class="controls">
<input type="text" id="product_name" name="product_name" value="<?=$Row["name"]?>" >
</div>
</div>



<div class="control-group">
<label class="control-label" for="description">Textarea</label>
<div class="controls">
<textarea id="description" name="description" class="textarea-medium" rows="6"><?=$Row["description"]?></textarea>
</div>
</div>

<?


$statusRecommend=$Row["flag_recommend"];
$statusBestseller=$Row["flag_bestseller"];
	
?>


<h4 class="sub-header">สถานะสินค้า</h4>


<div class="row-fluid" style="margin-left:40px;">
<div class="span3">
<label class="checkbox">
  <input class="icheckbox" id="statusRecommend" name="statusRecommend" type="checkbox" value="1" <? if($statusRecommend){?>checked<? } ?> > &nbsp; สินค้าแนะนำ
</label>
</div>
<div class="span6">
<label class="checkbox">
  <input class="icheckbox" id="statusBestseller" name="statusBestseller" type="checkbox" value="1" <? if($statusBestseller){?>checked<? } ?> > &nbsp; สินค้าขายดี
</label>
</div>




</div>
<br>

<?

$sql = "SELECT * from store_file ";
$sql.= " WHERE store_id='".$ModuleDataID."'";
$sql.= " ORDER BY order_by ASC";
#echo $sql;

$Conn->query($sql);
$FileList = $Conn->getResult();
$CntRecFile = $Conn->getRowCount();

?>

<h4 class="sub-header">ภาพสินค้า</h4>
<div class="row-fluid">
<div class="span4">
<a id="btn_add_photo"  class="btn btn-primary"  data-toggle="modal" href="../obj/file-upload-prompt.php"><i class="icon-plus"></i> เพิ่มภาพสินค้า</a>
</div>
<div class="span8">จำนวนภาพสินค้า <span id="area_num_photo"><?=$CntRecFile?></span> ภาพ</div>
</div>
<br>

<script>
$(document).ready(function(){					 
$("#area_select_photo").sortable({'placeholder':'sortable-cat-highlight'});
$("#area_select_photo").disableSelection();
});
</script>
<div class="row-fluid">
<ul id="area_select_photo">
<?
	$_file_old_id="";

	for ($i=0;$i<$CntRecFile;$i++) {
		$RowFile = $FileList[$i];
		
		$physical_name=_SYSTEM_UPLOADS_FOLDER_."/store/".$RowFile["physical_name"];
		$filesize=SystemSizeFilter($RowFile["file_size"]);
		$_file_old_id.=$RowFile["id"]."-";
		?>
        
        <li class="boxli_file_photo" id="P<?=$RowFile["id"]?>" >
        <div class="file_photo_desc">
        <div class="delete" onClick="library_remove_photo(this);">นำออก</div>
          <div class="view ">
          <a  class="btn_photo_view"  data-toggle="modal" href="../library/index-action.php?<?=SystemEncryptURL("ModuleAction=showPhoto&file_id=P".$RowFile["id"])?>"> ดูภาพขยาย </a>
          </div>
        </div>
         <img  alt="<?=$Row["file_name"]?>" src="<?=$physical_name?>" >
        </li>
        
        <?
	}
?>

</ul>
</div>
<input type="hidden" name="inputPhotoFileID" id="inputPhotoFileID" >
<input type="hidden" name="inputPhotoOldFileID" id="inputPhotoOldFileID" value="<?=$_file_old_id?>" >
 
<br>
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