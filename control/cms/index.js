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



function sysListCateIDSearch(){ 
	$('#SysCateID').val($('#search_cateid').val());

	$('#SysPage').val(1);
	sysListLoadDatalist($('#mySearch').serialize());
}
