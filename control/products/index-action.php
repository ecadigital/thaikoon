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

	function check_input($value)
	{
	// Stripslashes
	if (get_magic_quotes_gpc())
	  {
	  $value = stripslashes($value);
	  }
	// Quote if not a number
	if (!is_numeric($value))
	  {
	  $value = "'" . mysql_real_escape_string($value) . "'";
	  }
	return $value;
	}
	

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
	
	
	$sql = "SELECT p.*,c.name as category_name FROM products_main p";
	$sql.=" left join products_category c on(c.cate_id=p.cate_id) ";
	$sql.= " WHERE p.menu_id='".$SysMenuID."'";
	
	
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
<div style="float:left; margin-right:10px;">
<select id="search_cateid" name="search_cateid" onchange="sysListCateIDSearch();" >
<option value="0" data-level="0" >-</option>
<? my_loadTreeCatSelect(0, $_REQUEST["SysCateID"]); ?>
</select> 
</div>
<div class="input-append">
<input type="text" id="input_search" name="input_search" value="<?=$SysTextSearch?>" class="input-medium"  placeholder="search..">
<button class="btn" onclick="sysListTextSearch();"><i class="icon-search"></i></button>
</div>
</div>

</div>
<a href="index.php?<?=SystemEncryptURL("SysMenuID=$SysMenuID&ModuleAction=AddForm")?>" class="btn btn-success" ><i class="icon-plus"></i> Add New Product</a>

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
<th <?=SysGetTitleSort('p.id',$SysFSort,$SysSort)?>  >#&nbsp; &nbsp;</th>
<th  style="width:150px;">&nbsp;</th>
<th <?=SysGetTitleSort('p.name',$SysFSort,$SysSort)?>  style="width: 300px;" >Subject</th>
<th <?=SysGetTitleSort('c.cate_id',$SysFSort,$SysSort)?> style="width: 508px;" >Category</th>
<th <?=SysGetTitleSort('p.flag_display',$SysFSort,$SysSort)?> style="width: 125px;" >Enable/Disable</th>
<th  style="width: 46px; text-align:center;"><i class="icon-fire" ></i></th></tr>
</thead>

<tbody >

