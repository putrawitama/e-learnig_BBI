<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Level;
use App\AnswerSheet;
use App\Question;
use App\CaseStudy;
use App\Report;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard', [
            'user' => Auth::user(),
            'levels' => Level::all(),
            'participants' => User::whereHas('privilege', function($privilege){
                $privilege->where('type', 'USER');
            })->get(),
            'answer_sheets' => AnswerSheet::where('finished', true),
            'questions' => Question::all(),
            'case_studies' => CaseStudy::all(),
        ]);
    }

    public function index_users(){
        return view('admin.users', [
            'users' => User::all(),
            'levels' => Level::all(),
        ]);
    }

    public function show_user($user_id){
        return view('admin.show_user', [
            'user' => User::find($user_id),
            'answer_sheets' => AnswerSheet::where('finished', true)->whereHas('user', function($user) use($user_id){
                $user->where('id', $user_id);
            })->get(),
            'levels' => Level::all(),
        ]);
    }

    public function show_result($user_id, $level_id){
        $totalScore = 0;

        foreach(User::find($user_id)->answer_sheets()->where('level_id', $level_id)->first()->answers()->get() as $answer){
            switch ($answer->type) {
                case 'MULTIPLE':
                    $totalScore += $answer->question->choices()->where('correct', true)->first()->point == $answer->point ? $answer->question->score : 0;
                    break;
                    
                case 'CHECKLIST':
                    $cl_answers = json_decode($answer->checklists);

                    foreach($answer->question->checklists()->orderBy('id', 'asc')->get() as $key => $checklist){
                        $totalScore += ($checklist->answer == $cl_answers[$key]) || (is_null($checklist->answer) && $cl_answers[$key] == '0') ? $checklist->question->score : 0;
                    }
                    break;
            }            
        }

        $overalNonChecklistScore = Level::find($level_id)->questions()->where('answer_type', '<>', 'CHECKLIST')->sum('score');
        $overalChecklistScore = 0;
        
        foreach(Level::find($level_id)->questions()->where('answer_type', 'CHECKLIST')->get() as $q){
            $overalChecklistScore += $q->checklists()->count() * $q->score;
        }

        return view('admin.show_user_result', [
            'answer_sheet' => User::find($user_id)->answer_sheets()->where('level_id', $level_id)->first(),
            'total_score' => $totalScore / ($overalNonChecklistScore + $overalChecklistScore) * 100,
            'levels' => Level::all(),
        ]);
    }

    public function check_essay($user_id, $level_id){
        return view('admin.check_essay', [
            'levels' => Level::all(),
            'level' => Level::find($level_id),
            'answer_sheet' => User::find($user_id)->answer_sheets()->where('level_id', $level_id)->first(),
        ]);
    }

    public function submit_essay(Request $request){
        $answer_sheet = AnswerSheet::find($request->answer_sheet_id);
        $totalScore = 0;

        foreach($request->score as $score){
            $totalScore += $score;
        }

        foreach(User::find($answer_sheet->user->id)->answer_sheets()->where('level_id', $answer_sheet->level->id)->first()->answers()->get() as $answer){
            switch ($answer->type) {
                case 'MULTIPLE':
                    $totalScore += $answer->question->choices()->where('correct', true)->first()->point == $answer->point ? $answer->question->score : 0;
                    break;
                    
                case 'CHECKLIST':
                    $cl_answers = json_decode($answer->checklists);

                    foreach($answer->question->checklists()->orderBy('id', 'asc')->get() as $key => $checklist){
                        $totalScore += ($checklist->answer == $cl_answers[$key]) || (is_null($checklist->answer) && $cl_answers[$key] == '0') ? $checklist->question->score : 0;
                    }
                    break;
            }            
        }

        $overalNonChecklistScore = $answer_sheet->level->questions()->where('answer_type', '<>', 'CHECKLIST')->sum('score');
        $overalChecklistScore = 0;

        foreach($answer_sheet->level->questions()->where('answer_type', 'CHECKLIST')->get() as $q){
            $overalChecklistScore += $q->checklists()->count() * $q->score;
        }
        
        Report::create([
            'score' => $totalScore / ($overalNonChecklistScore + $overalChecklistScore) * 100,
            'answer_sheet_id' => $answer_sheet->id
        ]);

        return redirect()->route('admin-user-result', [
            'user_id' => $answer_sheet->user->id,
            'level_id' => $answer_sheet->level->id,
        ]);
    }
}
