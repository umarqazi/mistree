<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('workshop')->user();

    //dd($users);

    return view('workshop.home');
})->name('home');

