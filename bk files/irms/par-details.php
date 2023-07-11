<?php
include("config.php");
$id = $_GET['id'];


$data=[];
$q="select * from is_detail where headerId='".$id."' order by id DESC";
$query = sqlsrv_query($conn,$q);
while($r = sqlsrv_fetch_array($query)){
    $data[]=$r;    
}
echo json_encode($data);
?>