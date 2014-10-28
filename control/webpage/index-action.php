<?
if($_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest"){
	require("../lib/system_core.php");
}
if($_REQUEST['ModuleAction']!=""){
	$ModuleAction = $_REQUEST['ModuleAction'];
	$SysMenuID=$_POST["SysMenuID"];
	$ModuleDataID = $_REQUEST['ModuleDataID'];
}
?>

<? 
	if ($ModuleAction == "UpdateData") {


	$sql = "select count(*) as CNT  from webpage where menu_id = '$SysMenuID'";
	
	$Conn->query($sql);
	$Content = $Conn->getResult();
	$C=$Content[0]["CNT"];
	
	//	$input_content = htmlspecialchars( (string)$_REQUEST["input_content"] );
	$input_content = stripslashes( (string)$_REQUEST["input_content"] );

		if($C>0){
			
				
	$update="";
	$update[] = "content 		= '".$input_content."'";
	$sql = "update  webpage set ".implode(",",array_values($update)) ;
	$sql.=" where menu_id = '".$SysMenuID."'";		
	
	
	
	$Conn->execute($sql);
	
			
		}else{
		
		$insert="";
		$insert["site_code"] 			= "'S0001'";
		$insert["menu_id"] 				= "'".$SysMenuID."'";
		$insert["lang_code"] 				= "'".$_SESSION['LANG']."'";
		
		$insert["content"] 			= "'".$input_content."'";
		
		$sql = "insert into webpage(".implode(",",array_keys($insert)).") values (".implode(",",array_values($insert)).")";
		
		$Conn->execute($sql);
		
			
			
		}
	


}

?>