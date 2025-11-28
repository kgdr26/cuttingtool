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
                    <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                    <button type="button" class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        {{-- side left --}}
        <div class="grid-list-machine">
            <div class="row mb-3">
                <div class="col-6">
                    <p class="judul-menu"><i></i>Registration Machine</p>
                </div>
                <div class="col-6">
                    <div class="d-flex justify-content-end align-items-center w-100">
                        <button type="button" class="btn btn-border me-1" data-name="upload"><i class="icon-excel"></i> Upload</button>
                        <button type="button" class="btn btn-border me-1" data-name="download"><i class="bi bi-download"></i> Download</button>
                        <button type="button" class="btn btn-add" data-name="add"><i class="bi bi-plus-circle"></i> Add Machine</button>
                    </div>
                </div>
            </div>

            <div class="gridtable">
                <input type="hidden" id="id_machine">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>PLANT ID</th>
                            <th>WCT ID</th>
                            <th>OP NAME</th>
                            <th>MAKER MACHINE NAME</th>
                            <th>ACTION</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="getallmachineregis">
                    </tbody>
                </table>
            </div>
        </div>
        {{-- side right --}}
        <div class="grid-list-tool">
            <div class="row mb-3">
                <div class="col-12">
                    <p class="judul-menu"><i></i><span id="selected_machine">-</span></p>
                </div>
            </div>

            <div class="table-assy-tool">
                <table id="table_list_assy_tool">
                    <thead>
                        <tr>
                            <th>TOOL PORT</th>
                            <th colspan="2">CUTTING TOOL LIST</th>
                            <th>PRICE</th>
                            <th>&#931;</th>
                            <th>MACRO</th>
                            <th>MIN/MAX</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="assyToolPort">
                        <tr>
                            <td colspan="8" class="text-center">Please Select Machine</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end align-items-center w-100">
                <button type="button" class="btn btn-add" id="btn_add_assy" disabled data-name="add_assy">Add Assy Tool</button>
            </div>
        </div>
    </div>

</section>

