<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use App\Question;
use App\Choice;
use App\CaseStudy;
use App\Checklist;
use App\Evaluation;
use App\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{    
    public function index(){
        return view('admin.exams', [
            'levels' => Level::all(),
            'users' => User::whereHas('privilege', function($privilege){
                $privilege->where('type', 'USER');
            })->get(),
        ]);
    }

    public function show_level($level_id){
        return view('admin.level', [
            'level' => Level::find($level_id),
            'levels' => Level::all(),
        ]);
    }

    public function config_level($level_id){
        return view('admin.edit_level_config', [
            'level' => Level::find($level_id),
            'levels' => Level::all(),
        ]);
    }

    public function patch_config_level(Request $request){
        Level::find($request->level_id)->update([
            'exam_threshold' => $request->exam,
            'evaluation_threshold' => $request->evaluation,
        ]);

        return redirect()->route('admin-level-config', ['level_id' => $request->level_id]);
    }
     
    public function create_tujuan($level_id){
        return view('admin.create_tujuan', [
            'levels' => Level::all(),
            'level' => Level::find($level_id)
        ]);
    }
     
    public function store_tujuan(Request $request){
        $level = Level::find($request->level_id);
        $level->tujuan = $request->editor;
        $level->save();

        return redirect()->route('admin-level', ['level_id' => $level->id]);
    }
     
    public function create_uraian($level_id){
        return view('admin.create_uraian', [
            'levels' => Level::all(),
            'level' => Level::find($level_id)
        ]);
    }
     
    public function store_uraian(Request $request){
        $level = Level::find($request->level_id);
        $level->uraian = $request->editor;
        $level->save();

        return redirect()->route('admin-level', ['level_id' => $level->id]);
    }

    public function create_case_study($level_id){
        return view('admin.create_case_study', [
            'levels' => Level::all(),
            'level' => Level::find($level_id)
        ]);
    }

    public function store_case_study(Request $request){
        $level = Level::find($request->level_id);
        
        $newNumber = $level->case_studies()->count() > 0 ? $level->case_studies()->orderBy('number', 'desc')->first()->number + 1 : 1;
        $body = $request->cs_type == 'AUDIO' ? $this->store_audio($request->cs_audio, $level->id, $newNumber) : $request->cs_body;

        $caseStudy = CaseStudy::create([
            'number' => $newNumber,
            'title' => $request->cs_title,
            'body' => $body,
            'type' => $request->cs_type,
            'level_id' => $level->id
        ]);

        return redirect()->route('admin-question-create', ['level_id' => $caseStudy->level->id]);
    }

    public function store_audio($audio, $level_id, $number){
        return Storage::disk('real_public')->putFileAs('audio', $audio, 'audio_level_'.$level_id.'_number_'.$number.'.'.$audio->getClientOriginalExtension());
    }

    public function show_case_study($id){
        return view('admin.show_case_study', [
            'levels' => Level::all(),
            'caseStudy' => CaseStudy::find($id)
        ]);
    }

    public function edit_case_study($id){
        return view('admin.edit_case_study', [
            'levels' => Level::all(),
            'caseStudy' => CaseStudy::find($id)
        ]);
    }

    public function patch_case_study(Request $request){
        $caseStudy = CaseStudy::find($request->case_study_id);

        if($caseStudy->type == 'AUDIO') Storage::disk('real_public')->delete($caseStudy->body);

        $caseStudy->title = $request->cs_title;
        $caseStudy->body = $request->cs_type == 'AUDIO' ? $this->store_audio($request->cs_audio, $caseStudy->level->id, $caseStudy->number) : $request->cs_body;
        $caseStudy->type = $request->cs_type;
        $caseStudy->save();

        return redirect()->route('admin-case-study', ['case_study_id' => $caseStudy->id]);
    }

    public function remove_case_study($id){
        $caseStudy = CaseStudy::find($id);
        $level_id = $caseStudy->level->id;

        if($caseStudy->type == 'AUDIO') Storage::disk('real_public')->delete($caseStudy->body);

        foreach ($caseStudy->questions as $question) {
            $question->case_study_id = null;
            $question->save();
        }

        $caseStudy->delete();

        $num = 1;

        $level = Level::find($level_id);

        foreach ($level->case_studies()->orderBy('number', 'asc')->get() as $cs) {
            $cs->number = $num;
            $cs->save();

            $num++;
        }
        
        return redirect()->route('admin-level', ['level_id' => $level->id]);
    }

    public function show_question($question_id){
        return view('admin.show_question', [
            'levels' => Level::all(),
            'question' => Question::find($question_id)
        ]);
    }

    public function create_question($level_id){
        $level = Level::find($level_id);
        $caseStudies = CaseStudy::where('level_id', $level->id)->get();

        return view('admin.create_question', [
            'levels' => Level::all(),
            'level' => $level,
            'caseStudies' => $caseStudies
        ]);
    }

    public function store_question(Request $request){
        $fields = [
            'body' => $request->question_body,
            'answer_type' => $request->answer_type,
            'level_id' => $request->level_id
        ];

        if($request->answer_type == 'ESSAY') $fields['essay'] = $request->essay;
        if($request->case_study != 0) {
            $fields['case_study_id'] = $request->case_study;
            $fields['number'] = CaseStudy::find($request->case_study)->questions()->count() > 0 ? CaseStudy::find($request->case_study)->questions()->orderBy('number', 'desc')->first()->number + 1 : 1;
        }else{
            $fields['number'] = Level::find($request->level_id)->questions()->doesnthave('case_study')->get()->count() > 0 ? Level::find($request->level_id)->questions()->doesnthave('case_study')->orderBy('number', 'desc')->first()->number + 1 : 1;
        }

        $question = Question::create($fields);

        switch ($request->answer_type) {
            case 'MULTIPLE':
                $this->store_multiple_choice($request, $question->id);
                break;
            
            case 'CHECKLIST':
                $this->store_checklist($request, $question->id);
                break;
        }

        return redirect()->route('admin-level', ['level_id' => $request->level_id]);
    }

    public function edit_question($id){
        return view('admin.edit_question', [
            'levels' => Level::all(),
            'question' => Question::find($id)
        ]);
    }

    public function patch_question(Request $request){
        $question = Question::find($request->question_id);
        $oldCaseStudy = $question->case_study ? $question->case_study->id : null;
        
        $question->case_study_id = $request->case_study != 0 ? $request->case_study : null;
        $question->body = $request->question_body;

        switch ($question->answer_type) {
            case 'MULTIPLE':
                foreach ($question->choices()->orderBy('id', 'asc')->get() as $key => $choice) {
                    $choice->body = $request->multi[$key];
                    $choice->correct = $request->answer_correct == $key ? TRUE : FALSE;
                    $choice->save();
                }
                break;
                
            case 'ESSAY':
                $question->essay = $request->essay;
                break;

            case 'CHECKLIST':
                foreach ($question->checklists()->orderBy('id', 'asc')->get() as $key => $checklist) {
                    $checklist->body = $request->cl_body[$key];
                    $checklist->answer = $request->cl_correct[$key];
                    $checklist->save();
                }
                break;
        }

        if($oldCaseStudy != $request->case_study){
            if($request->case_study != 0) {
                $question->number = CaseStudy::find($request->case_study)->questions()->count() > 0 ? CaseStudy::find($request->case_study)->questions()->orderBy('number', 'desc')->first()->number + 1 : 1;
            }else{
                $question->number = $question->level->questions()->doesnthave('case_study')->get()->count() > 0 ? $question->level->questions()->doesnthave('case_study')->orderBy('number', 'desc')->first()->number + 1 : 1;
            }
        }

        $question->save();

        $num = 1;

        if($oldCaseStudy){
            foreach (CaseStudy::find($oldCaseStudy)->questions()->orderBy('number', 'asc')->get() as $q) {
                $q->number = $num;
                $q->save();
    
                $num++;
            }
        }else{
            foreach ($question->level->questions()->doesnthave('case_study')->orderBy('number', 'asc')->get() as $q) {
                $q->number = $num;
                $q->save();
    
                $num++;
            }
        }
        
        return redirect()->route('admin-question', ['question_id' => $question->id]);
    }

    public function remove_question($id){
        $question = Question::find($id);
        $level_id = $question->level->id;
        $caseStudy = $question->case_study ? $question->case_study->id : null;
        
        switch ($question->answer_type) {
            case 'MULTIPLE':
                foreach ($question->choices as $choice) {
                    $choice->delete();
                }
                break;
            
            case 'CHECKLIST':
                foreach ($question->checklists as $checklist) {
                    $checklist->delete();
                }
                break;
        }

        $question->delete();

        $num = 1;

        if($caseStudy) {
            foreach (CaseStudy::find($caseStudy)->questions()->orderBy('number', 'asc')->get() as $q) {
                $q->number = $num;
                $q->save();
    
                $num++;
            }
        }else{
            foreach (Level::find($level_id)->questions()->doesnthave('case_study')->orderBy('number', 'asc')->get() as $q) {
                $q->number = $num;
                $q->save();
    
                $num++;
            }
        }

        return redirect()->route('admin-level', ['level_id' => $level_id]);
    }

    public function store_multiple_choice($request, $question_id){
        $point = 'a';

        foreach ($request->mc_body as $key => $mc_body) {
            $choice = Choice::create([
                'point' => $point,
                'body' => $mc_body,
                'correct' => $request->mc_correct == $key ? true : false,
                'question_id' => $question_id
            ]);
            
            $point++;
        }
    }

    public function store_checklist($request, $question_id){
        foreach ($request->checklist as $key => $cl_body) {
            $fields = [
                'body' => $cl_body,
                'question_id' => $question_id
            ];

            if($request->cl_correct[$key]) $fields['answer'] = $request->cl_correct[$key];
            
            $checklist = Checklist::create($fields);
        }
    }
    
    public function create_evaluation($level_id){
        return view('admin.create_evaluation', [
            'levels' => Level::all(),
            'level' => Level::find($level_id)
        ]);
    }
    
    public function store_evaluation(Request $request){
        foreach ($request->evaluation as $key => $eval) {
            Evaluation::create([
                'number' => Level::find($request->level_id)->evaluations()->count() > 0 ? Level::find($request->level_id)->evaluations()->orderBy('number', 'desc')->first()->number + 1 : 1,
                'body' => $eval,
                'level_id' => $request->level_id
            ]);
        }

        return redirect()->route('admin-level', ['level_id' => $request->level_id]);
    }
    
    public function edit_evaluation($level_id){
        return view('admin.edit_evaluation', [
            'levels' => Level::all(),
            'level' => Level::find($level_id)
        ]);
    }
    
    public function patch_evaluation(Request $request){
        foreach (Level::find($request->level_id)->evaluations()->orderBy('number', 'asc')->get() as $key => $eval) {
            $eval->body = $request->evaluation[$key];
            $eval->save();
        }

        return redirect()->route('admin-level', ['level_id' => $request->level_id]);
    }
    
    public function remove_evaluation($evaluation_id){
        $evaluation = Evaluation::find($evaluation_id);
        $level_id = $evaluation->level->id;

        $evaluation->delete();

        $num = 1;

        foreach (Level::find($level_id)->evaluations()->orderBy('number', 'asc')->get() as $eval) {
            $eval->number = $num;
            $eval->save();

            $num++;    
        }

        return redirect()->route('admin-level', ['level_id' => $level_id]);
    }

    public function edit_question_score($level_id){
        return view('admin.edit_question_score', [
            'levels' => Level::all(),
            'level' => Level::find($level_id)
        ]);
    }

    public function patch_question_score(Request $request){
        $questions = [];

        foreach (Level::find($request->level_id)->case_studies()->has('questions')->orderBy('number', 'asc')->get() as $cs) {
            foreach($cs->questions()->orderBy('number', 'asc')->get() as $question){
                $questions[] = $question;
            }
        }

        foreach(Level::find($request->level_id)->questions()->doesnthave('case_study')->orderBy('number', 'asc')->get() as $question){
            $questions[] = $question;
        }

        foreach($questions as $key => $question){
            $question->score = $request->question[$key];
            $question->save();
        }

        return redirect()->route('admin-level', ['level_id' => $request->level_id]);
    }
}
