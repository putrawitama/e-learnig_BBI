@extends('admin.main')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        Pengaturan Level {{$level->name}}
    </h1>

    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Ubah Nilai
                    </h6>
                </div>

                <div class="card-body">
                    <form action="{{route('admin-level-config-patch')}}" method="post">
                        <div class="form-group">
                            <label>Minimum nilai ujian</label>
                            <input type="number" class="form-control" name="exam" placeholder="Nilai ujian" value="{{$level->exam_threshold}}">
                        </div>
                        <div class="form-group">
                            <label>Minimum nilai penilaian diri</label>
                            <input type="number" class="form-control" name="evaluation" placeholder="Nilai penilaian diri" value="{{$level->evaluation_threshold}}">
                        </div>
                        <input type="hidden" name="level_id" value="{{$level->id}}">
                        <input type="submit" class="btn btn-primary" value="Simpan">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection