<?php 

Route::get('/', ['as'=>'testing',function(){
   return view('test');
}]);

Route::get('redirect',function(){
   return redirect()->route('testing');
});



?>