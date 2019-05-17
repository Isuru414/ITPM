<?php
Route::get('/', function () { return view('index'); });


Route::get('/courses', 'coursecontrolleradd@index');
Route::get('/wall', 'wallmanagementcontroller@something');
Route::get('/digital', 'digitallibbrarycontroller@something');


Route::get('/course', function () { return view('course'); });

Route::get('/contact', function () { return view('contact'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Registration Routes...
 $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
 $this->post('register', 'Auth\RegisterController@register')->name('auth.register');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('courses', 'Admin\CoursesController');
    Route::post('courses_mass_destroy', ['uses' => 'Admin\CoursesController@massDestroy', 'as' => 'courses.mass_destroy']);
    Route::post('courses_restore/{id}', ['uses' => 'Admin\CoursesController@restore', 'as' => 'courses.restore']);
    Route::delete('courses_perma_del/{id}', ['uses' => 'Admin\CoursesController@perma_del', 'as' => 'courses.perma_del']);
    Route::resource('lessons', 'Admin\LessonsController');
    Route::post('lessons_mass_destroy', ['uses' => 'Admin\LessonsController@massDestroy', 'as' => 'lessons.mass_destroy']);
    Route::post('lessons_restore/{id}', ['uses' => 'Admin\LessonsController@restore', 'as' => 'lessons.restore']);
    Route::delete('lessons_perma_del/{id}', ['uses' => 'Admin\LessonsController@perma_del', 'as' => 'lessons.perma_del']);
    Route::resource('digital_libraries', 'Admin\DigitalLibrariesController');
    Route::post('digital_libraries_mass_destroy', ['uses' => 'Admin\DigitalLibrariesController@massDestroy', 'as' => 'digital_libraries.mass_destroy']);
    Route::post('digital_libraries_restore/{id}', ['uses' => 'Admin\DigitalLibrariesController@restore', 'as' => 'digital_libraries.restore']);
    Route::delete('digital_libraries_perma_del/{id}', ['uses' => 'Admin\DigitalLibrariesController@perma_del', 'as' => 'digital_libraries.perma_del']);
    Route::resource('wall_managements', 'Admin\WallManagementsController');
    Route::post('wall_managements_mass_destroy', ['uses' => 'Admin\WallManagementsController@massDestroy', 'as' => 'wall_managements.mass_destroy']);
    Route::post('wall_managements_restore/{id}', ['uses' => 'Admin\WallManagementsController@restore', 'as' => 'wall_managements.restore']);
    Route::delete('wall_managements_perma_del/{id}', ['uses' => 'Admin\WallManagementsController@perma_del', 'as' => 'wall_managements.perma_del']);
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');



 
});
