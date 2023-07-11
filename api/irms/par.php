<?php
include("config.php");

function utf8ize( $mixed ) {
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } elseif (is_string($mixed)) {
        return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
    }
    return $mixed;
}

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

// $q = "select (ISNULL(receiverId,'')+' - '+ISNULL(receiver,'')) as rec,CONVERT(varchar(23), docDate, 121) as ddate,* from is_header where isContractor <> 1 ".$addqry." order by h.id DESC
// OFFSET ".$offset." ROWS
// FETCH NEXT ".$limit." ROWS ONLY;
// ";

$q="select (ISNULL(h.receiverId,'')+' - '+ISNULL(h.receiver,'')) as rec,CONVERT(varchar(23), h.docDate, 121) as ddate, d.total_qty, * from is_header AS h LEFT JOIN (SELECT headerId, SUM(qty) as total_qty, SUM(qtyReleased) as total_released FROM is_detail group by headerId) as d on d.headerId = h.id where d.total_qty <> total_released and h.isContractor <> 1 ".$addqry." order by h.controlNum DESC OFFSET ".$offset." ROWS FETCH NEXT ".$limit." ROWS ONLY;
";
$query = sqlsrv_query($conn,$q);
while($r = sqlsrv_fetch_array($query)){
    $data[]=$r;    
}
echo json_encode(utf8ize($data));
// echo json_last_error_msg(); 
?>