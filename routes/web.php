<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
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

// Route::get('/', function () { return view('index'); });
Route::get('/', [App\Http\Controllers\HomeController::class, 'Show'])->name('index');
Route::get('/index', [App\Http\Controllers\HomeController::class, 'Show'])->name('index');
Route::post('/bookingroomTypeAjax', [App\Http\Controllers\HomeController::class, 'RoomTypeAjax'])->name('bookingroomTypeAjax');
Route::post('/maxGuestDetailsAjax', [App\Http\Controllers\HomeController::class, 'MaxGuestDetailsAjax'])->name('maxGuestDetailsAjax');
Route::post('/guestDetailsFieldsAjax', [App\Http\Controllers\HomeController::class, 'GuestDetailsFieldsAjax'])->name('guestDetailsFieldsAjax');
Route::get('/searchRoom', [App\Http\Controllers\BookingController::class, 'Search'])->name('searchRoom');
Route::post('/guestDetails', [App\Http\Controllers\BookingController::class, 'Guest'])->name('guestDetails');
Route::post('/payment', [App\Http\Controllers\BookingController::class, 'Payment'])->name('payment');
Route::post('/ConfirmPayment', [App\Http\Controllers\BookingController::class, 'ConfirmPayment'])->name('ConfirmPayment');
Route::get('/paymentSuccess', [App\Http\Controllers\BookingController::class, 'PaymentSuccess'])->name('paymentSuccess');
Route::get('/testemail', [App\Http\Controllers\BookingController::class, 'Testemail'])->name('testemail');
Route::post('/paymentcancel', [App\Http\Controllers\BookingController::class, 'paymentcancel'])->name('paymentcancel');
Route::get('/paymentgateway', [App\Http\Controllers\BookingController::class, 'paymentgateway'])->name('paymentgateway');
Route::post('/paymentgatewayres', [App\Http\Controllers\BookingController::class, 'paymentgatewayres'])->name('paymentgatewayres');
Route::post('/paymentgatewayres_billdesk', [App\Http\Controllers\BookingController::class, 'paymentgatewayres_billdesk'])->name('paymentgatewayres_billdesk');

Route::post('/hallbookingdatesAjax', [App\Http\Controllers\HomeController::class, 'HallbookingDates'])->name('hallbookingdatesAjax');
Route::post('/hallNoDetailsAjax', [App\Http\Controllers\HallBookingController::class, 'HallNoDetailsAjax'])->name('hallNoDetailsAjax');
Route::get('/hallSearch', [App\Http\Controllers\HallBookingController::class, 'Search'])->name('hallSearch');
Route::post('/hallGuestDetails', [App\Http\Controllers\HallBookingController::class, 'Guest'])->name('hallGuestDetails');
Route::post('/hallpayment', [App\Http\Controllers\HallBookingController::class, 'Payment'])->name('hallpayment');
Route::post('/HallConfirmPayment', [App\Http\Controllers\HallBookingController::class, 'ConfirmPayment'])->name('HallConfirmPayment');
Route::get('/paymentSuccessforhall', [App\Http\Controllers\HallBookingController::class, 'PaymentSuccess'])->name('PaymentSuccessforhall');

require __DIR__.'/auth.php';
Route::get('/dashboard', [App\Http\Controllers\User\HomeController::class, 'Index'])->name('dashboard');
Route::get('/allbookingDetails', [App\Http\Controllers\User\BookingController::class, 'BookingDetails'])->name('bookinDetailsUser');
Route::get('/bookingDetails/{booking_id}', [App\Http\Controllers\User\BookingController::class, 'Show'])->name('bookinDetails');
Route::post('/bookingCancelAjax', [App\Http\Controllers\User\BookingController::class, 'Cancel'])->name('bookingCancelAjax');

