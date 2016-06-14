/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2016-06-08 19:10:25
 * @version $Id$
 */
$("#signIn").click(function(){
	if(!$("#inUserID").val()){
		alert("用户名不输还想登陆？");
		return false;
	}
	else if(!$("#inPassword1").val()){
		alert("密码不输还想登陆？");
		return false;
	}
	else{
		$.ajax({
	    type: "post",
	    url: "signIn.php",     
	    data: {
				inUserID: $("#inUserID").val(), 
				inPassword: $("#inPassword1").val(), 
			},
		dataType:'json',
	    success: function(data) {
	    	if(data.success == true){
	    		window.location.href=data.msg;
	    		return;
	    	}
	        alert(data.msg);
     	},
	    error: function(jqXHR) {
	         alert("发生错误：" + jqXHR.status); 
	    }
	})
	return false;
	}
	
});
$("#signUp").click(function(){
	var upPassword2 = $("#upPassword2").val();
	var upPassword1 = $("#upPassword1").val();
	if(!$("#upUserID").val()){
		alert("用户名不输还想注册？");
		return false;
	}
	else if(!upPassword1){
		alert("密码不输还想注册？");
		return false;
	}
	else if(!upPassword2){
		alert("密码不确认还想注册？");
		return false;
	}
	else if(!(upPassword1===upPassword2)){
		alert("两次密码不一样还想注册？");
		return false;
	}
	$.ajax({
	    type: "post",
	    url: "signUp.php",     
	    data: {
				upUserID: $("#upUserID").val(), 
				upPassword: $("#upPassword1").val(), 
			},
 		dataType:'json',
	    success: function(data) {
	    	if(data.success==true){
	        	alert(data.msg);
	        	$("#close").click();
	        }
	        else if(data.success==false){
	        	alert(data.msg);
	        }
     	},
	    error: function(jqXHR) {
	         alert("发生错误：" + jqXHR.status); 
	    }
	})
	return false;

});