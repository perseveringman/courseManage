<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2016-06-09 16:24:57
 * @version $Id$
 */

header("Content-Type: text/plain;charset=utf-8"); 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	search();
}
function search(){
	if (!isset($_POST["StuID"]) || empty($_POST["StuID"])
		|| !isset($_POST["cName"]) || empty($_POST["cName"])
		|| !isset($_POST["Grade"]) || empty($_POST["Grade"])) {
		echo '{"success":false,"msg":"参数错误，信息填写不全"}';
		return;
	}
	//TODO: 获取POST表单数据并保存到数据库
	$conn = new mysqli('localhost', 'root', '','studentManage');
	if(mysqli_connect_errno())
	{
	    echo mysqli_connect_error();
	}
	$sql1="SELECT Grade FROM Grade WHERE StuID = '".$_POST["StuID"]."' AND cName = '".$_POST["cName"]."'";
	$result = $conn->query($sql1);
	$row = mysqli_fetch_array($result,MYSQLI_NUM);
	$sql2 = "SELECT Credits FROM Course WHERE cName = '".$_POST["cName"]."'";
	$result2 = $conn->query($sql2);
	$row2 = mysqli_fetch_array($result2,MYSQLI_NUM);
	$sql3 = "SELECT totalCredits FROM Student WHERE StuID = '".$_POST["StuID"]."'";
	$result3 = $conn->query($sql3);
	$row3 = mysqli_fetch_array($result3,MYSQLI_NUM);
	if($row[0]<60&&$_POST["Grade"]>=60){
		//调用存储过程，更新成绩及总学分

		$sql4 = "call updateGrades(".$_POST["StuID"].",'".$_POST["cName"]."',".$_POST["Grade"].",".$row2[0].",".$row3[0].")";
		$result4 = $conn->query($sql4);
		if(mysqli_errno($conn).mysqli_error($conn)=="1644分数不能超过100分！"){
			echo '{"success":false,"msg":"分数不能超过100分！"}';
		}
		else{
			echo '{"success":true,"msg": "更新成功!"}';
		}
		/*echo '{"success":true,"msg":'.$sql4.'}';*/
	}
	else if($row[0]>60&&$_POST["Grade"]<60){
		$sql4 = "call updateGrades3(".$_POST["StuID"].",'".$_POST["cName"]."',".$_POST["Grade"].",".$row2[0].",".$row3[0].")";
		$result4 = $conn->query($sql4);
		if(mysqli_errno($conn).mysqli_error($conn)=="1644分数不能低于0分！"){
			echo '{"success":false,"msg":"分数不能低于0分！"}';
		}
		else{
			echo '{"success":true,"msg": "更新成功!"}';
		}
	}
	else if($_POST["Grade"]>100){
		echo '{"success":false,"msg":"分数不能超过100分！"}';
	}
	else if($row[0]>=60){
		$conn->query("UPDATE Grade SET Grade = ".$_POST["Grade"]." WHERE StuID = '".$_POST["StuID"]."' AND cName = '".$_POST["cName"]."'");
		echo '{"success":true,"msg":"更新成功！"}';
	}
/*	$conn->query("DELIMITER //");
	$conn->query("CREATE PROCEDURE proc1(OUT s int)");
	$conn->query("BEGIN");
	$conn->query("SELECT COUNT(*) INTO s FROM user;");  
	$conn->query("END"); 
	$conn->query("//");  
	$conn->query("DELIMITER ;");*/
/*    $return ='{"success":true,"msg":'.$table.'}';
    $arr = array ('success'=>true,'msg'=>$table);
    echo json_encode($arr);  */
	$conn->close();
	//提示保存成功

}