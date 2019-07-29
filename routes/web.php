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
    return redirect('/login');
})->name('main');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', function () {
    return redirect()->route('user');
})->name('home');

Route::get('/logout', 'UserController@logout')->name('logout');

Route::prefix('/admin')->middleware('auth', 'admin')->group(function(){
    Route::get('/', 'AdminController@index')->name('admin');
    
    Route::get('/users', 'AdminController@index_users')->name('admin-users');
    Route::get('/users/{user_id}', 'AdminController@show_user')->name('admin-user-show');
    Route::get('/users/{user_id}/{level_id}', 'AdminController@show_result')->name('admin-user-result');
    // Shows form for checking essay
    Route::get('/users/{user_id}/{level_id}/check_essay', 'AdminController@check_essay')->name('admin-user-essay-check');
    // Submit essay
    Route::post('/users/essay/submit', 'AdminController@submit_essay')->name('admin-user-essay-submit');
    
    // Shows list of exam levels
    Route::get('/exams', 'ExamController@index')->name('admin-exams');
    
    // ============= LEVEL
    // Shows list of tujuan, uraian, and questions in that level 
    Route::get('/level/{level_id}', 'ExamController@show_level')->name('admin-level');
    // Shows forms for level configuration 
    Route::get('/level/{level_id}/config', 'ExamController@config_level')->name('admin-level-config');
    // Patch config to db
    Route::post('/level/config/patch', 'ExamController@patch_config_level')->name('admin-level-config-patch');
    
    // ============= TUJUAN PEMBELAJARAN
    // Shows form for creating tujuan
    Route::get('/level/{level_id}/tujuan/create', 'ExamController@create_tujuan')->name('admin-tujuan-create');
    // Store new tujuan in DB
    Route::post('/tujuan/create', 'ExamController@store_tujuan')->name('admin-tujuan-store');
    
    // ============= URAIAN MATERI
    // Shows form for creating uraian
    Route::get('/level/{level_id}/uraian/create', 'ExamController@create_uraian')->name('admin-uraian-create');
    // Store new uraian in DB
    Route::post('/uraian/create', 'ExamController@store_uraian')->name('admin-uraian-store');
    
    // ============= STUDI KASUS
    // Shows form for creating case study
    Route::get('/level/{level_id}/casestudy/create', 'ExamController@create_case_study')->name('admin-case-study-create');
    // Store case study in DB
    Route::post('/casestudy/create', 'ExamController@store_case_study')->name('admin-case-study-store');
    // Shows case study detail
    Route::get('/casestudy/{case_study_id}', 'ExamController@show_case_study')->name('admin-case-study');
    // Shows form for editing case study
    Route::get('/casestudy/{case_study_id}/edit', 'ExamController@edit_case_study')->name('admin-case-study-edit');
    // Patch case study in DB
    Route::post('/casestudy/patch', 'ExamController@patch_case_study')->name('admin-case-study-patch');
    // Remove case study
    Route::get('/casestudy/{case_study_id}/remove', 'ExamController@remove_case_study')->name('admin-case-study-remove');
    
    // ============= SOAL
    // Shows specific question and its answers (essay or multiple choice)
    Route::get('/question/{question_id}', 'ExamController@show_question')->name('admin-question');
    // Shows form for creating question
    Route::get('/level/{level_id}/question/create', 'ExamController@create_question')->name('admin-question-create');
    // Store new question in DB
    Route::post('/question/create', 'ExamController@store_question')->name('admin-question-store');
    // Shows form for editing question
    Route::get('/question/{question_id}/edit', 'ExamController@edit_question')->name('admin-question-edit');
    // Patch question
    Route::post('/question/patch', 'ExamController@patch_question')->name('admin-question-patch');
    // Remove question
    Route::get('/question/{question_id}/remove', 'ExamController@remove_question')->name('admin-question-remove');
    // Shows form for editing question's score
    Route::get('/level/{level_id}/question/scores', 'ExamController@edit_question_score')->name('admin-question-score-edit');
    // Patch question's score
    Route::post('/question/scores/patch', 'ExamController@patch_question_score')->name('admin-question-score-patch');
    
    // ============= PENILAIAN DIRI
    // Shows form for creating evaluation
    Route::get('/level/{level_id}/evaluation/create', 'ExamController@create_evaluation')->name('admin-evaluation-create');
    // Store evaluation in DB
    Route::post('/evaluation/create', 'ExamController@store_evaluation')->name('admin-evaluation-store');
    // Shows form for editing evaluation
    Route::get('/evaluation/{level_id}/edit', 'ExamController@edit_evaluation')->name('admin-evaluation-edit');
    // Patch evaluation in DB
    Route::post('/evaluation/patch', 'ExamController@patch_evaluation')->name('admin-evaluation-patch');
    // Remove evaluation from DB
    Route::get('/evaluation/{evaluation_id}/remove', 'ExamController@remove_evaluation')->name('admin-evaluation-remove');
});

Route::prefix('/user')->middleware('auth', 'user')->group(function(){
    // Shows user's profile
    Route::get('/profile', 'UserController@index')->name('user');
    // Patch finished to true in answersheet
    Route::get('/exam/{level_id}/finish', 'UserController@finish_exam')->name('user-exam-finish');
    // Shosw evaluation form
    Route::get('/exam/{level_id}/evaluation', 'UserController@show_evaluation')->name('user-exam-evaluation');
    // Shows result page for user
    Route::get('/exam/{level_id}/result', 'UserController@show_result')->name('user-exam-result');
    // Reset exam
    Route::get('/exam/{level_id}/reset', 'UserController@reset_exam')->name('user-exam-reset');
    // Shows create if doesn't exist answersheet, show questions
    Route::get('/exam/{level_id}/{case_study_number?}/{question_number?}', 'UserController@show_question')->name('user-exam-questions');
    // Store answer to DB
    Route::post('/exam/answer/submit', 'UserController@store_answer')->name('user-exam-answer-store');
    // Submit evaluation to DB
    Route::post('/exam/evaluation/submit', 'UserController@store_evaluation')->name('user-exam-evaluation-store');
    //show list form nilai applicants
    Route::get('/applicants', 'UserController@show_list_form')->name('list-applicants');
    //show lform penilaian applicants
    Route::get('/applicants/new', 'UserController@show_form_penilaian')->name('form-penilaian');
    //submit lform penilaian applicants
    Route::post('/applicants/new/create', 'UserController@submit_applicant')->name('form-penilaian-create');
    //show lform penilaian applicants
    Route::get('/applicants/view/{interview_form_id}', function($interview_form_id){
        return view('user.form_applicant', [
            'form' => Auth::user()->interview_forms()->find($interview_form_id)
        ]);
    })->name('form-penilaian-view');
});