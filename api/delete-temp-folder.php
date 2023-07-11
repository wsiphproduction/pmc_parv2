<?php 

$path = '../storage/app/public';
$date = date('Y-m-d');
$dirs = glob( $path. '/*' , GLOB_ONLYDIR);
foreach($dirs as $dir){
	if($path."/".$date != $dir){
		$dirPath = $dir;
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
		    $dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
		    if (is_dir($file)) {
		        self::deleteDir($file);
		    } else {
		        unlink($file);
		    }
		}
		rmdir($dirPath);
	}
}
 ?>