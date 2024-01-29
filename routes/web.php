<?php

use App\Models\User;
use App\Models\Lecture;
use App\Models\Product;
use App\Models\MenuItem;
use App\Models\Specialty;
use App\Models\CMELecture;
use App\Models\IvlnCourse;
use App\Models\Membership;
use App\Models\IvlnSection;
use App\Models\HtmlTemplate;
use App\classes\calculateTax;
use App\Models\PasswordReset;
use App\classes\generateInvoice;
use App\Models\JournalApplication;
use App\Models\ProductCountryType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AutomatedNotification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\TestController;
use App\Models\HealthInnovationInitiative;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\VerifyEmailController;

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
    return redirect(env('APP_FRONT_END'));
});
Route::get('test', function(){
    $a = Membership::all();
    dd($a);
});
Route::get('/test1', [PaymentController::class, 'test']);
Route::get('/getPayment', [PaymentController::class, 'payment']);
// Route::get('/get-status', [PaymentController::class, 'getStatus']);

// Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
//     ->middleware(['signed', 'throttle:6,1'])
//     ->name('verification.verify');

// Resend link to verify email
// Route::post('/email/verify/resend', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');

Route::get('/user/verify/{token}', [VerifyEmailController::class, 'verifyUser']);

Route::get('/get_payment_status', [PaymentController::class, 'getPaymentStatus']);
Route::get('/getPayStatus', [PaymentController::class, 'getPayStatus']);


// Route::get('test', function () {
//     $favs=User::find(1)->ivlnFavorites;
//         foreach($favs as $fav){
//             switch($fav->model_type){
//                 case 'App\\Models\\IvlnCourse':
//                     $fav->course=IvlnCourse::find($fav->model_id)->with(
//                         ['lectures' => function($query) {
//                                 $query->where('status', 1)
//                                     ->where('lecture_type_id',1);
//                             }
//                         ]);
//                     break;
//                 case 'App\\Models\\Lecture':
//                     $fav->lecture=Lecture::find($fav->model_id);
//                     dump($fav->lecture);
//                     $fav->course=IvlnCourse::find(6)->with(
//                         ['lectures' => function($query) {
//                                 $query->where('status', 1)
//                                     ->where('lecture_type_id',1);
//                             }
//                         ])->first();
//                     dd($fav->course);
//                     break;
//                 case 'App\\Models\\IvlnSection':
//                     $fav->section=IvlnSection::find($fav->model_id)->with('lectures');
//                     $fav->course=IvlnCourse::find($fav->section->course_id)->with(
//                         ['lectures' => function($query) {
//                                 $query->where('status', 1)
//                                     ->where('lecture_type_id',1);
//                             }
//                         ]);
//                     break;
//             }
//         }
// });

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('/get-status', [PaymentController::class, 'getPaymentStatus']);
Route::get('/payLink',[PaymentController::class, 'getPaymentFromUser']);
Route::get('/cme-payment', [PaymentController::class, 'sendEmailToCMESuccessful']);