<?php
$serverName = "172.16.20.43";
$connectionInfo = array( "Database"=>"PPE_ISSUANCE", "UID"=>"app_ppeissuance", "PWD"=>"Gai5huxe" );
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$config = sqlsrv_fetch_array(sqlsrv_query($conn,"select CONVERT(varchar(23), davao_last, 121) as davaol,CONVERT(varchar(23), agusan_last, 121) as agusanl, * from config where id=1"));

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

