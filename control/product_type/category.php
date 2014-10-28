<?
require("../lib/system_core.php");
include_once("function.php");
$Sys_Title=_SYSTEM_TITLE_;
$Sys_MainFile[]=array(type=>'javascript',path=>'category.js');
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

<ul class="nav nav-tabs  menu-top-inner">
<li><a href="../products/category.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID")?>" >ชนิดสินค้า</a></li>
<li  class="active"><a href="../product_type/category.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID")?>" >ประเภทการใช้งาน</a></li>
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
	
	$sql = "select *  from products_type where cate_id = '$ModuleDataID'";
	
	$Conn->query($sql);
	$Content = $Conn->getResult();
	$Row=$Content[0];

	
	$content_html=$Row["content"];
	
}
?>



<form id="frm" name="frm"  method="post" class="form-horizontal" enctype="multipart/form-data" onSubmit="return false;" >

<input type="hidden"   id="SysMenuID" name="SysMenuID" value="<?=$SysMenuID?>" />
<input type="hidden" name="ModuleAction" id="ModuleAction" value="<?=$ModuleAction_Current?>" />
<input type="hidden" name="ModuleDataID" id="ModuleDataID" value="<?=stripslashes($ModuleDataID)?>" />
<input type="hidden"  name="SysModReturnURL" id="SysModReturnURL" value="<?=SystemEncryptURL("SysMenuID=$SysMenuID")?>"/>


<div class="clearfix">
<a href="category.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID&Page=$Page")?>" class="btn" ><i class="icon-chevron-left"></i>Back</a>
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
<label class="control-label" for="category_name">Category name</label>
<div class="controls">
<input type="text" id="category_name" name="category_name" class="request" value="<?=$Row["name"]?>" required>
<span class="help-block">Category name..</span>
</div>
</div>

<div class="control-group">
<label class="control-label" for="parent_id">Parent id</label>
<div class="controls">
<select id="parent_id" name="parent_id"  >
<option value="0" data-level="0" >-</option>
<? my_loadTreeCatSelect(0,$Row["parent_id"]); ?>
</select>      


<span class="help-block">Category name..</span>
</div>
</div>
<div class="control-group">
<label class="control-label" for="product_name">รูปภาพ</label>
<div class="controls">
			<?
          
			$ObjUFileID="OnePic";
			$ObjUFileType="onepic";
			$img="../../uploads/product_type/".$Row["filepic"];
			if ((is_file($img) && file_exists($img) )) {
				$ObjUFileOldPath=$img;
			}
			
			include('../obj/objUploadPic/index.php'); 
            ?>
           
            <br>
			โดยขนาดรูปที่เหมาะสมคือขนาด 297x166  px.

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


<div style="clear:both;">&nbsp;</div>
</div>
</div>

<div class="clearfix">
<div class="line-control-footer"></div>
<a href="category.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID")?>" class="btn" ><i class="icon-chevron-left"></i>Back</a>
<button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
<button type="submit" class="btn btn-success" onClick="submitFormContent();"><i class="icon-ok"></i> <?=_SAVE_?></button>

</div>
</form>


<?  }else if($ModuleAction == "SortForm"){ ?>
<?
	function my_loadSortTreeCat($ParentID){
	global $Conn;	
	$sql = "SELECT * FROM products_type";
	$sql.= " WHERE parent_id='$ParentID'";
	$sql.= " ORDER BY order_by ASC";
	
	
	$Conn->query($sql);
	$ContentList = $Conn->getResult();
	$CntRecInPage = $Conn->getRowCount();
	$TotalRec= $Conn->var_totalRow;
	
	for ($i=0;$i<$CntRecInPage;$i++) {
			
		$Row = $ContentList[$i];
		$sql1 = "SELECT count(*) as CNT FROM products_type ";
		$sql1.=" WHERE parent_id ='".$Row["cate_id"]."' ";
		
		$sql1.=" ORDER BY order_by ASC";
		$Conn->query($sql1);
		$ContentList1 = $Conn->getResult();
		$RecordCount1= $ContentList1[0]["CNT"];
		
			?>
			<li id="<?=$Row["cate_id"]?>" rel="<?=$Row["order_by"]?>">
            	<div class="box">
                    <div class="ft-left" >
                   <?=$Row["name"]?>
                    </div>
                    <div class="clear"></div>
                </div>
			<?
			if($RecordCount1>0){
			?>
			<ul class="sortable-cat"><?=my_loadSortTreeCat($Row["cate_id"]); ?></ul></li>
			<?
			}
	
		}
	}
?>



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

<form id="frm" name="frm"  method="post" class="form-horizontal" onSubmit="return false;">
<input type="hidden"  name="SysModReturnURL" id="SysModReturnURL" value="<?=SystemEncryptURL("SysMenuID=$SysMenuID")?>"/>
<div class="clearfix">
<a href="category.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID")?>" class="btn" ><i class="icon-chevron-left"></i>Back</a>
<button type="submit" class="btn btn-success" onClick="mod_verifySortableCategories();"><i class="icon-ok"></i> <?=_SAVE_?></button>
<div class="line-control-header"></div>
</div>

<div class="block block-themed block-last">
<div class="block-title">
<h4>Sort</h4>
</div>
<div class="block-content" style="min-height:300px;">

    <div id="sortable-area" >
    <ul class="sortable-cat">
    <?
    my_loadSortTreeCat(0);
    ?>
    </ul>
    <br>

    </div>
</div>

</div>

<div class="clearfix">
<div class="line-control-footer"></div>
<a href="category.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID")?>" class="btn" ><i class="icon-chevron-left"></i>Back</a>
<button type="submit" class="btn btn-success" onClick="mod_verifySortableCategories();"><i class="icon-ok"></i> <?=_SAVE_?></button>

</div>
    </form>




<? }else{ ?>

<div class="clearfix">

<a id="btn_add" class="btn btn-success" href="category.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID&ModuleAction=AddForm")?>"><i class="icon-plus"></i> Add New Product Type</a>

<a  class="btn"  href="category.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID&ModuleAction=SortForm")?>"><i class="icon-plus"></i><?=_Store_Cateory_Sorting_?></a>
<div class="line-control-header"></div>
</div>
<br>


 <div id="categories-content">
<?
  my_loadTreeCat(0);
?>
</div>

<? } ?>

</div><!-- page-content -->
<? require("../inc/inc-web-footer.php");?>
</div><!-- inner-container -->
</div>

</body></html>