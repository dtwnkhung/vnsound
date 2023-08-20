<?php

use App\Repositories\AchievementRepository;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SlidersController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ConfigsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OtherNewsController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\AchievementsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\checkAdmin;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::middleware(['auth'])->prefix('admin')->group(function ()
{

    Route::get('/resetPass', [ResetPasswordController::class, 'showResetForm'])->name('resetPass');
    Route::post('/changePass', [ResetPasswordController::class, 'changePass'])->name('password.update');
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    Route::group(['middleware' => 'verfiy-account'], function ()
    {
        Route::get('/', [StaterkitController::class, 'home'])->name('home');
        // Teacher
        Route::prefix('teachers')->group(function ()
        {
            Route::get('/', [UserController::class, 'indexTeacher'])->name('teachers.index');
            Route::get('data', [UserController::class, 'getListTeachers'])->name('teachers.data');
            Route::get('view/{id}', [UserController::class, 'view'])->name('teachers.view');

            Route::get('edit/{id}', [UserController::class, 'edit'])->name('teachers.edit');
            Route::put('update/{id}', [UserController::class, 'update'])->name('teachers.update');

            Route::get('changePassword/{id}', [UserController::class, 'changePassword'])->name('teachers.changePassword');
            Route::put('updatePassword/{id}', [UserController::class, 'updatePassword'])->name('teachers.updatePassword');

            //Save Image in content quill editor
            Route::post('handlerImage', [UserController::class, 'handlerImage'])->name('teachers.handlerImage');
            Route::get('create', [UserController::class, 'create'])->name('teachers.create');
            Route::post('store', [UserController::class, 'store'])->name('teachers.store');

            Route::get('delete/{id}', [UserController::class, 'delete'])->name('teachers.delete');
        });

        // Student
        Route::prefix('students')->group(function ()
        {
            Route::get('/representativeStudent', [StudentController::class, 'representativeStudent'])->name('students.representativeStudent');
            Route::get('/opinionStudent', [StudentController::class, 'opinionStudent'])->name('students.opinionStudent');

            Route::get('dataOpinion', [StudentController::class, 'getListOpinion'])->name('students.dataOpinion');
            Route::get('dataRepresentative', [StudentController::class, 'getListRepresentative'])->name('students.dataRepresentative');

            Route::get('editRepresentativeStudent/{id}', [StudentController::class, 'editRepresentativeStudent'])->name('students.editRepresentativeStudent');
            Route::get('editOpinionStudent/{id}', [StudentController::class, 'editOpinionStudent'])->name('students.editOpinionStudent');

            Route::put('updateRepresentativeStudent/{id}', [StudentController::class, 'updateRepresentativeStudent'])->name('students.updateRepresentativeStudent');
            Route::put('updateOpinionStudent/{id}', [StudentController::class, 'updateOpinionStudent'])->name('students.updateOpinionStudent');

            Route::get('createRepresentative', [StudentController::class, 'createRepresentative'])->name('students.createRepresentative');
            Route::get('createOpinion', [StudentController::class, 'createOpinion'])->name('students.createOpinion');

            Route::post('storeRepresentative', [StudentController::class, 'storeRepresentative'])->name('students.storeRepresentative');
            Route::post('storeOpinion', [StudentController::class, 'storeOpinion'])->name('students.storeOpinion');

            Route::get('deleteRepresentative/{id}', [StudentController::class, 'deleteRepresentative'])->name('students.deleteRepresentative');
            Route::get('deleteOpinion/{id}', [StudentController::class, 'deleteOpinion'])->name('students.deleteOpinion');

        });
        // Product
        Route::prefix('products')->group(function ()
        {
            Route::get('/', [ProductController::class, 'index'])->name('products.index');
            Route::get('data', [ProductController::class, 'getList'])->name('products.data');
            Route::get('view/{id}', [ProductController::class, 'view'])->name('products.view');

            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
            Route::put('update/{id}', [ProductController::class, 'update'])->name('products.update');

            //Save Image in content quill editor
            Route::post('handlerImage', [ProductController::class, 'handlerImage'])->name('products.handlerImage');
            Route::get('create', [ProductController::class, 'create'])->name('products.create');
            Route::post('store', [ProductController::class, 'store'])->name('products.store');

            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('products.delete');
        });
        // Artists
        Route::prefix('artists')->group(function ()
        {
            Route::get('/', [ArtistController::class, 'index'])->name('artists.index');
            Route::get('data', [ArtistController::class, 'getList'])->name('artists.data');
            Route::get('view/{id}', [ArtistController::class, 'view'])->name('artists.view');

            Route::get('edit/{id}', [ArtistController::class, 'edit'])->name('artists.edit');
            Route::put('update/{id}', [ArtistController::class, 'update'])->name('artists.update');

            //Save Image in content quill editor
            Route::post('handlerImage', [ArtistController::class, 'handlerImage'])->name('artists.handlerImage');
            Route::post('deleteImageClubs', [ArtistController::class, 'delete_image_clubs'])->name('artists.deleteImageClubs');
            Route::post('deleteImagePartner', [ArtistController::class, 'delete_image_partner'])->name('artists.deleteImagePartner');
            Route::post('deleteImageProject1', [ArtistController::class, 'delete_image_project1'])->name('artists.deleteImageProject1');
            Route::post('deleteImageProject2', [ArtistController::class, 'delete_image_project2'])->name('artists.deleteImageProject2');
            Route::get('create', [ArtistController::class, 'create'])->name('artists.create');
            Route::post('store', [ArtistController::class, 'store'])->name('artists.store');
            Route::get('delete/{id}', [ArtistController::class, 'delete'])->name('artists.delete');
        });
        // events
        Route::prefix('events')->group(function ()
        {
            Route::get('/', [EventController::class, 'index'])->name('events.index');
            Route::get('data', [EventController::class, 'getList'])->name('events.data');

            Route::get('edit/{id}', [EventController::class, 'edit'])->name('events.edit');
            Route::put('update/{id}', [EventController::class, 'update'])->name('events.update');


            Route::get('create', [EventController::class, 'create'])->name('events.create');
            Route::post('store', [EventController::class, 'store'])->name('events.store');

            Route::get('delete/{id}', [EventController::class, 'delete'])->name('events.delete');
        });
        // services
        Route::prefix('services')->group(function ()
        {
            Route::get('/', [ServiceController::class, 'index'])->name('services.index');
            Route::get('data', [ServiceController::class, 'getList'])->name('services.data');

            Route::get('edit/{id}', [ServiceController::class, 'edit'])->name('services.edit');
            Route::put('update/{id}', [ServiceController::class, 'update'])->name('services.update');


            Route::get('create', [ServiceController::class, 'create'])->name('services.create');
            Route::post('store', [ServiceController::class, 'store'])->name('services.store');

            Route::get('delete/{id}', [ServiceController::class, 'delete'])->name('services.delete');
        });
        // services
        Route::prefix('projects')->group(function ()
        {
            Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
            Route::get('data', [ProjectController::class, 'getList'])->name('projects.data');

            Route::get('edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
            Route::put('update/{id}', [ProjectController::class, 'update'])->name('projects.update');


            Route::get('create', [ProjectController::class, 'create'])->name('projects.create');
            Route::post('store', [ProjectController::class, 'store'])->name('projects.store');

            Route::get('delete/{id}', [ProjectController::class, 'delete'])->name('projects.delete');
        });
        // Categories
        Route::prefix('categories')->group(function ()
        {
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('data', [CategoryController::class, 'getList'])->name('categories.data');
            Route::get('view/{id}', [CategoryController::class, 'view'])->name('categories.view');

            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::put('update/{id}', [CategoryController::class, 'update'])->name('categories.update');

            Route::get('create', [CategoryController::class, 'create'])->name('categories.create');
            Route::post('store', [CategoryController::class, 'store'])->name('categories.store');

            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
        });
        // News
        Route::prefix('news')->group(function ()
        {
            Route::get('/', [NewsController::class, 'index'])->name('news.index');
            Route::get('data', [NewsController::class, 'getList'])->name('news.data');
            Route::get('view/{id}', [NewsController::class, 'view'])->name('news.view');

            Route::get('edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
            Route::put('update/{id}', [NewsController::class, 'update'])->name('news.update');


            //Save Image in content quill editor
            Route::post('handlerImage', [NewsController::class, 'handlerImage'])->name('news.handlerImage');
            Route::get('create', [NewsController::class, 'create'])->name('news.create');
            Route::post('store', [NewsController::class, 'store'])->name('news.store');

            Route::get('delete/{id}', [NewsController::class, 'delete'])->name('news.delete');
        });
        // Other News
        Route::prefix('otherNews')->group(function ()
        {
            Route::get('/', [OtherNewsController::class, 'index'])->name('otherNews.index');
            Route::get('data', [OtherNewsController::class, 'getList'])->name('otherNews.data');
            Route::get('view/{id}', [OtherNewsController::class, 'view'])->name('otherNews.view');

            Route::get('edit/{id}', [OtherNewsController::class, 'edit'])->name('otherNews.edit');
            Route::put('update/{id}', [OtherNewsController::class, 'update'])->name('otherNews.update');


            //Save Image in content quill editor
            Route::post('handlerImage', [OtherNewsController::class, 'handlerImage'])->name('otherNews.handlerImage');
            Route::get('create', [OtherNewsController::class, 'create'])->name('otherNews.create');
            Route::post('store', [OtherNewsController::class, 'store'])->name('otherNews.store');

            Route::get('delete/{id}', [OtherNewsController::class, 'delete'])->name('otherNews.delete');
        });
        // Sliders
        Route::prefix('sliders')->group(function ()
        {
            Route::get('/', [SlidersController::class, 'index'])->name('sliders.index');
            Route::get('data', [SlidersController::class, 'getList'])->name('sliders.data');

            Route::get('edit/{id}', [SlidersController::class, 'edit'])->name('sliders.edit');
            Route::put('update/{id}', [SlidersController::class, 'update'])->name('sliders.update');


            Route::get('create', [SlidersController::class, 'create'])->name('sliders.create');
            Route::post('store', [SlidersController::class, 'store'])->name('sliders.store');

            Route::get('delete/{id}', [SlidersController::class, 'delete'])->name('sliders.delete');
        });
        // Components
        Route::prefix('components')->group(function ()
        {
            Route::get('/', [ComponentsController::class, 'index'])->name('components.index');
            Route::get('data', [ComponentsController::class, 'getList'])->name('components.data');

            Route::get('edit/{id}', [ComponentsController::class, 'edit'])->name('components.edit');
            Route::put('update/{id}', [ComponentsController::class, 'update'])->name('components.update');


            Route::post('handlerImage', [ComponentsController::class, 'handlerImage'])->name('components.handlerImage');
            Route::get('create', [ComponentsController::class, 'create'])->name('components.create');
            Route::post('store', [ComponentsController::class, 'store'])->name('components.store');

            Route::get('delete/{id}', [ComponentsController::class, 'delete'])->name('components.delete');
        });
        // partners
        Route::prefix('partners')->group(function ()
        {
            Route::get('/', [PartnerController::class, 'index'])->name('partners.index');
            Route::get('data', [PartnerController::class, 'getList'])->name('partners.data');

            Route::get('edit/{id}', [PartnerController::class, 'edit'])->name('partners.edit');
            Route::put('update/{id}', [PartnerController::class, 'update'])->name('partners.update');


            Route::post('handlerImage', [PartnerController::class, 'handlerImage'])->name('partners.handlerImage');
            Route::get('create', [PartnerController::class, 'create'])->name('partners.create');
            Route::post('store', [PartnerController::class, 'store'])->name('partners.store');

            Route::get('delete/{id}', [PartnerController::class, 'delete'])->name('partners.delete');
        });
        // achievements
        Route::prefix('achievements')->group(function ()
        {
            Route::get('/', [AchievementsController::class, 'index'])->name('achievements.index');
            Route::get('data', [AchievementsController::class, 'getList'])->name('achievements.data');

            Route::get('edit/{id}', [AchievementsController::class, 'edit'])->name('achievements.edit');
            Route::put('update/{id}', [AchievementsController::class, 'update'])->name('achievements.update');


            Route::post('handlerImage', [AchievementsController::class, 'handlerImage'])->name('achievements.handlerImage');
            Route::get('create', [AchievementsController::class, 'create'])->name('achievements.create');
            Route::post('store', [AchievementsController::class, 'store'])->name('achievements.store');

            Route::get('delete/{id}', [AchievementsController::class, 'delete'])->name('achievements.delete');
        });
        // Contacts
        Route::prefix('contacts')->group(function ()
        {
            Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
            Route::get('data', [ContactController::class, 'getList'])->name('contacts.data');
            Route::get('/lienhe', [ContactController::class, 'indexContact'])->name('contacts.indexContact');
            Route::get('dataContact', [ContactController::class, 'getListContact'])->name('contacts.dataContact');

            Route::get('edit/{id}', [ContactController::class, 'edit'])->name('contacts.edit');
            Route::put('update/{id}', [ContactController::class, 'update'])->name('contacts.update');
            Route::get('editContact/{id}', [ContactController::class, 'editContact'])->name('contacts.editContact');
            Route::put('updateContact/{id}', [ContactController::class, 'updateContact'])->name('contacts.updateContact');


            Route::post('handlerImage', [ContactController::class, 'handlerImage'])->name('contacts.handlerImage');
            Route::get('create', [ContactController::class, 'create'])->name('contacts.create');
            Route::post('store', [ContactController::class, 'store'])->name('contacts.store');

            Route::get('delete/{id}', [ContactController::class, 'delete'])->name('contacts.delete');
        });
    });
    // Configs
    //    Route::prefix('configs')->group(function () {
    //        Route::get('edit', [ConfigsController::class, 'edit'])->name('configs.edit');
    //        Route::put('update', [ConfigsController::class, 'update'])->name('configs.update');
    //
    //        Route::get('create', [ConfigsController::class, 'create'])->name('configs.create');
    //        Route::post('store', [ConfigsController::class, 'store'])->name('configs.store');
    //    });
});

//Route Fontend

Route::get('/', [HomeController::class, 'index'])->name('fe.home');
// Route::get('/trang-chu.html', [HomeController::class, 'index'])->name('fe.home');
//Route::post('/login', [HomeController::class, 'login'])->name('home.login');
Route::get('/logout', [HomeController::class, 'logout'])->name('home.logout');

Route::get('/gioi-thieu.html', [HomeController::class, 'introduce'])->name('home.introduce');
Route::get('/tin-tuc.html', [HomeController::class, 'listNews'])->name('home.listnews');
Route::get('/kien-thuc.html', [HomeController::class, 'knowledges'])->name('home.knowledges');
Route::get('/news/{slug}.html', [HomeController::class, 'news'])->name('home.news');
Route::get('/khoa-hoc.html', [HomeController::class, 'product'])->name('home.products');
Route::get('/khoa-hoc/{slug}.html', [HomeController::class, 'productsBySlug'])->name('home.productsBySlug');

Route::get('/lien-he.html', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/thu-vien.html', [HomeController::class, 'library'])->name('home.library');
Route::get('/nghe-sy.html', [HomeController::class, 'artists'])->name('home.artists');
Route::get('/nghe-sy/{slug}.html', [HomeController::class, 'artistDetail'])->name('home.artistDetail');

// Route::get('/chi-tiet-nghe-si.html', [HomeController::class, 'artistDetail'])->name('home.artistDetail');
Route::get('/chinh-sach.html', [HomeController::class, 'policy'])->name('home.policy');
Route::get('/dieu-khoan.html', [HomeController::class, 'rules'])->name('home.rules');
Route::post('/addContact', [HomeController::class, 'addContact'])->name('home.addContact');
Route::post('/addLienhe', [HomeController::class, 'addLienhe'])->name('home.addLienhe');
Route::post('/registerUser', [HomeController::class, 'registerUser'])->name('home.registerUser');
Route::post('/fogot', [HomeController::class, 'sendFogotPasswordMail'])->name('home.fogot');
Route::get('/getById', [HomeController::class, 'getById'])->name('home.getById');
Route::get('thu-vien.html/{id}', [HomeController::class, 'viewDetailLibrary'])->name('home.viewDetailLibrary');