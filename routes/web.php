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

Route::view('/lay/index', 'index');

Route::group(['middleware' => ['role:administrator|superadministrator']], function () {

//User
    Route::get('user/user_import', 'ImportStudentController@import')->name('user.import');
    Route::post('user/import_file', 'ImportStudentController@import_file')->name('user.import_file');
    Route::resource('/user', 'UserController');

//Category
    Route::resource('category', 'CategoryController');

//Faculty
    Route::resource('faculty', 'FacultyController');

//Department
    Route::resource('department', 'DepartmentController');

//Category Questionnaire

    Route::resource('category_questionnaire', 'CategoryQuestionnaireController');

//Step Questionnaire
    Route::get('questionnaire/step_questionnaire/step_first', 'StepQuestionnaireController@stepFirst')->name('step_questionnaire.step_first');
    Route::post('questionnaire/step_questionnaire/store_first', 'StepQuestionnaireController@storeFirst')->name('step_questionnaire.store_first');

    Route::get('questionnaire/step_questionnaire/{questionnaire}/step_two', 'StepQuestionnaireController@stepTwo')->name('step_questionnaire.step_two');
    Route::post('questionnaire/step_questionnaire/{questionnaire}/store_two', 'StepQuestionnaireController@storeTwo')->name('step_questionnaire.store_two');

    Route::get('questionnaire/step_questionnaire/{questionnaire}/step_three', 'StepQuestionnaireController@stepThree')->name('step_questionnaire.step_three');
    Route::post('questionnaire/step_questionnaire/{questionnaire}/store_three', 'StepQuestionnaireController@storeThree')->name('step_questionnaire.store_three');

    Route::get('questionnaire/step_questionnaire/{questionnaire}/step_four', 'StepQuestionnaireController@stepFour')->name('step_questionnaire.step_four');
    Route::post('questionnaire/step_questionnaire/{questionnaire}/store_four', 'StepQuestionnaireController@storeFour')->name('step_questionnaire.store_four');

//Quiz
    Route::get('quiz/index', 'QuizController@index')->name('quiz.index');
    Route::post('quiz/store', 'QuizController@store')->name('quiz.store');
    Route::get('quiz/{quiz}/edit', 'QuizController@edit')->name('quiz.edit');
    Route::put('quiz/{quiz}/update', 'QuizController@update')->name('quiz.update');
    Route::delete('quiz/{quiz}/destroy', 'QuizController@destroy')->name('quiz.destroy');

    //Objective
    Route::get('quiz/{quiz}/objective/create', 'ObjectiveController@create')->name('objective.create');
    Route::get('quiz/objective/{objective}/edit', 'ObjectiveController@edit')->name('objective.edit');
    Route::post('quiz/{quiz}/objective/store', 'ObjectiveController@store')->name('objective.store');
    Route::delete('quiz/{quiz}/objective/destroy', 'ObjectiveController@destroy')->name('objective.destroy');

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
    Route::get('questionnaire/manament/{questionnaire}/create', 'PhaseQuestionnaireController@create')->name('phase_questionnaire.create');
    Route::post('questionnaire/manament/{questionnaire}/store_phase', 'PhaseQuestionnaireController@store_phase')->name('phase_questionnaire.store_phase');

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
    Route::post('questionnaire/phase/measurement/{questionnaire}/store', 'MeasurementController@store')->name('measurement_phase_questionnaire.store');
//For Questionnaire
    Route::delete('questionnaire/phase/measurement/{measurement}/destroy_questionnaire', 'MeasurementController@destroy_questionnaire')->name('measurement_questionnaire.destroy');
    Route::get('questionnaire/phase/measurement/{measurement}/edit_questionnaire', 'MeasurementController@edit_questionnaire')->name('measurement_questionnaire.edit');
    Route::put('questionnaire/phase/measurement/{measurement}/update_questionnaire', 'MeasurementController@update_questionnaire')->name('measurement_questionnaire.update');

//For Phase
    Route::delete('questionnaire/phase/measurement/{measurement}/destroy', 'MeasurementController@destroy')->name('measurement_phase_questionnaire.destroy');
    Route::get('questionnaire/phase/measurement/{measurement}/edit', 'MeasurementController@edit')->name('measurement_phase_questionnaire.edit');
    Route::put('questionnaire/phase/measurement/{measurement}/update', 'MeasurementController@update')->name('measurement_phase_questionnaire.update');

//For Quize
    Route::get('quiz/measurement/index', 'MeasurementController@index')->name('measurement_quiz.index');
    Route::get('quiz/measurement/{quiz}/show', 'MeasurementQuizController@show')->name('measurement_quiz.show');
    Route::post('quiz/measurement/{quiz}/store', 'MeasurementQuizController@store')->name('measurement_quiz.store');

    Route::delete('quiz/measurement/{measurement}/destroy_quiz', 'MeasurementQuizeController@destroy_quize')->name('measurement_quiz.destroy');
    Route::get('quiz/measurement/{measurement}/edit_quiz', 'MeasurementQuizeController@edit_quize')->name('measurement_quiz.edit');
    Route::put('quiz/measurement/{measurement}/update_quiz', 'MeasurementQuizeController@update_quize')->name('measurement_quiz.update');


//Public
    Route::get('questionnaire/{questionnaire}/publish_questionnaire/show', 'PublishQuestionnaireController@show')->name('publish_questionnaire.show');
    Route::put('questionnaire/{phase}/publish_questionnaire/public', 'PublishQuestionnaireController@public')->name('publish_questionnaire.public');

    Route::get('quiz/{quiz}/publish/show', 'PublishQuizController@show')->name('publish_quiz.show');
    Route::put('quiz/{quiz}/publish/store', 'PublishQuizController@publish')->name('publish_quiz.publish');

//Room
    Route::resource('room', 'RoomController');

//Room Quiz & Questionnaire
    Route::get('room/quiz_questionnaire/index', 'RoomController@quiz_questionnaire')->name('quiz_questionnaire.index');
    Route::get('room/quiz_questionnaire/{room}/show', 'RoomController@show_questionnaire_quiz')->name('quiz_questionnaire.show');
    Route::get('room/quiz_questionnaire/{room}/student', 'RoomController@student')->name('room.student');
    Route::post('room/quiz_questionnaire/{room}/store', 'RoomController@store_questionnaire_quiz')->name('quiz_questionnaire.store');
// Room Quiz
    Route::get('room/quiz_questionnaire/{room}/quiz/create', 'RoomQuestionnaireController@create')->name('room_questionnaire.create');
    Route::post('room/quiz_questionnaire/{room}/quiz/store', 'RoomQuestionnaireController@store')->name('room_questionnaire.store');
// Room Questionnaire
    Route::get('room/quiz_questionnaire/{room}/questionnaire/create', 'RoomQuizController@create')->name('room_quiz.create');
    Route::post('room/quiz_questionnaire/{room}/questionnaire/store', 'RoomQuizController@store')->name('room_quiz.store');

//Report
    Route::get('report_room/index', 'ReportRoomController@index')->name('report_room.index');
    Route::get('report_room/{room}/show', 'ReportRoomController@show')->name('report_room.show');
    Route::get('report_room/{room}/{quiz}/chart_quiz', 'ReportRoomController@chart_quiz')->name('report_room.chart_quiz');
    Route::get('report_room/{room}/{questionnaire}/chart_questionnaire', 'ReportRoomController@chart_questionnaire')->name('report_room.chart_questionnaire');

//GroupQuestionnaire
    Route::post('questionnaire/manament/questionnaire/{questionnaire}/group_questionnaire/store', 'GroupQuestionnaireController@store')->name('group_questionnaire.store');
    Route::get('questionnaire/manament/questionnaire/{questionnaire}/group_questionnaire/edit', 'GroupQuestionnaireController@edit')->name('group_questionnaire.edit');
    Route::get('questionnaire/manament/questionnaire/{questionnaire}/group_questionnaire/show', 'GroupQuestionnaireController@show')->name('group_questionnaire.show');
    Route::put('questionnaire/manament/questionnaire/{questionnaire}/group_questionnaire/update', 'GroupQuestionnaireController@update')->name('group_questionnaire.update');
    Route::delete('questionnaire/manament/questionnaire/group_questionnaire/{group_questionnaire}/destroy', 'GroupQuestionnaireController@destroy')->name('group_questionnaire.destroy');

//GroupOptionQuestionnaire
    Route::post('questionnaire/manament/questionnaire/{questionnaire}/group_option_questionnaire/store', 'GroupOptionQuestionnaireController@store')->name('group_option_questionnaire.store');


//OptionQuestionnaire 
    Route::get('questionnaire/manament/questionnaire/{questionnaire}/option_questionnaire/show', 'OptionQuestionnaireController@show')->name('option_questionnaire.show');
    Route::post('questionnaire/manament/questionnaire/{questionnaire}/option_questionnaire/store', 'OptionQuestionnaireController@store')->name('option_questionnaire.store');
//Ajax
    Route::get('user/department/{department}/rooms','DepartmentController@ajax_rooms')->name('department.ajax_rooms');

});


Route::group(['middleware' => ['auth']], function () {
    //Student
    Route::get('/student/result_all', 'StudentController@result_all')->name('student.result_all');
    Route::get('/student/room', 'StudentController@room')->name('student.room');
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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('table-list', function () {
        return view('pages.table_list');
    })->name('table');

    Route::get('typography', function () {
        return view('pages.typography');
    })->name('typography');

    Route::get('icons', function () {
        return view('pages.icons');
    })->name('icons');

    Route::get('map', function () {
        return view('pages.map');
    })->name('map');

    Route::get('notifications', function () {
        return view('pages.notifications');
    })->name('notifications');

    Route::get('rtl-support', function () {
        return view('pages.language');
    })->name('language');

    Route::get('upgrade', function () {
        return view('pages.upgrade');
    })->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});


