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

Route::get('/', function () {
    return redirect()->to('/login');
});

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/admin/account-crm', 'AdminController@getAccountCRM')->name('account_crm');
Route::get('/admin/contacts', 'ContactsController@index')->name('contacts');

Route::group(['prefix' => '/admin/contacts'], function () {
    Route::get('/view/{id}', 'ContactsController@viewContact')
        ->name('view_contact')
        ->middleware('auth', 'can:read-contacts');
    Route::get('/create', 'ContactsController@create')
        ->name('create_contact')
        ->middleware('auth', 'can:create-contacts');
    Route::post('/create', 'ContactsController@store')
        ->name('store_contact')
        ->middleware('auth', 'can:create-contacts');
    Route::get('/edit/{id}', 'ContactsController@editContact')
        ->name('edit_contact')
        ->middleware('auth', 'can:update-contacts');
    Route::post('/edit', 'ContactsController@updateContact')
        ->name('update_contact')
        ->middleware('auth', 'can:update-contacts');
    Route::post('/delete', 'ContactsController@deleteContact')
        ->name('delete_contact')
        ->middleware('auth', 'can:delete-contacts');
    Route::post('/import', 'ContactsController@import')
        ->name('import_contacts')
        ->middleware('auth', 'can:create-contacts');
});

Route::get('/admin/leads', 'LeadsController@index')->name('leads');

Route::group(['prefix' => '/admin/leads'], function () {
    Route::get('/view/{id}', 'LeadsController@viewLead')
        ->name('view_lead')
        ->middleware('auth', 'can:read-leads');
    Route::get('/create', 'LeadsController@createLead')
        ->name('create_lead')
        ->middleware('auth', 'can:create-leads');
    Route::post('/create', 'LeadsController@store')
        ->name('store_lead')
        ->middleware('auth', 'can:create-leads');
    Route::get('/edit/{id}', 'LeadsController@editLead')
        ->name('edit_lead')
        ->middleware('auth', 'can:update-leads');
    Route::post('/edit', 'LeadsController@updateLead')
        ->name('update_lead')
        ->middleware('auth', 'can:update-leads');
    Route::post('/delete', 'LeadsController@deleteLead')
        ->name('delete_lead')
        ->middleware('auth', 'can:delete-leads');
    Route::post('/import', 'LeadsController@import')
        ->name('import_leads')
        ->middleware('auth', 'can:create-leads');
});

Route::get('/admin/users', 'UsersController@index')->name('users');

Route::group(['prefix' => '/admin/users'], function () {
    Route::get('/view/{id}', 'UsersController@viewUser')
        ->name('view_user')
        ->middleware('auth', 'can:read-users');
    Route::get('/create', 'UsersController@createUser')
        ->name('create_user')
        ->middleware('auth', 'can:create-users');
    Route::post('/create', 'UsersController@storeUser')
        ->name('store_user')
        ->middleware('auth', 'can:create-users');
    Route::get('/edit/{id}', 'UsersController@editUser')
        ->name('edit_user')
        ->middleware('auth', 'can:update-users');
    Route::post('/edit', 'UsersController@updateUser')
        ->name('update_user')
        ->middleware('auth', 'can:update-users');
    Route::post('/delete', 'UsersController@deleteUser')
        ->name('delete_user')
        ->middleware('auth', 'can:delete-users');
});