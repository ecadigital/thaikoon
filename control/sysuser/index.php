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
	
	$sql = "select *  from sysuser where userid = '$ModuleDataID'";
	
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



<h4 class="sub-header">ข้อมูลระบบ</h4>

<div class="control-group">
<label class="control-label request"  for="product_name">* Username</label>
<div class="controls">
<input type="text" id="input_username" name="input_username" class="input-large request " value="<?=$Row["username"]?>" >  <span class="request"> 5-30 ตัวอักษรเท่านั้น </span>
</div>
</div>

<div id="control-groupgroup-pw">

<div class="control-group <? if($ModuleAction=="AddForm"){ ?>hide<? }?>">
<label class="checkbox"><input id="flagChangePW" name="flagChangePW" class="icheckbox" value="Y" <? if($ModuleAction=="AddForm"){ ?> checked <? } ?> type="checkbox"> &nbsp; <span class="label label-info"> &nbsp; ต้องการเปลี่ยน Password &nbsp;</span></label>
</div>

<div class="control-group">
<label class="control-label request"  for="product_name">* Password</label>
<div class="controls">
<input type="password" id="input_pw" name="input_pw" <? if($ModuleAction=="EditForm"){ ?>disabled<? } ?> class="input-large request "> <span class="request">รหัสผ่าน 5-12 อักษรขึ้นไป</span>
</div>
</div>

<div class="control-group">
<label class="control-label request"  for="product_name">* Confirm Password</label>
<div class="controls">
<input type="password" id="input_pwconfirm" name="input_pwconfirm" <? if($ModuleAction=="EditForm"){ ?>disabled<? } ?>  class="input-large request "  >
</div>
</div>
</div>

<div class="control-group">
<label class="control-label request" for="product_display" >กลุ่มสิทธิการใช้งาน</label>
<div class="controls">
<select id="product_display" name="product_display" class="input-large">
<?=SystemArraySelect($source_status,$Row["flag_display"]); ?>
</select>
</div>
</div>




<h4 class="sub-header">ข้อมูลทั่วไป</h4>


<div class="control-group">
<label class="control-label request"  for="product_name">* ชื่อ</label>
<div class="controls">
<input type="text" id="input_fname" name="input_fname" class="input-large request " value="<?=$Row["firstname"]?>" >



</div>
</div>
<div class="control-group">
<label class="control-label request"  for="product_name">* นามสกุล</label>
<div class="controls">
<input type="text" id="input_lastname" name="input_lastname" class="input-large request " value="<?=$Row["lastname"]?>" >
</div>
</div>

<div class="control-group">
<label class="control-label" for="product_name">รูปภาพ</label>
<div class="controls">
			<?
          
			$ObjUFileID="OnePic";
			$ObjUFileType="onepic";
			$ObjUFileResizeType="CROP";
			$ObjUFileResizeWidth="200";
			$ObjUFileResizeHeight="200";
	
			$img="../../uploads/users/".$Row["filepic"];
			if ((is_file($img) && file_exists($img) )) {
				$ObjUFileOldPath=$img;
			}
			
			include('../obj/objUploadPic/index.php'); 
            ?>
           
            <br>
			โดยขนาดรูปที่เหมาะสมคือขนาด 200x200  px.

</div>
</div>
<div class="control-group">
<label class="control-label" for="product_display">วันเกิด</label>
<div class="controls">
<input type="text" id="input_showdate" name="input_showdate"  class="calendar" value="<?=$showDate?>">

</div>
</div>


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

<script type="text/javascript">
$(document).ready(function(){
	//$('#flagChangePW')	
	
	$('#flagChangePW').on('ifChanged', function(event){
 		if($(this).is(':checked')){	
			$("#input_pw").prop('disabled', false);
			$("#input_pwconfirm").prop('disabled', false);	
		}else{
			$('#control-groupgroup-pw .control-group').removeClass('error');
			$("#input_pw").prop('disabled', true);
			$("#input_pwconfirm").prop('disabled', true);	
		}
	});
	
	
});

</script>


<? }else if ($ModuleAction == "Sorting"){ ?>

<?

	$sql = "SELECT p.*,c.name as category_name FROM article_main p";
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
 	$physical_name="../../uploads/news/".$Row["filepic"];
	
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