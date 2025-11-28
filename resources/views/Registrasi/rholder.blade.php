@extends('main')
@section('content')

<section>
    <div class="card-header">
        <div class="row">
            <div class="col-8">
                @include('Registrasi.card_header')
            </div>
            <div class="col-4">
                <div class="input-group style-search mx-4 w-100">
                    <input id="searchHolderRegis" type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                    <button type="button" class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-6">
                <p class="judul-menu"><i></i>Registration Holder</p>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end align-items-center w-100">
                    <button type="button" class="btn btn-border me-1" data-name="upload"><i class="icon-excel"></i> Upload</button>
                    <button type="button" class="btn btn-border me-1" data-name="download"><i class="bi bi-download"></i> Download</button>
                    <button type="button" class="btn btn-add" data-name="add"><i class="bi bi-plus-circle"></i> Add Holder</button>
                </div>
            </div>
        </div>
        <div class="gridtable">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>PART NO</th>
                        <th>ENGINEERING NO</th>
                        <th>HES NO</th>
                        <th>SPESIFICATION</th>
                        <th>HOLDER TYPE</th>
                        <th>MAKER</th>
                        <th>MATERIAL</th>
                        <th>MARKING PROGRAM</th>
                        <th>PRICE</th>
                        <th>LIFETIME</th>
                        <th>DRAWING</th>
                        <th>ACTION</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="dataAllHolderRegis">
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- Modal Add --}}
<div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Registration Holder</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Part No</label>
                        <div class="col-8">
                            <input type="text" name="part_no" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Engineering No</label>
                        <div class="col-8">
                            <input type="text" name="engineering_no" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">HES No</label>
                        <div class="col-8">
                            <div class="input-group">
                                <span class="input-group-text" id="">IN-5</span>
                                <input type="text" name="hes_no" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="textarea-label col-4">Spesification</label>
                        <div class="col-8">
                            <textarea name="spesification"  cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Holder Type</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="id_holder">
                                <option value="" disabled selected>Select Type</option>
                                @forelse ($holder as $key => $row)
                                    <option value="{{$row->id}}">{{$row->holder_type}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Maker</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="id_maker">
                                <option value="" disabled selected>Select Maker</option>
                                @forelse ($maker as $key => $row)
                                    <option value="{{$row->id}}">{{$row->maker_name}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Material</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="id_material">
                                <option value="" disabled selected>Select Material</option>
                                @forelse ($material as $key => $row)
                                    <option value="{{$row->id}}">{{$row->material_type}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Marking Program</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="id_marking">
                                <option value="" disabled selected>Select Marking</option>
                                @forelse ($marking as $key => $row)
                                    <option value="{{$row->id}}">{{$row->program_no}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Unit</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="id_unit">
                                <option value="" disabled selected>Select Unit</option>
                                @forelse ($unit as $key => $row)
                                    <option value="{{$row->id}}">{{$row->description}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Price</label>
                        <div class="col-8">
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" name="price" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Lifetime</label>
                        <div class="col-8">
                            <input type="text" name="lifetime" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="textarea-label col-4">Drawing</label>
                        <div class="col-8">
                            <label for="formFile" class="form-label">Upload File Drawing: JPG, JPEG, PNG, PDF</label>
                            <input class="form-control" name="drawing" type="file" id="formFile">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="save_add"><span>Save</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Add --}}

{{-- Modal Edit --}}
<div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Registration Holder</h5>
                <input type="hidden" id="id_edit">
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Part No</label>
                        <div class="col-8">
                            <input type="text" id="part_no" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Engineering No</label>
                        <div class="col-8">
                            <input type="text" id="engineering_no" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">HES No</label>
                        <div class="col-8">
                            <div class="input-group">
                                <span class="input-group-text" id="">IN-5</span>
                                <input type="text" id="hes_no" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="textarea-label col-4">Spesification</label>
                        <div class="col-8">
                            <textarea name="model_name" id="spesification"  cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Type</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" name="" id="id_holder">
                                <option value="" disabled selected>Select Type</option>
                                @forelse ($holder as $key => $row)
                                    <option value="{{$row->id}}">{{$row->holder_type}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Maker</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" name="" id="id_maker">
                                <option value="" disabled selected>Select Maker</option>
                                @forelse ($maker as $key => $row)
                                    <option value="{{$row->id}}">{{$row->maker_name}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Material</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" name="" id="id_material">
                                <option value="" disabled selected>Select Material</option>
                                @forelse ($material as $key => $row)
                                    <option value="{{$row->id}}">{{$row->material_type}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Marking Program</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" name="" id="id_marking">
                                <option value="" disabled selected>Select Marking</option>
                                @forelse ($marking as $key => $row)
                                    <option value="{{$row->id}}">{{$row->program_no}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Unit</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" name="" id="id_unit">
                                <option value="" disabled selected>Select Unit</option>
                                @forelse ($unit as $key => $row)
                                    <option value="{{$row->id}}">{{$row->description}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Price</label>
                        <div class="col-8">
                            <div class="input-group">
                                <span class="input-group-text" id="">Rp.</span>
                                <input type="text" id="price" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Lifetime</label>
                        <div class="col-8">
                            <input type="text" id="lifetime" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="textarea-label col-4">Drawing</label>
                        <div class="col-8">
                            <label for="formFile" class="form-label">Upload File Drawing: JPG, JPEG, PNG, PDF</label>
                            <input class="form-control" name="drawing" type="file" id="formFileEdit">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="save_edit"><span>Save</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Edit --}}

{{-- Modal Upload --}}
<div class="modal fade" id="modal_upload" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload File</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="textarea-label col-4">Upload File (Excel)</label>
                        <div class="col-8">
                            <label for="formFile" class="form-label">Extension: Excel</label>
                            <input class="form-control" type="file" id="formFile">
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="textarea-label col-4">Upload File Drawing</label>
                        <div class="col-8">
                            <label for="fileInput" class="form-label">Extension: JPG, JPEG, PNG, PDF</label>
                            <input class="form-control" type="file" id="fileInput" multiple>
                            <div class="row mt-3" id="fileInfo">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id=""><span>Save</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Upload --}}

{{-- inisiasi data --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        getHolderRegis();
    });

    const getHolderRegis = async () => {
        fetch("{{ route('getallholderregis') }}", { // Laravel Blade syntax to generate the route URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            // Append the new data to the table
            var table = document.getElementById('dataAllHolderRegis');
            table.innerHTML = data.arr
        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
        });
    }
</script>

{{-- JS Add --}}
<script>
    $(document).on("click", "[data-name='add']", function (e) {
        $("#modal_add").modal('show');
        // clear input
        document.querySelector('input[name="part_no"]').value = '';
        document.querySelector('input[name="engineering_no"]').value = '';
        document.querySelector('input[name="hes_no"]').value = '';
        document.querySelector('textarea[name="spesification"]').value = '';
        document.querySelector('select[name="id_holder"]').value = '';
        document.querySelector('select[name="id_maker"]').value = '';
        document.querySelector('select[name="id_material"]').value = '';
        document.querySelector('select[name="id_marking"]').value = '';
        document.querySelector('select[name="id_unit"]').value = '';
        document.querySelector('input[name="price"]').value = '';
        document.querySelector('input[name="lifetime"]').value = '';
        document.querySelector('input[name="drawing"]').value = '';

        let part_no         = document.querySelector('input[name="part_no"]');
        let engineering_no  = document.querySelector('input[name="engineering_no"]');
        let hes_no          = document.querySelector('input[name="hes_no"]');
        let spesification   = document.querySelector('textarea[name="spesification"]');
        let id_holder       = document.querySelector('select[name="id_holder"]');
        let id_maker        = document.querySelector('select[name="id_maker"]');
        let id_material     = document.querySelector('select[name="id_material"]');
        let id_marking      = document.querySelector('select[name="id_marking"]');
        let id_unit         = document.querySelector('select[name="id_unit"]');
        let price           = document.querySelector('input[name="price"]');
        let lifetime        = document.querySelector('input[name="lifetime"]');
        let drawing         = document.querySelector('input[name="drawing"]');

        // save data
        document.getElementById('save_add').addEventListener('click', function() {
            let formData = new FormData();
            formData.append('part_no', part_no.value);
            formData.append('engineering_no', engineering_no.value);
            formData.append('hes_no', hes_no.value);
            formData.append('spesification', spesification.value);
            formData.append('id_holder', id_holder.value);
            formData.append('id_maker', id_maker.value);
            formData.append('id_material', id_material.value);
            formData.append('id_marking', id_marking.value);
            formData.append('id_unit', id_unit.value);
            formData.append('price', price.value);
            formData.append('lifetime', lifetime.value);
            formData.append('drawing', drawing.files[0]);
            formData.append('aksi', 'add');

            fetch("{{ route('crudholderregis') }}", { // Laravel Blade syntax to generate the route URL
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                // Append the new data to the table
                if(data.status == 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success...',
                        text: data.message
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#modal_add").modal('hide');
                            getHolderRegis();
                        }
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message
                    })
                }
            })
            .catch((error) => {
                // Handle errors here
                console.error('Error:', error);
            });
        });
    });
</script>
{{-- End JS Add --}}

{{-- JS Edit --}}
<script>
    $(document).on("click", "[data-name='edit']", function (e) {
        $("#modal_edit").modal('show');
        let id  = $(this).data('item');

        // fetch data
        fetch("{{ route('getallholderregis') }}", { // Laravel Blade syntax to generate the route URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({id: id})
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            // Append the new data to the table
            console.log(data);
            document.getElementById('part_no').value   = data.arr.part_no;
            document.getElementById('engineering_no').value   = data.arr.engineering_no;
            document.getElementById('hes_no').value   = data.arr.hes_no;
            document.getElementById('spesification').value   = data.arr.spesification;
            // select2 set value
            $('#id_holder').val(data.arr.id_holder).trigger('change');
            $('#id_maker').val(data.arr.id_maker).trigger('change');
            $('#id_material').val(data.arr.id_material).trigger('change');
            $('#id_marking').val(data.arr.id_marking).trigger('change');
            $('#id_unit').val(data.arr.id_unit).trigger('change');
            document.getElementById('price').value          = data.arr.price;
            document.getElementById('lifetime').value       = data.arr.lifetime;
            // set drawing
            document.getElementById('formFileEdit').value   = data.arr.drawing;
            
        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
        });

        // save data edit
        document.getElementById('save_edit').addEventListener('click', function() {
            let formData = new FormData();
            formData.append('id', id);
            formData.append('part_no', document.getElementById('part_no').value);
            formData.append('engineering_no', document.getElementById('engineering_no').value);
            formData.append('hes_no', document.getElementById('hes_no').value);
            formData.append('spesification', document.getElementById('spesification').value);
            formData.append('id_holder', document.getElementById('id_holder').value);
            formData.append('id_maker', document.getElementById('id_maker').value);
            formData.append('id_material', document.getElementById('id_material').value);
            formData.append('id_marking', document.getElementById('id_marking').value);
            formData.append('id_unit', document.getElementById('id_unit').value);
            formData.append('price', document.getElementById('price').value);
            formData.append('lifetime', document.getElementById('lifetime').value);
            formData.append('drawing', document.getElementById('formFileEdit').files[0]);
            formData.append('aksi', 'edit');

            fetch("{{ route('crudholderregis') }}", { // Laravel Blade syntax to generate the route URL
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if(data.status) {
                    Swal.fire({
                        position:'center',
                        title: 'Success!',
                        icon: 'success',
                        message: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        position:'center',
                        title: 'Failed!',
                        icon: 'error',
                        message: data.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }

                console.log(data);
                $("#modal_edit").modal('hide');
                getHolderRegis();

            })
            .catch((error) => {
                // Handle errors here
                console.error('Error:', error);
            });
        });
    });
</script>
{{-- End JS Edit --}}

{{-- JS Upload File --}}
<script>
    $(document).on("click", "[data-name='upload']", function (e) {
        $("#modal_upload").modal('show');
    });

    $(document).ready(function() {
        // Handle change event of file input
        $('#fileInput').change(function() {
            // Get the files
            var files = $(this)[0].files;

            // Clear previous file information
            $('#fileInfo').html('');

            // Loop through the files and display information
            var html = '';
            for (var i = 0; i < files.length; i++) {
                var fileName = files[i].name;
                var fileSize = files[i].size;
                var fileSizeKB = fileSize / 1024;

                html += '<div class="col-12 mb-3">';
                html += '<div class="card-preview-file">';
                html += '<button class="btn btn-remove" type="button" data-item="file_'+(i + 1)+'">';
                html += '<i class="bi bi-x-lg"></i>';
                html += '</button>';
                html += '<div class="card-info-file">';
                html += '<p>'+fileName+'</p>';
                html += '<p>'+fileSizeKB.toFixed(2)+' KB</p>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                // Display file information
            }

            $('#fileInfo').append(html);
        });
    });
</script>
{{-- End Upload File --}}

{{-- JS Delete --}}
<script>
    $(document).on("click", "[data-name='delete']", function (e) {
        var id      = $(this).data('item');
        var part_no = $(this).data('arr');

        Swal.fire({
            title: 'Anda yakin?',
            text: 'Hapus Data '+part_no+'?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // fetch data
                fetch("{{ route('crudholderregis') }}", { // Laravel Blade syntax to generate the route URL
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                    },
                    body: JSON.stringify({id: id, part_no: part_no, aksi: 'delete'})
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if(data.status) {
                        Swal.fire({
                            position:'center',
                            title: 'Success!',
                            icon: 'success',
                            message: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            position:'center',
                            title: 'Failed!',
                            icon: 'error',
                            message: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                    getHolderRegis();
                })
                .catch((error) => {
                    // Handle errors here
                    console.error('Error:', error);
                });
            }
        });
    });
</script>
{{-- End JS Delete --}}

{{-- JS Select2 --}}
<script>
    $(".select-2-add").select2({
        placeholder: '--Select--',
        allowClear: false,
        width: '100%',
        dropdownParent: $('#modal_add')
    });

    $(".select-2-edit").select2({
        allowClear: false,
        width: '100%',
        dropdownParent: $('#modal_edit')
    });
</script>
{{-- End JS Select2 --}}



@stop