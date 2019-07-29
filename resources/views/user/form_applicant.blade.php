<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title><link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sb-admin-2.min.css') }}">
    
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">

    <div id="wrapper" style="background-color:white;">
    
        <div id="content-wrapper" class="d-flex flex-column" style="background-color:white;">
    
        <div id="content" style="background-color:white;">
    
            <!-- Begin Page Content -->
            <div class="container" style="padding-top:40px;background-color:white;">
    
                <div class="row">
                    <div class="col-md-4">
                        <h3>Formulir</h3>
                        <div class="form-group">
                            <label>Nama Lengkap Pelamar</label>
                            <input class="form-control" type="text" name="full_name" placeholder="Nama Lengkap" value="{{$form->full_name}}">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input class="form-control" type="date" name="date_of_birth" value="{{$form->date_of_birth}}">
                        </div>
                        <div class="form-group">
                            <label>Pendidikan Terakhir</label>
                            <input class="form-control" type="text" name="education" placeholder="Pendidikan Terakhir" value="{{$form->education}}">
                        </div>
                        <div class="form-group">
                            <label>Unit Kerja</label>
                            <input class="form-control" type="text" name="unit" placeholder="Unit Kerja" value="{{$form->unit}}">
                        </div>
                        <div class="form-group">
                            <label>Posisi Yang Dilamar</label>
                            <input class="form-control" type="text" name="position" placeholder="Posisi" value="{{$form->position}}">
                        </div>
                        <div class="form-group">
                            <label>Nama Pewawancara</label>
                            <input class="form-control" type="text" name="interviewer" placeholder="Nama Pewawancara" value="{{$form->interviewer}}">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Wawancara</label>
                            <input class="form-control" type="date" name="date_of_interview" value="{{$form->date_of_interview}}">
                        </div>
                
                        <h3>Kesimpulan</h3>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox ">
                                <input type="radio" id="PASSED" name="result" class="custom-control-input" value="PASSED" @if($form->result=='PASSED') checked @endif>
                                <label class="custom-control-label" for="PASSED">Dapat Disarankan</label>
                            </div>
                            <div class="custom-control custom-checkbox ">
                                <input type="radio" id="RECONSIDERED" name="result" class="custom-control-input" value="RECONSIDERED" @if($form->result=='RECONSIDERED') checked @endif>
                                <label class="custom-control-label" for="RECONSIDERED">Dipertimbangkan</label>
                            </div>
                            <div class="custom-control custom-checkbox ">
                                <input type="radio" id="REJECTED" name="result" class="custom-control-input" value="REJECTED" @if($form->result=='REJECTED') checked @endif>
                                <label class="custom-control-label" for="REJECTED">Tidak dapat disarankan</label>
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
                                            <td><input class="form-control" type="text" name="competency[]" value="@if($i < $form->competencies()->count()){{$form->competencies[$i]->competency}}@endif"></td>
                                            <td><input class="form-control" type="number" name="score[]" value="@if($i < $form->competencies()->count()){{$form->competencies[$i]->score}}@endif"></td>
                                            <td><textarea class="form-control" name="evidence[]" cols="30" rows="1" >@if($i < $form->competencies()->count()){{$form->competencies[$i]->evidence}}@endif</textarea></td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    
            </div>
            <!-- /.container-fluid -->
    
        </div>
        <!-- End of Main Content -->
    
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; E-Modul BBI 2019</span>
            </div>
            </div>
        </footer>
        <!-- End of Footer -->
    
        </div>
        <!-- End of Content Wrapper -->
    
    </div>
    <!-- End of Page Wrapper -->
    
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>      
    </body>
</html>