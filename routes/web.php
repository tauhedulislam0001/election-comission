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

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\User\CarBookController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SingleTripController as SingleTripRentController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\BeAgentController;
use App\Http\Controllers\BookingManagement\GetFare\Edit\RoundTripEditFareController;
use App\Http\Controllers\BookingManagement\GetFare\Edit\SingleTripEditFareController;
use App\Http\Controllers\BookingManagement\GetFare\RoundTripFareController;
use App\Http\Controllers\BookingManagement\GetFare\SingleTripFareController;
use App\Http\Controllers\BookingManagement\StoreBooking\BookingUpdate\RoundTripUpdateController;
use App\Http\Controllers\BookingManagement\StoreBooking\CarRentalController;
use App\Http\Controllers\BookingManagement\StoreBooking\RoundTripBookingController;
use App\Http\Controllers\BookingManagement\StoreBooking\SingleTripBookingController;
use App\Http\Controllers\RoundTripController;
use App\Http\Controllers\Frontend\Session\SessionController;



//=======================================================================================================//
//=======================================================================================================//
//=======================================================================================================//
//=======================================================================================================//

Route::get('/', [FrontendController::class, 'getIndex'])->name('welcome');
Route::get('/visit-site', [FrontendController::class, 'visitSite'])->name('visit-site');

//=================== Frontend Controller Bangla ===================

Route::get('/admin-login', [AdminController::class, 'index'])->name('adminuser.login');
// Route::post('/login', [AdminController::class, 'authenticate'])->name('adminuser.login');
Route::post('/user-login', [AdminController::class, 'authenticate'])->name('adminuser.login');

//=================== admin middleware ===================

// Route::group(['prefix' => 'admin/'], function () {
Route::group(['middleware' => 'admin.guest'], function () {

    //=================== Guest Route ===================

});

//=================== Backend Route Start From here ===================

Route::group(['middleware' => 'admin.auth'], function () {

    //=================== Admin Logout ===================

    Route::post('user/logout', [FrontendController::class, 'logout'] )->name('user.logout');

    //=================== Dashboard Controller ===================

    Route::get('home', [DashboardController::class, 'getIndex'])->name('admin.dashboard');

    //=================== Admin Profile Controller ===================

    Route::get('user/profile', [AdminProfileController::class, 'getIndex'])->name('admin.profile');
    Route::post('user/profile/update-profile', [AdminProfileController::class, 'postUpdateProfile'])->name('admin.update-profile');
    Route::post('user/profile/update-profile-picture/', [AdminProfileController::class, 'postUpdateProfilePicture'])->name('admin.update-picture');
    Route::get('user/profile/remove/profile-picture', [AdminProfileController::class, 'getRemovePicture'])->name('admin.remove-picture');
    Route::get('user/change-password', [AdminProfileController::class, 'getEditPassword'])->name('admin.change-password');
    Route::post('user/change-password/update', [AdminProfileController::class, 'postUpdatePassword'])->name('admin.change-password.update');

    Route::get('user-info/update', [AdminProfileController::class, 'agentInfoUpdate'])->name('agent-info.update');    //agent user info update 
 
    //=================== Permission Controller ===================

    Route::resource('permissions', 'Admin\PermissionsController');

    //=================== Role Controller ===================

    Route::resource('roles', 'Admin\RolesController');

    //=================== Service Provider Controller ===================

    Route::resource('serviceProviders', 'Admin\ServiceProvidersController');


    Route::get('all/admin-users', [AdminUserController::class, 'getIndex'])->name('admin-users.index');
    Route::get('admin-users/create', [AdminUserController::class, 'getCreate'])->name('admin-users.create');
    Route::post('admin-users/store', [AdminUserController::class, 'postStore'])->name('admin-users.store');
    Route::get('admin-users/edit/{id}', [AdminUserController::class, 'getEdit'])->name('admin-users.edit');
    Route::post('admin-users/update/{id}', [AdminUserController::class, 'postUpdate'])->name('admin-users.update');
    Route::get('admin-users/delete/{id}', [AdminUserController::class, 'getDestroy'])->name('admin-users.destroy');
    Route::get('admin-users/disable/{id}', [AdminUserController::class, 'inActive'])->name('admin-users.inactive');
    Route::get('admin-users/enable/{id}', [AdminUserController::class, 'active'])->name('admin-users.active');

    //=================== User Controller ===================

    Route::get('all/user', [UserController::class, 'getIndex'])->name('user.index');
    Route::get('user/create', [UserController::class, 'getCreate'])->name('user.create');
    Route::post('user/store', [UserController::class, 'postStore'])->name('user.store');
    Route::get('user/edit/{id}', [UserController::class, 'getEdit'])->name('user.edit');
    Route::post('user/update/{id}', [UserController::class, 'postUpdate'])->name('user.update');
    Route::get('user/delete/{id}', [UserController::class, 'getDestroy'])->name('user.destroy');
    Route::get('user/disable/{id}', [UserController::class, 'inActive'])->name('user.inactive');
    Route::get('user/enable/{id}', [UserController::class, 'active'])->name('user.active');
    Route::get('user/credit/{id}', [UserController::class, 'getCreditForm'])->name('user.credit');

    //=================== Message Controller ===================

    Route::get('all/message', [MessageController::class, 'index'])->name('message.index');
    Route::get('message/create', [MessageController::class, 'create'])->name('message.create');
    Route::post('message/store', [MessageController::class, 'store'])->name('message.store');
    Route::get('message/view/{id}', [MessageController::class, 'view'])->name('message.view');
    Route::post('message/update/{id}', [MessageController::class, 'update'])->name('message.update');
    Route::get('message/delete/{id}', [MessageController::class, 'destory'])->name('message.destroy');
    Route::get('message/disable/{id}', [MessageController::class, 'inActive'])->name('message.inactive');
    Route::get('message/enable/{id}', [MessageController::class, 'active'])->name('message.active');
    
});

