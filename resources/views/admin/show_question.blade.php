@extends('admin.main')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        {{$question->level->name}} - Number {{$question->number}}
    </h1>
    <div class="row">
        <div class="col-md-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Soal
                        <a href="{{route('admin-question-edit', ['question_id' => $question->id])}}" class="btn btn-success btn-circle btn-sm" title="Ubah Soal">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="{{route('admin-question-remove', ['question_id' => $question->id])}}" class="btn btn-danger btn-circle btn-sm" title="Hapus Soal">
                            <i class="fas fa-trash"></i>
                        </a>
                    </h6>
                </div>

                <div class="card-body">
                    @if($question->case_study)
                        <div id="case-study-section">
                            <h2><a href="{{route('admin-case-study', ['case_study_id' => $question->case_study->id])}}">Case Study: {{$question->case_study->title}}</a></h2>
                        </div>
                    @endif
                    {!!$question->body!!}
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Jawaban
                    </h6>
                </div>

                <div class="card-body">
                    @switch($question->answer_type)
                        @case('MULTIPLE')
                            <ol type="A">
                                @foreach($question->choices as $choice)
                                    <li class="{{$choice->correct ? 'text-success':'text-gray'}}">{{$choice->body}}</li>
                                @endforeach
                            </ol>
                            @break
                        
                        @case('ESSAY')
                            <p>{{$question->essay}}</p>
                            @break

                        @case('CHECKLIST')
                            <ul>
                                @foreach($question->checklists()->orderBy('id', 'asc')->get() as $checklist)
                                    <li>{{$checklist->body}} - @if($checklist->answer){{$checklist->answer}}@else NONE @endif</li>
                                @endforeach
                            </ul>
                            @break
                    @endswitch
                </div>
            </div>
        </div>
    </div>
@endsection