<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/evaluation', 'EvaluationController@index')->name('evaluation');
Route::post('/save', 'EvaluationController@save')->name('save');
Route::post('/update', 'EvaluationController@update')->name('update');
Route::get('/register', 'Auth\RegisterController@getRegister');
Route::get('/list/users', 'AdminController@redirectToUserList');
Route::get('/list/users-data', 'AdminController@getAllUsers');
Route::get('/manager/dashboard', 'ManagerController@getManagerEmployees');
Route::get('/list/submission-status', 'AdminController@getEmployeesSubmissionStatus');
Route::post('/list/check-submission', 'ManagerController@checkEmployeeSubmission');
Route::post('/approve-submission', 'EvaluationController@approveSubmission');
Route::post('/reject-submission', 'EvaluationController@rejectSubmission');
Route::post('/approve-submission-by-hr', 'EvaluationController@approveSubmissionByHR');

Route::post('/evaluation/ajax-process', 'EvaluationController@submissionAsDraft');
Route::get('/departments', 'DepartmentController@redirectToDepartmentList')->name('departmentList');
Route::get('/department/process-data', 'DepartmentController@list');
Route::get('/department/add-new', 'DepartmentController@index');
Route::post('/submit-department', 'DepartmentController@create')->name('submit-department');

/* Kpi-Subkpi-Department Routes */
Route::get('/subkpis', 'SubkpiController@index')->name('subkpiList');
Route::get('/subkpi/add-new', 'SubkpiController@createSubkpiForm');
Route::post('/submit-subkpi', 'SubkpiController@create');
Route::get('/subkpis', 'SubkpiController@index');
Route::get('/subkpi/add-new', 'SubkpiController@createSubkpiForm');
Route::post('/submit-subkpi', 'SubkpiController@create');
Route::get('/subkpi-data', 'SubkpiController@list');
Route::post('/subkpi-edit', 'SubkpiController@updatePreprocess');
Route::post('/subkpi-update', 'SubkpiController@update');

/* Update user*/
Route::post('/user-edit', 'AdminController@updatePreprocess');
Route::post('/user-update', 'AdminController@updateUser');

/* Scoring */
Route::get('/reports/report-generation', 'ScoreController@scoreTriggerPreprocess');
Route::post('/score-generation', 'ScoreController@scoreTrigger');
Route::get('/score', 'ScoreController@index');
/* Report Generation */
Route::get('/report/generate', 'ReportController@index');
Route::post('/report', 'ReportController@fetchReport');

/* Export Records*/
Route::get('/export-records', 'ExportController@index');
Route::post('/export-records/submissions', 'ExportController@export');