Auth::routes();
//=================== BeAgent Controller ===================

Route::get('/beagent', [BeAgentController::class, 'index'])->name('beagent');
Route::get('/divTodistrict', [BeAgentController::class, 'get_disitrict_by_division'])->name('divTodistrict');
Route::get('/district2thana', [BeAgentController::class, 'get_district2thana'])->name('district2thana');
Route::get('/country2airlines', [BeAgentController::class, 'country2airlines'])->name('country2airlines');


//=================== Agent Register Controller ===================

Route::get('SingleFair', 'AgentRegisterController@get_single_trip_fair')->name('SingleFair');
Route::get('RoundFair', 'AgentRegisterController@get_round_trip_fair')->name('RoundFair');
Route::get('dSingleFair', 'AgentRegisterController@get_dsingle_trip_fair')->name('dSingleFair');
Route::post('agentSingupForm', 'AgentRegisterController@store')->name('agentSingupForm');
Route::post('carBookForm', 'AgentRegisterController@carBooking')->name('carBookForm');
Route::get('carBookFormNext', 'AgentRegisterController@carBookingStep2')->name('carBookingStep2');
Route::post('storeCarBooking', 'AgentRegisterController@storeCarBooking')->name('storeCarBookForm');
Route::post('storeRoundCarBooking', 'AgentRegisterController@storeRoundTripCarBooking')->name('storeRoundCarBookForm');
Route::get('completeCarBooking', 'AgentRegisterController@completeCarBooking')->name('completeCarBookForm');
// Route::get('/tnc', 'AgentRegisterController@tnc')->name('tnc');

//=================== RoundTripFare Controller ===================
Route::post('/verify/round-strip/fare', [RoundTripFareController::class, 'verifyRoundTripFair'])->name('round-trip.verify-fare');

//=================== RoundTrip Booking Controller ===================
Route::post('/store-booking/round/trip', [RoundTripBookingController::class, 'store'])->name('round-trip.booking');

//=================== SingleTripFare Controller ===================
Route::post('/verify/single-strip/fare', [SingleTripFareController::class, 'verifySingleTripFair'])->name('single-trip.verify-fare');

//=================== SingleTrip Booking Controller ===================
Route::post('/store-booking/single/trip', [SingleTripBookingController::class, 'store'])->name('single-trip.booking');

//=================== Session Controller ===================

Route::post('session', 'AgentRegisterController@session')->name('session');
Route::post('customers/register', [CustomerController::class, 'postCustomerRegister'])->name('customer.register');

//=================== Single Trip Controller ===================

Route::post('single/trip/fair', [SingleTripRentController::class, 'get_single_trip_fair_controller']);

//=================== Single Trip Service Provider Status Controller ===================

Route::post('single-trip/service-provider/assign/{id}', [SingleTripServiceProviderStatusController::class, 'assignProvider'])->name('assign-provider');

//=================== Round Trip Controller ===================

Route::post('round/trip/fair', [RoundTripController::class, 'get_round_trip_fair_controller'])->name('roundTripFare');

//=================== Car Rental Booking Controller ===================

Route::post('car-rental/store/booking', [CarRentalController::class, 'store'])->name('car-rental.store');
Route::post('car-rental/pay_now/booking', [CarRentalController::class, 'update']);


//=======================================================================================================//
//=======================================================================================================//
//=======================================================================================================//
//=======================================================================================================//

//  Vue Js Frontend Controller
Route::get('get/airport/vue', [AirportVueController::class, 'index'])->name('GetAirportVue');
Route::get('get/division/vue', [DivisionVueController::class, 'index'])->name('GetDivisionVue');
Route::post('get/district/vue', [DistrictVueController::class, 'index'])->name('GetDistrictVue');
Route::post('get/all/district/vue', [DistrictVueController::class, 'AllDistrict']);
Route::post('get/thana/vue', [ThanaVueController::class, 'index'])->name('GetThanaVue');
Route::get('get/city/vue', [ThanaVueController::class, 'city']);
Route::post('get/PickupLocation/vue', [ThanaVueController::class, 'PickupLocationVue']);

// Select Currency 
Route::post('/select/currency',[SessionController::class,'SelectCurrency']);

// SingleTrip  Submit 
Route::post('/submit/singletrip',[SessionController::class,'SingleTrip']);
Route::post('/submit/roundtrip',[SessionController::class,'RoundTrip']);
Route::post('/submit/multicity',[SessionController::class,'MultiCity']);
Route::get('/single/trip/value',[SessionController::class,'SingleTripValue']);
Route::get('/single/trip/summery',[SessionController::class,'SingleTripSummery']);
Route::post('/single/trip/date/change',[SessionController::class,'SingleTripDateChange']);
Route::post('/bookig/car/info/save',[SessionController::class,'bookingCarInfoSave']);
Route::get('/passenger/dettails/page/summery',[SessionController::class,'PDPSummery']);
Route::post('/passenger/dettails/save',[SessionController::class,'PassengerDetailsSave']);
Route::get('departure/airport/get', [SessionController::class, 'DepartureAirport']);
Route::post('get/ailines/vue', [SessionController::class, 'GetAirlines']);
Route::post('get/all/ailines/vue', [SessionController::class, 'GetAllAirlines']);
Route::get('get/car/vue', [SessionController::class, 'GetCar']);
Route::post('flight/dettails/save', [SessionController::class, 'FlightDetailsSave']);
Route::post('coupon/validation/vue', [SessionController::class, 'getCouponValidate']);

// ==================== Profile Update Controller ====================

Route::post('profile/update/vue', [ProfileUpdateController::class, 'ProfileUpdate']);
Route::get('/profile/info/vue', [ProfileUpdateController::class, 'ProfileInfo']);
Route::post('/profile/info/id/vue', [ProfileUpdateController::class, 'ProfileInfoWithAgentCode']);
Route::post('profile/password/update/vue', [ProfileUpdateController::class, 'UpdatePassword']);
Route::post('profile/info/update/vue', [ProfileUpdateController::class, 'UpdateProfile']);


