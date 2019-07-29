@extends('admin.main')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        Penilaian Diri {{$level->name}}
    </h1>

    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Ubah Penilaian Diri
                    </h6>
                </div>

                <div class="card-body">
                    <form action="{{route('admin-evaluation-patch')}}" method="post">
                        <div id="section-body">
                            @foreach($level->evaluations()->orderBy('number', 'asc')->get() as $key => $eval)
                            <div class="form-group">
                                <label>Nomor {{ $key+1 }}</label>
                                <textarea class="form-control" name="evaluation[]" rows="1">{{$eval->body}}</textarea>
                            </div>
                            @endforeach
                        </div>
                        <input type="submit" class="btn btn-primary" value="Simpan">

                        <input type="hidden" name="level_id" value="{{$level->id}}">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection