@extends('user.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#intro" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="intro">
                    <h6 class="m-0 font-weight-bold text-primary">Pendahuluan</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="intro">
                    <div class="card-body">

                        <h2><strong>A. Standar Kompetensi</strong></h2>
                        <p>Memahami dan mampu menerapkan wawancara BBI (Behavioral Based Interview) berbasis kompetensiuntuk melakukan prosesrekrutmen dan seleksi dalam organisasi.</p>
                        <h2><strong>B. Deskripsi</strong></h2>
                        <p>E-Modul ini merupakan modul pembelajaran berbasis elektronik yang diperuntukkan kepada para ekskutif (pimpinan) organisasi dalam melakukan wawancara untuk proses rekrutmen dan seleksi. Teknikwawancara yang diajarkan dalam E-Modul ini adalah wawancara BBI (Behavioral Based Interview) berbasis kompetensi. Apabila E-Modul ini dipergunakan dengan tepat dapat mempermudah eksekutif mendapatkan kandidat yang sesuai dengan kompetensidari deskripsi pekerjaanyang diharapkan.</p>
                        <h2><strong>C. Prasyarat</strong></h2>
                        <p>Persyaratan awal yang dibutuhkanuntuk mempelajari E-Modul ini adalah memiliki peralatan (device) seperti komputer, laptop, atau smartphone.Selain itu, kemampuan awal yang dibutuhkan adalah kemampuan memahami kebutuhan organisasi dan deskripsi pekerjaan yang diharapkan. Selainitu, memiliki kemampuan untuk dapat berkomunikasi secara interaktif dan senantiasa memiliki motivasi internal untuk belajar.</p>
                        <h2><strong>D. Petunjuk Penggunaan E-Modul</strong></h2>
                        <ol>
                        	<li>Sebelum pembelajaran<br />
                        	-Mempersiapkan deviceyang dibutuhkan seperti komputer, laptop, atau smartphone.<br />
                        	-E-Modul ini terdiri dari empat (4) kegiatan pembelajaran sesuai dengan levelnya secara bertahap dengan level beginner, intermediate I, intermediate II, dan advance.<br />
                        	-Setiap kegiatan pembelajaran akan diberikan tujuan pembelajaran yang memuat kemampuan yang harus dikuasai untuk satu kesatuan kegiatan belajar, selanjutnya aka nada uraian materi sebelum diberikan latihan soal.</li>
                        	<li>Selama pembelajaran<br />
                        	-Pendalaman materi setiap level pada E-Modul<br />
                        	-Mempelajari, memahami, dan bertanya tentang materi<br />
                        	-Latihan soal (evaluasi) yang diajukan pada akhir pembahasan setiap materi pembelajaran (level)<br />
                        	-Mengevaluasi diri atas pemahaman yang dimiliki dengan melakukan checklistpada self evaluation.</li>
                        	<li>Setelah pembelajaran<br />
                        	-Menerima hasil dari latihan soal (evaluasi) untuk meneruskan belajar pada materi selanjutnya atau tetap pada materi yang sama.<br />
                        	-Menerima keputusan coachuntuk meneruskan belajar pada materi selanjutnya atau tetap pada materi yang sama.</li>
                        </ol>
                        <h2><strong>E.Tujuan Akhir </strong></h2>
                        <p>Setelah mempelajari E-Modul ini diharapkan para eksekutif dapat secara mandiri untuk menentukan kompetensi yang dibutuhkan dari setiap deskripsi pekerjaan dalam proses rekrutmen dan seleksi. Selanjutnya, diharapkan dapat melakukan wawancara BBI dan melakukan pengambilan keputusan yang tepatberdasarkan kompetensiatas calon pelamar.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($levels as $level)
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><a href="{{route('user-exam-questions', ['level_id' => $level->id])}}">{{$level->name}}</a></h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span style="font-size:84px"></span>
                        </div>
                        <div class="col-md-12">
                            <p>{{$level->case_studies()->has('questions')->count()}} studi kasus</p>
                            <p>{{$level->questions()->count()}} soal ({{$level->questions()->where('answer_type', 'MULTIPLE')->count()}} multiple choice, {{$level->questions()->where('answer_type', 'ESSAY')->count()}} essay, {{$level->questions()->where('answer_type', 'CHECKLIST')->count()}} checklist)</p>
                            <p>{{$level->evaluations()->count()}} penilaian diri</p>
                            <p class="font-weight-bold @if($user->answer_sheets()->where('level_id', $level->id)->count() == 0) text-danger @elseif(!$user->answer_sheets()->where('level_id', $level->id)->first()->finished) text-warning @elseif($user->answer_sheets()->where('level_id', $level->id)->first()->finished && $user->answer_sheets()->where('level_id', $level->id)->first()->report()->count() == 0) text-info @else text-success @endif">Status: @if($user->answer_sheets()->where('level_id', $level->id)->count() == 0) Blank @elseif(!$user->answer_sheets()->where('level_id', $level->id)->first()->finished) On Progress @elseif($user->answer_sheets()->where('level_id', $level->id)->first()->finished && $user->answer_sheets()->where('level_id', $level->id)->first()->report()->count() == 0) Submitted @else Verified @endif</p>
                            <hr class="sidebar-divider">
                            <p class="text-center"><a href="{{route('user-exam-questions', ['level_id' => $level->id])}}">@if($user->answer_sheets()->where('level_id', $level->id)->count() == 0 || !$user->answer_sheets()->where('level_id', $level->id)->first()->finished) Kerjakan Test @else Lihat Hasil @endif</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection