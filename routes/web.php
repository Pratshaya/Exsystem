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


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => ['role:administrator|superadministrator']], function () {

//User
    Route::resource('/user', 'UserController');

//Category
    Route::resource('category', 'CategoryController');

//Category Questionnaire

    Route::resource('category_questionnaire', 'CategoryQuestionnaireController');

//Quiz
    Route::get('quiz/index', 'QuizController@index')->name('quiz.index');
    Route::post('quiz/store', 'QuizController@store')->name('quiz.store');
    Route::get('quiz/{quiz}/edit', 'QuizController@edit')->name('quiz.edit');
    Route::put('quiz/{quiz}/update', 'QuizController@update')->name('quiz.update');
    Route::delete('quiz/{quiz}/destroy', 'QuizController@destroy')->name('quiz.destroy');

//Question
    Route::get('question/index', 'QuestionController@index')->name('question.index');
    Route::get('question/{quiz}/show', 'QuestionController@show')->name('question.show');
    Route::post('question/{quiz}/store', 'QuestionController@store')->name('question.store');
    Route::post('question/{question}/destroy', 'QuestionController@destroy')->name('question.destroy');

//Options
    Route::get('option/{question}/fetch', 'OptionController@fetch')->name('option.fetch');

//Result
    Route::resource('result', 'ResultController');
    Route::get('/result/{user}/chart', 'ResultController@chart')->name('result.chart');
    Route::get('/result/{user}/result', 'ResultController@result_show')->name('result.result_show');

    Route::resource('resultquestionnaite', 'ResultController');
    Route::get('/resultquestionnaite/{user}/chart', 'ResultController@chart')->name('resultquestionnaite.chart');
    Route::get('/resultquestionnaite/{user}/result', 'ResultController@result_show')->name('resultquestionnaite.result_show');

    Route::resource('slider', 'SliderController');
    Route::resource('post', 'PostController');
    Route::resource('tag', 'TagController');

//Questionnaire
    Route::get('questionnaire/index', 'QuestionnaireController@index')->name('questionnaire.index');
    Route::post('questionnaire/store', 'QuestionnaireController@store')->name('questionnaire.store');
    Route::get('questionnaire/{questionnaire}/edit', 'QuestionnaireController@edit')->name('questionnaire.edit');
    Route::put('questionnaire/{questionnaire}/update', 'QuestionnaireController@update')->name('questionnaire.update');
    Route::delete('questionnaire/{questionnaire}/destroy', 'QuestionnaireController@destroy')->name('questionnaire.destroy');

//PhaseQuestionnaire
    Route::get('questionnaire/manament/index', 'PhaseQuestionnaireController@index')->name('phase_questionnaire.index');
    Route::post('questionnaire/manament/questionnaire/{questionnaire}/store', 'PhaseQuestionnaireController@store')->name('phase_questionnaire.store');
    Route::post('questionnaire/manament/questionnaire/{phase_questionnaire}/option_store', 'PhaseQuestionnaireController@option_store')->name('phase_questionnaire.option_store');
    Route::get('questionnaire/manament/questionnaire/{questionnaire}/edit', 'PhaseQuestionnaireController@edit')->name('phase_questionnaire.edit');
    Route::get('questionnaire/manament/questionnaire/{questionnaire}/show', 'PhaseQuestionnaireController@show')->name('phase_questionnaire.show');
    Route::put('questionnaire/manament/questionnaire/{questionnaire}/update', 'PhaseQuestionnaireController@update')->name('phase_questionnaire.update');
    Route::delete('questionnaire/manament/questionnaire/{phaseQuestionnaire}/destroy', 'PhaseQuestionnaireController@destroy')->name('phase_questionnaire.destroy');

//Questionnaire
    Route::get('questionnaire/phase/question/index', 'QuestionPhaseController@index')->name('question_phase_questionnaire.index');
    Route::get('questionnaire/phase/question/{questionnaire}/show', 'QuestionPhaseController@show')->name('question_phase_questionnaire.show');
    Route::get('questionnaire/phase/question/{phase}/create', 'QuestionPhaseController@create')->name('question_phase_questionnaire.create');
    Route::post('questionnaire/phase/question/{phase}/store', 'QuestionPhaseController@store')->name('question_phase_questionnaire.store');

//Measurement
    Route::get('questionnaire/phase/measurement/index', 'MeasurementController@index')->name('measurement_phase_questionnaire.index');
    Route::get('questionnaire/phase/measurement/{questionnaire}/show', 'MeasurementController@show')->name('measurement_phase_questionnaire.show');
    Route::post('questionnaire/phase/measurement/store', 'MeasurementController@store')->name('measurement_phase_questionnaire.store');
    Route::delete('questionnaire/phase/measurement/{measurement}/destroy', 'MeasurementController@destroy')->name('measurement_phase_questionnaire.destroy');
    Route::get('questionnaire/phase/measurement/{measurement}/edit', 'MeasurementController@edit')->name('measurement_phase_questionnaire.edit');
    Route::put('questionnaire/phase/measurement/{measurement}/update', 'MeasurementController@update')->name('measurement_phase_questionnaire.update');

//Public
    Route::get('questionnaire/{questionnaire}/publish_questionnaire/show', 'PublishQuestionnaireController@show')->name('publish_questionnaire.show');
    Route::put('questionnaire/{phase}/publish_questionnaire/public', 'PublishQuestionnaireController@public')->name('publish_questionnaire.public');


    //Question Match
//    Route::get('quiz/question_match/index', 'QuizController@index')->name('quiz.index');
//    Route::post('quiz/question_match/store', 'QuizController@store')->name('quiz.store');
//    Route::get('quiz/question_match/{quiz}/edit', 'QuizController@edit')->name('quiz.edit');
//    Route::put('quiz/{quiz}/update', 'QuizController@update')->name('quiz.update');
//    Route::delete('quiz/{quiz}/destroy', 'QuizController@destroy')->name('quiz.destroy');

});


Route::group(['middleware' => ['auth']], function () {
    //Student
    Route::get('/student/result_all', 'StudentController@result_all')->name('student.result_all');
    Route::get('/student/result_all_questionnaire', 'StudentController@result_all_questionnaire')->name('student.result_all_questionnaire');
    Route::get('/student/posts', 'StudentController@posts')->name('student.posts');
    Route::get('/student/quizzes', 'StudentController@quizzes')->name('student.quizzes');
    Route::get('/student/{quiz}', 'StudentController@show')->name('student.show');
    Route::get('/student', 'StudentController@index')->name('student.index');
    Route::get('/student/{questionnaire}/showStudent', 'StudentController@show_questionnaire')->name('student.show_questionnaire');
    Route::get('/student/{category}/category', 'StudentController@index_category')->name('student.index_category');
    Route::post('/student/{quiz}/store', 'StudentController@store')->name('student.store');
    Route::post('/student/{questionnaire}/store_questionnaire', 'StudentController@store_questionnaire')->name('student.store_questionnaire');
    Route::get('/student/{post}/post', 'StudentController@post')->name('student.post');
    Route::get('/student/{result}/result_quiz', 'StudentController@result_quiz')->name('student.result_quiz');
    Route::get('/student/{result_questionnaire}/result_questionnaire', 'StudentController@result_questionnaire')->name('student.result_questionnaire');

});