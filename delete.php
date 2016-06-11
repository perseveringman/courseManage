<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2016-06-09 15:35:10
 * @version $Id$
 */
header("Content-Type: text/plain;charset=utf-8"); 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	delete();
}
function delete(){
	//TODO: 获取POST表单数据并保存到数据库
	$conn = new mysqli('localhost', 'root', '','studentManage');
	if(mysqli_connect_errno())
	{
	    echo mysqli_connect_error();
	}
	$conn->query("BEGIN");//开始事务定义
	if(!$conn->query("DELETE FROM Grade WHERE StuID = '".$_POST["StuID"]."'"))
	{
	$conn->query("ROLLBACK");//判断当执行失败时回滚
	echo '{"success":false,"msg":"删除失败!"}';
	}
	if(!$conn->query("DELETE FROM Student WHERE StuID = '".$_POST["StuID"]."'"))
	{
	$conn->query("ROLLBACK");//判断执行失败回滚
	echo '{"success":false,"msg":"删除失败!"}';
	}
	$conn->query("COMMIT");//执行事务

/*	if(mysqli_errno($conn).mysqli_error($conn)=="1644该用户不能注册!"){
		echo '{"success":false,"msg":"该用户不能注册!"}';
	}
	else{
		echo '{"success":true,"msg": "注册成功!"}';
	}*/
	
/*  	$result = mysql_query("SELECT TeID FROM Teacher");*/

	$conn->close();
	echo '{"success":true,"msg":"删除成功!"}';
	return;
	//提示保存成功

}