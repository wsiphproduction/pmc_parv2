<?php

$conn_d['davao']['type'] = 'sqlsrv';
$conn_d['davao']['host'] = '172.16.10.42\philsaga_db';
$conn_d['davao']['name'] = 'PMC-DAVAO';
$conn_d['davao']['uname'] = 'sa';
$conn_d['davao']['pword'] = '@Temp123!';

//Added by AAG 01/31/2018 for 201 Records of Employees from Agusan
$conn_a['agusan']['type'] = 'sqlsrv';
$conn_a['agusan']['host'] = '172.16.20.42\agusan_db';
$conn_a['agusan']['name'] = 'PMC-AGUSAN-NEW';
$conn_a['agusan']['uname'] = 'sa';
$conn_a['agusan']['pword'] = '@Temp123!';

$result = '';


$pdoempdata = new PDO($conn_d['davao']['type'].":server=".$conn_d['davao']['host'].";Database=".$conn_d['davao']['name'], $conn_d['davao']['uname'], $conn_d['davao']['pword']);
$pdoempdata->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$empdatasql = $pdoempdata->prepare("SELECT * FROM HRDepartment ORDER BY DeptID ASC");

$empdatasql->execute();
$empdatasql->setFetchMode(PDO::FETCH_ASSOC);

for($i=0; $rowempdata = $empdatasql->fetch(); $i++){     
	$result .= '<option value="'.$rowempdata['DeptDesc'].'" >'.$rowempdata['DeptDesc'].'<option>';
}

	echo $result;
?>

