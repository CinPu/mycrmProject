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

Route::get('/',function (){
    $user_Emp=\App\user_employee::with("employee","user")->get();
    $ticket_admin=[];
    foreach ($user_Emp as $tikerAdmin){
        if($tikerAdmin->user->hasAnyRole("TicketAdmin")){
            array_push($ticket_admin,$tikerAdmin);
        }
    }
    return view('welcome',compact("ticket_admin"));
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
    Route::post("employee/update/{edit_type}/{emp_id}","employeeController@update");
    Route::get("/emp/delete/{emp_id}","employeeController@destroy");
    Route::get("/employee/tag/tickets","employeeController@tagticket");
    Route::post("/ticket/import","ticketController@ticktImport");
    Route::post("/employee/import","employeeController@emp_Import");
    Route::get("/agent/ticket","admin_agentController@agentTicket");
    Route::post("/employee/filter","employeeController@filterResult");
    Route::post("/dept/import","departmentController@import");
    Route::get("/engaged/company","companyController@engagedCompany");
    Route::post("client/company/create/{type}","companyController@create");
    Route::get("client/company/profile/{id}","companyController@profile");
    Route::get("client/company/delete/{id}","companyController@destory");
    Route::post("client/company/update/{id}","companyController@companyupdate");
    Route::get("/ticket/status/{status}","ticketController@dadbordCard");
    Route::post("/company/edit/{type}/{id}","companyController@update");
    Route::post("client/company/import","companyController@import");
    Route::get("customer_company/delete/{id}","companyController@delete");
    Route::get("client","clientController@index");
    Route::get("client/customer/create/{id}","clientController@create");
    Route::post("client/customer/create/","clientController@store");
    Route::post("client/customer/update/{id}","clientController@update");
    Route::get("/profile/{client_id}","clientController@show");
    Route::get("/client/delete/{id}","clientController@destroy");
    Route::post("client/search","clientController@filter");
    Route::get("/leads","leadController@index");
    Route::get("/lead/create","leadController@create");
    Route::post("lead/create","leadController@store");
    Route::post("/tags/create","leadController@tag_add");
    Route::get("lead/view/{lead_id}","leadController@show");
    Route::post("/lead/post/comment","leadController@comment");
    Route::get("lead/comment/delete/{id}","leadController@comment_delete");
    Route::post("/lead/follower/add/{id}","leadController@lead_follower");
    Route::post("/lead/update/{id}","leadController@update");
    Route::get("/lead/edit/{id}","leadController@edit");
    Route::get("/lead/delete/{id}","leadController@destroy");
    Route::get("/products","productController@index");
    Route::get("/product/create","productController@create");
    Route::post("/product/create","productController@store");
    Route::get("/product/edit/{id}","productController@edit");
    Route::post("product/update/{id}","productController@update");
    Route::get("/product/delete/{id}","productController@destroy");
    Route::post("/tax/create","productController@tax");
    Route::post("/cat/create","productController@category");
    Route::get("product/show/{id}","productController@show");
    Route::get("/product/duplicate/{id}","productController@duplicate");
    Route::post("/action/confirm","productController@action_confirm");
    Route::get("work/done/{id}","leadController@work_done");
    Route::get("/lead/qualified/{id}","leadController@qualified");
    Route::get("deal","dealController@index");
    Route::get("deal/add","dealController@create");
    Route::post("/deal/add/{type}","dealController@store");
    Route::post("deal/full/form/save","dealController@full_form");
    Route::post("/camping/add","dealController@camping");
    Route::get("/deal/edit/{id}","dealController@edit");
    Route::post("/deal/update/","dealController@update");
    Route::get("deal/show/{id}","dealController@show");
    Route::get('/chat', function () {
        return view('chat');
    });


});
Route::post("/user_info/create/{id}","userinfoController@store");
Route::get("/ticket/create/{id}","ticketController@create");
Route::post("/ticket/create/{id}","ticketController@store");
Route::get("/test",function (){
    return view("test");
});
Route::get("/hello","userinfoController@index");
