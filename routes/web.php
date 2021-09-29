<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\URL;

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
Route::resource('/interview', 'InterviewController');
Route::resource('/fileupload', 'FileUploadsController');

Route::get('/details/{id}', 'InterviewController@details')->name('detail');

// URL::temporarySignedRoute('detail.show', now()->addSeconds(5));

Route::middleware(['auth'])->group(function () {

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/all_entries', function () {
    return view('entries/index');
});

Route::get('/all_sessions', function () {
    return view('entries/all_records');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/interview', function () {
    return view('Batchs/interview_batch');
});

Route::resource('/users', 'UserController');
Route::get('/users/kill/{id}', 'UserController@kill')->name('users.kill');
Route::get('/downloadTemplate', 'UserController@downloadCandidateTemplate')->name('candidates.template');
Route::post('/importTemplate', 'UserController@importTemplate')->name('import_Template');
Route::get('/downloadTemplate/groups', 'GroupController@downloadGroupTemplate')->name('groups.template');
Route::resource('/groups', 'GroupController');
Route::resource('/candidates', 'CandidateController');
Route::get('/session_ended', 'InterviewController@session_expire')->name('session_ended');
Route::get('/live-video', 'InterviewController@interviewVideo')->name('interviewVideo');
Route::get('/send-video-links', 'InterviewController@send_links')->name('sendLinks');
Route::get('/upload', 'UserController@upload')->name('candidates.upload');
Route::get('/upload/groups', 'GroupController@upload')->name('groups.upload');
Route::post('/importTemplate/groups', 'GroupController@importTemplate')->name('importTemplate');
Route::get('/groups/all/{group?}',"GroupController@group_users")->name("groups.group_index");
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