<?

 	$resize=SystemResizeImgAuto(960,960,100,100);
	
	$_index=(($Page-1)*$PageSize)+1;
	for ($i=0;$i<$CntRecInPage;$i++) {
	$Row = $ContentList[$i];
 	$physical_name="../../uploads/products/".$Row["filepic"];
	
	if (!(is_file($physical_name) && file_exists($physical_name) )) {
		$physical_name="../img/photo_not_available.jpg";
	}
	
	
?>

<tr >
<td class="span1 text-center"><?=($_index+$i)?></td>
<td>

<img src=<?=$physical_name?>  width="<?=$resize[0]?>" height="<?=$resize[1]?>" class="img-polaroid">


</td>
<td class="" valign="top" >
<a href="javascript:void(0)"><?=$Row["name"]?></a>
</td>
<td class="hidden-phone sorting_1"><?=$Row["category_name"]?></td>
<td class="span2" style="text-align:center;" ><?=$source_status[$Row["flag_display"]]?> </td>
<td class="span1 text-center ">
<div class="btn-group">
<a href="index.php?<?=SystemEncryptURL("ModuleAction=EditForm&SysMenuID=$SysMenuID&Page=$Page&ModuleDataID=".$Row["id"])?>" data-toggle="tooltip" title="" class="btn btn-mini btn-success" data-original-title="Edit"><i class="icon-pencil"></i></a>
<a href="javascript:void(0)" data-toggle="tooltip" title="" class="btn btn-mini btn-danger" data-original-title="Delete"><i class="icon-remove"></i></a>


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



<? 
}else if ($ModuleAction == "InsertNewData") {
?>
<?


$input_fileIDOnePic=$_REQUEST["input_fileIDOnePic"];

	if($input_fileIDOnePic!=""){
		$_source_library=SystemGetMoreData("library_file",array('file_name','physical_name','file_type','file_size','file_type','file_width','file_height'),"id='".$input_fileIDOnePic."'");	
		$store_physical_name 	= md5($_source_library["file_name"].date("His").rand(1,1000)).".".$_source_library["file_type"];
		$storeFolder = _SYSTEM_UPLOADS_FOLDER_.'/products';  
		$libraryFolder = _SYSTEM_UPLOADS_FOLDER_.'/library'; 
		
		copy($libraryFolder."/".$_source_library["physical_name"],$storeFolder."/".$store_physical_name);
	
	}
	
	
		$input_flag_media=$_REQUEST["input_flag_media"];
		$input_fileid_media=$_REQUEST["input_fileid_media"];
		
		if($input_flag_media=="UPLOADFILE" && $input_fileid_media!="" ){
			
			$_source_library=SystemGetMoreData("library_file",array('file_name','physical_name','file_type','file_size','file_type'),"id='".$input_fileid_media."'");	
			
			$media_file_name=$_source_library["file_name"];
			$media_file_size=$_source_library["file_size"];
			
			$media_physical_name 	= md5($_source_library["file_name"].date("His").rand(1,1000)).".".$_source_library["file_type"];
			$storeFolder = _SYSTEM_UPLOADS_FOLDER_.'/products';  
			$libraryFolder = _SYSTEM_UPLOADS_FOLDER_.'/library'; 
			
			copy($libraryFolder."/".$_source_library["physical_name"],$storeFolder."/".$media_physical_name);
			
		}
		
		$input_content = check_input($_REQUEST["input_content"]);
		
		$insert="";
		$insert["site_code"] 			= "'S0001'";	
		$insert["cate_id"] 				= "'".trim($_REQUEST['cate_id'])."'";
		$insert["type_id"] 				= "'".trim($_REQUEST['type_id'])."'";
		$insert["brand_id"] 				= "'".trim($_REQUEST['brand_id'])."'";
		
		$insert["menu_id"] 				= "'".trim($_REQUEST['SysMenuID'])."'";
		$insert["name"] 				= "'".trim($_REQUEST['product_name'])."'";
		$insert["content"] 				= "".$input_content."";
		
		if($input_fileIDOnePic!=""){
			$insert["filepic"] 			= "'".$store_physical_name."'";	
		}
		$insert["flag_media"] 			= "'".$input_flag_media."'";
		$insert["embed_code"] 			= "'".trim($_REQUEST['input_embed_code'])."'";		
		$insert["filemedia_name"] 		= "'".$media_file_name."'";	
		$insert["filemedia_physical"] 	= "'".$media_physical_name."'";	
		$insert["filemedia_size"] 		= "'".$media_file_size."'";	
		
		
		$insert["createby"] 			= "'".$_SESSION['UserID']."'";
		$insert["createdate"] 			= "sysdate()";
		$insert["updateby"] 			= "'".$_SESSION['UserID']."'";
		$insert["updatedate"] 			= "sysdate()";
		
		$sql = "insert into products_main(".implode(",",array_keys($insert)).") values (".implode(",",array_values($insert)).")";
		$Conn->execute($sql);
		$StoreID=$Conn->getInsertID();	
		
		
		if($StoreID<1){
			exit();
		}
		
		
		/*       FILE PHOTO  UPLOAD    */
		$file_list= substr($_REQUEST["inputPhotoFileID"],0,strlen($_REQUEST["inputPhotoFileID"])-1);
		$file_array=explode("-",$file_list);
		if(is_array($file_array)){	
		$order_by=0;
		foreach($file_array as $val){	
			$order_by++;
			if(strpos(":".$val,"L")){
				$_file_val_id=str_replace("L","",$val);	
				$_source_library=SystemGetMoreData("library_file",array('file_name','physical_name','file_type','file_size','file_type','file_width','file_height'),"id='".$_file_val_id."'");	
				
				$store_physical_name = md5($_source_library["file_name"].date("His").rand(1,1000)).".".$_source_library["file_type"];
				
				$insert="";
				$insert["mod_type"] 			= "'PHOTO'";
				$insert["product_id"] 			= "'".$StoreID."'";
				$insert["file_name"] 			= "'".$_source_library["file_name"]."'";
				$insert["physical_name"] 		= "'".$store_physical_name."'";
				$insert["file_type"] 			= "'".$_source_library["file_type"]."'";
				$insert["file_size"] 			= "'".$_source_library["file_size"]."'";
				$insert["file_width"] 			= "'".$_source_library["file_width"]."'";
				$insert["file_height"] 			= "'".$_source_library["file_height"]."'";
				$insert["order_by"] 			= "'".$order_by."'";	
				
		
				
				$sql = "insert into products_file(".implode(",",array_keys($insert)).") values (".implode(",",array_values($insert)).")";
				$Conn->execute($sql);
				$storeFolder = _SYSTEM_UPLOADS_FOLDER_.'/products';  
				$libraryFolder = _SYSTEM_UPLOADS_FOLDER_.'/library'; 
				
				copy($libraryFolder."/".$_source_library["physical_name"],$storeFolder."/".$store_physical_name);
			
				}
			}	
		}
			
		/*       FILE ALL  UPLOAD    */
		$file_list= substr($_REQUEST["inputFileAllID"],0,strlen($_REQUEST["inputFileAllID"])-1);
		$file_array=explode("-",$file_list);
		if(is_array($file_array)){	
		$order_by=0;
		foreach($file_array as $val){	
			$order_by++;
			if(strpos(":".$val,"L")){
				$_file_val_id=str_replace("L","",$val);	
				$_source_library=SystemGetMoreData("library_file",array('file_name','physical_name','file_type','file_size','file_type','file_width','file_height'),"id='".$_file_val_id."'");	
				
				$store_physical_name = md5($_source_library["file_name"].date("His").rand(1,1000)).".".$_source_library["file_type"];
				
				$insert="";
				$insert["mod_type"] 			= "'FILE'";
				$insert["product_id"] 			= "'".$StoreID."'";
				$insert["file_name"] 			= "'".$_source_library["file_name"]."'";
				$insert["physical_name"] 		= "'".$store_physical_name."'";
				$insert["file_type"] 			= "'".$_source_library["file_type"]."'";
				$insert["file_size"] 			= "'".$_source_library["file_size"]."'";
				$insert["file_width"] 			= "'".$_source_library["file_width"]."'";
				$insert["file_height"] 			= "'".$_source_library["file_height"]."'";
				$insert["order_by"] 			= "'".$order_by."'";	
				
		
				
				$sql = "insert into products_file(".implode(",",array_keys($insert)).") values (".implode(",",array_values($insert)).")";
				$Conn->execute($sql);
				$storeFolder = _SYSTEM_UPLOADS_FOLDER_.'/products';  
				$libraryFolder = _SYSTEM_UPLOADS_FOLDER_.'/library'; 
				
				copy($libraryFolder."/".$_source_library["physical_name"],$storeFolder."/".$store_physical_name);
			
				}
			}	
		}
	
		
		
		
		
?>

<? 
}else if ($ModuleAction == "UpdateData") {
	
	$input_fileIDOnePic=$_REQUEST["input_fileIDOnePic"];
	
	if($input_fileIDOnePic!=""){
		$_source_library=SystemGetMoreData("library_file",array('file_name','physical_name','file_type','file_size','file_type','file_width','file_height'),"id='".$input_fileIDOnePic."'");	
		$store_physical_name 	= md5($_source_library["file_name"].date("His").rand(1,1000)).".".$_source_library["file_type"];
		$storeFolder = _SYSTEM_UPLOADS_FOLDER_.'/products';  
		$libraryFolder = _SYSTEM_UPLOADS_FOLDER_.'/library'; 
		
		copy($libraryFolder."/".$_source_library["physical_name"],$storeFolder."/".$store_physical_name);
	
	}
	
	
		$input_flag_media=$_REQUEST["input_flag_media"];
		$input_fileid_media=$_REQUEST["input_fileid_media"];
	
		if($input_flag_media=="UPLOADFILE" && $input_fileid_media!="" ){
			
			$_source_library=SystemGetMoreData("library_file",array('file_name','physical_name','file_type','file_size','file_type'),"id='".$input_fileid_media."'");	
			
			$media_file_name=$_source_library["file_name"];
			$media_file_size=$_source_library["file_size"];
			
			$media_physical_name 	= md5($_source_library["file_name"].date("His").rand(1,1000)).".".$_source_library["file_type"];
			$storeFolder = _SYSTEM_UPLOADS_FOLDER_.'/products';  
			$libraryFolder = _SYSTEM_UPLOADS_FOLDER_.'/library'; 
			
			copy($libraryFolder."/".$_source_library["physical_name"],$storeFolder."/".$media_physical_name);
			
		}
	

	$input_content = check_input($_REQUEST["input_content"]);

	$update="";
	$update[] = "cate_id 		= '".trim($_REQUEST['cate_id'])."'";
	$update[] = "type_id 		= '".trim($_REQUEST['type_id'])."'";
	$update[] = "brand_id 		= '".trim($_REQUEST['brand_id'])."'";
	
	
	$update[] = "menu_id 		= '".trim($_REQUEST['SysMenuID'])."'";
	
	$update[] = "date_display 	= '".SystemDateFormatDB(trim($_REQUEST['input_showdate']))."'";
	
	
	$update[] = "name 		= '".trim($_REQUEST['product_name'])."'";
	$update[] = "content 		= ".$input_content."";
	

	if($input_fileIDOnePic!=""){
		$update[] = "filepic 		= '".$store_physical_name."'";
	}
	
	$update[] = "flag_media 		= '".$input_flag_media."'";
		
	if($input_flag_media=="UPLOADFILE" && $input_fileid_media!="" ){
		$update[] = "filemedia_name 		= '".$media_file_name."'";
		$update[] = "filemedia_physical 	= '".$media_physical_name."'";
		$update[] = "filemedia_size 		= '".$media_file_size."'";
		
	}else if($input_flag_media=="EMBED"){
		$update[] = "embed_code 		= '".trim($_REQUEST['input_embed_code'])."'";
	
	}
		
		
	
	$update[] = "flag_display 		= '".trim($_REQUEST['product_display'])."'";
	
	
	$update[] = "updateby 		= '".$_SESSION['UserID']."'";
	$update[] = "updatedate 		= sysdate()";
	
	
	
	$sql = "update  products_main set ".implode(",",array_values($update)) ;
	$sql.=" where id = '".$_REQUEST['ModuleDataID']."'";	
	
	
	$Conn->execute($sql);
	
	
	/*       FILE PHOTO  UPLOAD    */
	$file_list= substr($_REQUEST["inputPhotoFileID"],0,strlen($_REQUEST["inputPhotoFileID"])-1);
	$file_old_list= substr($_REQUEST["inputPhotoOldFileID"],0,strlen($_REQUEST["inputPhotoOldFileID"])-1);
	
	$file_array=explode("-",$file_list);
	$file_old_array=explode("-",$file_old_list);
	
	$file_old_store=array();
	foreach($file_array as $val){
		if(strpos(":".$val,"P")) $file_old_store[]= str_replace("P","",$val);			
	}
	$file_delete = array_diff($file_old_array, $file_old_store);
	
	if(count($file_delete)){
		 foreach($file_delete as $val){
			$row_filestore=SystemGetMoreData("products_file",array('physical_name'),"id='".$val."'");	
			$file_path_delete = _SYSTEM_UPLOADS_FOLDER_.'/products/'.$row_filestore["physical_name"];
			if (file_exists($file_path_delete)) {
				@unlink($file_path_delete);
			}
			$sql = "delete from products_file where id = '".$val."'";
			$Conn->execute($sql);
		 }
	}
	
	if(is_array($file_array)){	
		$order_by=0;
		foreach($file_array as $val){	
			$order_by++;
			if(strpos(":".$val,"L")){
				$_file_val_id=str_replace("L","",$val);	
				$_source_library=SystemGetMoreData("library_file",array('file_name','physical_name','file_type','file_size','file_type','file_width','file_height'),"id='".$_file_val_id."'");	
				
				$store_physical_name 	= md5($_source_library["file_name"].date("His").rand(1,1000)).".".$_source_library["file_type"];
				
				$insert="";
				$insert["mod_type"] 			= "'PHOTO'";
				$insert["product_id"] 			= "'".$_REQUEST['ModuleDataID']."'";
				$insert["file_name"] 			= "'".$_source_library["file_name"]."'";
				$insert["physical_name"] 		= "'".$store_physical_name."'";
				$insert["file_type"] 			= "'".$_source_library["file_type"]."'";
				$insert["file_size"] 			= "'".$_source_library["file_size"]."'";
				
				$insert["file_width"] 			= "'".$_source_library["file_width"]."'";
				$insert["file_height"] 			= "'".$_source_library["file_height"]."'";
				
				$insert["order_by"] 			= "'".$order_by."'";
				
				
				
				$sql = "insert into products_file(".implode(",",array_keys($insert)).") values (".implode(",",array_values($insert)).")";
				$Conn->execute($sql);
				$storeFolder = _SYSTEM_UPLOADS_FOLDER_.'/products';  
				$libraryFolder = _SYSTEM_UPLOADS_FOLDER_.'/library'; 
				
				copy($libraryFolder."/".$_source_library["physical_name"],$storeFolder."/".$store_physical_name);
			}else{
				$_file_val_id=str_replace("P","",$val);	
				$update="";
				$update[] = "order_by 		= '".$order_by."'";
				$sql = "update  products_file set ".implode(",",array_values($update)) ;
				$sql.=" where id = '".$_file_val_id."'";	
				$Conn->execute($sql);

				
			}
		}	
	}
		
		
	/*       FILE ALL  UPLOAD    */
	$file_list= substr($_REQUEST["inputFileAllID"],0,strlen($_REQUEST["inputFileAllID"])-1);
	$file_old_list= substr($_REQUEST["inputFileAllOldID"],0,strlen($_REQUEST["inputFileAllOldID"])-1);
	
	$file_array=explode("-",$file_list);
	$file_old_array=explode("-",$file_old_list);
	
	$file_old_store=array();
	foreach($file_array as $val){
		if(strpos(":".$val,"P")) $file_old_store[]= str_replace("P","",$val);			
	}
	$file_delete = array_diff($file_old_array, $file_old_store);
	
	if(count($file_delete)){
		 foreach($file_delete as $val){
			$row_filestore=SystemGetMoreData("products_file",array('physical_name'),"id='".$val."'");	
			$file_path_delete = _SYSTEM_UPLOADS_FOLDER_.'/products/'.$row_filestore["physical_name"];
			if (file_exists($file_path_delete)) {
				@unlink($file_path_delete);
			}
			$sql = "delete from products_file where id = '".$val."'";
			$Conn->execute($sql);
		 }
	}
	
	if(is_array($file_array)){	
		$order_by=0;
		foreach($file_array as $val){	
			$order_by++;
			if(strpos(":".$val,"L")){
				$_file_val_id=str_replace("L","",$val);	
				$_source_library=SystemGetMoreData("library_file",array('file_name','physical_name','file_type','file_size','file_type','file_width','file_height'),"id='".$_file_val_id."'");	
				
				$store_physical_name 	= md5($_source_library["file_name"].date("His").rand(1,1000)).".".$_source_library["file_type"];
				
				$insert="";
				$insert["mod_type"] 			= "'FILE'";
				$insert["product_id"] 			= "'".$_REQUEST['ModuleDataID']."'";
				$insert["file_name"] 			= "'".$_source_library["file_name"]."'";
				$insert["physical_name"] 		= "'".$store_physical_name."'";
				$insert["file_type"] 			= "'".$_source_library["file_type"]."'";
				$insert["file_size"] 			= "'".$_source_library["file_size"]."'";
				$insert["file_width"] 			= "'".$_source_library["file_width"]."'";
				$insert["file_height"] 			= "'".$_source_library["file_height"]."'";
				$insert["order_by"] 			= "'".$order_by."'";
				
				$sql = "insert into products_file(".implode(",",array_keys($insert)).") values (".implode(",",array_values($insert)).")";
				$Conn->execute($sql);
				$storeFolder = _SYSTEM_UPLOADS_FOLDER_.'/products';  
				$libraryFolder = _SYSTEM_UPLOADS_FOLDER_.'/library'; 
				
				copy($libraryFolder."/".$_source_library["physical_name"],$storeFolder."/".$store_physical_name);
			}else{
				$_file_val_id=str_replace("P","",$val);	
				$update="";
				$update[] = "order_by 		= '".$order_by."'";
				$sql = "update  products_file set ".implode(",",array_values($update)) ;
				$sql.=" where id = '".$_file_val_id."'";	
				$Conn->execute($sql);

				
			}
		}	
	}
	
	/*  ########################################### END File  ############### */	

	/*       FILE ALL  UPLOAD    */
	$file_list= substr($_REQUEST["inputProjectReferID"],0,strlen($_REQUEST["inputProjectReferID"])-1);
	$file_old_list= substr($_REQUEST["inputProjectReferOldID"],0,strlen($_REQUEST["inputProjectReferOldID"])-1);
	
	$file_array=explode("-",$file_list);
	$file_old_array=explode("-",$file_old_list);
	
	$file_old_store=array();
	foreach($file_array as $val){
		if(strpos(":".$val,"P")) $file_old_store[]= str_replace("P","",$val);			
	}
	$file_delete = array_diff($file_old_array, $file_old_store);

	if(count($file_delete)){
		 foreach($file_delete as $val){
			$sql = "delete from products_projectrefer where project_id = '".$val."' and product_id='".$_REQUEST['ModuleDataID']."'";
			
			$Conn->execute($sql);
		 }
	}

	
	if(is_array($file_array)){	
		$order_by=0;
		foreach($file_array as $val){	
			$order_by++;
			if(strpos(":".$val,"L")){
				$_file_val_id=str_replace("L","",$val);
				$insert="";
				$insert["project_id"] 			= "'".$_file_val_id."'";
				$insert["product_id"] 			= "'".$_REQUEST['ModuleDataID']."'";
				$insert["order_by"] 			= "'".$order_by."'";
				
				$sql = "insert into products_projectrefer(".implode(",",array_keys($insert)).") values (".implode(",",array_values($insert)).")";
				$Conn->execute($sql);	
			}else{
				$_file_val_id=str_replace("P","",$val);	
				$update="";
				$update[] = "order_by 		= '".$order_by."'";
				$sql = "update  products_projectrefer set ".implode(",",array_values($update)) ;
				$sql.=" where project_id = '".$_file_val_id."' and product_id='".$_REQUEST['ModuleDataID']."'";	
				$Conn->execute($sql);			
			}
		}	
	}
	
	/*  ########################################### END Project  ############### */	
	
	
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