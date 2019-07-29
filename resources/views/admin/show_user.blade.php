@extends('admin.main')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        Level yang Sudah Dikerjakan
    </h1>
    <h4 class="h3 mb-4 text-gray-800 text-center">
        {{$user->name}}
    </h4>
    <div class="row">

        @php $id = $user->id; @endphp
        @foreach($answer_sheets as $answer_sheet)
            <div class="col-xl-3 col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Level</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <a href="{{route('admin-user-result', ['user_id' => $user->id, 'level_id' => $answer_sheet->level->id])}}">Level {{$answer_sheet->level->name}}</a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        @endforeach

    </div>
@endsection