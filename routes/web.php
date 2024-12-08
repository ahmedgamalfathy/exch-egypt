<?php
use App\Http\Controllers\Dashboard\SFreeController;
use App\Http\Controllers\Dashboard\AgendaController;
use App\Http\Controllers\Dashboard\PrivacyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\StokController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\SectorController;
use App\Http\Controllers\Dashboard\NewstokController;
use App\Http\Controllers\Dashboard\RegisterController;
use App\Http\Controllers\Dashboard\UpdateProfileController;

Route::middleware('auth:admin')->group(function(){
    Route::get('/', function () { return view('welcome'); })->name('home');
    Route::resource('admins', AdminController::class);
    Route::post('admin/{id}/update',[UpdateProfileController::class,'update']);
    Route::post('/logout',[LoginController::class,'logout']);
  //StokController
    Route::controller(StokController::class)->group(function(){
        Route::get('/stoks','index')->name('stoks');
        Route::get('/stoks_create','create')->name('create');
        Route::post('/stoks','store')->name('store');
        Route::get('/stoks_edit/{id}','edit')->name('edit');
        Route::put('/stoks_update/{id}','update')->name('update');
        Route::delete('/stoks/{id}','destroy')->name('delete');
    });
    Route::controller(NewstokController::class)->group(function(){
      Route::get('/news','index')->name('news');
      Route::get('/create_new','create')->name('create_new');
      Route::get('/edit_new/{id}','edit')->name('edit_new');
      Route::post('/store_new','store')->name('store_new');
      Route::put('/store_update/{id}','update')->name('update_new');
      Route::delete('/delete_new/{id}','destroy')->name('delete_new');
    });
    Route::controller(SectorController::class)->group(function(){
        Route::get('/sectors','index')->name('sectors');
        Route::get('/sectors_create','create')->name('sector.create');
        Route::get('/sectors_edit/{id}','edit')->name('sector.edit');
        Route::put('/sectors_edit/{id}','update')->name('sector.update');
        Route::post('/sectors','store')->name('sector.store');
        Route::delete('/sectors/{id}','destroy')->name('delete.sector');
    });
    Route::controller(AgendaController::class)->group(function(){
        Route::get('/agendas','index')->name('agendas');
        Route::get('/agenda_create','create')->name('agenda.create');
        Route::get('/agenda_edit/{id}','edit')->name('agenda.edit');
        Route::put('/agenda_update/{id}','update')->name('agenda.update');
        Route::post('/agendas','store')->name('agenda.store');
    });
   Route::controller(PrivacyController::class)->group(function(){
       Route::get('/privacy','index')->name('privacy');
       Route::get('/privacy_create','create')->name('privacy.create');
       Route::get('/privacy_edit/{id}','edit')->name('privacy.edit');
       Route::post('/privacy','store')->name('privacy.store');
       Route::put('/privacy_update/{id}','update')->name('privacy.update');
       Route::delete('/privacy_delete/{id}','destroy')->name('privacy.delete');
   });
   Route::controller(SFreeController::class)->group(function(){
       Route::get('/sfree','index')->name('sfree.index');
       Route::get('/sfree_create','create')->name('sfree.create');
       Route::get('/sfree_edit/{id}','edit')->name('sfree.edit');
       Route::post('/sfree','store')->name('sfree.store');
       Route::PUT('/sfree/{id}','update')->name('sfree.update');
       Route::delete('/sfree/{id}','destroy')->name('sfree.delete');
   });



});
// Route::get('/', function () { return view('Dashboard.auth.Login'); })->name('home');
Route::middleware('guest:admin')->group(function(){
    Route::post('/login',[LoginController::class,'login']);
    Route::get('/login',[LoginController::class,'create'])->name('login');
});

Route::post('/register',[AdminController::class,'store']);
Route::get('/register_view',[RegisterController::class,'create']);




