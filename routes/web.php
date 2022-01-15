<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');
// Route::get('/', 'GalleryController@gallery');
Route::get('/wedding/gallery', 'GalleryController@gallery');
Route::get('/wedding/gallery-wide', 'GalleryController@galleryWide');
Route::get('/wedding/gallery/get_files', 'GalleryController@getPhotoList');
Route::get('/wedding/video', 'GalleryController@gallerywide');
Route::get('/admin/admin/admin/gallery', 'GalleryController@adminGallery');
Route::get('/admin/admin/admin/gallery/get_list', 'GalleryController@getAdminList');
Route::post('/admin/admin/admin/gallery/delete', 'GalleryController@deleteFile');
Route::post('/admin/admin/admin/gallery/restore', 'GalleryController@restoreFile');
Route::post('/admin/admin/admin/gallery/save-image', 'GalleryController@saveImage');