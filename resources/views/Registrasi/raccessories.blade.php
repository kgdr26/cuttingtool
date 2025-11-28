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
        <div class="row mb-3">
            <div class="col-6">
                <p class="judul-menu"><i></i>Registration Accessories</p>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end align-items-center w-100">
                    <button type="button" class="btn btn-border me-1" data-name="upload"><i class="icon-excel"></i> Upload</button>
                    <button type="button" class="btn btn-border me-1" data-name="download"><i class="bi bi-download"></i> Download</button>
                    <button type="button" class="btn btn-add" data-name="add"><i class="bi bi-plus-circle"></i> Add Accessories</button>
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
                        <th>TYPE</th>
                        <th>MAKER</th>
                        <th>MATERIAL</th>
                        {{-- <th>UNIT</th> --}}
                        <th>PRICE</th>
                        <th>LIFETIME</th>
                        <th>DRAWING</th>
                        <th>ACTION</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="dataAllAccRegis">
                    {{-- @for($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>08-91-00137</td>
                            <td>-</td>
                            <td>IN-5JC547</td>
                            <td>IN-5JC547 HOLDER C4-PSSNL-27042-12 SANDVIK</td>
                            <td>CAPTO</td>
                            <td>SANDVIK</td>
                            <td>ST</td>
                            <td>Rp. 1.963.200</td>
                            <td>2.000.000</td>
                            <td>
                                <i class="icon-pdf"></i>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-icon-edit" type="button" data-item="" data-name="edit"><i class="bi bi-pencil-square"></i></button>
                                    <button class="btn btn-icon-delete" type="button" data-item="" data-name="delete"><i class="bi bi-trash-fill"></i></button>
                                </div>
                            </td>
                        </tr> 
                    @endfor --}}
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
                <h5 class="modal-title">Add Registration Accessories</h5>
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
                        <label for="" class="text-label col-4">Accesories AccesoriesType</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="id_acc">
                                <option value="" disabled selected>Select Accesories Type</option>
                                @forelse ($acc as $key => $row)
                                    <option value="{{$row->id}}">{{$row->accesories_type}}</option>
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
                                <span class="input-group-text" id="">Rp.</span>
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
                <h5 class="modal-title">Edit Registration Accessories</h5>
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
                        <label for="" class="text-label col-4">Accesories Type</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" name="" id="id_acc">
                                <option value="" disabled selected>Select Type</option>
                                @forelse ($acc as $key => $row)
                                    <option value="{{$row->id}}">{{$row->accesories_type}}</option>
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
    document.addEventListener('DOMContentLoaded', function() {
        getAccRegis();
    });

    const getAccRegis = async () => {
        // fetch data
        fetch("{{ route('getaccregis') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            var table = document.getElementById("dataAllAccRegis");
            table.innerHTML = data.arr;
        })
        .catch(error => {
            console.log(error);
        });
    }
</script>