{{-- Modal Add --}}
<div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Registration Machine</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Plant ID</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="id_plant" id="">
                                <option value="" disabled selected>select Plant ID</option>
                                @forelse ($plant as $key => $row)
                                    <option value="{{$row->id}}">{{$row->plant_name}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">WCT</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="id_wct" id="">
                                <option value="" disabled selected>Select Wct</option>
                                @forelse ($wct as $key => $row)
                                    <option value="{{$row->id}}">{{$row->line_name}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Maker Machine Name</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="id_maker_machine" id="">
                                <option value="" disabled selected>Select Maker Machine</option>
                                @forelse ($maker_machine as $key => $row)
                                    <option value="{{$row->id}}">{{$row->machine_name}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">OP Name</label>
                        <div class="col-8">
                            <input type="text" name="op_name" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="save_add_machine"><span>Save</span></button>
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
                <h5 class="modal-title">Edit Registration Machine</h5>
                <input type="hidden" id="id_edit_machine">
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Plant ID</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" id="id_plant">
                                <option value="" disabled selected>select Plant ID</option>
                                @forelse ($plant as $key => $row)
                                    <option value="{{$row->id}}">{{$row->plant_name}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">WCT</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" name="" id="id_wct">
                                <option value="" disabled selected>Select Wct</option>
                                @forelse ($wct as $key => $row)
                                    <option value="{{$row->id}}">{{$row->line_name}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Maker Machine Name</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" name="" id="id_maker_machine">
                                <option value="" disabled selected>Select Maker Machine</option>
                                @forelse ($maker_machine as $key => $row)
                                    <option value="{{$row->id}}">{{$row->machine_name}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">OP Name</label>
                        <div class="col-8">
                            <input type="text" id="op_name" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="save_edit_machine"><span>Save</span></button>
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

{{-- Modal Add Assy--}}
<div class="modal fade" id="modal_add_assy" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Assy Tool</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Cutting Tool</label>
                        <div class="col-8">
                            <select class="form-select select-2-add-assy" name="id_cutting_tool_regis" id="" multiple>
                                @forelse ($cutting_tool as $key => $row)
                                    <option value="{{$row->id}}">{{$row->spesification}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Holder</label>
                        <div class="col-8">
                            <select class="form-select select-2-add-assy" name="id_holder_regis" id="">
                                <option value="" disabled selected>-- select Holder --</option>
                                @forelse ($holder as $key => $row)
                                    <option value="{{$row->id}}">{{$row->spesification}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Accessories</label>
                        <div class="col-8">
                            <select class="form-select select-2-add-assy" name="id_accessories_regis" id="" multiple>
                                @forelse ($accessories as $key => $row)
                                    <option value="{{$row->id}}">{{$row->spesification}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Tool Port</label>
                        <div class="col-8">
                            <input type="text" name="tool_port" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">&#931; Process</label>
                        <div class="col-8">
                            <input type="text" name="sigma_process" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Macro Address</label>
                        <div class="col-8">
                            <input type="text" name="macro_address" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">MIN/ MAX</label>
                        <div class="col-8">
                            <div class="input-group">
                                <input type="text" name="min_value" class="form-control" placeholder="MIN" aria-label="MIN" aria-describedby="basic-addon1">
                                <span class="input-group-text" id="basic-addon1">-</span>
                                <input type="text" name="max_value" class="form-control" placeholder="MAX" aria-label="MAX" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="save_add_assy_tool"><span>Save</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Add Assy --}}

{{-- Modal Edit Assy--}}
<div class="modal fade" id="modal_edit_assy" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Assy Tool</h5>
                <input type="hidden" id="id_assy_tool">
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Cutting Tool</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit-assy" id="id_cutting_tool_regis" multiple>
                                    @forelse ($cutting_tool as $key => $row)
                                        <option value="{{$row->id}}">{{$row->spesification}}</option>
                                    @empty
                                        <option value="">-- Data Not Found --</option>
                                    @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Holder</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit-assy" id="id_holder_regis">
                                <option value="" disabled selected>-- select Holder --</option>
                                @forelse ($holder as $key => $row)
                                    <option value="{{$row->id}}">{{$row->spesification}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Accessories</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit-assy" name="" id="id_accessories_regis" multiple>
                                @forelse ($accessories as $key => $row)
                                    <option value="{{$row->id}}">{{$row->spesification}}</option>
                                @empty
                                    <option value="">-- Data Not Found --</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Tool Port</label>
                        <div class="col-8">
                            <input type="text" id="tool_port" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">&#931; Process</label>
                        <div class="col-8">
                            <input type="text" id="sigma_process" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Macro Address</label>
                        <div class="col-8">
                            <input type="text" id="macro_address" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">MIN/ MAX</label>
                        <div class="col-8">
                            <div class="input-group">
                                <input type="text" id="min_value" class="form-control" placeholder="MIN" aria-label="MIN" aria-describedby="basic-addon1">
                                <span class="input-group-text" id="basic-addon1">-</span>
                                <input type="text" id="max_value" class="form-control" placeholder="MAX" aria-label="MAX" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"><span>Close</span></button>
                <button type="button" class="btn btn-save" id="save_edit_assy_tool"><span>Save</span></button>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Edit Assy --}}

{{-- initiate --}}
<script>
    // document on load
    document.addEventListener('DOMContentLoaded', function () {
        getallmachineregis();
    });

    const getallmachineregis = async () => {
        fetch("{{ route('getallmachineregis') }}", { // Laravel Blade syntax to generate the route URL
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
            // Append the new data to the table
            var table = document.getElementById('getallmachineregis');
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

        
        $("#save_add_machine").click(function (e) {
            let id_plant = $("select[name='id_plant']").val();
            let id_wct = $("select[name='id_wct']").val();
            let id_maker_machine = $("select[name='id_maker_machine']").val();
            let op_name = $("input[name='op_name']").val();


            console.log(id_plant, id_wct, id_maker_machine, op_name);
            let formData = new FormData();
            formData.append('id_plant', id_plant);
            formData.append('id_wct', id_wct);
            formData.append('id_maker_machine', id_maker_machine);
            formData.append('op_name', op_name);
            formData.append('aksi', 'add');

            fetch("{{ route('crudmachineregis') }}", { // Laravel Blade syntax to generate the route URL
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
                            getallmachineregis();
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
        let id = $(this).data('item');
        // alert(id);
        fetch("{{ route('getallmachineregis') }}", { // Laravel Blade syntax to generate the route URL
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
            // Append the new data to the table
            if(data.status == 'success'){
                $('#id_plant').val(data.arr.id_plant).trigger('change');
                $('#id_wct').val(data.arr.id_wct).trigger('change');
                $('#id_maker_machine').val(data.arr.id_maker_machine).trigger('change');
                $('#op_name').val(data.arr.op_name);
                
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

        // save data edit
        $("#save_edit_machine").click(function (e) {
            let id_plant         = $('#id_plant').val();
            let id_wct           = $("#id_wct").val();
            let id_maker_machine = $("#id_maker_machine").val();
            let op_name          = $("#op_name").val();

            let formData = new FormData();
            formData.append('id', id);
            formData.append('id_plant', id_plant);
            formData.append('id_wct', id_wct);
            formData.append('id_maker_machine', id_maker_machine);
            formData.append('op_name', op_name);
            formData.append('aksi', 'edit');

            fetch("{{ route('crudmachineregis') }}", { // Laravel Blade syntax to generate the route URL
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
                            $("#modal_edit").modal('hide');
                            getallmachineregis();
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
        let id          = $(this).data('item');
        let op_name     = $(this).data('arr');
        
        Swal.fire({
            title: 'Anda yakin?',
            text: 'Hapus data '+op_name+'?',
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

                fetch("{{ route('crudmachineregis') }}", { // Laravel Blade syntax to generate the route URL
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
                                getallmachineregis();
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
            }
        });
    });
</script>
{{-- End JS Delete --}}

{{-- onclick registration machine --}}
<script>
    // class click_machine
    $(document).on("click", ".click_machine", function (e) {
        // get id value
        let id      = $(this).data('item');
        let op_name = $(this).data('arr');
        // make highlight color to the row
        $('.click_machine').not(this).removeClass('active');
        $(this).addClass('active');
        document.getElementById('id_machine').value = id;
        document.getElementById('selected_machine').innerHTML = op_name;
        // enable button add assy
        document.getElementById('btn_add_assy').disabled = false;
        // fetch to sidebar
        fetchToolPort(id);

    });

    function fetchToolPort(id){
        fetch("{{ route('getassytoolport') }}", { // Laravel Blade syntax to generate the route URL
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
            if(data.status == 'success'){
                var table = document.getElementById('assyToolPort');
                table.innerHTML = data.arr
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
    }
        
</script>

{{-- JS Add Assy --}}
<script>
    $(document).on("click", "[data-name='add_assy']", function (e) {
        $("#modal_add_assy").modal('show');

        // save data add assy
        $("#save_add_assy_tool").click(function (e) {
            let formData = new FormData();
            formData.append('id_machine_regis', $("#id_machine").val());
            formData.append('id_cutting_tool_regis', $("select[name='id_cutting_tool_regis']").val());
            formData.append('id_holder_regis', $("select[name='id_holder_regis']").val());
            formData.append('id_accessories_regis', $("select[name='id_accessories_regis']").val());
            formData.append('tool_port', $("input[name='tool_port']").val());
            formData.append('sigma_process', $("input[name='sigma_process']").val());
            formData.append('macro_address', $("input[name='macro_address']").val());
            formData.append('min_value', $("input[name='min_value']").val());
            formData.append('max_value', $("input[name='max_value']").val());
            formData.append('aksi', 'add');

            console.log(formData);

            fetch("{{ route('crudassytoolport') }}", { // Laravel Blade syntax to generate the route URL
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
                            $("#modal_add_assy").modal('hide');
                            fetchToolPort($("#id_machine").val());
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
{{-- End JS Add Assy --}}

{{-- JS Edit Assy --}}
<script>
    $(document).on("click", "[data-name='edit_assy']", function (e) {
        $("#modal_edit_assy").modal('show');
        let id = $(this).data('item');
        $('#id_assy_tool').val(id);
        fetchToolPortDetail(id);
    });

    const fetchToolPortDetail = async(id) => {
        fetch("{{ route('getassytoolportdetail') }}", { // Laravel Blade syntax to generate the route URL
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
            // Append the new data to the table
            if(data.status == 'success'){
                // multiple select
                var id_cutting_tool_regis = data.arr.id_cutting_tool_regis.split(',');
                $('#id_cutting_tool_regis').val(id_cutting_tool_regis).trigger('change');
                $('#id_holder_regis').val(data.arr.id_holder_regis).trigger('change');
                var id_accesories_regis = data.arr.id_accesories_regis.split(',');
                $('#id_accessories_regis').val(id_accesories_regis).trigger('change');
                $('#tool_port').val(data.arr.tool_port);
                $('#sigma_process').val(data.arr.sigma_process);
                $('#macro_address').val(data.arr.macro_address);
                $('#min_value').val(data.arr.min_value);
                $('#max_value').val(data.arr.max_value);
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
    }

    // save data edit assy
    $("#save_edit_assy_tool").click(function (e) {
        let formData = new FormData();
        formData.append('id', $("#id_assy_tool").val());
        formData.append('id_cutting_tool_regis', $("select[id='id_cutting_tool_regis']").val());
        formData.append('id_holder_regis', $("select[id='id_holder_regis']").val());
        formData.append('id_accessories_regis', $("select[id='id_accessories_regis']").val());
        formData.append('tool_port', $("input[id='tool_port']").val());
        formData.append('sigma_process', $("input[id='sigma_process']").val());
        formData.append('macro_address', $("input[id='macro_address']").val());
        formData.append('min_value', $("input[id='min_value']").val());
        formData.append('max_value', $("input[id='max_value']").val());
        formData.append('aksi', 'edit');

        fetch("{{ route('crudassytoolport') }}", { // Laravel Blade syntax to generate the route URL
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
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false

                }).then((result) => {
                    $("#modal_edit_assy").modal('hide');
                    fetchToolPort($("#id_machine").val());
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
</script>
{{-- End JS Edit Assy --}}

{{-- JS Delete Assy --}}
<script>
    $(document).on("click", "[data-name='delete_assy']", function (e) {
        let id          = $(this).data('item');
        let tool_port   = $(this).data('arr');

        Swal.fire({
            title: 'Anda yakin?',
            text: 'Hapus data '+tool_port+'?',
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

                fetch("{{ route('crudassytoolport') }}", { // Laravel Blade syntax to generate the route URL
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
                                fetchToolPort($("#id_machine").val());
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
            }
        });
    });
</script>
{{-- End JS Delete Assy --}}

{{-- JS Klik tr Active --}}
<script>
    $(document).on("click", ".klik-tr", function (e) {
        $('.klik-tr').not(this).removeClass('active');
        $(this).addClass('active');
    });
</script>
{{-- End JS Klik tr Active --}}

{{-- JS Select2 --}}
<script>
    $(".select-2-add").select2({
        allowClear: false,
        width: '100%',
        dropdownParent: $('#modal_add')
    });

    $(".select-2-add-assy").select2({
        allowClear: false,
        width: '100%',
        dropdownParent: $('#modal_add_assy')
    });

    $(".select-2-edit").select2({
        allowClear: false,
        width: '100%',
        dropdownParent: $('#modal_edit')
    });

    $(".select-2-edit-assy").select2({
        allowClear: false,
        width: '100%',
        dropdownParent: $('#modal_edit_assy')
    });
</script>
{{-- End JS Select2 --}}

{{-- Fixed header --}}
<script>
    $('#table_list_assy_tool').floatThead({
        scrollContainer: function ($table) {
            return $table.closest('.table-assy-tool');
        }
    });
</script>
{{-- End Fixed header --}}

@stop