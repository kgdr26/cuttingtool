@extends('main')
@section('content')

<section>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-8">
                <p class="judul-menu"><i></i>USERS</p>
            </div>
            <div class="col-4">
                <div class="d-flex justify-content-end align-items-center w-100">
                    <div class="input-group style-search me-3">
                        <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                        <button type="button" class="input-group-text" id="basic-addon2" data-name=""><i class="bi bi-search"></i></button>
                    </div>
                    <button type="button" class="btn btn-add text-nowrap" data-name="add"><i class="bi bi-plus-circle"></i> Add Users</button>
                </div>
            </div>
        </div>
        <div class="gridtable">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>USERNAME</th>
                        <th>NRP</th>
                        <th>PASSWORD</th>
                        <th>ACCESS LEVEL</th>
                        <th>RFID</th>
                        <th>ACTION</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="datauser">
                    {{-- @for($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>Kang Dru</td>
                            <td>12345</td>
                            <td>***************</td>
                            <td>Engineering</td>
                            <td>1234567890</td>
                            <td>
                                <button class="btn btn-icon-edit" type="button" data-item="" data-name="edit"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-icon-delete" type="button" data-item="" data-name="delete"><i class="bi bi-trash"></i></button>
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
                <h5 class="modal-title">Add User</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Username</label>
                        <div class="col-8">
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">NRP</label>
                        <div class="col-8">
                            <input type="text" name="nrp" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">RFID</label>
                        <div class="col-8">
                            <input type="text" name="rfid" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Password</label>
                        <div class="col-8">
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Access Level</label>
                        <div class="col-8">
                            <select class="form-select select-2-add" name="">
                                <option value="0">Select Access Level</option>
                                <option value="admin">Superadmin</option>
                                <option value="eng">Engineering</option>
                                <option value="opr">Operator</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="textarea-label col-4">Image</label>
                        <div class="col-4">
                            <div class="card-auto position-relative">
                                <div class="card-foto">
                                    <img src="{{asset('assets/images/default.svg')}}" alt="user avatar" id="user_img">
                                </div>
                                <div class="input-type-file">
                                    <input class="style_input_image" type="file" id="img_users" name="img_users" accept="image/*" />
                                    <label for="img_users"></label>
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
                <h5 class="modal-title">Edit User</h5>
                <input type="hidden" id="id_edit">
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Username</label>
                        <div class="col-8">
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">NRP</label>
                        <div class="col-8">
                            <input type="text" id="nrp" name="nrp" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">RFID</label>
                        <div class="col-8">
                            <input type="text" id="rfid" name="rfid" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Password</label>
                        <div class="col-8">
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Access Level</label>
                        <div class="col-8">
                            <select class="form-select select-2-edit" id="role" name="role">
                                <option value="0">Select Access Level</option>
                                <option value="admin">Superadmin</option>
                                <option value="eng">Engineering</option>
                                <option value="opr">Operator</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="textarea-label col-4">Image</label>
                        <div class="col-4">
                            <div class="card-auto position-relative">
                                <div class="card-foto">
                                    <img src="{{asset('assets/images/default.svg')}}" alt="user avatar" id="user_img_edit">
                                </div>
                                <div class="input-type-file">
                                    <input class="style_input_image" type="file" id="img_users_edit" name="img_users_edit" accept="image/*" />
                                    <label for="img_users_edit"></label>
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

{{-- inisiate data --}}
<script>
   document.addEventListener('DOMContentLoaded', function() {
        getdatauser();
    });


    const getdatauser = () => {

        fetch("{{ route('getuser') }}", { // Laravel Blade syntax to generate the route URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                // body data
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if(data.status){
                let html = '';
                for (let i = 0; i < data.arr.length; i++) {
                    let row = data.arr[i];
                    html += '<tr>';
                    html += '<td>'+(i+1)+'</td>';
                    html += '<td>'+row.name+'</td>';
                    html += '<td>'+row.nrp+'</td>';
                    html += '<td>***************</td>';
                    html += '<td>'+row.role+'</td>';
                    html += '<td>'+row.rfid+'</td>';
                    html += '<td>';
                    html += '<button class="btn btn-icon-edit" type="button" data-item="'+row.id+'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    html += '<button class="btn btn-icon-delete" type="button" data-item="'+row.id+'" data-name="delete" data-arr="'+row.name+'"><i class="bi bi-trash"></i></button>';
                    html += '</td>';
                    html += '</tr>';
                }

                document.getElementById('datauser').innerHTML = html;
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
</script>


{{-- JS Modal ADD --}}
<script>
    $(document).on("click", "[data-name='add']", function (e) {
        $("#modal_add").modal('show');
        // clear input
        document.querySelector('input[name="name"]').value = '';
        document.querySelector('input[name="nrp"]').value = '';
        document.querySelector('input[name="rfid"]').value = '';
        document.querySelector('input[name="password"]').value = '';
        document.querySelector('select[name="role"]').value = 0;
        document.querySelector('input[name="img_users"]').value = '';
        document.getElementById('user_img').src = "{{asset('assets/images/default.svg')}}";

    });

    $("#img_users").on("change", function(e){
        var ext = $("#img_users").val().split('.').pop().toLowerCase();
        var file = e.target.files[0];
        // console.log(ext)
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Format image failed!'
            })
        } else {
            var uploadedFile    = URL.createObjectURL(e.target.files[0]);
            var imageName       = e.target.files[0].name;
            $('#user_img').attr('src', uploadedFile);
            // upload file
            var formData = new FormData();
            var file_lok = 'image_inspection_record';
            formData.append('drawing', file);
            formData.append('lokasi', file_lok);
            formData.append('imgstr', imageName);
            document.getElementById('image_add_insp').value = imageName;
        }
    });

    document.getElementById('save_add').addEventListener('click', function() {
        let name = document.querySelector('input[name="name"]').value;
        let nrp = document.querySelector('input[name="nrp"]').value;
        let rfid = document.querySelector('input[name="rfid"]').value;
        let password = document.querySelector('input[name="password"]').value;
        let role = document.querySelector('select[name=""]').value;
        let img = document.querySelector('input[name="img_users"]').files[0];
        let img_name = document.querySelector('input[name="img_users"]').files[0].name;

        if(name == '' || nrp == '' || rfid == '' || password == '' || role == 0 || img == undefined){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'All fields must be filled!'
            })
        } else {
            var formData = new FormData();
            formData.append('name', name);
            formData.append('nrp', nrp);
            formData.append('rfid', rfid);
            formData.append('password', password);
            formData.append('role', role);
            formData.append('img', img);
            formData.append('user_photo', img_name);
            formData.append('aksi', 'add');

            fetch("{{ route('cruduser') }}", { // Laravel Blade syntax to generate the route URL
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
                if(data.status){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#modal_add").modal('hide');
                            getdatauser();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message
                    })
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    });
</script>
{{-- End JS Modal Add --}}

{{-- JS Modal Edit --}}
<script>
    $(document).on("click", "[data-name='edit']", function (e) {
        $("#modal_edit").modal('show');
        let id = $(this).data('item');

        fetch("{{ route('getuser') }}", { // Laravel Blade syntax to generate the route URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                id: id
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if(data.status){
                document.getElementById('id_edit').value = data.arr.id;
                document.getElementById('name').value = data.arr.name;
                document.getElementById('nrp').value = data.arr.nrp;
                document.getElementById('rfid').value = data.arr.rfid;
                document.getElementById('password').value = data.arr.password;
                $('#role').val(data.arr.role).trigger('change');
                // check if there is file image uploaded
                if (data.arr.user_photo != null) {
                    document.getElementById('user_img_edit').src = "/public/user/" + data.arr.user_photo;
                }else {
                    document.getElementById('user_img_edit').src = "{{asset('assets/images/default.svg')}}";
                }
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });

    });

    $("#img_users_edit").on("change", function(e){
        var ext = $("#img_users_edit").val().split('.').pop().toLowerCase();
        var file = e.target.files[0];
        // console.log(ext)
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Format image failed!'
            })
        } else {
            var uploadedFile    = URL.createObjectURL(e.target.files[0]);
            var imageName       = e.target.files[0].name;
            $('#user_img_edit').attr('src', uploadedFile);
            // upload file
        }
    });

    document.getElementById('save_edit').addEventListener('click', function() {
        let id       = document.getElementById('id_edit').value;
        let name     = document.getElementById('name').value;
        let nrp      = document.getElementById('nrp').value;
        let rfid     = document.getElementById('rfid').value;
        let password = document.getElementById('password').value;
        let role     = document.getElementById('role').value;
        let fileInput = document.querySelector('input[name="img_users_edit"]');
        let img = null;
        let img_name = null;

        if (fileInput.files.length > 0) {
            img = fileInput.files[0];
            img_name = img.name;
        }

        if(name == '' || nrp == '' || rfid == '' || password == '' || role == 0){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'All fields must be filled!'
            })
        } else {
            var formData = new FormData();
            formData.append('id_edit', id);
            formData.append('name', name);
            formData.append('nrp', nrp);
            formData.append('rfid', rfid);
            formData.append('password', password);
            formData.append('role', role);
            formData.append('img', img);
            formData.append('user_photo', img_name);
            formData.append('aksi', 'edit');

            fetch("{{ route('cruduser') }}", { // Laravel Blade syntax to generate the route URL
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
                if(data.status){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#modal_edit").modal('hide');
                            getdatauser();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message
                    })
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    });

</script>
{{-- End JS Modal Edit --}}

{{-- JS Delete --}}
<script>
    $(document).on("click", "[data-name='delete']", function (e) {
        var id      = $(this).data('item');
        var detail  = $(this).data('arr');

        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to delete  ' + detail + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ route('cruduser') }}", { // Laravel Blade syntax to generate the route URL
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                    },
                    body: JSON.stringify({
                        id: id,
                        aksi: 'delete'
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if(data.status){
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message
                        }).then((result) => {
                            if (result.isConfirmed) {
                                getdatauser();
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        })
                    }
                })
                .catch((error) => {
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