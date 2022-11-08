<?php
use App\Http\Controllers\AddBookingAdmin;
use App\Http\Controllers\AddBookingStaff;
use App\Http\Controllers\AddBookingUserout;
use App\Http\Controllers\AdminFullcalendar;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalReqController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\HistoryAdmin;
use App\Http\Controllers\LocaiotnManageSuperAdmin;
use App\Http\Controllers\loginAdmin\AuthAdminController;
use App\Http\Controllers\loginOutsider\AuthOutsiderController;
use App\Http\Controllers\RequestAdminController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RequestStaffController;
use App\Http\Controllers\SSO\LoginSSO;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserManageSuperAdmin;
use App\Http\Controllers\user_out\User_RequestController;
use App\Http\Controllers\vice_admin\Vice_RequestController;
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
    
    
        return view('indexpage');
    
    
});

//เปลี่ยนหน้า

Route::post('/user-do-login', [AuthOutsiderController::class, "doLogin"])->name('login_outsider');
Route::post('/doRegisterUser', [AuthOutsiderController::class, "doRegister"])->name('registerUser');

Route::get('/user/register', [AuthOutsiderController::class, "register"])->name('register_outsider');
Route::get('/user/register/finish', [AuthOutsiderController::class, "oldregister"])->name('oldregister');



Route::get('/indexuser', [AuthOutsiderController::class, 'index'])->name('indexuser');

//user ภายนอกส่ง data
Route::get('/addbooking/', [AddBookingUserout::class, 'index'])->name('add-booking');
Route::get('/addbooking/{id}', [AddBookingUserout::class, 'edit']);
Route::post('/addbooking/add', [AddBookingUserout::class, 'store'])->name('booking-add');

//คำนวณราคาห้อง
Route::get('/calculate/', [CalReqController::class, 'index'])->name('cal-user');
Route::get('/calculate/user/{id}', [CalReqController::class, 'edit']);
Route::post('/calculate/add', [CalReqController::class, 'index2'])->name('cal-add');
Route::get('/search_location', [LocaiotnManageSuperAdmin::class, 'index2'])->name('search');

//Outsider

Route::get('fullcalender2/{id}', [AddBookingUserout::class, 'index2']);
Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);
Route::resource('/booking', FullCalenderController::class);
Route::get('fullcalender/', [FullCalenderController::class, 'index']);

/////staff///////////////////////////////////////////////////////////////////////////

// login staff
Route::get('/staff_login', [AuthController::class, "LoginView"])->name('stafflogin');
Route::post('/do-login', [AuthController::class, "doLogin"]);
Route::post('/do-register', [AuthController::class, "doRegister"]);
Route::get('/dashboard', [AuthController::class, "dashboard"])->name('staff-dashboard');
Route::get('/logout', [AuthController::class, "logout"]);

//จัดการคำขอ

Route::get('/request_staff', [StaffController::class, 'requeststaff'])->name('staff-request');
Route::post('/request_staff/update/{id}', [StaffController::class, 'update']);
Route::get('/location_staff', [StaffController::class, "location"])->name('staff-location');

//เพิ่มการจอง staff

Route::get('/addbookingastaff/', [AddBookingStaff::class, 'index'])->name('add-bookingstaff');
Route::get('/addbookingastaff/{id}', [AddBookingStaff::class, 'edit']);
Route::post('/addbookingstaff/add', [AddBookingStaff::class, 'store'])->name('booking-addstaff');
Route::get('fullcalenderstaff/{id}', [AddBookingStaff::class, 'index2']);

//request me

Route::get('/request/staff/', [RequestStaffController::class, 'index'])->name('request-staff');

//history
Route::get('/staff/history', [HistoryAdmin::class, 'index3'])->name('staff_history_index');
Route::get('/staff/historyreq', [HistoryAdmin::class, 'index4'])->name('staff_history_req');

/////staff///////////////////////////////////////////////////////////////////////////

/////admin///////////////////////////////////////////////////////////////////////////

//adminlogin

// admin
Route::get('/admin_login', [AuthAdminController::class, "LoginView"])->name('adminlogin');
Route::post('/admin-do-login', [AuthAdminController::class, "doLogin"]);
Route::post('/admin-do-register', [AuthAdminController::class, "doRegister"]);

