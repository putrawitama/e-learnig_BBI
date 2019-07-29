@extends('admin.main')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        Buat Penilaian Diri
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
                    <div class="text-right mb-1">
                        <button id="btn-add" class="btn btn-success btn-circle btn-sm" title="Tambah Penilaian"><i class="fas fa-plus"></i></button>
                        <button id="btn-remove" class="btn btn-danger btn-circle btn-sm" title="Hapus Penilaian"><i class="fas fa-minus"></i></button>
                    </div>
                    <form action="{{route('admin-evaluation-store')}}" method="post">
                            <div id="section-body">
                                <div class="form-group" tail="true" eval-number=1>
                                    <label>Nomor 1</label>
                                    <textarea class="form-control" name="evaluation[]" rows="1"></textarea>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>
                        <input type="hidden" name="level_id" value="{{$level->id}}">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const btnAdd = document.getElementById('btn-add')
        const btnRemove = document.getElementById('btn-remove')
        const sectionBody = document.getElementById('section-body')

        btnAdd.addEventListener('click', function(e){
            e.preventDefault()
            e.stopPropagation()

            const tail = document.querySelector('div[tail="true"]')
            const node = document.createElement('div')

            node.setAttribute('eval-number', parseInt(tail.getAttribute('eval-number')) + 1)
            node.setAttribute('tail', 'true')
            node.innerHTML = '<div class="form-group"><label>Nomor '+ (parseInt(tail.getAttribute('eval-number'))+1) +'</label><textarea class="form-control" name="evaluation[]" rows="1"></textarea></div>'
            tail.removeAttribute('tail')

            sectionBody.appendChild(node)
        })

        btnRemove.addEventListener('click', function(e){
            e.preventDefault()
            e.stopPropagation()

            const tail = document.querySelector('div[tail="true"]')

            if(parseInt(tail.getAttribute('eval-number')) == 1) return
            
            document.querySelector('div[eval-number="'+(parseInt(tail.getAttribute('eval-number'))-1)+'"]').setAttribute('tail', 'true')
            
            sectionBody.removeChild(tail)
        })
    </script>
@endsection
