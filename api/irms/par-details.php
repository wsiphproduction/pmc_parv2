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

$id = $_GET['id'];


$data=[];
$q="select * from is_detail where headerId='".$id."' order by id DESC";
$query = sqlsrv_query($conn,$q);
while($r = sqlsrv_fetch_array($query)){
    $data[]=$r;    
}
echo json_encode(utf8ize($data));
// echo json_last_error_msg(); 
?>