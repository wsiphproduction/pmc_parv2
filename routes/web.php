<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Accounting Login routes
// Route::view('/accounting/login','auth.login_acc');
// Route::get('/accounting/logout','Auth\LoginController@acc_logout');
// Route::post('/acc/checklogin', 'Auth\LoginController@acc_checklogin');
// Route::view('/accounting/home','accounting.home');

Route::get('/', function(){
	return redirect('par/login');
});

// Dept Login Routes
Route::view('/dept/login','auth.login_acc');
Route::get('/dept/logout','Auth\LoginController@dept_logout');
Route::post('/dept/checklogin', 'Auth\LoginController@dept_checklogin');
Route::get('/dept/index','DeptController@index');

// MCD Login Routes
Route::get('/par/login', 'Auth\LoginController@index');
Route::post('/par/checklogin', 'Auth\LoginController@checklogin');
Route::get('/par/logout', 'Auth\LoginController@logout');


Route::group(['middleware' => 'authenticated'], function(){
	
	// Landing Routes
	Route::get('/landing','Par\ParController@landing');


	// PAR Routes
	Route::get('/dashboard','Par\ParController@dashboard');
	Route::get('/par/index','Par\ParController@index')->name('par.index');
	Route::get('/par/edit/{id}','Par\ParController@edit');
	Route::get('/par/recreate/{id}','Par\ParController@recreate');
	Route::get('/par/add','Par\ParController@create');
	Route::get('/par/print/{id}', 'Par\ParController@print');
	//Route::get('/transfer/accountability','Par\ParController@transfer');
	Route::get('par/index',['as' => 'par/index', 'uses' => 'Par\ParController@index']);

	Route::get('/{id}/accountability','Par\ParController@items_per_employee');
	Route::post('/par/store', 'Par\ParController@store');
	Route::post('/par/update', 'Par\ParController@update');
	Route::post('/par/adjustments', 'Par\ParController@adjustments');
	Route::get('/par/details/{par_id}','Par\ParController@details');
	Route::post('/par/post','Par\ParController@post');
	Route::post('/par/close', 'Par\ParController@close_par');
	Route::post('/par/item/close','Par\ParController@close_item');
	Route::post('/par/transfer-item/auto','Par\ParController@auto_transfer_item');
	//Route::post('/par/transfer-item/manual','Par\ParController@manual_transfer_item');
	Route::post('/par/file-upload','FileController@fileUpload');
	Route::post('/copyFile','FileController@copyFile');
	Route::post('/par-item/delete', 'Par\ParController@item_delete');
	Route::post('/par/multiple/par', 'Par\ParController@multiple_transfer')->name('multiple.par');
	


	// Maintenance Routes
	Route::get('/maintenance/user','Maintenance\UserController@user');
	Route::post('/update/account','Maintenance\UserController@update_account');
	Route::post('/upload/avatar','Maintenance\UserController@upload_avatar');
	// Route::post('/user/lock','Maintenance\UserController@lock');
	// Route::post('/user/unlock','Maintenance\UserController@unlock');
	Route::post('/user/deactivate','Maintenance\UserController@deactivate');
	Route::post('/user/activate','Maintenance\UserController@activate');
	Route::post('/user/add','Maintenance\UserController@add');
	Route::post('/user/update','Maintenance\UserController@update');
	Route::get('/maintenance/stock-code','Item\ItemController@stock_code');
	Route::get('/maintenance/data','Maintenance\DataController@data_index');

	// Inv Code
	Route::post('/close_type/add', 'Maintenance\DataController@close_type_add');
	Route::post('/close_type/update', 'Maintenance\DataController@close_type_update');
	Route::post('/close_type/delete', 'Maintenance\DataController@close_type_delete');
	// Stock Type
	Route::post('/stock_type/add', 'Maintenance\DataController@stock_add');
	Route::post('/stock_type/update', 'Maintenance\DataController@stock_update');
	Route::post('/stock_type/delete', 'Maintenance\DataController@stock_delete');
	// Dept Code
	Route::post('/dept/add', 'Maintenance\DataController@dept_add');
	Route::post('/dept/update', 'Maintenance\DataController@dept_update');
	Route::post('/dept/delete', 'Maintenance\DataController@dept_delete');
	
	


	// Item Routes
	Route::get('/item/add','Item\ItemController@add');
	Route::post('/item/save','Item\ItemController@save');
	Route::get('/item/details/{item_id}','Item\ItemController@details');
	Route::get('/item/ajax','Item\ItemAjaxController@search');
	Route::get('/item/generate_serials','Item\AjaxController@generate_serials');
	Route::get('/item/ppe','Item\AjaxController@ppe');
	//Route::get('/item/list','Item\ItemController@index');
	Route::get('/item/non-stock','Item\ItemController@non_stock');
	Route::get('/item/edit/{id}','Item\ItemController@edit');
	Route::post('/item/update','Item\ItemController@update');

	Route::get('/create/item/{stock_code}','Item\ItemController@create_item');
	Route::post('/item/store','Item\ItemController@store');
	Route::post('/item/delete','Item\ItemController@item_delete');

	Route::get('/item/stocked','Item\ItemController@stocked');
	Route::post('/create/stock-code','Item\ItemController@create_stock_code');
	Route::post('/delete/stock-code','Item\ItemController@delete_stock_code');
	Route::post('/upload/stocked_items', 'FileController@upload_stocked_items');
	Route::post('/upload/ppe_items', 'FileController@upload_ppe_items');
	


	//Email Routes
	Route::post('/item/email/open-item', 'EmailController@email_open_item');
	Route::post('/par/email/details', 'EmailController@email_par_details');
	// Route::post('/par/email/unpost', 'EmailController@email_unpost_par');
	


	// Approver Routes
	Route::get('/par/request/details/{id}','ApproverController@get_par_details');
	Route::get('/item/request/details/{id}','ApproverController@get_item_details');
	Route::post('/request/item/disapproved','ApproverController@item_disapproved');
	Route::post('/request/par/disapproved','ApproverController@par_disapproved');
	Route::post('/request/item/approved','ApproverController@item_approved');
	Route::post('/request/par/approved','ApproverController@par_approved');
	Route::resource('approver','ApproverController');
	


	// Ajax Filter / Search Routes
	Route::get('/par/search-items-to-transfer','SearchController@search_items_to_transfer');
	Route::get('/search/items','SearchController@items_to_par');

	Route::get('/filter/stock-items','SearchController@filter_stock_code_masterfile')->name('post');
	Route::get('/filter/saved-stock-items','SearchController@filter_saved_stock_items')->name('post');
	Route::get('/filter/saved-nonstock-items','SearchController@filter_saved_nonstock_items')->name('post');
	Route::get('/filter/par-list','SearchController@filter_par_list')->name('post');
	//Route::get('/search/stocked-items','SearchController@stocked_items');

	//Route::get('/search/stock','SearchController@stock_code');
	


	// Report Routes
	Route::get('/report/par-summary','Reports\ReportController@index');
	Route::get('/report/add-note-par-summary/{id}','Reports\ReportController@notes')->name('notes');

	Route::get('/report/contractor','Reports\ReportController@contractor');
	//Route::get('/report/department','Reports\ReportController@par_department');
	//Route::get('/report/personnel','Reports\ReportController@par_personnel');
	//Route::view('/report/items_without_par','reports.items-without-par');
	//Route::view('/report/par-status','reports.par_status');
	


	// Export Routes
	Route::get('/export/items_without_par/{category}','Reports\ExportController@items_without_par');
	

	Route::get('/export/personnel/{from}/{to}','Reports\ExportController@personnel_par');
	Route::get('/export/per-personnel/{emp}/{from}/{to}','Reports\ExportController@per_personnel_par');
	Route::get('/export/common/{from}/{to}','Reports\ExportController@department_par');
	Route::get('/export/per-common/{dept}/{from}/{to}','Reports\ExportController@per_department_par');
	Route::get('/export/doc/{status}/{from}/{to}','Reports\ExportController@doc_status');
	Route::get('/export/item/{status}/{from}/{to}','Reports\ExportController@item_status');
	


	// Ajax Router : Report Generator
	Route::get('/ajax/par_summary_report','Reports\AjaxController@ajax_par_summary_report')->name('post');

	Route::get('/ajax/items_without_par','Reports\AjaxController@ajax_items_without_par')->name('post');
	Route::get('/report/ajax_personnel','Reports\AjaxController@ajax_par_personnel')->name('post');
	Route::get('/ajax/get_department','Reports\AjaxController@ajax_par_department')->name('post');
	Route::get('/ajax/par_status','Reports\AjaxController@ajax_par_status')->name('post');
 

	Route::get('/irms/index','irms\IrmsController@index');
	Route::get('/process-irms/{id}/{emp}','irms\IrmsController@process');
	Route::post('/ppe/store', 'irms\IrmsController@store');


	// Accounting routes
	// Route::get('/accounting/item-verification','AccountingController@item_verification')->name('item_verification');
	// Route::get('/item/verify/{id}','AccountingController@item_verify');
	// Route::post('/item/verify','AccountingController@verify');
	// Route::post('/item/modal-verify','AccountingController@modal_verify');


	// Contractor Routes
	Route::get('/maintenance/contractor','Maintenance\ContractorController@index');
	Route::post('/contractor/store','Maintenance\ContractorController@store');
	Route::post('/upload/contractors', 'FileController@upload_contractors');

	// Dept Routes
	Route::get('/dept/par/list', 'DeptController@index');

});
	Route::get('/par/transaction-details/{id}','Par\ParController@transaction_details');

	Route::get('/par/details/print/{id}','ApproverController@print');

	Route::post('/employee/fetch', 'SearchController@fecth_employee')->name('employee.fetch');
	Route::post('/accountable/fetch', 'SearchController@fecth_accountable')->name('accountable.fetch');
	Route::post('/item/fetch', 'SearchController@fetch_item')->name('item.fetch');
	Route::post('/department/fetch', 'SearchController@fetch_department')->name('department.fetch');
	Route::post('/api/dept', 'SearchController@api_department')->name('api.dept');
	Route::post('/api/contractor', 'SearchController@api_contractor')->name('api.contractor');
	
	Route::post('/seial/check', 'SearchController@serial_check')->name('serial.check');
	Route::post('/api/department/fetch', 'SearchController@api_department')->name('api.department.fetch'); // search department on edit par
	Route::get('/par/view','Par\ParController@history')->name('par.view');
	Route::get('/par/preview/{id}','Par\ParController@history')->name('par.preview');
?>














