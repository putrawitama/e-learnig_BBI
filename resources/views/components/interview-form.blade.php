<div class="row">
    <div class="col-md-4">
        <h3>Formulir</h3>
        <div class="form-group">
            <label>Nama Lengkap Pelamar</label>
            <input class="form-control" type="text" name="full_name" placeholder="Nama Lengkap" value="@if(isset($answer['full_name'])){{$answer['full_name']}}@endif" @if(Auth::user()->privilege->type == 'ADMIN') disabled @endif>
        </div>
        <div class="form-group">
            <label>Tanggal Lahir</label>
            <input class="form-control" type="date" name="date_of_birth" value="@if(isset($answer['date_of_birth'])){{$answer['date_of_birth']}}@endif" @if(Auth::user()->privilege->type == 'ADMIN') disabled @endif>
        </div>
        <div class="form-group">
            <label>Pendidikan Terakhir</label>
            <input class="form-control" type="text" name="education" placeholder="Pendidikan Terakhir" value="@if(isset($answer['education'])){{$answer['education']}}@endif" @if(Auth::user()->privilege->type == 'ADMIN') disabled @endif>
        </div>
        <div class="form-group">
            <label>Unit Kerja</label>
            <input class="form-control" type="text" name="unit" placeholder="Unit Kerja" value="@if(isset($answer['unit'])){{$answer['unit']}}@endif" @if(Auth::user()->privilege->type == 'ADMIN') disabled @endif>
        </div>
        <div class="form-group">
            <label>Posisi Yang Dilamar</label>
            <input class="form-control" type="text" name="position" placeholder="Posisi" value="@if(isset($answer['position'])){{$answer['position']}}@endif" @if(Auth::user()->privilege->type == 'ADMIN') disabled @endif>
        </div>
        <div class="form-group">
            <label>Nama Pewawancara</label>
            <input class="form-control" type="text" name="interviewer" placeholder="Nama Pewawancara" value="@if(Auth::user()->privilege->type == 'ADMIN') {{$answer['interviewer']}} @else{{Auth::user()->name}}@endif" readonly>
        </div>
        <div class="form-group">
            <label>Tanggal Wawancara</label>
            <input class="form-control" type="date" name="date_of_interview" value="@if(isset($answer['date_of_interview'])){{$answer['date_of_interview']}}@endif" @if(Auth::user()->privilege->type == 'ADMIN') disabled @endif>
        </div>

        <h3>Kesimpulan</h3>
        <div class="form-group">
            <div class="custom-control custom-checkbox ">
                <input type="radio" id="PASSED" @if(Auth::user()->privilege->type=='ADMIN') name="result[{{$answer['i']}}][{{$answer['j']}}]" @else name="result" @endif class="custom-control-input" value="PASSED" @if(isset($answer['result']) && $answer['result']=='PASSED') checked @endif @if(Auth::user()->privilege->type == 'ADMIN') disabled @endif>
                <label class="custom-control-label" for="PASSED">Dapat Disarankan</label>
                <small class="form-text text-muted">
                    Bila kompetensi mendukung bidang pekerjaan yang dituju
                </small>
            </div>
            <div class="custom-control custom-checkbox ">
                <input type="radio" id="RECONSIDERED" @if(Auth::user()->privilege->type=='ADMIN') name="result[{{$answer['i']}}][{{$answer['j']}}]" @else name="result" @endif class="custom-control-input" value="RECONSIDERED" @if(isset($answer['result']) && $answer['result']=='RECONSIDERED') checked @endif @if(Auth::user()->privilege->type == 'ADMIN') disabled @endif>
                <label class="custom-control-label" for="RECONSIDERED">Dipertimbangkan</label>
                <small class="form-text text-muted">
                    Bila subyek hanya memiliki 2 hingga 3 kompetensi yang diharapkan
                </small>
            </div>
            <div class="custom-control custom-checkbox ">
                <input type="radio" id="REJECTED" @if(Auth::user()->privilege->type=='ADMIN') name="result[{{$answer['i']}}][{{$answer['j']}}]" @else name="result" @endif class="custom-control-input" value="REJECTED" @if(isset($answer['result']) && $answer['result']=='REJECTED') checked @endif @if(Auth::user()->privilege->type == 'ADMIN') disabled @endif>
                <label class="custom-control-label" for="REJECTED">Tidak dapat disarankan</label>
                <small class="form-text text-muted">
                    Bila kompetensi tidak sesuai dengan bidang yang dituju
                </small>
            </div>
        </div>

    </div>
    <div class="col-md-8">
    <h3>Pertimbangan Hasil Wawancara</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col" class="text-center">Kompetensi</th>
                        <th scope="col" class="text-center">Skor</th>
                        <th scope="col" class="text-center">Bukti Hasil Wawancara</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 0; $i < 10; $i++)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td><input class="form-control" type="text" name="competency[]" placeholder="Isi Kompetensi" value="@if(isset($answer['competencies'][$i])){{$answer['competencies'][$i]->competency}}@endif" @if(Auth::user()->privilege->type == 'ADMIN') disabled @endif></td>
                            <td><input class="form-control" type="number" name="score[]" placeholder="Skor" value="@if(isset($answer['competencies'][$i])){{$answer['competencies'][$i]->score}}@endif" @if(Auth::user()->privilege->type == 'ADMIN') disabled @endif></td>
                            <td><textarea class="form-control" name="evidence[]" cols="30" rows="1" @if(Auth::user()->privilege->type == 'ADMIN') disabled @endif>@if(isset($answer['competencies'][$i])){{$answer['competencies'][$i]->evidence}}@endif</textarea></td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
