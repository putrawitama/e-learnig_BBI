@extends('user.main')
@section('content')

    <div class="row">
        <div class="col-md-12" id="form_penilaian">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Formulir Penilaian
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{route('form-penilaian-create')}}" method="post">
                        @component('components.interview-form')@endcomponent
                        <div class="text-right">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection