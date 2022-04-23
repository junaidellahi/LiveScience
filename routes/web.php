<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudyController;

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
    return view('home');
});

Route::get('/home', function () {
    return view('home');
}); 
//create page
Route::get('/create', function () {
    return view('studies.create');
});

Route::get('/studies', [StudyController::class, 'showall']);//SHOWS ALL STUDIES ON MY STUDIES PAGE
Route::get('/studies/category/{category}', [StudyController::class, 'showsubjects']);// SUB NAV BAR SHOW ONLY 1 SUBJECT TYPE
Route::get('/studies/{id}', [StudyController::class, 'showdetails']);//ALLOWS USER TO SEE A SEE A STUDY AND ITS DETAILS
//like a study
Route::post('/studies/like/{id}',[StudyController::class, 'like'] );

Route::get('/dataset/download/{id}', [StudyController::class, 'downloaddataset']);//download dataset
Route::get('/studies/download/{id}', [StudyController::class, 'download']);// DOWNLOAD supporting document/experiment design

//create a study
Route::post('/createstudy',[StudyController::class, 'store'] );

//manage my studies
Route::get('/managemystudies', [StudyController::class, 'managemystudies']); //SHOWS ALL OF USER STUDIES
Route::get('/studies/manageresults/{id}', [StudyController::class, 'manageresults']);//PAGE TO DELETE AND ADD RESULTS
Route::get('/studies/managecomments/{id}', [StudyController::class, 'managecomments']);//PAGE TO DELETE AND ADD COMMENTS
Route::get('/studies/manage/{id}', [StudyController::class, 'manage']);//PAGE EDIT STUDY DETAILS AND ADD REFERENCES


Route::POST('/update/{id}',[StudyController::class, 'updatestudydetails'] ); //LINKS TO METHOD TO UPDATE DETAILS FORM
Route::POST('/addreference/{id}',[StudyController::class, 'addreference'] );//LINKS TO METHOD TO ADD REREFCE
Route::POST('/comment/{id}',[StudyController::class, 'addcomment'] );//LINKS TO METHOD TO ADD COMMENT 


Route::delete('/deletecomment/{id}', [StudyController::class, 'deletecomment']);//LINKS TO METHOD TO DELETE COMMENT REREFCE
Route::delete('/deletedata/{id}', [StudyController::class, 'deletedataset']);//DELETE A RESULT OR DATASET
Route::delete('/removestudy/{id}', [StudyController::class, 'removestudy']); //DELETE STUDY



Route::get('/editstudy/{id}', [StudyController::class, 'editstudy']);



//LINKS TO FUNCTION TO CREATE A STUDY
Route::post('/createstudy',[StudyController::class, 'store'] );
//LINKS TO FUNCTION TO ADD A DATASET TO A STUDY
Route::post('/adddataset',[StudyController::class, 'adddataset'] );


Auth::routes();

//DELETE FUNCTION ON MYSTUDY PAGE



//SHOW THE SPECIFIC SUBJECTS

//ALLOWS USER TO SEE DOWNLOAD A FILE


