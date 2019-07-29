@extends('admin.main')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">Users List</h1>

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <!-- <th>No. Hp</th> -->
                                <th>Privilege</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $value)
                                <tr>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->email}}</td>
                                    <!-- <td>086747354</td> -->
                                    <td>{{$value->privilege->type}}</td>
                                    <td>@if($value->privilege->type == 'USER')<a href="{{route('admin-user-show', ['user_id' => $value->id])}}">Lihat progress</a> @endif</td>
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