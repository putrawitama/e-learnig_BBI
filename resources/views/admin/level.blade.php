@extends('admin.main')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        Level {{$level->name}} 
        <a href="{{route('admin-level-config', ['level_id' => $level->id])}}" class="btn btn-success btn-circle btn-sm" title="Ubah Level">
            <i class="fas fa-pen"></i>
        </a>
    </h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Tujuan Pembelajaran
                        <a href="{{route('admin-tujuan-create', ['level_id' => $level->id])}}" class="btn btn-success btn-circle btn-sm" title="{{ $level->tujuan == null ? 'Tambah Tujuan':'Ubah Tujuan'}}">
                            @if($level->tujuan == null)
                                <i class="fas fa-plus"></i>
                            @else
                                <i class="fas fa-pen"></i>
                            @endif
                        </a>
                    </h6>
                </div>
                <div class="card-body">
                    @if($level->tujuan == null)
                        <p>Belum Ada Tujuan !</p>
                    @else
                        {!!$level->tujuan!!}
                    @endif
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Penilaian Diri
                        <a href="{{route('admin-evaluation-create', ['level_id' => $level->id])}}" class="btn btn-success btn-circle btn-sm" title="Tambah Penilaian">
                            <i class="fas fa-plus"></i>
                        </a>
                        <a href="{{route('admin-evaluation-edit', ['level_id' => $level->id])}}" class="btn btn-success btn-circle btn-sm" title="Ubah Penilaian">
                            <i class="fas fa-pen"></i>
                        </a>
                    </h6>
                </div>
                <div class="card-body">
                    @if($level->evaluations()->count() > 0)
                        <ol>
                            @foreach($level->evaluations()->orderBy('number', 'asc')->get() as $eval)
                            <li>{{$eval->body}} - <a href="{{route('admin-evaluation-remove', ['evaluation_id' => $eval->id])}}" class="text-danger">Hapus</a></li>
                            @endforeach
                        </ol>
                    @else
                        <p>Belum Ada Penilaian Diri</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Uraian Materi
                        <a href="{{route('admin-uraian-create', ['level_id' => $level->id])}}" class="btn btn-success btn-circle btn-sm" title="{{ $level->uraian == null ? 'Tambah Uraian':'Ubah Uraian'}}">
                            @if($level->uraian == null)
                                <i class="fas fa-plus"></i>
                            @else
                                <i class="fas fa-pen"></i>
                            @endif
                        </a>
                    </h6>
                </div>
                <div class="card-body">
                    @if($level->uraian == null)
                        <p>Belum Ada Uraian Materi !</p>
                    @else
                        {!!$level->uraian!!}
                    @endif
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                    Daftar Soal
                        <a href="{{route('admin-question-create', ['level_id' => $level->id])}}" class="btn btn-success btn-circle btn-sm" title="Tambah Soal">
                            <i class="fas fa-plus"></i>
                        </a>
                        <a href="{{route('admin-question-score-edit', ['level_id' => $level->id])}}" class="btn btn-success btn-circle btn-sm" title="Ubah Skor Soal">
                            <i class="fas fa-pen"></i>
                        </a>
                    </h6>
                </div>
                <div class="card-body">
                    @foreach($level->case_studies()->has('questions')->get() as $case_study)
                        <h3><a href="{{route('admin-case-study', ['case_study_id' => $case_study->id])}}">Studi Kasus {{$case_study->number}} - {{$case_study->title}}</a></h3>
                        <ol>
                            @foreach($case_study->questions()->orderBy('number', 'asc')->get() as $question)
                            <li><a href="{{route('admin-question', ['question_id' => $question->id])}}">{!!$question->body!!}</a></li>
                            @endforeach
                        </ol>
                    @endforeach
                    @if($level->questions()->doesnthave('case_study')->count() > 0)
                        <h3>Soal Tanpa Studi Kasus</h3>
                        <ol>
                            @foreach($level->questions()->doesnthave('case_study')->orderBy('number', 'asc')->get() as $question)
                            <li><a href="{{route('admin-question', ['question_id' => $question->id])}}">{!!$question->body!!}</a></li>
                            @endforeach
                        </ol>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection