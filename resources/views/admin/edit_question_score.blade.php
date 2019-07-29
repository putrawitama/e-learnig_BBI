@extends('admin.main')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        Edit Skor Soal
    </h1>
    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Level {{$level->name}}
                    </h6>
                </div>

                <div class="card-body">
                    <form action="{{route('admin-question-score-patch')}}" method="post">
                        @if($level->case_studies()->has('questions')->count() > 0)
                            <div id="cs-question">
                                @foreach($level->case_studies()->has('questions')->orderBy('number', 'asc')->get() as $cs)
                                <h2><a href="{{route('admin-case-study', ['case_study_id' => $cs->id])}}">Studi Kasus {{$cs->number}}: {{$cs->title}}</a></h2>
                                    @foreach($cs->questions()->orderBy('number', 'asc')->get() as $question)
                                    <div class="form-group" tail="true" eval-number=1>
                                        <label>{{$question->number}}. {{$question->answer_type}}</label>
                                        <input class="form-control" type="number" name="question[]" value="{{$question->score}}">
                                    </div> 
                                    @endforeach
                                @endforeach    
                            </div>
                        @endif
                        @if($level->questions()->doesnthave('case_study')->count() > 0)
                            <div id="question">
                                @foreach($level->questions()->doesnthave('case_study')->orderBy('number', 'asc')->get() as $question)
                                <div class="form-group" tail="true" eval-number=1>
                                    <label>{{$question->number}}. {{$question->answer_type}}</label>
                                    <input class="form-control" type="number" name="question[]" value="{{$question->score}}">
                                </div>
                                @endforeach
                            </div>
                        @endif
                        <p>*) Skor tipe soal checklist merupakan skor individual tiap poin checklist</p>
                        <input type="hidden" name="level_id" value="{{$level->id}}">
                        <input type="submit" class="btn btn-primary" value="Simpan">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection