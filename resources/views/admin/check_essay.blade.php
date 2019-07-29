@extends('admin.main')
@section('content')
    @if($level->case_studies()->count() > 0 && $level->case_studies()->whereHas('questions', function($question){
        $question->whereIn('answer_type', ['ESSAY', 'FORM']);
    })->count() > 0)
        <form action="{{route('admin-user-essay-submit')}}" method="post">
            @foreach($level->case_studies()->whereHas('questions', function($question){
                $question->whereIn('answer_type', ['ESSAY', 'FORM']);
            })->orderBy('number', 'asc')->get() as $i => $case_study)
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Studi Kasus {{$case_study->number}} - {{$case_study->title}}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
											@if($case_study->type == 'TEXT')
												{!!$case_study->body!!}
											@else
												<audio controls>
													<source src="{{ URL::to('/') }}/files/{!!$case_study->body!!}" type="audio/mpeg">
													Your browser does not support the audio element.
												</audio>
											@endif
                                        </div>
                                    </div>
                                    @foreach($case_study->questions()->whereIn('answer_type', ['ESSAY', 'FORM'])->orderBy('number', 'asc')->get() as $j => $question)
                                        @if($question->answer_type == 'ESSAY')
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card shadow mb-4">
                                                        <div class="card-header py-3">
                                                            <h6 class="m-0 font-weight-bold text-primary">{{$question->level->name}} - Studi Kasus {{$question->case_study->number}} - No. {{$question->number}}</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h6 class="m-0 font-weight-bold text-danger">Soal</h6>
                                                                    <span>{!!$question->body!!}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h6 class="m-0 font-weight-bold text-success">Jawaban</h6>
                                                                    <p>{{$answer_sheet->answers()->where('question_id', $question->id)->first()->essay}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    Score: <input type="number" name="score[]" min="0" max="{{$question->score}}" value="{{$question->score}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card shadow mb-4">
                                                        <div class="card-header py-3">
                                                            <h6 class="m-0 font-weight-bold text-primary">{{$question->level->name}} - Studi Kasus {{$question->case_study->number}} - No. {{$question->number}}</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h6 class="m-0 font-weight-bold text-danger">Soal</h6>
                                                                    <span>{!!$question->body!!}</span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h6 class="m-0 font-weight-bold text-success">Jawaban</h6>
                                                                    <div>
                                                                        @component('components.interview-form', [
                                                                            'answer' => [
                                                                                'full_name' => $question->answers()->where('answer_sheet_id', $answer_sheet->id)->first()->interview_form->full_name,
                                                                                'date_of_birth' => $question->answers()->where('answer_sheet_id', $answer_sheet->id)->first()->interview_form->date_of_birth,
                                                                                'education' => $question->answers()->where('answer_sheet_id', $answer_sheet->id)->first()->interview_form->education,
                                                                                'unit' => $question->answers()->where('answer_sheet_id', $answer_sheet->id)->first()->interview_form->unit,
                                                                                'position' => $question->answers()->where('answer_sheet_id', $answer_sheet->id)->first()->interview_form->position,
                                                                                'interviewer' => $question->answers()->where('answer_sheet_id', $answer_sheet->id)->first()->interview_form->interviewer,
                                                                                'date_of_interview' => $question->answers()->where('answer_sheet_id', $answer_sheet->id)->first()->interview_form->date_of_interview,
                                                                                'result' => $question->answers()->where('answer_sheet_id', $answer_sheet->id)->first()->interview_form->result,
                                                                                'competencies' => $question->answers()->where('answer_sheet_id', $answer_sheet->id)->first()->interview_form->competencies,
                                                                                'i' => $i,
                                                                                'j' => $j,
                                                                            ]
                                                                        ])
                                                                        @endcomponent
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    Score: <input type="number" name="question_score[]" min="0" max="{{$question->score}}" value="{{$question->score}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="row">
                <div class="col-md-12">
                    <input class="btn btn-primary btn-block" type="submit" value="Submit">
                </div>
            </div>
            <input type="hidden" name="answer_sheet_id" value="{{$answer_sheet->id}}"> 
            @csrf
        </form>
    @endif
@endsection