@extends('user.main_exam')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        {{$answer_sheet->level->name}} - Hasil
    </h1>
    <h4 class="h3 mb-4 text-gray-800 text-center">
        {{$answer_sheet->user->name}}
    </h4>
    @if($answer_sheet->report()->count() > 0)
        <h4 class="h3 mb-4 mt-4 text-gray-600 text-center">
            {{ $answer_sheet->report->score >= $answer_sheet->level->exam_threshold ? 'Selamat kamu lulus dari tahap ini' : 'Maaf kamu belum lulus, Belajar Lagi yaa!' }}
        </h4>
    @endif
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Mulai Pengerjaan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$answer_sheet->created_at}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Skor Total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $answer_sheet->report()->count() > 0 ? $answer_sheet->report->score : 'Belum Ada Nilai'}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Skor Penilaian Diri</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $answer_sheet->report()->count() > 0 ? $answer_sheet->evaluation_answers()->where('answer', true)->count() : 'Belum Ada Nilai'}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-center">
        <a href="{{route('user')}}" class="btn btn-primary">Kembali ke Beranda</a>
        <a href="{{route('user-exam-reset', ['level_id' => $answer_sheet->level->id])}}" class="btn btn-success">Remedial</a>
    </div>
@endsection