Route::name('admin.')->prefix('admin')->group(function() {
    Route::middleware('guest')->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.login');
        });
        // Route::get('register', [App\Http\Controllers\Admin\Auth\RegisteredUserController::class, 'create'])->name('register');
        // Route::post('register', [App\Http\Controllers\Admin\Auth\RegisteredUserController::class, 'store']);
        Route::get('login', [App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [App\Http\Controllers\Admin\Auth\PasswordResetLinkController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [App\Http\Controllers\Admin\Auth\PasswordResetLinkController::class, 'store'])->name('password.email');
        Route::get('reset-password/{token}', [App\Http\Controllers\Admin\Auth\NewPasswordController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [App\Http\Controllers\Admin\Auth\NewPasswordController::class, 'store'])->name('password.update');
    });
    Route::middleware('auth')->group(function () {
        Route::get('verify-email', [App\Http\Controllers\Admin\Auth\EmailVerificationPromptController::class, '__invoke'])
                    ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', [App\Http\Controllers\Admin\Auth\VerifyEmailController::class, '__invoke'])
                    ->middleware(['signed', 'throttle:6,1'])
                    ->name('verification.verify');

        Route::post('email/verification-notification', [App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController::class, 'store'])
                    ->middleware('throttle:6,1')
                    ->name('verification.send');

        Route::get('confirm-password', [App\Http\Controllers\Admin\Auth\ConfirmablePasswordController::class, 'show'])
                    ->name('password.confirm');

        Route::post('confirm-password', [App\Http\Controllers\Admin\Auth\ConfirmablePasswordController::class, 'store']);

        Route::post('logout', [App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'destroy'])
                    ->name('logout');
    });
    Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'Dashboard'])->name('dashboard');
    
    Route::get('/params', [App\Http\Controllers\Admin\ParamController::class, 'Show'])->name('params');
    Route::get('/paramsadd', [App\Http\Controllers\Admin\ParamController::class, 'ShowAdd'])->name('paramsadd');
    Route::post('/paramsadd', [App\Http\Controllers\Admin\ParamController::class, 'Add'])->name('paramsadd');
    Route::get('/paramsedit/{id?}', [App\Http\Controllers\Admin\ParamController::class, 'ShowEdit'])->name('paramsedit');
    Route::post('/paramseditconfirm', [App\Http\Controllers\Admin\ParamController::class, 'Edit'])->name('paramseditconfirm');

    Route::get('/location', [App\Http\Controllers\Admin\LocationController::class, 'Show'])->name('location');
    Route::get('/locationadd', [App\Http\Controllers\Admin\LocationController::class, 'ShowAdd'])->name('locationadd');
    Route::post('/locationadd', [App\Http\Controllers\Admin\LocationController::class, 'Add'])->name('locationadd');
    Route::get('/locationedit/{id?}', [App\Http\Controllers\Admin\LocationController::class, 'ShowEdit'])->name('locationedit');
    Route::post('/locationeditconfirm', [App\Http\Controllers\Admin\LocationController::class, 'Edit'])->name('locationeditconfirm');

    Route::get('/roomType', [App\Http\Controllers\Admin\RoomTypeController::class, 'Show'])->name('roomType');
    Route::get('/roomTypeadd', [App\Http\Controllers\Admin\RoomTypeController::class, 'ShowAdd'])->name('roomTypeadd');
    Route::post('/roomTypeadd', [App\Http\Controllers\Admin\RoomTypeController::class, 'Add'])->name('roomTypeadd');
    Route::get('/roomTypeedit/{id?}', [App\Http\Controllers\Admin\RoomTypeController::class, 'ShowEdit'])->name('roomTypeedit');
    Route::post('/roomTypeeditconfirm', [App\Http\Controllers\Admin\RoomTypeController::class, 'Edit'])->name('roomTypeeditconfirm');

    Route::get('/rules', [App\Http\Controllers\Admin\RulesController::class, 'Show'])->name('rules');
    Route::get('/rulesadd', [App\Http\Controllers\Admin\RulesController::class, 'ShowAdd'])->name('rulesadd');
    Route::post('/rulesadd', [App\Http\Controllers\Admin\RulesController::class, 'Add'])->name('rulesadd');
    Route::get('/rulesedit/{id?}', [App\Http\Controllers\Admin\RulesController::class, 'ShowEdit'])->name('rulesedit');
    Route::post('/ruleseditconfirm', [App\Http\Controllers\Admin\RulesController::class, 'Edit'])->name('ruleseditconfirm');

    Route::get('/rooms', [App\Http\Controllers\Admin\RoomController::class, 'Show'])->name('rooms');
    Route::get('/roomsadd', [App\Http\Controllers\Admin\RoomController::class, 'ShowAdd'])->name('roomsadd');
    Route::post('/roomsadd', [App\Http\Controllers\Admin\RoomController::class, 'Add'])->name('roomsadd');
    Route::get('/roomsedit/{id?}', [App\Http\Controllers\Admin\RoomController::class, 'ShowEdit'])->name('roomsedit');
    Route::post('/roomseditconfirm', [App\Http\Controllers\Admin\RoomController::class, 'Edit'])->name('roomseditconfirm');
    Route::post('/roomTypeAjax', [App\Http\Controllers\Admin\RoomController::class, 'RoomTypeAjax'])->name('roomTypeAjax');

    Route::get('/cancelPlan', [App\Http\Controllers\Admin\CancelPlanController::class, 'Show'])->name('cancelPlan');
    Route::get('/cancelPlanadd', [App\Http\Controllers\Admin\CancelPlanController::class, 'ShowAdd'])->name('cancelPlanadd');
    Route::post('/cancelPlanadd', [App\Http\Controllers\Admin\CancelPlanController::class, 'Add'])->name('cancelPlanadd');
    Route::get('/cancelPlanedit/{id?}', [App\Http\Controllers\Admin\CancelPlanController::class, 'ShowEdit'])->name('cancelPlanedit');
    Route::post('/cancelPlaneditconfirm', [App\Http\Controllers\Admin\CancelPlanController::class, 'Edit'])->name('cancelPlaneditconfirm');

    Route::get('/cautionMoney', [App\Http\Controllers\Admin\CautionMoneyController::class, 'Show'])->name('cautionMoney');
    Route::get('/cautionMoneyadd', [App\Http\Controllers\Admin\CautionMoneyController::class, 'ShowAdd'])->name('cautionMoneyadd');
    Route::post('/cautionMoneyadd', [App\Http\Controllers\Admin\CautionMoneyController::class, 'Add'])->name('cautionMoneyadd');
    Route::get('/cautionMoneyedit/{id?}', [App\Http\Controllers\Admin\CautionMoneyController::class, 'ShowEdit'])->name('cautionMoneyedit');
    Route::post('/cautionMoneyeditconfirm', [App\Http\Controllers\Admin\CautionMoneyController::class, 'Edit'])->name('cautionMoneyeditconfirm');

    Route::get('/roomCharge', [App\Http\Controllers\Admin\RoomChargeController::class, 'Show'])->name('roomCharge');
    Route::get('/roomChargeadd', [App\Http\Controllers\Admin\RoomChargeController::class, 'ShowAdd'])->name('roomChargeadd');
    Route::post('/roomChargeadd', [App\Http\Controllers\Admin\RoomChargeController::class, 'Add'])->name('roomChargeadd');
    Route::get('/roomChargeedit/{id?}', [App\Http\Controllers\Admin\RoomChargeController::class, 'ShowEdit'])->name('roomChargeedit');
    Route::post('/roomChargeeditconfirm', [App\Http\Controllers\Admin\RoomChargeController::class, 'Edit'])->name('roomChargeeditconfirm');
    
    Route::get('/document', [App\Http\Controllers\Admin\DocumentController::class, 'Show'])->name('document');
    Route::get('/documentadd', [App\Http\Controllers\Admin\DocumentController::class, 'ShowAdd'])->name('documentadd');
    Route::post('/documentadd', [App\Http\Controllers\Admin\DocumentController::class, 'Add'])->name('documentadd');
    Route::get('/documentedit/{id?}', [App\Http\Controllers\Admin\DocumentController::class, 'ShowEdit'])->name('documentedit');
    Route::post('/documenteditconfirm', [App\Http\Controllers\Admin\DocumentController::class, 'Edit'])->name('documenteditconfirm');

    Route::get('/manageBooking', [App\Http\Controllers\Admin\Booking\BookingController::class, 'Manage'])->name('manageBooking');
    Route::get('/bookingDetails/{booking_id?}', [App\Http\Controllers\Admin\Booking\BookingController::class, 'BookingDetails'])->name('bookingDetails');


    Route::get('/manageHallBooking', [App\Http\Controllers\Admin\Booking\HallBookingController::class, 'HallManage'])->name('manageHallBooking');
    Route::get('/hallbookingDetails/{booking_id?}', [App\Http\Controllers\Admin\Booking\HallBookingController::class, 'BookingDetails'])->name('hallbookingDetails');


    Route::get('/roombooking', [App\Http\Controllers\Admin\Booking\BookingController::class, 'Show'])->name('booking');
    Route::get('/bulkbook', [App\Http\Controllers\Admin\Booking\BookingController::class, 'bulkbook'])->name('bulkbook');
    // Route::get('/searchroom', [App\Http\Controllers\Admin\Booking\BookingController::class, 'Search'])->name('searchroom');
    // Route::post('/roomBook', [App\Http\Controllers\Admin\Booking\BookingController::class, 'Book'])->name('roomBook');
    // Route::post('/passengerDetails', [App\Http\Controllers\Admin\Booking\BookingController::class, 'PassengerDetails'])->name('passengerDetails');

    Route::post('/bookingConfirm', [App\Http\Controllers\Admin\Booking\BookingController::class, 'BookingConfirm'])->name('bookingConfirm');

    Route::post('/bulkBookingConfirm', [App\Http\Controllers\Admin\Booking\BookingController::class, 'bulkBookingConfirm'])->name('bulkBookingConfirm');
    Route::get('/bulkManage', [App\Http\Controllers\Admin\Booking\BookingController::class, 'bulkManage'])->name('bulkManage');
    Route::get('/consolidatebills', [App\Http\Controllers\Admin\Booking\BookingController::class, 'consolidatebills'])->name('consolidatebills');
    Route::get('/consolidate_list', [App\Http\Controllers\Admin\Booking\BookingController::class, 'consolidate_list'])->name('consolidate_list');
    Route::get('/finalbill/', [App\Http\Controllers\Admin\Booking\BookingController::class, 'finalbill'])->name('finalbill');

    Route::post('/addconbill', [App\Http\Controllers\Admin\Booking\BookingController::class, 'addconbill'])->name('addconbill');
    Route::get('/bulkpaymentDetails/{booking_id?}', [App\Http\Controllers\Admin\Booking\BookingController::class, 'bulkpaymentDetails'])->name('bulkpaymentDetails');
    Route::post('/bulkpaymentsubmit', [App\Http\Controllers\Admin\Booking\BookingController::class, 'bulkpaymentsubmit'])->name('bulkpaymentsubmit');
    Route::post('/bulkStoreMenu', [App\Http\Controllers\Admin\Booking\BookingController::class, 'bulkStoreMenu'])->name('bulkStoreMenu');
    Route::get('/bulkViewBill/{booking_id?}', [App\Http\Controllers\Admin\Booking\BookingController::class, 'bulkViewBill'])->name('bulkViewBill');

    Route::get('/additem/{booking_id?}', [App\Http\Controllers\Admin\Booking\BookingController::class, 'additem'])->name('additem');
    Route::get('/addmiscellaneous/{booking_id?}', [App\Http\Controllers\Admin\Booking\BookingController::class, 'addmiscellaneous'])->name('addmiscellaneous');
    Route::post('/bulkStoremisitem', [App\Http\Controllers\Admin\Booking\BookingController::class, 'bulkStoremisitem'])->name('bulkStoremisitem');
    Route::get('/delete_item/{id?}', [App\Http\Controllers\Admin\Booking\BookingController::class, 'delete_item'])->name('delete_item');
    Route::get('/delmis_item/{id?}', [App\Http\Controllers\Admin\Booking\BookingController::class, 'delmis_item'])->name('delmis_item');

    Route::post('/searchroom', [App\Http\Controllers\Admin\Booking\BookingController::class, 'Search'])->name('searchroomAjax');
    Route::get('/bulkbookingcanceldtls/{booking_id?}', [App\Http\Controllers\Admin\Booking\BookingController::class, 'bulkbookingcanceldtls'])->name('bulkbookingcanceldtls');
    
    Route::post('/bulkroombookingcancel', [App\Http\Controllers\Admin\Booking\BookingController::class, 'bulkroombookingcancel'])->name('bulkroombookingcancel');
    Route::post('/bulkSearchaccomodation', [App\Http\Controllers\Admin\Booking\BookingController::class, 'bulkSearchaccomodation'])->name('bulkSearchaccomodation');
    Route::post('/getroomtypebylocation', [App\Http\Controllers\Admin\Booking\BookingController::class, 'getroomtypebylocation'])->name('getroomtypebylocation');

    Route::post('/geturl', [App\Http\Controllers\Admin\Booking\BookingController::class, 'geturl'])->name('geturl');
    Route::get('/books/{dt_range?}', [App\Http\Controllers\Admin\Booking\BookingController::class, 'books'])->name('books');
    
    Route::post('/passengerDetailsAjax', [App\Http\Controllers\Admin\Booking\BookingController::class, 'PassengerDetails'])->name('passengerDetailsAjax');
    Route::post('/bookingroomTypeAjax', [App\Http\Controllers\Admin\Booking\BookingController::class, 'RoomTypeAjax'])->name('bookingroomTypeAjax');
    Route::post('/priceDetailsAjax', [App\Http\Controllers\Admin\Booking\BookingController::class, 'PriceDetails'])->name('priceDetailsAjax');
    Route::post('/previewDetailsAjax', [App\Http\Controllers\Admin\Booking\BookingController::class, 'PreviewDetails'])->name('previewDetailsAjax');


    Route::get('/hallBooking', [App\Http\Controllers\Admin\Booking\HallBookingController::class, 'Show'])->name('hallBooking');
    Route::post('/searchhall', [App\Http\Controllers\Admin\Booking\HallBookingController::class, 'Search'])->name('searchhallAjax');
    Route::post('/hallBookingConfirm', [App\Http\Controllers\Admin\Booking\HallBookingController::class, 'BookingConfirm'])->name('hallBookingConfirm');
   
    Route::post('/hallpriceDetailsAjax', [App\Http\Controllers\Admin\Booking\HallBookingController::class, 'PriceDetails'])->name('hallpriceDetailsAjax');
    Route::post('/hallpreviewDetailsAjax', [App\Http\Controllers\Admin\Booking\HallBookingController::class, 'PreviewDetails'])->name('hallpreviewDetailsAjax');
    Route::post('/hallBookingDateAjax', [App\Http\Controllers\Admin\Booking\HallBookingController::class, 'BookingDate'])->name('hallBookingDateAjax');


    Route::get('/roomRent', [App\Http\Controllers\Admin\RoomRentController::class, 'Show'])->name('roomRent');
    Route::get('/roomRentadd', [App\Http\Controllers\Admin\RoomRentController::class, 'ShowAdd'])->name('roomRentadd');
    Route::post('/roomRentadd', [App\Http\Controllers\Admin\RoomRentController::class, 'Add'])->name('roomRentadd');
    Route::get('/roomRentedit/{id?}', [App\Http\Controllers\Admin\RoomRentController::class, 'ShowEdit'])->name('roomRentedit');
    Route::post('/roomRenteditconfirm', [App\Http\Controllers\Admin\RoomRentController::class, 'Edit'])->name('roomRenteditconfirm');

    Route::get('/hallRent', [App\Http\Controllers\Admin\HallRentController::class, 'Show'])->name('hallRent');
    Route::get('/hallRentadd', [App\Http\Controllers\Admin\HallRentController::class, 'ShowAdd'])->name('hallRentadd');
    Route::post('/hallRentadd', [App\Http\Controllers\Admin\HallRentController::class, 'Add'])->name('hallRentadd');
    Route::get('/hallRentedit/{id?}', [App\Http\Controllers\Admin\HallRentController::class, 'ShowEdit'])->name('hallRentedit');
    Route::post('/hallRenteditconfirm', [App\Http\Controllers\Admin\HallRentController::class, 'Edit'])->name('hallRenteditconfirm');
    Route::post('/hallNoAjax', [App\Http\Controllers\Admin\HallRentController::class, 'HallNoAjax'])->name('hallNoAjax');

    Route::get('/canteenMenu', [App\Http\Controllers\Admin\MenuController::class, 'Show'])->name('canteenMenu');
    Route::get('/canteenMenuadd', [App\Http\Controllers\Admin\MenuController::class, 'ShowAdd'])->name('canteenMenuadd');
    Route::post('/canteenMenuadd', [App\Http\Controllers\Admin\MenuController::class, 'Add'])->name('canteenMenuadd');
    Route::get('/canteenMenuedit/{id?}', [App\Http\Controllers\Admin\MenuController::class, 'ShowEdit'])->name('canteenMenuedit');
    Route::post('/canteenMenueditconfirm', [App\Http\Controllers\Admin\MenuController::class, 'Edit'])->name('canteenMenueditconfirm');

    //Payment status & Final bill
    Route::get('/roompaymentStatus', [App\Http\Controllers\Admin\Payment\RoomController::class, 'Show'])->name('roompaymentStatus');
    Route::get('/roompaymentStatusDetails/{booking_id?}', [App\Http\Controllers\Admin\Payment\RoomController::class, 'Details'])->name('roompaymentStatusDetails');
    Route::post('/roomFinalPayent', [App\Http\Controllers\Admin\Payment\RoomController::class, 'PayNow'])->name('roomFinalPayent');
    Route::get('/roombookingcanceldtls/{booking_id?}', [App\Http\Controllers\Admin\Payment\RoomController::class, 'roombookingcanceldtls'])->name('roombookingcanceldtls');
    Route::post('/roombookingcancel', [App\Http\Controllers\Admin\Payment\RoomController::class, 'roombookingcancel'])->name('roombookingcancel');
    Route::get('/addMenu/{booking_id?}', [App\Http\Controllers\Admin\Payment\RoomController::class, 'AddMenu'])->name('addMenu');
    Route::post('/storeMenu', [App\Http\Controllers\Admin\Payment\RoomController::class, 'StoreMenu'])->name('storeMenu');
    Route::get('/viewBill/{booking_id?}', [App\Http\Controllers\Admin\Payment\RoomController::class, 'ViewBill'])->name('viewBill');
    
    Route::post('/priceAjax', [App\Http\Controllers\Admin\Payment\RoomController::class, 'PriceAjax'])->name('priceAjax');

    Route::get('/hallpaymentStatus', [App\Http\Controllers\Admin\Payment\HallController::class, 'Show'])->name('hallpaymentStatus');
    Route::get('/hallpaymentStatusDetails/{booking_id?}', [App\Http\Controllers\Admin\Payment\HallController::class, 'Details'])->name('hallpaymentStatusDetails');
    Route::get('/addMenuHall/{booking_id?}', [App\Http\Controllers\Admin\Payment\HallController::class, 'AddMenu'])->name('addMenuHall');
    Route::post('/storeMenuHall', [App\Http\Controllers\Admin\Payment\HallController::class, 'StoreMenu'])->name('storeMenuHall');
    Route::post('/hallFinalPayent', [App\Http\Controllers\Admin\Payment\HallController::class, 'PayNow'])->name('hallFinalPayent');
    Route::get('/hallbookingcanceldtls/{booking_id?}', [App\Http\Controllers\Admin\Payment\HallController::class, 'hallbookingcanceldtls'])->name('hallbookingcanceldtls');
    Route::post('/hallbookingcancel', [App\Http\Controllers\Admin\Payment\HallController::class, 'hallbookingcancel'])->name('hallbookingcancel');
    Route::get('/viewBillHall/{booking_id?}', [App\Http\Controllers\Admin\Payment\HallController::class, 'ViewBill'])->name('viewBillHall');

    // report section
    Route::get('/paymentRoom', [App\Http\Controllers\Admin\Report\RoomController::class, 'Show'])->name('paymentRoom');
    Route::get('/bookinglist', [App\Http\Controllers\Admin\Report\RoomController::class, 'bookinglist'])->name('bookinglist');
    Route::get('/paymentHall', [App\Http\Controllers\Admin\Report\HallController::class, 'Show'])->name('paymentHall');

});