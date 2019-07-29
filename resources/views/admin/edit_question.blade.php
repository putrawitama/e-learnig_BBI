@extends('admin.main')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        Ubah Soal {{$question->level->name}}
    </h1>
    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Nomor {{$question->number}}
                    </h6>
                </div>

                <div class="card-body">
                    
                    <form action="{{route('admin-question-patch')}}" method="post">
                        <div id="case-study-section" class="form-group">
                            <label>Pilih Studi Kasus</label>
                            <select name="case_study" class="form-control">
                                <option value="0">Tidak ada</option>
                                @foreach($question->level->case_studies as $case_study)
                                <option value="{{$case_study->id}}" @if($question->case_study) @if($question->case_study->id == $case_study->id) selected @endif @endif>{{$case_study->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="question-section" class="form-group">
                            <label>Soal</label>
                            <textarea name="question_body" id="question-body" cols="30" rows="10">{!!$question->body!!}</textarea>
                        </div>
                        <div id="answer-section">
                            @switch($question->answer_type)
                                @case('MULTIPLE')
                                    <label>Jawaban Pilihan Ganda</label>
                                       @foreach($question->choices()->orderBy('id', 'asc')->get() as $key => $choice)
                                           <div class="input-group mb-3">
                                               <div class="input-group-prepend">
                                                   <div class="input-group-text">
                                                       <input type="radio" name="answer_correct" value="{{$key}}" @if($choice->correct) checked @endif>
                                                   </div>
                                               </div>
                                               <input type="text" class="form-control" name="multi[]" value="{{$choice->body}}">
                                           </div>
                                       @endforeach
                                    @break
                                    
                                @case('ESSAY')
                                    <div class="form-group">
                                        <label>Jawaban Essay</label>
                                        <textarea name="essay" class="form-control" rows="3">{{$question->essay}}</textarea>
                                    </div>
                                    @break

                                @case('CHECKLIST')
                                    <label>Jawaban Checklist</label>
                                    @foreach($question->checklists()->orderBy('id', 'asc')->get() as $checklist)
                                        <div class="form-row mb-3">
                                            <div class="col-10">
                                                <input type="text" name="cl_body[]" class="form-control" value="{{$checklist->body}}">
                                            </div>
                                            <div class="col-2">
                                                <input type="text"  name="cl_correct[]" class="form-control" min="1" max="5" value="{{$checklist->answer}}">
                                            </div>
                                        </div>
                                    @endforeach
                                    @break
                            @endswitch
                        </div>
                        <input type="hidden" name="question_id" value="{{$question->id}}">
                        @csrf
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        const options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
        const questionBody = document.getElementById('question-body')
        CKEDITOR.replace( questionBody, options );
    </script>
@endsection