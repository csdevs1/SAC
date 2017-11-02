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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add/permissions/{role_id}', 'PermissionController@show');

#Permission
Route::post('/create/menu/permission', 'PermissionController@createPermission');
Route::post('/delete/menu/permission', 'PermissionController@deletePermission');
#end

#Tickets
Route::get('/support/tickets', 'TicketController@index');
Route::post('/create/ticket', 'TicketController@create');
Route::post('/update/ticket', 'TicketController@edit');
Route::get('/get/status/ticket', 'TicketController@getTicketsByStatus');
Route::get('/get/ticket/', 'TicketController@getTickets');
    //Checklist
    Route::get('/get/checklist/', 'TicketController@getTicketChecklist');
    Route::post('/create/checklist', 'TicketController@create_checklist');
    //Services
    Route::get('/get/ticket/service', 'TicketController@getTicketService');
    Route::post('/create/service', 'TicketController@create_service');
#end

#Vehicles
Route::get('/get/company/vehicles', 'VehicleController@get_by_company');
#End

#Company
Route::get('/get/company/groups', 'CompanyController@get_groups');
Route::get('/get/companies', 'CompanyController@get_companies');
#End

#Carrier
Route::get('/get/group/carriers', 'CarrierController@getCarrier');
#End

#Employees
Route::get('/get/company/employees', 'EmployeesController@get_by_company');
Route::get('/get/employee', 'EmployeesController@get_employee_info');
#End

#USERS
Route::get('/get/users', 'UserController@get');
Route::get('/get/user', 'UserController@getUserById');
Route::post('/edit/user', 'UserController@edit');
#END

#SAC
Route::get('/get/technicians', 'SacController@get');
Route::get('/get/sac', 'SacController@getTechnicianById');
Route::post('/edit/sac', 'SacController@edit');
#END

#GRAPH
Route::get('/reporte', 'GraphController@index');
Route::get('/graph/get/attention', 'GraphController@getNTicketByAttention');
Route::get('/graph/get/device', 'GraphController@getNTicketByDevice');
#END

Route::get('/roles', 'RoleController@show');
Route::get('/get/roles', 'RoleController@get');

Route::post('/api/submenu', 'MenuController@get_submenu');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