// All Booking
Route::get('/user/all/single/trip/booking',[BookingController::class,'SingleTripBooking']);
Route::get('/user/all/round/trip/booking',[BookingController::class,'RoundTripBooking']);
Route::get('/user/all/multicity/trip/booking',[BookingController::class,'MulticityTripBooking']);
Route::get('/user/all/car_rental/booking',[BookingController::class,'CarRentalBooking']);
Route::get('/contact_us/store/',[FrontendController::class,'ContactFormStore']);
Route::post('/get/single/booking',[BookingController::class,'GetBookingWithId']);
Route::post('/get/single/booking_id',[BookingController::class,'GetBookingId']);
Route::post('/SingleTrip/booking/cancel',[BookingController::class,'SingleTripBookingCancel']);
Route::post('/get/singleTrip/booking/details',[BookingController::class,'SingleTripBookingDetails']);
Route::post('/RoundTrip/booking/cancel',[BookingController::class,'roundtripBookingCancel']);
Route::post('/get/roundtrip/booking/details',[BookingController::class,'roundtripBookingDetails']);
Route::post('/get/carrental/booking/details',[BookingController::class,'CarRentalBookingDetails']);
Route::post('/submit/adb_pgw_subtotal',[BookingController::class,'adb_pgw_subtotal']);
Route::get('/payment/slab',[BookingController::class,'PaymentSlab']);

// Reset Password
Route::get('password-reset',[ForgotPasswordController::class,'ResetForm'])->name('ResetForm');
Route::post('password-reset/submit',[ForgotPasswordController::class,'sendResetLinkEmail']);
Route::post('password-get',[ForgotPasswordController::class,'sendResetLinkdone'])->name('passwords.reset');

//=================== SingleTripEditFare Controller ===================
Route::post('/verify/single-strip/edit/fare', [SingleTripEditFareController::class, 'verifySingleTripFair']);

//=================== SingleTripEditUpdate Controller ===================
Route::post('/single-trip/update/booking', [SignleTripUpdateController::class, 'update']);

//=================== RoundTrip Edit Fare Controller ===================


Route::post('/verify/round-strip/edit/fare', [RoundTripEditFareController::class, 'verifyRoundTripFair']);
Route::post('/round-trip/update/booking', [RoundTripUpdateController::class, 'update']);

//=================== BookingController ===================

Route::post('/get/multicity/booking/details',[BookingController::class,'MulticityBookingDetails']);

//=================== MyEarningMyEarningController ===================

Route::get('/agent/earning/get',[MyEarningMyEarningController::class,'AgentEarning']);
Route::get('/agent/earning/commission/get',[MyEarningMyEarningController::class,'AgentCommission']);
Route::post('/agent/earning/add/points',[MyEarningMyEarningController::class,'AgentAddPoints']);
Route::post('/agent/earning/cash/withdraw',[MyEarningMyEarningController::class,'AgentCashWithdraw']);
Route::get('/agent/earning/get/totalWithdrawable',[MyEarningMyEarningController::class,'AgenttotalWithdrawable']);

//=================== FrontendPaymentReferencesController ===================

Route::get('/payment/referances/get/amount',[FrontendPaymentReferencesController::class,'GetAmount']);
Route::post('/nagad/manual/payment/store',[NagadManualPaymentController::class,'store']);


Route::get('/HolidayDate', [FrontendController::class, 'HolidayDate'])->name('HolidayDate');
Route::get('/currencyConverRate', [FrontendController::class, 'currencyConverRate']);


// OTP Send
Route::post('/mail/otp/send', [OTPmailSenderController::class, 'otpSendByMail'])->name('otpSendByMail');
Route::post('/otp/verify', [OTPVerifyController::class, 'OtpVerify'])->name('OtpVerify');
Route::post('/otp/resend', [OTPVerifyController::class, 'OtpResend'])->name('OtpResend');

//=================== Handle page ===================

Route::get('/{anypath}', [FrontendController::class, 'getIndex'])->where('path','.*');
Route::get('/{anypath}/{id}', [FrontendController::class, 'getIndex'])->where('path','.*');
Route::get('/{anypath}/{id}/{slug}', [FrontendController::class, 'getIndex'])->where('path','.*');
