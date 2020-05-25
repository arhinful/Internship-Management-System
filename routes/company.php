<?php

Route::group(['namespace' => 'Company'], function() {
    Route::get('/', 'HomeController@index')->name('company.dashboard');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('company.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('company.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('company.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Passwords
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('company.password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('company.password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('company.password.reset');

    // Must verify email
    Route::get('email/resend','Auth\VerificationController@resend')->name('company.verification.resend');
    Route::get('email/verify','Auth\VerificationController@show')->name('company.verification.notice');
    Route::get('email/verify/{id}','Auth\VerificationController@verify')->name('company.verification.verify');

    //my routes
    Route::get('all_enrolled_student','HomeController@all_enrolled_student')->name('company.all_enrolled_student');
    Route::get('enroll_new_student','HomeController@enroll_new_student')->name('company.enroll_new_student');
    Route::get('profile','HomeController@profile')->name('company.profile');
    Route::post('enroll_student', 'HomeController@enroll_student')->name('company.enroll_student');
    Route::get('student_details/{id}','HomeController@student_details')->name('company.student_details');
    Route::get('previous_students', 'HomeController@previous_students')->name('company.previous_students');
    Route::post('add_act', 'HomeController@add_act')->name('company.add_act');
    Route::post('update_act', 'HomeController@update_act')->name('company.update_act');
    Route::post('update_profile', 'HomeController@update_profile')->name('company.update');

    Route::post('change_password', 'HomeController@change_password')->name('company.change_password');

});