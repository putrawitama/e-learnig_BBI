@extends('user.main_exam')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        Penilaian Diri
    </h1>
    <div class="row">
        <div class="col-md-6" id="case-study-section">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        {{$level->name}} - Penilaian Diri
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{route('user-exam-evaluation-store')}}" method="post">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col" class="text-center">Pertanyaan</th>
                                        <th scope="col" class="text-center">YA</th>
                                        <th scope="col" class="text-center">TIDAK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($level->evaluations()->orderBy('number', 'asc')->get() as $eval)
                                        <tr>
                                            <th scope="row">{{$eval->number}}</th>
                                            <th>{{$eval->body}}</th>
                                            <td class="text-center">
                                                <div class="custom-control custom-checkbox ">
                                                    <input type="radio" id="{{$eval->number}}_a" name="eval[{{$loop->index}}]" class="custom-control-input" value="1">
                                                    <label class="custom-control-label" for="{{$eval->number}}_a"></label>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="custom-control custom-checkbox ">
                                                    <input type="radio" id="{{$eval->number}}_b" name="eval[{{$loop->index}}]" class="custom-control-input" value="0">
                                                    <label class="custom-control-label" for="{{$eval->number}}_b"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="level_id" value="{{$level->id}}">
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