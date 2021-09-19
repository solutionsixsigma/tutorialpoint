<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\QuestionTypeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubTopicsController;
use App\Http\Controllers\LanguageController;

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

Route::get('/userpanel', function () {
    return view('userpanel.index');
});

Route::get('/', function () {
    return view('userpanel.index');
});

Route::get('/userpanel/user/', function () {
    return view('userpanel.user');
});

Route::get('/userpanel/impboard/', function () {
    return view('userpanel.impboard');
});

Route::get('/userpanel/dashboard', function () { return view('userpanel.dashboard'); });

Route::get('/userpanel/classes/', function () { return view('userpanel.classes'); });
Route::get('/userpanel/subject/', function () { return view('userpanel.subject'); });
Route::get('/userpanel/topics/', function () { return view('userpanel.topics'); });
Route::get('/userpanel/subtopics/', function () { return view('userpanel.subtopics'); });
Route::get('/userpanel/language/', function () { return view('userpanel.language'); });
Route::get('/userpanel/questiontype/', function () { return view('userpanel.questiontype'); });
Route::get('/userpanel/keywords/', function () { return view('userpanel.keyword'); });

Route::get('/login', [UserController::class,'login']);
Route::get('/registration', [UserController::class,'registration']);
Route::post('/user/registerUser', [UserController::class,'userpanel.user.registerUser']);
Route::post('/login-auth', [UserController::class,'loginUser'])->name('login-auth');

/**************************************** Board ****************************************** */
Route::get('/userpanel/board', function () { return view('userpanel.board'); });
Route::get('/userpanel/board',[BoardController::class,'index']);
Route::post('subBoard',[BoardController::class,'create'])->name('subBoard');
Route::put('/board',[BoardController::class,'updateboard'])->name('board.update');
Route::delete('/delete/{id}',[BoardController::class,'destroy']);
Route::get('/edit/{id}',[BoardController::class,'edit']);
Route::put('/edit/{id}',[BoardController::class,'edit']);
Route::get('/view/{id}',[BoardController::class,'edit']);
Route::delete('/selected-boards', [BoardController::class,'deleteAllrecord'])->name('board.deleteSelected');
Route::get('/importCsv', [BoardController::class,'importCsv']);
Route::post('/storeCsv', [BoardController::class,'storeCsv']);

/**************************************** Class ****************************************** */

Route::get('/userpanel/classes', function () { return view('userpanel.classes'); });
Route::get('/userpanel/classes',[ClassesController::class,'index']);
Route::post('subClasses',[ClassesController::class,'create'])->name('subClasses');
Route::put('/classes',[ClassesController::class,'updateclasses'])->name('classes.update');
Route::delete('/delete/{id}',[ClassesController::class,'destroy']);
Route::get('/edit/{id}',[ClassesController::class,'edit']);
Route::put('/edit/{id}',[ClassesController::class,'edit']);
Route::get('/view/{id}',[ClassesController::class,'edit']);
Route::delete('/selected-classes', [ClassesController::class,'deleteAllrecord'])->name('classes.deleteclass');
Route::get('/importCsv', [ClassesController::class,'importCsv']);
Route::post('/storeCsv', [ClassesController::class,'storeCsv']);

/**************************************** Subject ****************************************** */

Route::get('/userpanel/subject', function () { return view('userpanel.subject'); });
Route::get('/userpanel/subject',[SubjectController::class,'index']);
Route::post('subSubject',[SubjectController::class,'create'])->name('subSubject');
Route::put('/subject',[SubjectController::class,'updatesubject'])->name('subject.update');
Route::delete('/delete/{id}',[SubjectController::class,'destroy']);
Route::get('/edit/{id}',[SubjectController::class,'edit']);
Route::put('/edit/{id}',[SubjectController::class,'edit']);
Route::get('/view/{id}',[SubjectController::class,'edit']);
Route::delete('/selected-subject', [SubjectController::class,'deleteAllrecord'])->name('subject.deleteSubjectSelected');
Route::get('/importCsv', [SubjectController::class,'importCsv']);
Route::post('/storeCsv', [SubjectController::class,'storeCsv']);


/**************************************** Topics ****************************************** */


