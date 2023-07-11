<?php
$serverName = "172.16.20.28";

$connectionInfo = array( "Database"=>"PPE_TEST", "UID"=>"sa", "PWD"=>"@Temp123!" );
$conn = sqlsrv_connect( $serverName, $connectionInfo);
$config=sqlsrv_fetch_array(sqlsrv_query($conn,"select CONVERT(varchar(23), davao_last, 121) as davaol,CONVERT(varchar(23), agusan_last, 121) as agusanl, * from config where id=1"));
function refcode($n){		
	$r=strlen($n);
	$e=6 - $r;
	$z="";
	for($x=1;$x<=$e;$x++){
		$z.="0";
	}
	$refcode=$z.$n;
	return $refcode;
}

?>

