<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $alluser=\App\User::all();
    $admins=[];
    foreach ($alluser as $user){
        if($user->hasAnyRole("Admin")){
            array_push($admins,$user);

        }
    }
    return view('welcome',compact("admins"));
});

Auth::routes();
Route::group(['middleware'=>'auth'],function () {
    Route::get("/logout", "Auth\LoginController@logout");
    Route::get('/home', 'HomeController@index');
    Route::get("/ticket/dashboard","ticketController@dashboard");
    Route::get("/company/profile","companyController@index");
    Route::post("/company/profile","companyController@store");
    Route::post("/role/assign/{uid}", "RolemangeControllerController@insertRole");
    Route::post("/role/remove/{uid}", "RolemangeControllerController@removeRole");
    Route::get("/department", "departmentController@index");
    Route::post("/dept/create", "departmentController@store");
    Route::post("/dept/edit/{id}", "departmentController@update");
    Route::get("/dept/delete/{id}", "departmentController@destroy");
    Route::post("/department/change/{id}", "departmentController@dept_change");
    Route::get("/agent", "admin_agentController@index");
    Route::post("/agent/create", "admin_agentController@store");
    Route::get("/delete/agent/{id}", "admin_agentController@destroy");
    Route::get("/case_type", "case_typeController@index");
    Route::post("/case_type/create", "case_typeController@store");
    Route::post("/case_type/update/{id}", "case_typeController@update");
    Route::get("case_type/delete/{id}", "case_typeController@destroy");
    Route::get("/priority", "priorityController@index");
    Route::post("/priority/create", "priorityController@store");
    Route::post("/priority/update/{id}", "priorityController@update");
    Route::get("priority/delete/{id}", "priorityController@destroy");
    Route::get("/tickets/{ticket_id}","ticketController@show");
    Route::get("/status/change/{ticket_id}","ticketController@statusChange");
    Route::post("/assign","ticketController@assigned");
    Route::post("/reassigned","ticketController@reassign");
    Route::get("/countdown/{ticket_id}","ticketController@countdown");
    Route::post("comment","ticketController@postcomment");
    Route::get("/agent/detail/{id}","admin_agentController@agentDetail");
    Route::get("/isassign/{name}","assignticketController@isassign");
    Route::get("/piechart","piechartController@index");
    Route::post("/search","piechartController@filterBy");
    Route::get("/dept/showmember/{id}","departmentController@showMember");
    Route::get("/guestUser","userinfoController@index");
    Route::get("/guestuser/sending/{id}","userinfoController@sendinghistory");
    Route::get("/comment/delete/{id}","ticketController@cmtDelete");
    Route::get("/user/setting","admin_agentController@setting");
    Route::post("/user/setting","admin_agentController@agentInfo_update");
    Route::get("/pp/change","admin_agentController@ppchange");
    Route::post("pp/change","admin_agentController@profileChange");
    Route::post("/ticket/search","searchController@ticket");
    Route::get("/employee","employeeController@index");
    Route::post("/employee/create","employeeController@store");
    Route::post("/dept/head/{id}","departmentController@set_dept_head");
    Route::get("/role","RolemangeControllerController@index");
    Route::post("/add/follower/{id}","ticketController@follower");
    Route::get("/follower/remove/{id}","ticketController@removefollower");
    Route::get("/emp/profile/{emp_id}","employeeController@profile");
    Route::get("/emp/edit/{emp_id}","employeeController@edit");
    Route::post("/emp/edit/{emp_id}","employeeController@update");
    Route::get("/emp/delete/{emp_id}","employeeController@destroy");
    Route::get("/employee/tag/tickets","employeeController@tagticket");
    Route::post("/ticket/import","ticketController@ticktImport");
    Route::post("/employee/import","employeeController@emp_Import");
    Route::get("/agent/ticket","admin_agentController@agentTicket");


});
Route::post("/user_info/create/{id}","userinfoController@store");
Route::get("/ticket/create/{id}","ticketController@create");
Route::post("/ticket/create/{id}","ticketController@store");
Route::get("/test",function (){
    return view("test");
});
Route::get("/hello","userinfoController@index");
