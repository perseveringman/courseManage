<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2016-06-09 12:45:00
 * @version $Id$
 */

header("Content-Type: text/plain;charset=utf-8"); 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	search();
}
function search(){
	//TODO: 获取POST表单数据并保存到数据库
	$conn = new mysqli('localhost', 'root', '','studentManage');
	if(mysqli_connect_errno())
	{
	    echo mysqli_connect_error();
	}
	if(empty($_POST["StuID"])&&empty($_POST["cName"])){
		$sql ="SELECT * from search";
	}
	else if($_POST["StuID"]&&empty($_POST["cName"])){
		$sql = "SELECT * from search WHERE StuID = '".$_POST["StuID"]."'";
	}
	else if(empty($_POST["StuID"])&&$_POST["cName"]){
		$sql = "SELECT * from search WHERE cName = '".$_POST["cName"]."'";
	}
	else{
		$sql = "SELECT * from search WHERE StuID = '".$_POST["StuID"]."' AND cName = '".$_POST["cName"]."'";
	}
	$result = $conn->query($sql);
	if (!$result) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }

    $table='<thead>
				<tr>
					<th>StuID</th>
					<th>StuName</th>
					<th>StuMajor</th>
					<th>cID</th>
					<th>cName</th>
					<th>Grade</th>
					<th>Credits</th>
					<th>totalCredits</th>
				</tr>
			</thead>';

    while($row = mysqli_fetch_array($result,MYSQLI_NUM))
    {
        $table.='<tbody>';
        $table.='<tr>';
        $table.='<td>'.$row[0].'</td>';
        $table.='<td>'.$row[1].'</td>';
        $table.='<td>'.$row[2].'</td>';
        $table.='<td>'.$row[3].'</td>';
        $table.='<td>'.$row[4].'</td>';
        $table.='<td>'.$row[5].'</td>';
        $table.='<td>'.$row[6].'</td>';
        $table.='<td>'.$row[7].'</td>';
        $table.="</tr>";
        $table.='<tbody>';
    }
    $return ='{"success":true,"msg":'.$table.'}';
    $arr = array ('success'=>true,'msg'=>$table);
    echo json_encode($arr);  
    return;
	$conn->close();
	//提示保存成功

}