@extends('admin.main')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Registered Users</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span style="font-size:84px">{{$participants->count()}}</span>
                        </div>
                        <div class="col-md-12 text-center">
                            <span style="font-size:18px">Total registered users</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Finished Exams</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span style="font-size:84px">{{$answer_sheets->count()}}</span>
                        </div>
                        <div class="col-md-12 text-center">
                            <span style="font-size:18px">Total finished exams</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Exam Levels</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span style="font-size:84px">{{$levels->count()}}</span>
                        </div>
                        <div class="col-md-12 text-center">
                            <span style="font-size:18px">Total exam levels</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Case Studies</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span style="font-size:84px">{{$case_studies->count()}}</span>
                        </div>
                        <div class="col-md-12 text-center">
                            <span style="font-size:18px">Total case studies created</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Questions With Case Study</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span style="font-size:84px">{{$questions->where('case_study_id', '<>', null)->count()}}</span>
                        </div>
                        <div class="col-md-12 text-center">
                            <span style="font-size:14px">Total questions with case study created</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Questions Without Case Study</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span style="font-size:84px">{{$questions->where('case_study_id', null)->count()}}</span>
                        </div>
                        <div class="col-md-12 text-center">
                            <span style="font-size:14px">Total questions without case study created</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection