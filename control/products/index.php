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

<ul class="nav nav-tabs menu-top-inner">
<li class="active"><a href="../products/index.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID")?>" >รายการสินค้า</a></li>
<li class=""><a href="../products/category.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID")?>" >ชนิดสินค้า</a></li>
<li class=""><a href="../product_type/category.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID")?>" >ประเภทการใช้งาน</a></li>

</ul>



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
	
	$sql = "select *  from products_main where id = '$ModuleDataID'";
	
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
<h4><?=_Store_Product_AddNew_?></h4>
</div>
<div class="block-content">


<h4 class="sub-header">ข้อมูลทั่วไปของสินค้า</h4>

<div class="control-group">
    <label class="control-label" for="product_display">เปิด/ปิดการแสดงผล</label>
    <div class="controls">
    <select id="product_display" name="product_display" class="input-xlarge">
    <?=SystemArraySelect($source_status,$Row["flag_display"]); ?>
    </select>
    </div>
</div>

<div class="control-group">
<label class="control-label" for="cate_id">ชนิดสินค้า</label>
<div class="controls">
<select  id="cate_id"  name="cate_id" class="input-xlarge" required>
<option value="0" data-level="0" >-</option>
<? my_loadTreeCatSelect(0,$Row["cate_id"]); ?>
</select>

</div>
</div>


<div class="control-group">
<label class="control-label" for="type_id">ประเภทการใช้งาน</label>
<div class="controls">
<select id="type_id" name="type_id" class="input-xlarge" required>
<option value="0" data-level="0" >-</option>
<? my_loadTreeTypeSelect(0,$Row["type_id"]); ?>
</select>

</div>
</div>



<div class="control-group">
<label class="control-label request"  for="product_name">* ชื่อสินค้า</label>
<div class="controls">
<input type="text" id="product_name" name="product_name" class="input-xxlarge request " value="<?=$Row["name"]?>" >
</div>
</div>


<div class="control-group">
<label class="control-label" for="brand_id">Brand</label>
<div class="controls">
<select   id="brand_id" name="brand_id" class="input-xlarge" required>
<option value="0" data-level="0" >-</option>
<? SystemGetSqlSelect('products_brand','id','name',$Row["brand_id"]); ?>
</select>

</div>
</div>



<div class="control-group">
<label class="control-label" for="product_name">รูปภาพ</label>
<div class="controls">
			<?
           
			$ObjUFileID="OnePic";
			$ObjUFileType="onepic";
			$img="../../uploads/products/".$Row["filepic"];
			if ((is_file($img) && file_exists($img) )) {
				$ObjUFileOldPath=$img;
			}
			
			include('../obj/objUploadPic/index.php'); 
            ?>
           
            <br>
			โดยขนาดรูปที่เหมาะสมคือขนาด ###x### px.

</div>
</div>

<div class="control-group">
<label class="control-label" for="product_display">File Video </label>
<div class="controls">

<?

$flag_media= $Row["flag_media"];

if($flag_media==""){
	$flag_media="UPLOADFILE";
}


?>
<input type="hidden" id="input_flag_media" name="input_flag_media" value="<?=$flag_media?>" >
<ul class="nav nav-tabs" id="#myTab">
	<li class="active" ><a href="#home" id="UPLOADFILE" data-toggle="tab">Upload FIle Video</a></li>
	<li><a href="#profile" id="EMBED"  data-toggle="tab">Embed code</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane active" id="home">
  <a href="#" class="btn btn-primary" style="display:<? if( $Row["filemedia_physical"] !="" ){ ?>none; <? } ?>" id="btnUPLOADFILE">Browes FIle Video</a>
  <div id="area_uploading" class="progress progress-striped active" style="width:200px; display:none;">
  <div class="bar" style="width: 80%;">Uploading</div> </div>
  
  <div id="area_box_file" style="display:<? if($Row["filemedia_physical"] =="" ){ ?>none;<? } ?>"><span class="label label-warning">
  <i class="icon-film"></i> <span id="area_filename"><?=$Row["filemedia_name"]?> (<?=SystemSizeFilter($Row["filemedia_size"])?>)</span>  <i></i> 
 
  </span>
   <a _id="15" href="javascript:removeFileMedia()" data-toggle="tooltip" title="" class="btn btn-mini btn-danger btn-del" data-original-title="Delete"><i class="icon-remove"></i></a>
  </div> 
  
  <input type="hidden" id="input_fileid_media" name="input_fileid_media" >
  
   <input type="hidden" id="input_file_media_old" name="input_file_media_old" value="<?=$Row["filemedia_physical"]?>" >
  
  </div>
  <div class="tab-pane" id="profile">
  	<textarea id="input_embed_code"  name="input_embed_code" class="input-xxlarge" rows="4" ><?=$Row["embed_code"]?></textarea>
  </div>

