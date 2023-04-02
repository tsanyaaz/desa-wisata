<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TouristAttractionController;
use App\Http\Controllers\TourismCategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\HomestayController;
use App\Http\Controllers\TourPackageController;
use App\Http\Controllers\ReservationController;
use App\Models\Employee;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth', 'role:Administrator,Bendahara,Pemilik']], function () {
    Route::get('/dashboard', function () {
        $countEmployees = Employee::count();
        $countEmployeesOwner = Employee::where('jobtitle', 'Pemilik')->count();
        return view('welcome', compact('countEmployees', 'countEmployeesOwner'));
    });
});

Route::get('/', function () {
    return view('home');
});

Route::group(['middleware' => ['role:Pelanggan']], function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/edit/{id}', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::post('/reservations/update/{id}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::get('/reservations/delete/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});
// //-----Home
// Route::get('/', function () {
//     return view('home');
// });
// //-----End Home

// //-----Auth Reservations
// Route::middleware(['auth'])->group(function () {
//     Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
//     Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
//     Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');
//     Route::get('/reservations/edit/{id}', [ReservationController::class, 'edit'])->name('reservations.edit');
//     Route::post('/reservations/update/{id}', [ReservationController::class, 'update'])->name('reservations.update');
//     Route::get('/reservations/delete/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
// });
// //-----End Auth Reservations

//-----Auth
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::post('/postregister', [LoginController::class, 'postregister'])->name('postregister');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
//-----End Auth

// //-----Dashboard
// Route::middleware(['auth', 'checkrole:Administrator,Bendahara,Pemilik'])->group(function () {
//     Route::get('/dashboard', function () {
//         $countEmployees = Employee::count();
//         $countEmployeesOwner = Employee::where('jobtitle', 'Pemilik')->count();
//         return view('welcome', compact('countEmployees', 'countEmployeesOwner'));
//     });
// });
// //-----End Dashboard

// //-----Dashboard
// Route::get('/', function () {
//     $countEmployees = Employee::count();
//     $countEmployeesOwner = Employee::where('jobtitle', 'Pemilik')->count();
//     return view('welcome', compact('countEmployees', 'countEmployeesOwner'));
// })->middleware('auth');
// //-----End Dashboard

Route::group(['middleware' => ['auth', 'role:Administrator']], function () {
    //-----Employees
    // Index
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

    // Create
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');

    // Store
    Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');

    // Edit
    Route::get('/employees/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');

    // Update
    Route::post('/employees/update/{id}', [EmployeeController::class, 'update'])->name('employees.update');

    // Delete
    Route::get('/employees/delete/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    //-----End Employees

    //-----Users
    // Index
    Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('auth');

    // Create
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('auth');

    // Store
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store')->middleware('auth');

    // Edit
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');

    // Update
    Route::post('users/update/{id}', [UserController::class, 'update'])->name('users.update')->middleware('auth');

    // Activate
    Route::put('/users/activate/{id}', [UserController::class, 'activate'])->name('users.activate')->middleware('auth');

    // Deactivate
    Route::put('/users/deactivate/{id}', [UserController::class, 'deactivate'])->name('users.deactivate')->middleware('auth');

    // Delete
    Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth');
    //-----End Users

    //-----Tourist Attractions
    // Index
    Route::get('/touristAttractions', [TouristAttractionController::class, 'index'])->name('touristAttractions.index')->middleware('auth');

    // Create
    Route::get('/touristAttractions/create', [TouristAttractionController::class, 'create'])->name('touristAttractions.create')->middleware('auth');

    // Store
    Route::post('/touristAttractions/store', [TouristAttractionController::class, 'store'])->name('touristAttractions.store')->middleware('auth');

    // Edit
    Route::get('/touristAttractions/edit/{id}', [TouristAttractionController::class, 'edit'])->name('touristAttractions.edit')->middleware('auth');

    // Update
    Route::post('/touristAttractions/update/{id}', [TouristAttractionController::class, 'update'])->name('touristAttractions.update')->middleware('auth');

    // Delete
    Route::get('/touristAttractions/delete/{id}', [TouristAttractionController::class, 'destroy'])->name('touristAttractions.destroy')->middleware('auth');
    //-----End Tourist Attractions

    //-----Tourism Category
    // Index
    Route::get('/tourismCategories', [TourismCategoryController::class, 'index'])->name('tourismCategories.index')->middleware('auth');

    // Create
    Route::get('/tourismCategories/create', [TourismCategoryController::class, 'create'])->name('tourismCategories.create')->middleware('auth');

    // Store
    Route::post('/tourismCategories/store', [TourismCategoryController::class, 'store'])->name('tourismCategories.store')->middleware('auth');

    // Edit
    Route::get('/tourismCategories/edit/{id}', [TourismCategoryController::class, 'edit'])->name('tourismCategories.edit')->middleware('auth');

    // Update
    Route::post('/tourismCategories/update/{id}', [TourismCategoryController::class, 'update'])->name('tourismCategories.update')->middleware('auth');

    // Delete
    Route::get('/tourismCategories/delete/{id}', [TourismCategoryController::class, 'destroy'])->name('tourismCategories.destroy')->middleware('auth');
    //-----End Tourism Category

    //-----News
    // Index
    Route::get('/news', [NewsController::class, 'index'])->name('news.index')->middleware('auth');

    // Create
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create')->middleware('auth');

    // Store
    Route::post('/news/store', [NewsController::class, 'store'])->name('news.store')->middleware('auth');

    // Edit
    Route::get('/news/edit/{id}', [NewsController::class, 'edit'])->name('news.edit')->middleware('auth');

    // Update
    Route::post('/news/update/{id}', [NewsController::class, 'update'])->name('news.update')->middleware('auth');

    // Delete
    Route::get('/news/delete/{id}', [NewsController::class, 'destroy'])->name('news.destroy')->middleware('auth');
    //-----End News

    //-----News Category
    // Index
    Route::get('/newsCategories', [NewsCategoryController::class, 'index'])->name('newsCategories.index')->middleware('auth');

    // Create
    Route::get('/newsCategories/create', [NewsCategoryController::class, 'create'])->name('newsCategories.create')->middleware('auth');

    // Store
    Route::post('/newsCategories/store', [NewsCategoryController::class, 'store'])->name('newsCategories.store')->middleware('auth');

    // Edit
    Route::get('/newsCategories/edit/{id}', [NewsCategoryController::class, 'edit'])->name('newsCategories.edit')->middleware('auth');

    // Update
    Route::post('/newsCategories/update/{id}', [NewsCategoryController::class, 'update'])->name('newsCategories.update')->middleware('auth');

    // Delete
    Route::get('/newsCategories/delete/{id}', [NewsCategoryController::class, 'destroy'])->name('newsCategories.destroy')->middleware('auth');
    //-----End News Category

    //-----Homestay
    // Index
    Route::get('/homestays', [HomestayController::class, 'index'])->name('homestays.index')->middleware('auth');

    // Create
    Route::get('/homestays/create', [HomestayController::class, 'create'])->name('homestays.create')->middleware('auth');

    // Store
    Route::post('/homestays/store', [HomestayController::class, 'store'])->name('homestays.store')->middleware('auth');

    // Edit
    Route::get('/homestays/edit/{id}', [HomestayController::class, 'edit'])->name('homestays.edit')->middleware('auth');

    // Update
    Route::post('/homestays/update/{id}', [HomestayController::class, 'update'])->name('homestays.update')->middleware('auth');

    // Delete
    Route::get('/homestays/delete/{id}', [HomestayController::class, 'destroy'])->name('homestays.destroy')->middleware('auth');
});
//-----End Homestay

Route::group(['middleware' => ['auth', 'role:Bendahara']], function () {
    //-----Tour Packages
    // Index
    Route::get('/tourPackages', [TourPackageController::class, 'index'])->name('tourPackages.index')->middleware('auth');

    // Create
    Route::get('/tourPackages/create', [TourPackageController::class, 'create'])->name('tourPackages.create')->middleware('auth');

    // Store
    Route::post('/tourPackages/store', [TourPackageController::class, 'store'])->name('tourPackages.store')->middleware('auth');

    // Edit
    Route::get('/tourPackages/edit/{id}', [TourPackageController::class, 'edit'])->name('tourPackages.edit')->middleware('auth');

    // Update
    Route::post('/tourPackages/update/{id}', [TourPackageController::class, 'update'])->name('tourPackages.update')->middleware('auth');

    // Delete
    Route::get('/tourPackages/delete/{id}', [TourPackageController::class, 'destroy'])->name('tourPackages.destroy')->middleware('auth');
    //-----End Tour Packages

    //-----Reservation
    // Index
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index')->middleware('auth');

    // Create
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create')->middleware('auth');

    // Store
    Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store')->middleware('auth');

    // Edit
    Route::get('/reservations/edit/{id}', [ReservationController::class, 'edit'])->name('reservations.edit')->middleware('auth');

    // Update
    Route::post('/reservations/update/{id}', [ReservationController::class, 'update'])->name('reservations.update')->middleware('auth');

    // Delete
    Route::get('/reservations/delete/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy')->middleware('auth');
});
//-----End Reservation

//-----Report
// Export PDF
Route::get('/export', [EmployeeController::class, 'export'])->name('employees.export');
//-----End Report