<?
if($_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest"){
	require("./lib/system_core.php");
}
if($_REQUEST['ModuleAction']!=""){
	$ModuleAction = $_REQUEST['ModuleAction'];
	$SysMenuID=$_POST["SysMenuID"];
	$ModuleDataID = $_REQUEST['ModuleDataID'];
}
?>

<? 
	if ($ModuleAction == "InsertData") {	
		$insert="";
		$insert["name"] 			= "'".trim($_REQUEST['input_name'])."'";
		$insert["email"] 			= "'".trim($_REQUEST['input_email'])."'";
		$insert["tel"] 			= "'".trim($_REQUEST['input_tel'])."'";
	//	$insert["subject"] 			= "'".trim($_REQUEST['input_subject'])."'";
		$insert["message"] 			= "'".trim($_REQUEST['input_message'])."'";
		$insert["createdate"] 			= "sysdate()";
		$sql = "insert into contactus(".implode(",",array_keys($insert)).") values (".implode(",",array_values($insert)).")";
		$Conn->execute($sql);
	
		
		$arrTmp["name"]="info@thaikoon.com";
		$arrTmp["email"]="info@thaikoon.com";
		$arrEmailForm[]=$arrTmp;
		/*
		$arrTmp["name"]="email1@thaikoon.com";
		$arrTmp["email"]="pissapak.s@thaikoon.com";
		$arrEmailTo[]=$arrTmp;
		
		$arrTmp["name"]="email2@thaikoon.com";
		$arrTmp["email"]="sales@thaikoon.com";
		$arrEmailTo[]=$arrTmp;
		
	
		$arrTmp["name"]="kemtongwit@hotmail.com";
		$arrTmp["email"]="kemtongwit@hotmail.com";
		$arrEmailBcc[]=$arrTmp;
		*/
		
			
		$HtmlBody='Name: '.trim($_REQUEST['input_name']);
		$HtmlBody.='<BR>Email: '.trim($_REQUEST['input_email']);
		$HtmlBody.='<BR>Message: '.trim($_REQUEST['input_message']);
		iconv( 'TIS-620', 'UTF-8',trim($HtmlBody) );
	
		//SystemSendEmail($arrEmailForm,$arrEmailTo,'',$arrEmailBcc,'Send us a message System.',$HtmlBody,'');
	}

?>