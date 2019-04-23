<?php
Route::get('/', function () {
    return view('index');
});
Route::get('/classification', function () {
    return view('classification');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/profile', 'UserController@loginValidate')->name('profile');
Route::get('/register', function () {
    return view('register');
});
Route::get('/game', function () {
    return view('game');
});
Route::get('/test/{id}', 'UserController@testAuth');

Route::post('/game', 'UserController@animate')->name('animate');

Route::get('/algorithms/bubble_sort', function () {
    return view('/algorithms/Bubble_sort');
});
Route::get('/algorithms/heap_sort', function () {
    return view('/algorithms/Heap_sort');
});
Route::get('/algorithms/insertion_sort', function () {
    return view('/algorithms/Insertion_sort');
});
Route::get('/algorithms/merge_sort', function () {
    return view('/algorithms/Merge_sort');
});
Route::get('/algorithms/quick_sort', function () {
    return view('/algorithms/Quick_sort');
});
Route::get('/algorithms/selection_sort', function () {
    return view('/algorithms/Selection_sort');
});

Route::post('/profile/oracle',  'UserController@oracle')->name('profile/oracle');
Route::post('/profile/profile', 'UserController@loginValidate')->name('profile/profile');
Route::post('/profile/register','UserController@register');
Route::post('/profile/login',   'UserController@login');
Route::post('/profile/test',    'UserController@testValidate');
Route::post('/profile/logout',  'UserController@logout')->name('profile/logout');
Route::post('/profile/report',  'UserController@reportValidate');
Route::post('/profile/test_wrong',  'UserController@test_wrongValidate');
Route::post('/profile/update_wrong',  'UserController@test_updateWrongValidate')->name('profile/update_wrong');

Route::get('/profile/oracle',  'UserController@loginValidate');
Route::get('/profile/register','UserController@loginValidate');
Route::get('/profile/report',  'UserController@reportValidate');
Route::get('/profile/login',   'UserController@loginValidate');
Route::get('/profile/logout',  'UserController@logout')->name('profile/logout');
Route::get('/profile/profile', 'UserController@loginValidate')->name('profile/profile');
Route::get('/profile/test',    'UserController@testValidate')->name('profile/test');
Route::get('/profile/test_wrong/{mode}',  'UserController@test_wrongValidate')->name('profile/test_wrong');
