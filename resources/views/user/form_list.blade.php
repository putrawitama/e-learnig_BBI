@extends('user.main')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">Daftar Penilaian Pelamar</h1>

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <a href="{{ route('form-penilaian') }}" class="btn btn-success btn-sm text-white mb-4" title="Buat Penilaian"><i class="fas fa-plus"></i> Tambah Penilaian</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable_applicants" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <!-- <th>No. Hp</th> -->
                                    <th>Unit Kerja</th>
                                    <th>Posisi Yang Dilamar</th>
                                    <th>Tanggal Wawancara</th>
                                    <th>Print Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Auth::user()->interview_forms()->where('type', 'REAL')->orderBy('created_at', 'desc')->get() as $form)
                                <tr>
                                    <th>{{$form->full_name}}</th>
                                    <th>{{$form->date_of_birth}}</th>
                                    <!-- <th>No. Hp</th> -->
                                    <th>{{$form->unit}}</th>
                                    <th>{{$form->position}}</th>
                                    <th>{{$form->date_of_interview}}</th>
                                    <th><a href="{{route('form-penilaian-view', ['interview_form_id' => $form->id])}}">Print Data</a></th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
        </div>
    </div>
@endsection