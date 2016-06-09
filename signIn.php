<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2016-06-08 19:46:48
 * @version $Id$
 */
header("Content-Type: text/plain;charset=utf-8"); 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	turnTo();
}
function turnTo(){
	//判断信息是否填写完全
	if (!isset($_POST["inUserID"]) || empty($_POST["inUserID"])
		|| !isset($_POST["inPassword"]) || empty($_POST["inPassword"])) {
		echo '{"success":false,"msg":"参数错误，信息填写不全"}';
		return;
	}
	//TODO: 获取POST表单数据并保存到数据库
	$conn = new mysqli('localhost', 'root', '','studentManage');
	if(mysqli_connect_errno())
	{
	    echo mysqli_connect_error();
	}

	$result = mysqli_query($conn,"SELECT UID,UPassword FROM Users");
    while($row = mysqli_fetch_array($result,MYSQLI_NUM)) {
    	if($row[0]==$_POST["inUserID"]&&$row[1]==$_POST["inPassword"]){
    	
			echo '{"success":true,"msg":"http://localhost/courseManage/main.html?'.$_POST["inUserID"].'"}';
			//确保重定向后，后续代码不会被执行 
			exit;
    	}
    }
    echo '{"success":false,"msg": "登录失败！请重新输入账户密码"}';
/*  	$result = mysql_query("SELECT TeID FROM Teacher");*/

	$conn->close();
	//提示保存成功
}