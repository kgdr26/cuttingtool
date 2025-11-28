@extends('main')
@section('content')

<section>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-4">
                <p class="judul-menu"><i></i>List Machine</p>
            </div>
            <div class="col-8">
                <div class="d-flex justify-content-end align-items-center w-100">
                    <button type="button" class="btn btn-border me-1" data-name="upload"><i class="icon-excel"></i> Upload</button>
                    <button type="button" class="btn btn-border me-1" data-name="download"><i class="bi bi-download"></i> Download</button>
                    <button type="button" class="btn btn-add" data-name="add"><i class="bi bi-plus-circle"></i> Add Machine</button>
                    <div class="input-group style-search mx-4 w-25">
                        <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                        <button type="button" class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="gridtable">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>PLANT ID</th>
                        <th>WCT ID</th>
                        <th>OP NAME</th>
                        <th>MAKER MACHINE NAME</th>
                        <th>ASSET ID</th>
                        <th>MACHINE NAME</th>
                        <th>IP ADDRESS</th>
                        <th>PORT</th>
                        <th>ACTION</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="getlistmachine">
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
                <h5 class="modal-title">Add Machine</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto">

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Plant ID</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="id_plant" id="">
                                <option value="" disabled selected>--select Plant ID--</option>
                                @forelse ($plant as $key => $row)
                                    <option value="{{$row->id}}">{{$row->plant_name}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">WCT ID</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="id_wct" id="">
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">OP Name</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="op_name" id="">
                            </select>
                        </div>
                    </div>

                    <div class="card-auto p-0 mb-3">
                        <div class="card-header-input">
                            Machine Information
                        </div>
                        <div class="card-body-input">
                            <div class="row mb-3">
                                <label for="" class="text-label col-4">Asset ID</label>
                                <div class="col-8">
                                    <input type="text" name="asset_id" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="" class="text-label col-4">Machine Name</label>
                                <div class="col-8">
                                    <input type="text" name="machine_name" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-auto p-0">
                        <div class="card-header-input">
                            Communication
                        </div>
                        <div class="card-body-input">
                            <div class="row mb-3">
                                <label for="" class="text-label col-4">IP Address</label>
                                <div class="col-8">
                                    <input type="text" name="ip_address" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="" class="text-label col-4">Port</label>
                                <div class="col-8">
                                    <input type="text" name="port" class="form-control">
                                </div>
                            </div>
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
                <h5 class="modal-title">Edit Machine</h5>
                <input type="text" id="id_edit">
            </div>
            <div class="modal-body">
                <div class="card-auto">

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Plant ID</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" id="id_plant">
                                @forelse ($plant as $key => $row)
                                    <option value="{{$row->id}}">{{$row->plant_name}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">WCT ID</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" id="id_wct">
                                {{-- @forelse ($wct as $key => $row)
                                    <option value="{{$row->id}}">{{$row->id_wct}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse --}}
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">OP Name</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" id="op_name">
                                {{-- @forelse ($op_name as $key => $row)
                                    <option value="{{$row->id}}">{{$row->op_name}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse --}}
                            </select>
                        </div>
                    </div>

                    <div class="card-auto p-0 mb-3">
                        <div class="card-header-input">
                            Machine Information
                        </div>
                        <div class="card-body-input">
                            <div class="row mb-3">
                                <label for="" class="text-label col-4">Asset ID</label>
                                <div class="col-8">
                                    <input type="text" id="asset_id" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="" class="text-label col-4">Machine Name</label>
                                <div class="col-8">
                                    <input type="text" id="machine_name" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-auto p-0">
                        <div class="card-header-input">
                            Communication
                        </div>
                        <div class="card-body-input">
                            <div class="row mb-3">
                                <label for="" class="text-label col-4">IP Address</label>
                                <div class="col-8">
                                    <input type="text" id="ip_address" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <label for="" class="text-label col-4">Port</label>
                                <div class="col-8">
                                    <input type="text" id="port" class="form-control">
                                </div>
                            </div>
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

{{-- initiate load --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        getListMachine();
    });

    const getListMachine = async () => {
        fetch("{{route('getmachinelist')}}", {
            method: 'POST',
            headers: {
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
            console.log(data)
            document.getElementById('getlistmachine').innerHTML = data.arr;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>

{{-- chaining select --}}
<script>
    $(document).on('change', '#id_plant', function() {
        $('#id_plant').on('change', function() {
            var idPlant = $(this).val();
            // alert(idPlant);
            if (idPlant) {
                $.ajax({
                    url: "{{ route('getwctbyplant') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id_plant: idPlant
                    },
                    success: function(data) {
                        console.log(data)
                        $('#id_wct').empty();
                        $('#id_wct').append('<option value="" disabled selected>--Select WCT ID--</option>');
                        $.each(data, function(key, value) {
                            console.log(value)
                            $('#id_wct').append('<option value="' + data[key].id + '">' + data[key].id_wct + '</option>');
                        });
                    }
                });
            } else {
                $('#id_wct').empty();
                $('#id_wct').append('<option value="" disabled selected>Select from the first option</option>');
            }
        });
    });

    $(document).on('change', '#id_wct', function() {
        $('#id_wct').on('change', function() {
            var idWct = $(this).val();
            if (idWct) {
                $.ajax({
                    url: "{{ route('getopbywct') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id_wct: idWct
                    },
                    success: function(data) {
                        console.log(data)
                        $('#op_name').empty();
                        $('#op_name').append('<option value="" disabled selected>--Select OP Name--</option>');
                        $.each(data, function(key, value) {
                            console.log(value)
                            $('#op_name').append('<option value="' + data[key].id + '">' + data[key].op_name + '</option>');
                        });
                    }
                });
            } else {
                $('#op_name').empty();
                $('#op_name').append('<option value="" disabled selected>Select from the first option</option>');
            }
        });
    });


    $(document).ready(function() {
        $('select[name="id_plant"]').on('change', function() {
            var idPlant = $(this).val();
            if (idPlant) {
                $.ajax({
                    url: "{{ route('getwctbyplant') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id_plant: idPlant
                    },
                    success: function(data) {
                        console.log(data)
                        $('select[name="id_wct"]').empty();
                        $('select[name="id_wct"]').append('<option value="" disabled selected>--Select WCT ID--</option>');
                        $.each(data, function(key, value) {
                            console.log(value)
                            $('select[name="id_wct"]').append('<option value="' + data[key].id + '">' + data[key].id_wct + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="id_wct"]').empty();
                $('select[name="id_wct"]').append('<option value="" disabled selected>Select from the first option</option>');
            }
        });



        $('select[name="id_wct"]').on('change', function() {
            var idWct = $(this).val();
            if (idWct) {
                $.ajax({
                    url: "{{ route('getopbywct') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id_wct: idWct
                    },
                    success: function(data) {
                        console.log(data)
                        $('select[name="op_name"]').empty();
                        $('select[name="op_name"]').append('<option value="" disabled selected>--Select OP Name--</option>');
                        $.each(data, function(key, value) {
                            console.log(value)
                            $('select[name="op_name"]').append('<option value="' + data[key].id + '">' + data[key].op_name + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="op_name"]').empty();
                $('select[name="op_name"]').append('<option value="" disabled selected>Select from the first option</option>');
            }
        });

        
    });
</script>

{{-- JS Add --}}
<script>
    $(document).on("click", "[data-name='add']", function (e) {
        $("#modal_add").modal('show');

        // add data
        document.getElementById('save_add').addEventListener('click', function() {
            let formData = new FormData();
            formData.append('id_plant', $('select[name="id_plant"]').val());
            formData.append('id_wct', $('select[name="id_wct"]').val());
            formData.append('op_name', $('select[name="op_name"]').val());
            formData.append('asset_id', $('input[name="asset_id"]').val());
            formData.append('machine_name', $('input[name="machine_name"]').val());
            formData.append('ip_address', $('input[name="ip_address"]').val());
            formData.append('port', $('input[name="port"]').val());
            formData.append('aksi', 'add');

            // fetch data
            fetch("{{route('crudmachinelist')}}", {
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
                console.log(data);
                if (data.status == 'success') {
                    Swal.fire({
                        position:'center',
                        title: 'Success!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((data) => {
                        // close modal
                        $("#modal_add").modal('hide');
                        // refresh page
                        getListMachine();
                        // location.reload();
                    });
                } else {
                    Swal.fire({
                        position:'center',
                        title: 'Failed!',
                        text: data.message,
                        icon: 'error',
                        showConfirmButton: true,
                        // timer: 1500
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: error,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            });

        });
    });
</script>
{{-- End JS Add --}}

{{-- JS Edit --}}
<script>
    $(document).on("click", "[data-name='edit']", function (e) {
        $("#modal_edit").modal('show');
        // get data
        let id  = $(this).data('item');
        fetch("{{route('getmachinelist')}}", {
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
            console.log(data);
            let id_plant         = data.arr.id_plant;
            let id_wct           = data.arr.id_wct;
            let id_machine_regis = data.arr.list.id_machine_regis;
            let asset_id         = data.arr.list.asset_id;
            let machine_name     = data.arr.list.machine_name;
            let ip_address       = data.arr.list.ip_address;
            let port             = data.arr.list.port;

            // set value
            document.getElementById('id_edit').value = id;
            // select2 set value plant
            $('#id_plant').val(id_plant).trigger('change');
            $.ajax({
                url: "{{ route('getwctbyplant') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id_plant: id_plant
                },
                success: function(data) {
                    console.log(data)
                    $('#id_wct').empty();
                    $('#id_wct').append('<option value="" disabled selected>--Select WCT ID--</option>');
                    $.each(data, function(key, value) {
                        console.log(value)
                        $('#id_wct').append('<option value="' + data[key].id + '">' + data[key].id_wct + '</option>');
                    });
                    setTimeout(() => {
                        $('#id_wct').val(id_wct).trigger('change');
                    }, 1000);
                    // add loading animation
                    $('#id_wct').append('<option value="" disabled selected>Loading...</option>');
                }
            });

            // add loading animation
            $.ajax({
                url: "{{ route('getopbywct') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id_wct: id_wct
                },
                success: function(data) {
                    console.log(data)
                    $('#op_name').empty();
                    $('#op_name').append('<option value="" disabled selected>--Select OP Name--</option>');
                    $.each(data, function(key, value) {
                        console.log(value)
                        $('#op_name').append('<option value="' + data[key].id + '">' + data[key].op_name + '</option>');
                    });
                    setTimeout(() => {
                        $('#op_name').val(id_machine_regis).trigger('change');
                    }, 1500);
                    // add loading animation
                    $('#op_name').append('<option value="" disabled selected>Loading...</option>');
                }
            });
            document.getElementById('asset_id').value = asset_id;
            document.getElementById('machine_name').value = machine_name;
            document.getElementById('ip_address').value = ip_address;
            document.getElementById('port').value = port;
        })
        .catch(error => {
            console.error('Error:', error);
        });

        // save edit
        document.getElementById('save_edit').addEventListener('click', function() {
            let formData = new FormData();
            formData.append('id', document.getElementById('id_edit').value);
            formData.append('op_name', $('#op_name').val());
            formData.append('asset_id', $('#asset_id').val());
            formData.append('machine_name', $('#machine_name').val());
            formData.append('ip_address', $('#ip_address').val());
            formData.append('port', $('#port').val());
            formData.append('aksi', 'edit');

            // if null then alert
            if ($('#id_plant').val() == null || $('#id_wct').val() == null || $('#op_name').val() == null || $('#asset_id').val() == '' || $('#machine_name').val() == '' || $('#ip_address').val() == '' || $('#port').val() == '') {
                Swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: 'All fields must be filled!',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }


            // fetch data
            fetch("{{route('crudmachinelist')}}", {
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
                console.log(data);
                if (data.status == 'success') {
                    Swal.fire({
                        position:'center',
                        title: 'Success!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((data) => {
                        // close modal
                        $("#modal_edit").modal('hide');
                        // refresh page
                        getListMachine();
                        // location.reload();
                    });
                } else {
                    Swal.fire({
                        position:'center',
                        title: 'Failed!',
                        text: data.message,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: error,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
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
        let id              = $(this).data('item');
        let machine_name    = $(this).data('arr');
        Swal.fire({
            title: 'Anda yakin?',
            text: 'Hapus data '+machine_name+'?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                let formData = new FormData();
                formData.append('id', id);
                formData.append('aksi', 'delete');
                fetch("{{route('crudmachinelist')}}", {
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
                    console.log(data);
                    if (data.status == 'success') {
                        Swal.fire({
                            position:'center',
                            title: 'Success!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((data) => {
                            // refresh page
                            getListMachine();
                            // location.reload();
                        });
                    } else {
                        Swal.fire({
                            position:'center',
                            title: 'Failed!',
                            text: data.message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        position:'center',
                        title: 'Failed!',
                        text: error,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            }
        });
    });
</script>
{{-- End JS Delete --}}

{{-- JS Select2 --}}
<script>
    $(".select-2-add").select2({
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