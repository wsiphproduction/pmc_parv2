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
//$count = 0;
$emp = $_GET['emp_id'];

$empdata=array();
$pdoempdata = new PDO($conn_a['agusan']['type'].":server=".$conn_a['agusan']['host'].";Database=".$conn_a['agusan']['name'], $conn_a['agusan']['uname'], $conn_a['agusan']['pword']);
$pdoempdata->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$empdatasql = $pdoempdata->prepare("SELECT fullName, EmpID FROM ViewHREmpMaster WHERE Active = 0 AND EmpID = ? ");
$empdatasql->bindValue(1, "$emp", PDO::PARAM_STR);
$empdatasql->execute();

$empdatasql->setFetchMode(PDO::FETCH_ASSOC);
for($i=0; $rowempdata = $empdatasql->fetch(); $i++){
	$result .= $rowempdata['EmpID'].':'.$rowempdata['fullName'].'|';    
}


$pdoempdata = new PDO($conn_d['davao']['type'].":server=".$conn_d['davao']['host'].";Database=".$conn_d['davao']['name'], $conn_d['davao']['uname'], $conn_d['davao']['pword']);
$pdoempdata->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$empdatasql = $pdoempdata->prepare("SELECT fullName, EmpID FROM ViewHREmpMaster WHERE Active = 0 AND EmpID = ? ");
$empdatasql->bindValue(1, "$emp", PDO::PARAM_STR);
$empdatasql->execute();

$empdatasql->setFetchMode(PDO::FETCH_ASSOC);
for($i=0; $rowempdata = $empdatasql->fetch(); $i++){
	$result .= $rowempdata['EmpID'].':'.$rowempdata['fullName'].'|'; 
}
	
	echo rtrim($result,'|');

?>