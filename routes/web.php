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
Route::post('/blob-upload', 'FileUploadsController@saveBlob');

Route::get('/details/{id}/{user_id}/{client_id}', 'InterviewController@details')->name('details');

// URL::temporarySignedRoute('detail.show', now()->addSeconds(5));
Route::get('/interview/{id}/{user_id}/{client_id}', 'InterviewController@show_interview')->name('show.interview');

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


Route::get('/interview', function () {
    return view('Batchs/interview_batch');
});

Route::get('/all_sessions', 'FileUploadsController@all_entries')->name('all_entries');
Route::resource('/users', 'UserController');
Route::get('/index', 'UserController@dashboard')->name('users.dashboard');
Route::get('/users/kill/{id}', 'UserController@kill')->name('users.kill');
Route::get('/downloadTemplate', 'UserController@downloadCandidateTemplate')->name('candidates.template');
Route::post('/importTemplate', 'UserController@importTemplate')->name('import_Template');
Route::get('/downloadTemplate/groups', 'GroupController@downloadGroupTemplate')->name('groups.template');
Route::get('/groups/kill/{id}', 'GroupController@kill')->name('groups.kill');
Route::resource('/groups', 'GroupController');
Route::resource('/candidates', 'CandidateController');
Route::get('/admin/candidates/', 'CandidateController@adminCands')->name('adminCands');
Route::get('/candidates/kill/{id}', 'CandidateController@kill')->name('candidates.kill');
Route::get('/session_ended', 'InterviewController@session_expire')->name('session_ended');
Route::get('/all_candidates/interviews', 'InterviewController@all_candidates')->name('all_candidates');
Route::get('/live-video', 'InterviewController@interviewVideo')->name('interviewVideo');
Route::get('/send-video-links', 'InterviewController@send_links')->name('sendLinks');
Route::get('/upload', 'UserController@upload')->name('candidates.upload');
Route::get('/upload/groups', 'GroupController@upload')->name('groups.upload');
Route::get('/clients/groups', 'GroupController@clients_grp')->name('groups.clients');
Route::post('/importTemplate/groups', 'GroupController@importTemplate')->name('importTemplate');
Route::get('/groups/all/{group?}',"GroupController@group_users")->name("groups.group_index");
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