Route::get('/userpanel/topics', function () { return view('userpanel.topics'); });
Route::get('/userpanel/topics',[TopicsController::class,'index']);
Route::post('subTopics',[TopicsController::class,'create'])->name('subTopics');
Route::put('/topics',[TopicsController::class,'updatetopics'])->name('topics.update');
Route::delete('/delete/{id}',[TopicsController::class,'destroy']);
Route::get('/edit/{id}',[TopicsController::class,'edit']);
Route::put('/edit/{id}',[TopicsController::class,'edit']);
Route::get('/view/{id}',[TopicsController::class,'edit']);
Route::delete('/selected-topics', [TopicsController::class,'deleteAllrecord'])->name('topics.deleteTopicsSelected');
Route::get('/importCsv', [TopicsController::class,'importCsv']);
Route::post('/storeCsv', [TopicsController::class,'storeCsv']);

/**************************************** Subtopics ****************************************** */

Route::get('/userpanel/subtopics', function () { return view('userpanel.subtopics'); });
Route::get('/userpanel/subtopics',[SubTopicsController::class,'index']);
Route::post('subSubTopics',[SubTopicsController::class,'create'])->name('subSubTopics');
Route::put('/subtopics',[SubTopicsController::class,'updatesubtopics'])->name('subtopics.update');
Route::delete('/delete/{id}',[SubTopicsController::class,'destroy']);
Route::get('/edit/{id}',[SubTopicsController::class,'edit']);
Route::put('/edit/{id}',[SubTopicsController::class,'edit']);
Route::get('/view/{id}',[SubTopicsController::class,'edit']);
Route::delete('/selected-subtopics', [SubTopicsController::class,'deleteAllrecord'])->name('subtopics.deleteSubTopicsSelected');
Route::get('/importCsv', [SubTopicsController::class,'importCsv']);
Route::post('/storeCsv', [SubTopicsController::class,'storeCsv']);

/**************************************** Type Of QUestion ****************************************** */

Route::get('/userpanel/questiontype', function () { return view('userpanel.questiontype'); });
Route::get('/userpanel/questiontype',[QuestionTypeController::class,'index']);
Route::post('subQuestionType',[QuestionTypeController::class,'create'])->name('subQuestionType');
Route::put('/questiontype',[QuestionTypeController::class,'updatequestiontype'])->name('questiontype.update');
Route::delete('/delete/{id}',[QuestionTypeController::class,'destroy']);
Route::get('/edit/{id}',[QuestionTypeController::class,'edit']);
Route::put('/edit/{id}',[QuestionTypeController::class,'edit']);
Route::get('/view/{id}',[QuestionTypeController::class,'edit']);
Route::delete('/selected-questiontype', [QuestionTypeController::class,'deleteAllrecord'])->name('questiontype.deleteQuestionTypeSelected');
Route::get('/importCsv', [QuestionTypeController::class,'importCsv']);
Route::post('/storeCsv', [QuestionTypeController::class,'storeCsv']);


/**************************************** Language ****************************************** */

Route::get('/userpanel/language', function () { return view('userpanel.language'); });
Route::get('/userpanel/language',[LanguageController::class,'index']);
Route::post('subLanguage',[LanguageController::class,'create'])->name('subLanguage');
Route::put('/language',[LanguageController::class,'updatelanguage'])->name('language.update');
Route::delete('/delete/{id}',[LanguageController::class,'destroy']);
Route::get('/edit/{id}',[LanguageController::class,'edit']);
Route::put('/edit/{id}',[LanguageController::class,'edit']);
Route::get('/view/{id}',[LanguageController::class,'edit']);
Route::delete('/selected-language', [LanguageController::class,'deleteAllrecord'])->name('language.deleteLangSelected');
Route::get('/importCsv', [LanguageController::class,'importCsv']);
Route::post('/storeCsv', [LanguageController::class,'storeCsv']);


/**************************************** Keywords ****************************************** */

Route::get('/userpanel/keyword', function () { return view('userpanel.keyword'); });
Route::get('/userpanel/keyword',[KeywordController::class,'index']);
Route::post('subKeyword',[KeywordController::class,'create'])->name('subKeyword');
Route::put('/keyword',[KeywordController::class,'updatekeyword'])->name('keyword.update');
Route::delete('/delete/{id}',[KeywordController::class,'destroy']);
Route::get('/edit/{id}',[KeywordController::class,'edit']);
Route::put('/edit/{id}',[KeywordController::class,'edit']);
Route::get('/view/{id}',[KeywordController::class,'edit']);
Route::delete('/selected-keyword', [KeywordController::class,'deleteAllrecord'])->name('topics.deleteKeySelected');
Route::get('/importCsv', [KeywordController::class,'importCsv']);
Route::post('/storeCsv', [KeywordController::class,'storeCsv']);
