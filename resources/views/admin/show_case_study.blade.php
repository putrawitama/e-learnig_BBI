@extends('admin.main')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        Studi Kasus
    </h1>
    <div class="row">
        <div class="col-md-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        {{$caseStudy->title}}
                        <a href="{{route('admin-case-study-edit', ['case_study_id' => $caseStudy->id])}}" class="btn btn-success btn-circle btn-sm" title="Ubah Studi Kasus">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="{{route('admin-case-study-remove', ['case_study_id' => $caseStudy->id])}}" class="btn btn-danger btn-circle btn-sm" title="Hapus Studi Kasus">
                            <i class="fas fa-trash"></i>
                        </a>
                    </h6>
                </div>

                <div class="card-body">
                    @if($caseStudy->type == 'TEXT')
                        {!!$caseStudy->body!!}
                    @else
                        <audio controls>
                            <source src="{{ URL::to('/') }}/files/{!!$caseStudy->body!!}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection