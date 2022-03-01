<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesainsController;
use App\Http\Controllers\HomeController;
use App\Models\Contact;
use App\Models\Desain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/download', function (Request $request) {
  // return json_encode(Storage::disk('public')->exists("/file" . "/" . $request->file));
  if (Storage::disk('public')->exists("/file" . "/" . $request->file)) {
    $phone = Cookie::get('phone');
    $user = Contact::where('phone', $phone)->first();
    $desain = Desain::where('link', $request->file)->first();
    DB::table('desains')->where('id', $desain->id)->update(['downloaded_time' => $desain->downloaded_time + 1]);
    DB::table('contacts')->where('id', $user->id)->update(['downloaded_file' => $user->downloaded_file + 1]);
    return Storage::download("/file" . "/" . $request->file);
  } else {
    return redirect('/404');
  }
});

Route::post('/validate', function (Request $request) {
  if (!Contact::where('phone', $request->phone)->first()) {
    $contact = Contact::create([
      'phone' => $request->phone,
      'downloaded_file' => 0
    ]);
    Cookie::queue('phone', $contact->phone, 365 * 60 * 60 * 60);
    return redirect('/');
  } else {
    Cookie::queue('phone', $request->phone, 365 * 60 * 60 * 60);
    return redirect('/');
  }
});

Route::middleware(['auth'])->group(function () {

  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  Route::resource('/desain', DesainsController::class);
  Route::resource('/category', CategoriesController::class);
});

require __DIR__ . '/auth.php';
