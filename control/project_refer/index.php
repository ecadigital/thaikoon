<?
require("../lib/system_core.php");
include_once("function.php");
$Sys_Title=_SYSTEM_TITLE_;
$Sys_MainFile[]=array(type=>'javascript',path=>'index.js');
$Sys_MainFile[]=array(type=>'javascript',path=>'../js/ckeditor/ckeditor.js');
$Sys_MainFile[]=array(type=>'javascript',path=>'../js/ajaxupload.js');
if ($ModuleAction=="") $ModuleAction="Datalist";



$SysPMS=SystemGetPermissionText($SysMenuID);


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
	
	$sql = "select *  from project_main where id = '$ModuleDataID'";
	
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
<h4>จัดการเนื้อหา</h4>
</div>
<div class="block-content">


<h4 class="sub-header">ข้อมูลทั่วไป</h4>




<div class="control-group">
<label class="control-label" for="product_display">เปิด/ปิดการแสดงผล</label>
<div class="controls">
<select id="product_display" name="product_display" class="input-xlarge">
<?=SystemArraySelect($source_status,$Row["flag_display"]); ?>
</select>

</div>
</div>


<div class="control-group">
<label class="control-label request"  for="product_name">* Project name</label>
<div class="controls">
<input type="text" id="product_name" name="product_name" class="input-xxlarge request " value="<?=$Row["name"]?>" >
</div>
</div>

<div class="control-group">
<label class="control-label request"  for="location_name">* Location</label>
<div class="controls">
<input type="text" id="location_name" name="location_name" class="input-xxlarge request " value="<?=$Row["location"]?>" >
</div>
</div>


<div class="control-group">
<label class="control-label request"  for="description">* Description</label>
<div class="controls">
<textarea   id="description" name="description" rows="4" style="width:544px;" class="input-xxlarge request "><?=$Row["description"]?></textarea>
</div>
</div>

<div class="control-group">
<label class="control-label request"  for="project_owner">* Project Owner</label>
<div class="controls">
<input type="text" id="project_owner" name="project_owner" class="input-xxlarge request " value="<?=$Row["project_owner"]?>" >
</div>
</div>

<div class="control-group">
<label class="control-label" for="product_name">รูปภาพ</label>
<div class="controls">
			<?
          
			$ObjUFileID="OnePic";
			$ObjUFileType="onepic";
			$img="../../uploads/project_refer/".$Row["filepic"];
			if ((is_file($img) && file_exists($img) )) {
				$ObjUFileOldPath=$img;
			}
			
			include('../obj/objUploadPic/index.php'); 
            ?>
           
            <br>
			โดยขนาดรูปที่เหมาะสมคือขนาด 297x166  px.

</div>
</div>




<br>

<?

$sql = "SELECT * from project_file ";
$sql.= " WHERE project_id='".$ModuleDataID."'";
$sql.= " ORDER BY order_by ASC";
#echo $sql;

$Conn->query($sql);
$FileList = $Conn->getResult();
$CntRecFile = $Conn->getRowCount();

?>

<h4 class="sub-header">Photo Gallery</h4>
<div class="row-fluid">
<div class="span4">
<a id="btn_add_photo"  class="btn btn-primary"  data-toggle="modal" href="../obj/file-upload-prompt.php"><i class="icon-plus"></i> เพิ่มรูปภาพ</a>
</div>
<div class="span8">จำนวนภาพ <span id="area_num_photo"><?=$CntRecFile?></span> ภาพ</div>
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
		
		$physical_name=_SYSTEM_UPLOADS_FOLDER_."/project_refer/".$RowFile["physical_name"];
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


<? }else if ($ModuleAction == "Sorting"){ ?>

<?

	$sql = "SELECT p.*,c.name as category_name FROM project_main p";
	$sql.=" left join article_category c on(c.cate_id=p.cate_id) ";
	$sql.= " WHERE p.menu_id='".$SysMenuID."'";
	
	
	if (trim($SysTextSearch)!=""){
		$sql.=" AND (p.name  like '%".$SysTextSearch."%' ";
		$sql.=")";
	}
	
	if (trim($SysCateID)>0){
		$sql.=" AND (p.cate_id  = '".$SysCateID."' ";
		$sql.=")";
	}
	
	
	$sql.= " ORDER BY order_by asc ";
	
//	echo $sql;
	
	$Conn->query($sql,$Page,$PageSize);
	$ContentList = $Conn->getResult();
	$CntRecInPage = $Conn->getRowCount();
	$TotalRec= $Conn->getTotalRow();

	?>
    
  
<form id="frm" name="frm"  method="post" class="form-horizontal" onSubmit="return false;">
<input type="hidden"  name="SysModReturnURL" id="SysModReturnURL" value="<?=SystemEncryptURL("SysMenuID=$SysMenuID")?>"/>
<div class="clearfix">
<a href="index.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID")?>" class="btn" ><i class="icon-chevron-left"></i>Back</a>
<button type="submit" class="btn btn-success" onClick="mod_verifySortableCategories();"><i class="icon-ok"></i> <?=_SAVE_?></button>
<div class="line-control-header"></div>
</div>
        
        
        <div class="block block-themed block-last">
<div class="block-title">
<h4>Sort</h4>
</div>
<div class="block-content">

    <div id="sortable-area" >
    <ul class="sortable-cat">
      <?
		for ($i=0;$i<$CntRecInPage;$i++) {
	$Row = $ContentList[$i];
 	$physical_name="../../uploads/project_refer/".$Row["filepic"];
	
	if (!(is_file($physical_name) && file_exists($physical_name) )) {
		$physical_name="../img/photo_not_available.jpg";
	}
	?>
    
   <li id="<?=$Row["id"]?>" rel="<?=$Row["order_by"]?>">
            	<div class="box">
                    <div class="ft-left" >
                   <?=$Row["name"]?>
                    </div>
                    <div class="clear"></div>
                </div>
			
			</li>
   
   <? } ?>
        
    </ul>
    </div>
    <br>

    
    

</div>
</div>
   <div class="clearfix">
<div class="line-control-footer"></div>
<a href="index.php" class="btn" ><i class="icon-chevron-left"></i>Back</a>
<button type="submit" class="btn btn-success" onClick="mod_verifySortableCategories();"><i class="icon-ok"></i> <?=_SAVE_?></button>

</div>     
       </form>
        
        
        
        
        
        <style type="text/css">
ul.sortable-cat {
  list-style:none;
  padding: 0;
  margin: 0 0 0 25px;
}
ul.sortable-cat li{
	margin: 7px 0 0 0;
}
.sortable-cat li div.box {
	color: #484848;
	border: 1px solid #ebebeb;
	padding:5px 10px;
	cursor: move;
}
.sortable-cat-highlight {
	background-color: #fbf9ee;
	border:1px #fcefa1  dashed;
	display:inline-block;
	width:100%;
	height:30px;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
						   
	 $(".sortable-cat").sortable({
		 'placeholder':'sortable-cat-highlight',
		  opacity: 0.7,
		  forcePlaceholderSize: true,
		  helper:'clone',
		  cursor: 'move',
		  maxLevels: 5,
		  tolerance: 'pointer'
		});
	  $(".sortable-cat").disableSelection();
	});
</script>


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