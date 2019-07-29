@extends('admin.main')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        {{$answer_sheet->level->name}} - Hasil
    </h1>
    <h4 class="h3 mb-4 text-gray-800 text-center">
        {{$answer_sheet->user->name}}
    </h4>
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
        @if($answer_sheet->report()->count() == 0)
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Skor Total (Multiple choice & Checklist)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{  $total_score }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Skor Total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @if($answer_sheet->report()->count() == 0)
                                    <a class="btn btn-success mt-2" href="{{route('admin-user-essay-check', ['user_id' => $answer_sheet->user_id, 'level_id' => $answer_sheet->level_id])}}">Check Essay & Form</a>
                                @else
                                    {{$answer_sheet->report->score}}
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(!($answer_sheet->report()->count() == 0 && $answer_sheet->level->questions()->where('answer_type', 'ESSAY')->count() > 0))
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Status</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Verified</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection