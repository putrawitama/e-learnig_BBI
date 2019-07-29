@extends('admin.main')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        Buat Tujuan Pembelajaran
    </h1>
    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Level {{$level->name}}
                    </h6>
                </div>

                <div class="card-body">
                    <form action="{{route('admin-tujuan-store')}}" method="post">
                        <textarea name="editor" id="editor" cols="30" rows="10">{{$level->tujuan}}</textarea>
                        <input type="hidden" name="level_id" value="{{$level->id}}">
                        <input type="submit" class="btn btn-primary mt-3" value="Simpan">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        const options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
        CKEDITOR.replace( 'editor', options );
    </script>
@endsection