<?
if($_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest"){
	require("../lib/system_core.php");
	require("function.php");
}
if($_REQUEST['ModuleAction']!=""){
	$ModuleAction = $_REQUEST['ModuleAction'];
	$SysMenuID=$_POST["SysMenuID"];
	$ModuleDataID = $_REQUEST['ModuleDataID'];
}
?>

<?
if ($ModuleAction == "Datalist") {
	if(!$Page){
		$Page=$_REQUEST["SysPage"];
	}
	$PageSize=$_REQUEST["SysPageSize"];
	$SysTextSearch=trim($_REQUEST["SysTextSearch"]);
	$SysCateID=$_REQUEST["SysCateID"];
	
	$SysFSort = $_POST["SysFSort"];
	$SysSort = $_POST["SysSort"];
	if ($SysFSort=="") $SysFSort="p.id";
	if ($SysSort=="") $SysSort="desc";
	
	
	
	if($Page<1) $Page=1;
	if($PageSize<1) $PageSize=10;
	
	
	$sql = "SELECT p.*,s.name as menu_name FROM webpage p";
	$sql.=" left join sysmenu s on(s.menu_id=p.menu_id) ";
	$sql.= " WHERE 1=1 ";
	
	
	if (trim($SysTextSearch)!=""){
		$sql.=" AND (p.name  like '%".$SysTextSearch."%' ";
		$sql.=")";
	}
	
	if (trim($SysCateID)>0){
		$sql.=" AND (p.cate_id  = '".$SysCateID."' ";
		$sql.=")";
	}
	
	
	$sql.= " ORDER BY ".$SysFSort." ".$SysSort;
	
	$Conn->query($sql,$Page,$PageSize);
	$ContentList = $Conn->getResult();
	$CntRecInPage = $Conn->getRowCount();
	$TotalRec= $Conn->getTotalRow();
	$TotalPageCount=ceil($TotalRec/$PageSize);
	
	
	
?>	



<form name="mySearch" id="mySearch" action="./index.php" method="post">
<input type="hidden"   id="SysMenuID" name="SysMenuID" value="<?=$SysMenuID?>" />
<input type="hidden"  name="SysModURL" id="SysModURL" value="index-action.php"/>
<input type="hidden"  name="SysModReturnURL" id="SysModReturnURL" value="<?=SystemGetReturnURL()?>"/>
<input type="hidden" name="SysPage"  id="SysPage" value="<?=$Page?>">
<input type="hidden" name="SysPageSize"  id="SysPageSize" value="<?=$PageSize?>">
<input type="hidden" name="SysTotalPageCount"  id="SysTotalPageCount" value="<?=$TotalPageCount?>">
<input type="hidden"  name="SysTextSearch" id="SysTextSearch" value="<?=$SysTextSearch?>">
<input type="hidden"  name="SysFSort" id="SysFSort" value="<?=$SysFSort?>"/>
<input type="hidden" name="SysSort"  id="SysSort" value="<?=$SysSort?>"/>
<input type="hidden" name="SysCateID"  id="SysCateID" value="<?=$_REQUEST["SysCateID"]?>"/>
</form>


<div class="clearfix">
<div class="btn-group pull-right">
<div class="dataTables_filter" >
<?=$_REQUEST["SysCateID"]?>
<div style="float:left; margin-right:10px;">&nbsp;</div>
<div class="input-append">
<input type="text" id="input_search" name="input_search" value="<?=$SysTextSearch?>" class="input-medium"  placeholder="search..">
<button class="btn" onclick="sysListTextSearch();"><i class="icon-search"></i></button>
</div>
</div>

</div>
<a href="index.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID&ModuleAction=AddForm")?>" class="btn btn-success" ><i class="icon-plus"></i> Add New CMS</a>

<div class="line-control-header"></div>
</div>

<div  class="dataTables_wrapper form-inline" role="grid">
 <?
$v_paging["Page"]=$Page;
$v_paging["Type"]="HEAD";
$v_paging["PageSize"]=$PageSize;
$v_paging["TotalRec"]=$TotalRec;
$v_paging["CntRecInPage"]=$RowCountInPage;
SystemPaging($v_paging);
?>

<style>
.dataTable tbody td {
	/*
	vertical-align:top;
	*/
}
</style>

            
<table class="table table-bordered table-hover dataTable" >
<thead>
<tr role="row">
<th <?=SysGetTitleSort('p.id',$SysFSort,$SysSort)?>  >#</th>

<th <?=SysGetTitleSort('p.name',$SysFSort,$SysSort)?>  style="width: 300px;" >Subject</th>
<th <?=SysGetTitleSort('c.cate_id',$SysFSort,$SysSort)?> style="width: 508px;" >Menu</th>
<th  style="width: 46px; text-align:center;"><i class="icon-fire" ></i></th></tr>
</thead>

<tbody >

