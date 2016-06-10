<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2016-06-08 19:46:48
 * @version $Id$
 */
header("Content-Type: text/plain;charset=utf-8"); 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	create();
}
function create(){
	//判断信息是否填写完全
	if (!isset($_POST["upUserID"]) || empty($_POST["upUserID"])
		|| !isset($_POST["upPassword"]) || empty($_POST["upPassword"])) {
		echo '{"success":false,"msg":"参数错误，信息填写不全"}';
		return;
	}
	//TODO: 获取POST表单数据并保存到数据库
	$conn = new mysqli('localhost', 'root', '','studentManage');
	if(mysqli_connect_errno())
	{
	    echo mysqli_connect_error();
	}
 	$sql = "insert into Users values('".$_POST["upUserID"]."','".$_POST["upPassword"]."')";
	$conn->query($sql);
	if(mysqli_errno($conn).mysqli_error($conn)=="1644该用户不能注册!"){
		echo '{"success":false,"msg":"该用户不能注册!"}';
	}
	else if(mysqli_errno($conn).mysqli_error($conn)=="1644此用户已经存在!"){
		echo '{"success":false,"msg":"此用户已经存在!"}';
	}
	else{
		echo '{"success":true,"msg": "注册成功!"}';
	}
	
/*  	$result = mysql_query("SELECT TeID FROM Teacher");*/

	$conn->close();
	//提示保存成功
return;
}