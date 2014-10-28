<?
	date_default_timezone_set("Asia/Bangkok");
	//error_reporting(0);
	define("_DATABASE_HOST_",'localhost');
	define("_DATABASE_USERNAME_",'digitgood_river');
	define("_DATABASE_PASSWORD_",'river2014+');
	define("_DATABASE_NAME_",'digitgood_river');
	// Upload
	define("_SYSTEM_HOST_NAME_","http://".$_SERVER["SERVER_NAME"]."/river");
	
	
	define("_SYSTEM_UPLOAD_FOLDER_",'../UploadFile/'.date("Ymd")."/MenuID".$SysMenuID);
	define("_SYSTEM_ACCOUNT_PICTURE_",'../UploadFile/AccountPicture');
	define("_SYSTEM_UPLOAD_HTML_PICTURE_",'../UploadFile/HTMLUPLOADIMAGE');
	define("_SYSTEM_UPLOAD_FOLDER_HTML_",_SYSTEM_UPLOAD_FOLDER_."/HTML");
	define("_SYSTEM_UPLOAD_FOLDER_PICTURE_",_SYSTEM_UPLOAD_FOLDER_."/PICTURE");
	define("_SYSTEM_UPLOAD_FOLDER_THUMBNAIL_",_SYSTEM_UPLOAD_FOLDER_."/THUMBNAIL");
	define("_SYSTEM_UPLOAD_FOLDER_FILE_",_SYSTEM_UPLOAD_FOLDER_."/FILES");
	
	define("_SYSTEM_FULL_UPLOAD_PATH_","http://"._SYSTEM_HOST_NAME_."/"._SYSTEM_UPLOAD_FOLDER_);
	
	define("_FRONT_URLFULL_PATH_","http://".$_SERVER["SERVER_NAME"]."/river");
	//define("_FRONT_PATH_","../");
	

?>