</div>
 
<script>




$('a[data-toggle="tab"]').on('shown', function (e) {
  e.target // activated tab
  e.relatedTarget // previous tab

 $('#input_flag_media').val($(this).attr('id'));
})


function removeFileMedia(){
		
	 if (confirm('Delete?')) {
		 
		 
	$('#btnUPLOADFILE').show();
	$('#area_box_file').hide();
	
	$('#input_fileid_media').val('');
	$('#input_file_media_old').val('');
		/* 
		var Vars="ModuleAction=DeleteData&id="+$(this).attr('_id');
		$.ajax({
			url : "index-action.php",
			data : Vars,
			type : "post",
			cache : false ,
			success : function(resp){
				window.location=window.location;
			}
		});
		*/
	 }	
	
}


</script>

  <script type="text/javascript">

	$(document).ready(function(){
	
		$('#<?=$flag_media?>').tab('show');						   
							   

		new AjaxUpload('btnUPLOADFILE', {
            action: '../obj/objUploadMedia/upload.php?mod=<?=$ObjAttachFileMod?>',
			onSubmit : function(file , ext){
				
				if(ext=="mp4"){	
					$('#btnUPLOADFILE').hide();
					$('#area_uploading').show();
				}else{
					alert('เฉพาะไฟล์นามสกุล mp4');
					return false;	
				}
				
				},
			onComplete : function(file,data){
			
				
				var obj = jQuery.parseJSON(data);
				
				$('#area_uploading').hide();
				$('#area_box_file').show();
				$('#area_filename').html(obj.file_name+' ('+obj.file_size+')');
				
				$('#input_fileid_media').val(obj.file_id);
				
				//$('#input<?=$ObjAttachFile_ID?><?=$index?>').val(data);
				
				//$('#<?=$ObjAttachFile_ID?>_filename<?=$index?>').html(file);
				
			}		
		});
		
	  	  
	});
                                
   </script>
   

</div>
</div>

<h4 class="sub-header">เนื้อหา</h4>


<div class="control-group"  >

<textarea cols="80" id="input_content" name="input_content" rows="10"><?=$content_html?></textarea>
<script>

//CKEDITOR.replace( 'input_content');
var editor=CKEDITOR.replace( 'input_content');

</script>



</div>


<br>

<?

$sql = "SELECT * from products_file ";
$sql.= " WHERE product_id='".$ModuleDataID."'";
$sql.= " AND mod_type='PHOTO'";
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
		
		$physical_name=_SYSTEM_UPLOADS_FOLDER_."/products/".$RowFile["physical_name"];
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
<?
$sql = "SELECT * from products_file ";
$sql.= " WHERE product_id='".$ModuleDataID."'";
$sql.= " AND mod_type='FILE'";
$sql.= " ORDER BY order_by ASC";
#echo $sql;

$Conn->query($sql);
$FileList = $Conn->getResult();
$CntRecFile = $Conn->getRowCount();