{{-- JS Add --}}
<script>
    $(document).on("click", "[data-name='add']", function (e) {
        document.querySelector("input[name='part_no']").value = '';
        document.querySelector("input[name='engineering_no']").value = '';
        document.querySelector("input[name='hes_no']").value = '';
        document.querySelector("textarea[name='spesification']").value = '';
        $("select[name='id_acc']").val('').trigger("change");
        $("select[name='id_maker']").val('').trigger("change");
        $("select[name='id_material']").val('').trigger("change");
        $("select[name='id_unit']").val('').trigger("change");
        document.querySelector("input[name='price']").value = '';
        document.querySelector("input[name='lifetime']").value = '';
        document.querySelector("input[name='drawing']").value = '';
        $("#modal_add").modal('show');
        let part_no         = document.querySelector("input[name='part_no']");
        let engineering_no  = document.querySelector("input[name='engineering_no']");
        let hes_no          = document.querySelector("input[name='hes_no']");
        let spesification   = document.querySelector("textarea[name='spesification']");
        let id_acc          = document.querySelector("select[name='id_acc']");
        let id_maker        = document.querySelector("select[name='id_maker']");
        let id_material     = document.querySelector("select[name='id_material']");
        let id_unit         = document.querySelector("select[name='id_unit']");
        let price           = document.querySelector("input[name='price']");
        let lifetime        = document.querySelector("input[name='lifetime']");
        let drawing         = document.querySelector("input[name='drawing']");

        // save data
        document.getElementById("save_add").addEventListener("click", function() {
            let formData = new FormData();
            formData.append("part_no", part_no.value);
            formData.append("engineering_no", engineering_no.value);
            formData.append("hes_no", hes_no.value);
            formData.append("spesification", spesification.value);
            formData.append("id_acc", id_acc.value);
            formData.append("id_maker", id_maker.value);
            formData.append("id_material", id_material.value);
            formData.append("id_unit", id_unit.value);
            formData.append("price", price.value);
            formData.append("lifetime", lifetime.value);
            formData.append("drawing", drawing.files[0]);
            formData.append("aksi", "add");

            fetch("{{ route('crudaccregis') }}", {
                method: "POST",
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
                if (data.status == "success") {
                    Swal.fire({
                        position:'center',
                        title: 'Success!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((data) => {
                        // close modal
                        $("#modal_add").modal('hide');
                        getAccRegis();
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
                console.log(error);
            });

        });


    });
</script>
{{-- End JS Add --}}

{{-- JS Edit --}}
<script>
    $(document).on("click", "[data-name='edit']", function (e) {
        $("#modal_edit").modal('show');
        let id = $(this).data("item");

        // fetch data
        fetch("{{ route('getaccregis') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({id: id})
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            document.getElementById("part_no").value = data.arr.part_no;
            document.getElementById("engineering_no").value = data.arr.engineering_no;
            document.getElementById("hes_no").value = data.arr.hes_no;
            document.getElementById("spesification").value = data.arr.spesification;
            $('#id_acc').val(data.arr.id_accesories).trigger('change');
            $('#id_maker').val(data.arr.id_maker).trigger('change');
            $('#id_material').val(data.arr.id_material).trigger('change');
            $('#id_unit').val(data.arr.id_unit).trigger('change');
            document.getElementById("price").value = data.arr.price;
            document.getElementById("lifetime").value = data.arr.lifetime;
            document.getElementById('formFileEdit').value   = data.arr.drawing;
            

        })
        .catch(error => {
            console.log(error);
        });

        document.getElementById('save_edit').addEventListener('click', function(){
            let formData = new FormData();
            formData.append("id", id);
            formData.append("part_no", document.getElementById("part_no").value);
            formData.append("engineering_no", document.getElementById("engineering_no").value);
            formData.append("hes_no", document.getElementById("hes_no").value);
            formData.append("spesification", document.getElementById("spesification").value);
            formData.append("id_acc", document.getElementById("id_acc").value);
            formData.append("id_maker", document.getElementById("id_maker").value);
            formData.append("id_material", document.getElementById("id_material").value);
            formData.append("id_unit", document.getElementById("id_unit").value);
            formData.append("price", document.getElementById("price").value);
            formData.append("lifetime", document.getElementById("lifetime").value);
            formData.append("drawing", document.getElementById("formFileEdit").files[0]);
            formData.append("aksi", "edit");

            fetch("{{ route('crudaccregis') }}", {
                method: "POST",
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
                if (data.status == "success") {
                    Swal.fire({
                        position:'center',
                        title: 'Success!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((data) => {
                        getAccRegis();
                        $("#modal_edit").modal('hide');
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
                console.log(error);
            });

        })


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
        var id      = $(this).data("item");
        var part_no = $(this).data("arr");
        Swal.fire({
            title: 'Anda yakin?',
            text: 'Hapus data '+part_no+'?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ route('crudaccregis') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({id: id, aksi: "delete"})
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.status == "success") {
                        Swal.fire({
                            position:'center',
                            title: 'Success!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((data) => {
                            getAccRegis();
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
                    console.log(error);
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