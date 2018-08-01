<?php

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
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/step2', 'UserController@step2');
Route::get('/RegisterdMessage', function () {
    return view('RegisteredMessage');
});
Auth::routes();
//to get file
Route::get('/getFile/{fileName}/{taskId}', 'HomeController@getFile')->name('getFile');

Route::get('/', 'HomeController@errorPage')->name('home');
//CLIENT ROUTES
Route::group(['middleware' => ['role:client']], function () {
    Route::get('/client/home', 'HomeController@index')->name('home');
    Route::get('/client/allocatedManagers', 'HomeController@showAllocatedManagers');

    // Client Task routes
    Route::get('/client/all_Tasks/{projectID}', 'TaskController@all_Tasks');
    Route::post('/client/addTask', 'TaskController@addNewTask');
    Route::get('/client/tasksDetails/{taskid}', 'TaskController@tasksDetails');
    Route::post('/client/Comment', 'TaskController@addCommentClient');
    // Client Project routes
    Route::get('/client/projects', 'ProjectController@index');
    Route::post('/client/addProject', 'ProjectController@addNewProject');
    //Clinet request for new resourece
    Route::get('/client/requestNewResource', 'UserController@reqNewResource');
    Route::post('/client/reqNewResourceRegister', 'UserController@reqNewResourceRegister');
    Route::get('/client/viewRequest', 'UserController@viewRequest');

});
//CM Routes

Route::group(['middleware' => ['role:CM']], function () {
    Route::get('/cm/home', 'HomeController@index')->name('home');
    Route::post('/cm/Comment', 'TaskController@addComment');
    Route::get('/cm/viewTasks', 'UserController@viewTasksCM')->name('viewTasks');
    Route::get('/cm/tasksDetails/{taskid}', 'TaskController@tasksDetails');
});

//HR routes
Route::group(['middleware' => ['role:HR']], function () {
    Route::get('/hr/home', 'HomeController@index')->name('home');
    //clients
    Route::get('/hr/clients', 'UserController@index');
    Route::get('/hr/clientDetails/{id}', 'UserController@clientDetails');
    Route::get('/hr/cmDetails/{id}', 'UserController@cmDetails');
    //client Manager
    Route::get('/hr/cm', 'UserController@clientManagerForm');
    Route::get('/hr/allcm', 'UserController@allClientsManager');
    Route::post('/hr/cmSubmit', 'UserController@clientManagerSubmit');
    //Allocation
    Route::get('/hr/allocation/{id}', 'AllocationController@allcoateResource');
    Route::post('/hr/allocate', 'AllocationController@saveAllocation');
    Route::get('/hr/viewAllocation{id}', 'AllocationController@viewAllocation');    
    Route::get('/hr/viewProjects', 'ProjectController@viewAllProjects');
    Route::get('/hr/ProjectsAllTasks/{projectID}', 'TaskController@viewAllTasks');
    
});
//Boss Routes
Route::group(['middleware' => ['role:director']], function () {
    Route::get('/admin/home', 'HomeController@index')->name('home');
    Route::get('/admin/registerRequests', 'UserController@index');
    Route::get('/admin/clients', 'UserController@allApprovedClients');
    Route::get('/admin/Users', 'UserController@allUser');
    Route::get('/admin/addHR', 'UserController@HRform');
    Route::post('/admin/hrSubmit', 'UserController@HRSubmit');
    Route::get('/admin/viewProjects', 'ProjectController@viewAllProjects'); 
    Route::get('/admin/ProjectsAllTasks/{projectID}', 'TaskController@viewAllTasks');   
    Route::get('/admin/tasksDetails/{taskid}', 'TaskController@tasksDetails');
    Route::get('/admin/viewreport', 'UserController@viewReport');

     
       
});

//---------------AJAX REQUESTs/Calls [Only Post call please to secure the data flow]
Route::post('/delete_clients', 'UserController@deleteClient');
Route::post('/approve_clients_requests', 'UserController@approveClientRequest');
Route::post('/restore_clients', 'UserController@restoreClient');
Route::post('/deleteClientRequest', 'UserController@deleteClientRequest');
Route::post('/deleteAllocatedCM', 'AllocationController@deleteAllocatedCM');
//timer routes
Route::post('/addStartTime', 'TaskController@addStartTime');
Route::post('/Pause', 'TaskController@addPauseTime');
Route::post('/Resume', 'TaskController@addResumeTime');
Route::post('/EndTime', 'TaskController@addEndTime');
Route::post('/currentStatus', 'TaskController@currentStatus');
//end timer routes

// CommentAjax
Route::post('/commentsData', 'TaskController@CommentAjax');
Route::post('/Comment', 'TaskController@addComment');


//chat Routes
Route::get('/list', 'ChatsController@list');
Route::get('/chat/{id}', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');

