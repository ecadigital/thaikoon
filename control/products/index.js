function project_selectList(Vars){	

		$.ajax({
			url : "../obj/project_refer/index-action.php",
			data : "ModuleAction=selectListProject&"+Vars,
			type : "post",
			cache : false ,	
			success : function(resp){	
				$('#area_select_project').append(resp);
				sys_modal_close();
				$('#area_num_project').html($('.boxli_project_refer').length);
				
				
			}
		});		
}

function library_remove_project(my){
$(my).parents("div").parents("li").remove();
$('#area_num_project').html($('.boxli_project_refer').length);
}



function sysValidate(elm){
	
	if(elm.val()==""){	
		elm.parent().parent().addClass('error');
		return 1;
	}else{
		elm.parent().parent().removeClass('error');
		return 0;
	}
	
	
}


function validateFormContent() {

	var Check=0;
	
	$("#frm input.request").each(function(  ) {
		Check+=sysValidate($(this));
	})
	

	
	if(Check<1){
		return true;
	}else{
		return false;
	}	
}

function CKupdate(){
    for ( instance in CKEDITOR.instances ){
		  CKEDITOR.instances[instance].updateElement();
	}      
}

function submitFormContent() {
	CKupdate();
	
	//File Photo
	var ObjPhotoID = "";
	$('#area_select_photo li').each(function(i){
			ObjPhotoID += $(this).attr('id')+'-';
	});
	$('#inputPhotoFileID').val(ObjPhotoID);
	
	//File All
	var ObjFileID = "";
	$('#area_select_file li').each(function(i){
			ObjFileID += $(this).attr('id')+'-';
	});
	$('#inputFileAllID').val(ObjFileID);
	

	//Project Refer
	var ObjProjectReferID = "";
	$('#area_select_project li').each(function(i){
			ObjProjectReferID += $(this).attr('id')+'-';
	});
	$('#inputProjectReferID').val(ObjProjectReferID);

	
	
	if (validateFormContent()) {	
		var Vars=$('#frm').serialize();	
		$.ajax({
			url : "index-action.php",
			data : Vars,
			type : "post",
			cache : false ,
			success : function(resp){
				
				window.location='index.php?'+$('#SysModReturnURL').val();
			}
		});
	
	}else{
		alert('Please enter information.');	
	}
}


function setTestTab(){
	//$('#myTabs a[href="#home"]').tab('show');		
}

$(document).ready(function() {
	$('#btn_add_photo').live('click', function(e){						
				$(this).sys_modal({iframe:true,modal_size:'modal-iframe-full'});
			
	});	
	
	
	$('#btn_add_file').live('click', function(e){						
				$(this).sys_modal({iframe:true,modal_size:'modal-iframe-full'});
			
	});	
	
	
	$('#btn_insert_project').live('click', function(e){	
			var _url=$(this).attr('href');										
				
			//Project Refer
			var ObjProjectReferID = "";
			$('#area_select_project li').each(function(i){
					ObjProjectReferID += $(this).attr('id')+'-';
			});
		
			_url+='&project_list='+ObjProjectReferID;
			$(this).sys_modal({url:_url,iframe:true,modal_size:'modal-80per'});
	
	});	
		

	
	$('.btn_photo_view').live('click', function(e){	
		
		var _url=$(this).attr('href');
	
	
		var ObjPhotoID = "";
		$('#area_select_photo li').each(function(i){
			ObjPhotoID += $(this).attr('id')+'-';
		});
	
		_url+='&file_list='+ObjPhotoID;
									
		$(this).sys_modal({url:_url,modal_size:'modal-full'});		   
	 });
	
});


function sysListCateIDSearch(){ 
	$('#SysCateID').val($('#search_cateid').val());

	$('#SysPage').val(1);
	sysListLoadDatalist($('#mySearch').serialize());
}