Route::get('/admin_dashboard', [AuthAdminController::class, "dashboard"])->name('admin-dashboard')->middleware('Stafftest');

Route::get('/admin_logout', [AuthAdminController::class, "logout"]);

//จััดการ  user
Route::get('/usermanage', [UserManageSuperAdmin::class, 'index'])->name('user-manage');
Route::post('/usermanage/update/{id}', [UserManageSuperAdmin::class, 'update']);
Route::post('/usermanage/updateadmin/{id}', [UserManageSuperAdmin::class, 'updateadmin']);
Route::get('/usermanage/delete/{id}', [UserManageSuperAdmin::class, 'delete']);
Route::get('/usermanage/deleteadmin/{id}', [UserManageSuperAdmin::class, 'deleteAdmin']);



//จัดการห้อง
Route::get('/locationmanage/', [LocaiotnManageSuperAdmin::class, 'index'])->name('location-manage');
Route::post('/locationmanage/add', [LocaiotnManageSuperAdmin::class, 'store'])->name('location-manage-add');
Route::get('/locationmanage/delete/{id}', [LocaiotnManageSuperAdmin::class, 'delete']);
Route::post('/locationmanage/update/{id}', [LocaiotnManageSuperAdmin::class, 'update']);

//admin จัดการคำขอ
Route::get('/request/superadmin', [RequestController::class, 'index'])->name('request-manage');
Route::post('/request/update/{id}', [RequestController::class, 'update']);
Route::get('/request/delete/{id}', [RequestController::class, 'delete']);

Route::post('/request/updatereq/{id}', [RequestController::class, 'updatereq'])->name('updatereq');
//sendemail
Route::post('/sendmail/update/{id}', [EmailController::class, 'sendEmailNew'])->name('addlist');

//vice_admin

//vice_admin จัดการคำขอ
Route::get('/request/vice_admin', [Vice_RequestController::class, 'index'])->name('request_vice');
Route::post('/request/vice_admin/update/{id}', [Vice_RequestController::class, 'update']);
//user_out คำขอของฉัน
Route::get('/request/user', [User_RequestController::class, 'index'])->name('request_user');
Route::get('/request/detail/{id}', [User_RequestController::class, 'detail']);

//staff เพิ่มผู้ดูแลระบบ

Route::get('/manage/staff', [StaffController::class, 'index'])->name('staff_add');
Route::get('/manage/delete/{id}', [StaffController::class, 'delete']);
Route::post('/manage/addrole', [StaffController::class, 'store'])->name('addrole_staff');
Route::get('/manage/deleteatten/{id}', [StaffController::class, 'deleteatten']);

Route::get('/manage/history', [HistoryAdmin::class, 'index'])->name('history_index');
Route::get('/manage/historyreq', [HistoryAdmin::class, 'index2'])->name('history_req');

//เพิ่มการจอง admin

Route::get('/addbookingadmin/', [AddBookingAdmin::class, 'index'])->name('add-bookingadmin');
Route::get('/addbookingadmin/{id}', [AddBookingAdmin::class, 'edit']);
Route::post('/addbookingadmin/add', [AddBookingAdmin::class, 'store'])->name('booking-addadmin');
Route::get('fullcalenderadmin/{id}', [AddBookingAdmin::class, 'index2']);

//Request Admin
Route::get('/request/admin/', [RequestAdminController::class, 'index'])->name('request-admin');

//calendar ทั้งหมด
Route::get('/calendar/admin/', [AdminFullcalendar::class, 'index'])->name('calendar-admin');
Route::get('/calendar/admin/{id}', [AdminFullcalendar::class, 'edit']);

//
Route::get('fullcalenderadmin/', [FullCalenderController::class, 'indexadmin']);
//

//calendar
Route::get('findcalender1/{id}', [AdminFullcalendar::class, 'index2']);
Route::get('findcalender0/{id}', [AdminFullcalendar::class, 'index3']);

Route::get('adminfullcalender1/{id}', [AddBookingUserout::class, 'index3']);

Route::get('adminfullcalender0/{id}', [AddBookingUserout::class, 'index4']);

/////admin///////////////////////////////////////////////////////////////////////////

//sso

Route::get('/asc-login/', [LoginSSO::class, 'index'])->name('sso-login');
Route::get('/sls-logout/', [LoginSSO::class, 'logout'])->name('sso-logout');
