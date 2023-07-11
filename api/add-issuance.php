<?php

$conn_d['davao']['type'] = 'sqlsrv';
$conn_d['davao']['host'] = '172.16.10.42\philsaga_db';
$conn_d['davao']['name'] = 'PMC-DAVAO';
$conn_d['davao']['uname'] = 'sa';
$conn_d['davao']['pword'] = '@Temp123!';

$conn_a['agusan']['type'] = 'sqlsrv';
$conn_a['agusan']['host'] = '172.16.20.42\agusan_db';
$conn_a['agusan']['name'] = 'PMC-AGUSAN-NEW';
$conn_a['agusan']['uname'] = 'sa';
$conn_a['agusan']['pword'] = '@Temp123!';

$result = '';

$empdata=array();

if(isset($_GET['emp'])){
	//bk
	// SELECT EmpID, FullName, LName, Active FROM ViewHREmpMaster WHERE Active = 1 AND EmpID LIKE ? OR LName LIKE ?
	//
	$emp = $_GET['emp'];
	$pdoempdata = new PDO($conn_a['agusan']['type'].":server=".$conn_a['agusan']['host'].";Database=".$conn_a['agusan']['name'], $conn_a['agusan']['uname'], $conn_a['agusan']['pword']);
	$pdoempdata->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	$empdatasql = $pdoempdata->prepare('SELECT e.EmpID, e.FullName, e.LName, e.Active, p.positiondesc, d.DeptDesc FROM ViewHREmpMaster AS e LEFT JOIN hrposition p ON p.PositionID=e.PositionID LEFT JOIN hrdepartment d ON d.deptid=e.deptid WHERE e.Active = 1 AND e.EmpID LIKE ? OR e.LName LIKE ?');
	//$empdatasql->bindValue(1, "%$emp%", PDO::PARAM_STR);
	$empdatasql->execute(array("%$emp%", "%$emp%"));

	for($i=0; $rowempdata = $empdatasql->fetch(); $i++){   
		$result .= "<li class='emp_li'><a href='#'>".$rowempdata['EmpID']." - ".$rowempdata['FullName'].'</a><span style="display:none;">'.$rowempdata['DeptDesc'].'</span></li>|';
	}

	$pdoempdata = new PDO($conn_d['davao']['type'].":server=".$conn_d['davao']['host'].";Database=".$conn_d['davao']['name'], $conn_d['davao']['uname'], $conn_d['davao']['pword']);
	$pdoempdata->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$empdatasql = $pdoempdata->prepare('SELECT e.EmpID, e.FullName, e.LName, e.Active, p.positiondesc, d.DeptDesc FROM ViewHREmpMaster AS e LEFT JOIN hrposition p ON p.PositionID=e.PositionID LEFT JOIN hrdepartment d ON d.deptid=e.deptid WHERE e.Active = 1 AND e.EmpID LIKE ? OR e.LName LIKE ?');
	//$empdatasql->bindValue(1, "%$emp%", PDO::PARAM_STR);
	$empdatasql->execute(array("%$emp%", "%$emp%"));

	for($i=0; $rowempdata = $empdatasql->fetch(); $i++){     
		$result .= "<li class='emp_li'><a href='#'>".$rowempdata['EmpID']." - ".$rowempdata['FullName'].'</a><span style="display:none;">'.$rowempdata['DeptDesc'].'</span></li>|';
	}
		echo $result;
}

if(isset($_GET['dept'])){

	$dept = $_GET['dept'];
	$pdoempdata = new PDO($conn_a['agusan']['type'].":server=".$conn_a['agusan']['host'].";Database=".$conn_a['agusan']['name'], $conn_a['agusan']['uname'], $conn_a['agusan']['pword']);
	$pdoempdata->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$empdatasql = $pdoempdata->prepare('SELECT DISTINCT DeptDesc FROM HRDepartment WHERE DeptDesc LIKE ? ');
	$empdatasql->bindValue(1, "%$dept%", PDO::PARAM_STR);
	$empdatasql->execute();

	for($i=0; $rowempdata = $empdatasql->fetch(); $i++){   
		$result .= "<li class='dept_li'><a href='#'>".$rowempdata['DeptDesc'].'</a></li>|';
	}
		echo $result;
}

    
?>

