/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2016-06-09 12:42:05
 * @version $Id$
 */
$('#welcome').text("Welcome!"+" "+GetRequest());
$('#pageSearch').click(function(){
	$('article').hide();
	$('#partSearch').show();
	$('#tableSearch').hide();
});
$('#pageDelete').click(function(){
	$('article').hide();
	$('#partDelete').show();
});
$('#pageUpdate').click(function(){
	$('article').hide();
	$('#partUpdate').show();
});
$("#btnSearch").click(function(){
		$('#tableSearch').show();
		$.ajax({
	    type: "post",
	    url: "Search.php",     
	    data: {
				StuID: $("#StuID").val(), 
				cName: $("#cName").val() 
			},
		dataType:'json',
	    success: function(data) {
	    	if(data.success == true){
	    		$("#tableSearch").html(data.msg);
	    		return false;
	    	}
	        alert(data.msg);
     	},
	    error: function(jqXHR) {
	         alert("发生错误：" + jqXHR.status); 
	    }
	})
	return false;
	
});
$("#btnDelete").click(function(){
		$.ajax({
	    type: "post",
	    url: "delete.php",     
	    data: {
				StuID: $("#dStuID").val()
			},
		dataType:'json',
	    success: function(data) {
	    	if(data.success == true){
	    		alert(data.msg);
	    		return false;
	    	}
	        alert(data.msg);
     	},
	    error: function(jqXHR) {
	         alert("发生错误：" + jqXHR.status); 
	    }
	})
	return false;
	
});
$("#btnUpdate").click(function(){
/*	if($("#UGrade").val()<60){
		alert("老师别太绝情啊！");
		return false;
	}*/
	$.ajax({
	    type: "post",
	    url: "Update.php",     
	    data: {
				StuID: $("#UStuID").val(), 
				cName: $("#UcName").val(),
				Grade: $("#UGrade").val()
			},
		dataType:'json',
	    success: function(data) {
	    	if(data.success == true){
	    		alert(data.msg);
	    		return false;
	    	}
	        alert(data.msg);
	 	},
	    error: function(jqXHR) {
	         alert("发生错误：" + jqXHR.status); 
	    }
	})
	return false;
	
});
function GetRequest() {   
   var url = location.search; //获取url中"?"符后的字串   
   var theRequest = new Object();   
   if (url.indexOf("?") != -1) {   
      var str = url.substr(1);   

   }   
   return str;   
}  

