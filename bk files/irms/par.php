<?php
include("config.php");
$addqry="";
$offset=0;
if(isset($_GET['offset'])){
    $offset=$_GET['offset'];
}
$limit=20;
if(isset($_GET['limit'])){
    $limit=$_GET['limit'];
}
if(isset($_GET['searchon'])){
	if($_GET['searchtxt']<>''){
		$sea=$_GET['searchtxt'];
		$addqry.=" and (receiver like '%".$_GET['searchtxt']."%' OR receiverId like '%".$_GET['searchtxt']."%' OR controlNum like '%".$_GET['searchtxt']."%') ";
	}
	if($_GET['location']<>''){
		$loc=$_GET['location'];
		$addqry.=" and location like '%".$_GET['location']."%' ";
	}
}


$data=[];
$q="select (ISNULL(receiverId,'')+' - '+ISNULL(receiver,'')) as rec,CONVERT(varchar(23), docDate, 121) as ddate,* from is_header where isContractor<>1 ".$addqry." order by id DESC
OFFSET ".$offset." ROWS
FETCH NEXT ".$limit." ROWS ONLY;
";
$query = sqlsrv_query($conn,$q);
while($r = sqlsrv_fetch_array($query)){
    $data[]=$r;    
}
echo json_encode($data);
?>