@extends('admin.main')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        Buat Soal Baru
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
                    <form action="{{route('admin-question-store')}}" method="post">
                        <div id="case-study-section" class="form-group">
                            <div class="text-right mb-0">
                                <a href="{{route('admin-case-study-create', ['level_id' => $level->id])}}" class="btn btn-success btn-sm text-white" title="Buat Studi Kasus"><i class="fas fa-plus"></i> Studi Kasus</a>
                            </div>
                            <label>Pilih Studi Kasus</label>
                            <select name="case_study" class="form-control">
                                <option value="0">Tidak ada</option>
                                @foreach($caseStudies as $caseStudy)
                                    <option value="{{$caseStudy->id}}">{{$caseStudy->level->name}} - {{$caseStudy->number}}. {{$caseStudy->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <textarea id="question-body" name="question_body" cols="30" rows="10" placeholder="Fill the question body here!"></textarea>

                        <div id="case-study-section" class="form-group mt-3">
                            <label>Pilih Tipe Soal</label>
                            <select name="answer_type" id="answer-type-dropdown" class="form-control">
                                <option value="MULTIPLE" selected>Multiple Choice</option>
                                <option value="ESSAY">Essay</option>
                                <option value="CHECKLIST">Checklist</option>
                                <option value="FORM">Form Interview</option>
                            </select>
                        </div>

                        <div id="answer-section" class="form-group">
                            <div class="answer-type form-group" id="answer-checklist">
                                <label>Jawaban Checklist</label>
                                <div class="text-right mb-3">
                                    <button id="add-checklist" class="btn btn-success btn-circle btn-sm" title="Tambah Checklist"><i class="fas fa-plus"></i></button>
                                    <button id="remove-checklist" class="btn btn-danger btn-circle btn-sm" title="Kurangi Checklist"><i class="fas fa-minus"></i></button>
                                </div>
                                <!-- <div><button id="add-checklist">Tambah Checklist</button><button id="remove-checklist">Kurangi Checklist</button></div> -->

                                <div class="form-row mb-3" cl-number="1" cl-tail="true">
                                    <div class="col-10">
                                        <input type="text" name="checklist[]" class="form-control checklist-elems" placeholder="Item">
                                    </div>
                                    <div class="col-2">
                                        <input type="text"  name="cl_correct[]" class="form-control" min="1" max="5">
                                    </div>
                                </div>
                                <!-- <div cl-number="1" cl-tail="true"><textarea class="checklist-elems" name="checklist[]" cols="50" rows="1"></textarea> <input type="number" name="cl_correct[]" min="1" max="5"></div> -->
                            </div>
                            <div class="answer-type form-group" id="answer-essay">
                                <label>Jawaban Essay</label>
                                <textarea name="essay" cols="30" class="form-control" rows="10" placeholder="Fill the answer for essay here!"></textarea>
                            </div>
                            <div class="answer-type" id="answer-multiple">
                                <label>Jawaban Pilihan Ganda</label>
                                @php
                                    $point = 'a';
                                @endphp
                                @for( $i=0; $i < 4; $i++)
                                
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="radio" name="mc_correct" value="{{$i}}" @if($point == 'a') checked @endif>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="mc_body[]">
                                    </div>
                                    @php
                                        $point++;
                                    @endphp
                                @endfor
                            </div>
                        </div>
                        <input type="hidden" name="level_id" value="{{$level->id}}">
                        <input type="submit" class="btn btn-primary mt-3" value="Simpan">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js?cb=1234"></script>
    <script>
        (function(){

            const switchAnswerDropdown = document.getElementById('answer-type-dropdown')
            const answerEssay = document.getElementById('answer-essay')
            const answerMultiple = document.getElementById('answer-multiple')
            const answerChecklist = document.getElementById('answer-checklist')
            const answerTypeSections = document.getElementsByClassName('answer-type')
            const questionBody = document.getElementById('question-body')

            const addChecklist = document.getElementById('add-checklist')
            const removeChecklist = document.getElementById('remove-checklist')
            const options = {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
            };

            CKEDITOR.replace( questionBody, options );

            switchAnswerDropdown.addEventListener('change', function(e){
                e.stopPropagation()
                
                for (let i = 0; i < answerTypeSections.length; i++) {
                    const element = answerTypeSections[i];
                    element.style.display = 'none'
                }

                switch (this.value) {
                    case 'MULTIPLE':
                        answerMultiple.style.display = 'block'
                        break;
                        
                    case 'ESSAY':
                        answerEssay.style.display = 'block'
                        break;
                        
                    case 'CHECKLIST':
                        answerChecklist.style.display = 'block'
                        break;
                        
                }
            })

            addChecklist.addEventListener('click', function(e){
                e.preventDefault()
                e.stopPropagation()

                const clTail = document.querySelector('div[cl-tail="true"]')
                const newNumber = parseInt(clTail.getAttribute('cl-number')) + 1

                clTail.removeAttribute('cl-tail')

                const node = document.createElement('div')
                node.setAttribute('cl-number', newNumber)
                node.setAttribute('cl-tail', "true")
                node.className = "form-row mb-3"
                node.innerHTML = '<div class="col-10"><input type="text" name="checklist[]" class="form-control checklist-elems" placeholder="Item"></div><div class="col-2"><input type="text"  name="cl_correct[]" class="form-control" min="1" max="5"></div>'
                answerChecklist.appendChild(node)
            })

            removeChecklist.addEventListener('click', function(e){
                e.preventDefault()
                e.stopPropagation()

                const clTail = document.querySelector('div[cl-tail="true"]')
                const newNumber = parseInt(clTail.getAttribute('cl-number')) - 1
                const clNewTail = document.querySelector('div[cl-number="'+newNumber+'"]')

                if(clNewTail){
                    clNewTail.setAttribute('cl-tail', "true")
                    answerChecklist.removeChild(clTail)
                }
            })
        })()
    </script>
@endsection