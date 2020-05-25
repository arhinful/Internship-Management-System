<?php

Route::group(['namespace' => 'Staff'], function() {
    Route::get('/', 'HomeController@index')->name('staff.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('staff.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('staff.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('staff.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('staff.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('staff.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('staff.password.reset');

    // Must verify email
    Route::get('email/resend','Auth\VerificationController@resend')->name('staff.verification.resend');
    Route::get('email/verify','Auth\VerificationController@show')->name('staff.verification.notice');
    Route::get('email/verify/{id}','Auth\VerificationController@verify')->name('staff.verification.verify');

    //my routes
    //student routes
    Route::get('all_students', 'HomeController@all_students')->name('staff.all_students');
    Route::get('add_student', 'HomeController@add_student')->name('staff.add_student');
    Route::get('student/{id}', 'HomeController@single_student')->name('staff.single_student');
    Route::get('all_students_score', 'HomeController@all_students_score')->name('staff.all_students_score');
    Route::get('registered_companies', 'HomeController@registered_companies')->name('staff.registered_companies');
    Route::get('single_company/{id}', 'HomeController@single_company')->name('staff.single_company');
    Route::get('activities/{id}', 'HomeController@activities')->name('staff.activities');

    Route::get('current_student/{company_id}', 'HomeController@current_students')->name('staff.current_students');
    Route::get('previous_student/{company_id}', 'HomeController@previous_students')->name('staff.previous_students');
    //register student
    Route::post('register_student', 'HomeController@register_student')->name('staff.register_student');

    Route::get('settings', 'HomeController@settings')->name('staff.settings');
    Route::post('update_settings', 'HomeController@update_settings')->name('staff.update_settings');

});