?>
<h4 class="sub-header">Files Download</h4>
<div class="row-fluid">
<div class="span4">
<a id="btn_add_file"  class="btn btn-primary"  data-toggle="modal" href="../obj/file-upload-prompt.php?ObjUFileID=xxxx&ObjUFileType=filedownload"> &nbsp; <i class="icon-plus"></i> เพิ่มไฟล์ &nbsp; </a>
</div>
<div class="span8">จำนวนไฟล์ <span id="area_num_file"><?=$CntRecFile?></span> ไฟล์</div>
</div>
<br>
<script>
$(document).ready(function(){					 
$("#area_select_file").sortable({'placeholder':'sortable-file-highlight'});
$("#area_select_file").disableSelection();
});
</script>
<div class="row-fluid">
<ul id="area_select_file">
<?
	$_file_old_id="";

	for ($i=0;$i<$CntRecFile;$i++) {
		$RowFile = $FileList[$i];
		
		$physical_name=_SYSTEM_UPLOADS_FOLDER_."/products/".$RowFile["physical_name"];
		$filesize=SystemSizeFilter($RowFile["file_size"]);
		$_file_old_id.=$RowFile["id"]."-";
		?>
         
        <li class="boxli_file_all" id="P<?=$RowFile["id"]?>" >
        <div>
        
        <div class="file-name"  ><a href="../download-file/index.php?<?=SystemEncryptURL("ModuleAction=OneFiles&SysModType=PRODUCT&DID=".$RowFile["id"])?>"><?=$RowFile["file_name"]?></a></div>
        <div style="float:left; width:48px;"  class="btn btn-danger delete" onClick="library_remove_file(this);">นำออก</div>
        
       
        
      </div>
        </li>
           
        
        <?
	}
?>

</ul>
</div>
<input type="hidden" name="inputFileAllID" id="inputFileAllID" >
<input type="hidden" name="inputFileAllOldID" id="inputFileAllOldID" value="<?=$_file_old_id?>" >
 <br>
   <div style="clear:both;"></div>
<?
$sql = "SELECT pj.* from products_projectrefer ppf";
$sql.=" left join project_main pj on(pj.id=ppf.project_id) ";
$sql.= " WHERE ppf.product_id='".$ModuleDataID."'";
$sql.= " ORDER BY ppf.order_by ASC";
#echo $sql;

$Conn->query($sql);
$FileList = $Conn->getResult();
$CntRecFile = $Conn->getRowCount();

?>
<h4 class="sub-header">Project reference </h4>
<div class="row-fluid">
<div class="span4">
<a id="btn_insert_project"  class="btn btn-primary"  data-toggle="modal" href="../obj/project-prompt.php?<?=SystemEncryptURL("ModuleAction=AddForm")?>"> &nbsp; <i class="icon-plus"></i> Insert Project reference &nbsp; </a>
</div>
<div class="span8">จำนวน <span id="area_num_project"><?=$CntRecFile?></span> Project</div>
</div>
<br>
<script>
$(document).ready(function(){					 
$("#area_select_project").sortable({'placeholder':'sortable-projectrefer-highlight'});
$("#area_select_project").disableSelection();
});
</script>

<div class="row-fluid">
<ul id="area_select_project">
<?
	$_file_old_id="";
	
	if($_SESSION["LANG"]=="TH"){
		$_mid_pj="SPJT01";
	}else{
		$_mid_pj="SPJE01";
	}

	for ($i=0;$i<$CntRecFile;$i++) {
		$RowPJ = $FileList[$i];
		$_file_old_id.=$RowPJ["id"]."-";
		?>
         
        <li class="boxli_project_refer" id="P<?=$RowPJ["id"]?>" >
        <div>
        
        <div class="file-name"  ><a target="_blank" href="../project_refer/?<?=SystemEncryptURL("SysMenuID=$_mid_pj&ModuleAction=EditForm&ModuleDataID=".$RowPJ["id"])?>"><?=$RowPJ["name"]?></a></div>
        <div style="float:left; width:48px;"  class="btn btn-danger delete" onClick="library_remove_project(this);">นำออก</div>
        
       
        
      </div>
        </li>
           
        
        <?
	}
?>

</ul>
</div>
<input type="hidden" name="inputProjectReferID" id="inputProjectReferID" >
<input type="hidden" name="inputProjectReferOldID" id="inputProjectReferOldID" value="<?=$_file_old_id?>" >
<br>
<br>
<br>
<br>
<br>
<br>
<br>



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