<?

 	$resize=SystemResizeImgAuto(960,960,100,100);
	
	$_index=(($Page-1)*$PageSize)+1;
	for ($i=0;$i<$CntRecInPage;$i++) {
	$Row = $ContentList[$i];
	
	
	if($Row["menu_id"]!=""){
		$subject= "Menu : ".$Row["menu_name"];	
		$menu_name=$Row["menu_name"];
		 $link_edit="../webpage/index.php?".SystemEncryptURL("ModuleAction=EditForm&SysMenuID=".$Row["menu_id"]);
	}else{
		$subject= $Row["name"];
		$menu_name="-";
		 $link_edit="index.php?".SystemEncryptURL("ModuleAction=EditForm&SysMenuID=".$SysMenuID."&ModuleDataID=".$Row["id"]);
	}
	
   
	
?>

<tr >
<td class="span1 text-center"><?=($_index+$i)?></td>
<td class="" valign="top" ><a href="javascript:void(0)"><?=$subject?></a></td>
<td class="hidden-phone sorting_1"><?=$menu_name?></td>
<td class="span1 text-center ">
<div class="btn-group">
<a href="<?=$link_edit?>" data-toggle="tooltip" title="" class="btn btn-mini btn-success" data-original-title="Edit"><i class="icon-pencil"></i></a>
<a  _id="<?=$Row["id"]?>" href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-mini btn-danger btn-del" data-original-title="Delete"><i class="icon-remove"></i></a>


</div>
</td>
</tr>
<? } ?>
</tbody>
</table>

<?
$v_paging["Page"]=$Page;
$v_paging["Type"]="FOOTER";
$v_paging["PageSize"]=$PageSize;
$v_paging["TotalRec"]=$TotalRec;
$v_paging["CntRecInPage"]=$RowCountInPage;
SystemPaging($v_paging);
?>

</div>
<script>
$(".btn-del").click(function() {
	 if (confirm('Delete?')) {
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
	 }	
});

</script>


<? 
}else if ($ModuleAction == "InsertNewData") {
?>
<?

		$input_content = stripslashes( (string)$_REQUEST["input_content"] );	
			
		$insert="";
		$insert["site_code"] 		= "'S0001'";
		$insert["lang_code"] 		= "'".$_SESSION['LANG']."'";
		$insert["name"] 			= "'".$_REQUEST['title_name']."'";
		$insert["content"] 			= "'".$input_content."'";
		
		$sql = "insert into webpage(".implode(",",array_keys($insert)).") values (".implode(",",array_values($insert)).")";
		
		$Conn->execute($sql);
		
		
		
?>

<? 
}else if ($ModuleAction == "UpdateData") {
	
	$input_content = stripslashes( (string)$_REQUEST["input_content"] );
	
	$update="";
	$update[] = "name 		= '".trim($_REQUEST['title_name'])."'";
	$update[] = "content 		= '".$input_content."'";
	$update[] = "updateby 		= '".$_SESSION['UserID']."'";
	$update[] = "updatedate 		= sysdate()";
	
	
	
	$sql = "update  webpage set ".implode(",",array_values($update)) ;
	$sql.=" where id = '".$_REQUEST['ModuleDataID']."'";	

	
	$Conn->execute($sql);

	
	
?>


<? 
}else if ($ModuleAction == "DeleteData") {

$id= $_REQUEST["id"];


$sql = "delete from webpage where id = '".$id."'";
$Conn->execute($sql);



?>


<? 
}else if ($ModuleAction == "FormUpLoad") {
?>
<style>



</style>

<div class="modal-form" >
    <form id="frmprompt"  style="margin:0; padding:0;" method="post" class="form-horizontal" onsubmit="return false;"> 
        <input type="hidden"   id="SysMenuID" name="SysMenuID" value="<?=$SysMenuID?>" />
        <input type="hidden" name="ModuleAction" id="ModuleAction" value="<?=$ModuleAction_Current?>" />
        <input type="hidden" name="ModuleDataID" id="ModuleDataID" value="<?=stripslashes($ModuleDataID)?>" />
     
<div class="modal-header" >
	<a class="close" data-dismiss="modal">&times;</a>
	<h3>Add New Category</h3>
</div>
<div class="modal-body" style="width:500px;">
<br />


<div class="control-group">
<label class="control-label" for="category_name">Category name</label>
<div class="controls">
<input type="text" id="category_name" name="category_name" value="<?=$Row["name"]?>" required>
<span class="help-block">Category name..</span>
</div>
</div>

<div class="control-group">
<label class="control-label" for="parent_id">Parent id</label>
<div class="controls">
<select id="parent_id" name="parent_id" required>
<option value="0" data-level="0" >-</option>
<? my_loadTreeCatSelect(0,$Row["parent_id"]); ?>
</select>      
<span class="help-block">Category name..</span>
</div>
</div>

</div>
<div class="modal-footer">
<button type="reset" class="btn btn-danger"><i class="icon-repeat"></i> Reset</button>
	<a class="btn btn-success" onclick="submitFormContent();"><i class="icon-ok"></i> <?=_SAVE_?></a>
	<a class="btn" data-dismiss="modal">Close</a>
</div>
</form>
</div>


<?
}

?>