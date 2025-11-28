@extends('main')
@section('content')

<section>
    <div class="card-header">
        @include('Masterdata.card_header')
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-6">
                <p class="judul-menu"><i></i>Maker Tool</p>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end align-items-center w-100">
                    <div class="input-group style-search mx-4">
                        <input id="searchMaker" type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                        <button type="button" class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></button>
                    </div>
                    <button type="button" class="btn btn-add" data-name="add"><i class="bi bi-plus-circle"></i> Add Maker Tool</button>
                </div>
            </div>
        </div>
        <div class="gridtable">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Maker Tool ID</th>
                        <th>Tool Name</th>
                        <th>Supplyer Name</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="dataAllMaker">
                    {{-- @for($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>KWN</td>
                            <td>Kawanobe</td>
                            <td>Tomita</td>
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Maker Tool</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Maker Tool ID</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="id_maker">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Maker Name</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="maker_name">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Supplyer Name</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="suplier_name">
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Maker Tool</h5>
                <input type="hidden" id="id_edit">
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Maker Tool ID</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="id_maker" id="id_maker">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Tool Name</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="maker_name" id="maker_name">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="text-label col-5">Supplyer Name</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="suplier_name" id="suplier_name">
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

{{-- inisiasi data --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Fetch API to get all data
        fetch("{{ route('get_all_maker') }}", { // Laravel Blade syntax to generate the route URL
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
            var table = document.getElementById('dataAllMaker');
            table.innerHTML = data.arr
        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
        });
    });
</script>

{{-- JS Add --}}
<script>
    $(document).on("click", "[data-name='add']", function (e) {
        $("input[name='id_maker']").val('');
        $("input[name='maker_name']").val('');
        $("input[name='suplier_name']").val('');
        $("#modal_add").modal('show');
    });

    $(document).on("click", "#save_add", function (e) {
        var id_maker        = $("input[name='id_maker']").val();
        var maker_name      = $("input[name='maker_name']").val();
        var suplier_name    = $("input[name='suplier_name']").val();
        var aksi            = 'add';

        // Fetch API to save the data
        fetch("{{ route('crud_maker') }}", { // Laravel Blade syntax to generate the route URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                id_maker: id_maker,
                maker_name: maker_name,
                suplier_name: suplier_name,
                aksi: aksi
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data.status)
            // Append the new data to the table
            if(data.status == 'success'){
                swal.fire({
                    position:'center',
                    title: 'Success!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((resp) => {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modal_add'));
                    modal.hide();

                    var table = document.getElementById('dataAllMaker');
                    table.innerHTML = data.arr
                });
            }else {
                swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: data.message,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
            swal.fire({
                position:'center',
                title: 'Failed!',
                text: data.message,
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            });
        });
    });
</script>
{{-- End JS Add --}}

{{-- JS Edit --}}
<script>
    $(document).on("click", "[data-name='edit']", function (e) {
        var id = $(this).data('item');
        var modal = new bootstrap.Modal(document.getElementById('modal_edit'));
        modal.show();
        document.getElementById('id_edit').value = id;

        // Fetch API to get the data
        fetch("{{ route('get_all_maker') }}", { // Laravel Blade syntax to generate the route URL
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
            // Append the new data to the table
            document.getElementById('id_maker').value = data.arr.id_maker;
            document.getElementById('maker_name').value = data.arr.maker_name;
            document.getElementById('suplier_name').value = data.arr.suplier_name;
        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
        });
    });

    // Save Edit
    $(document).on("click", "#save_edit", function (e) {
        var id              = $("#id_edit").val();
        var id_maker        = $("#id_maker").val();
        var maker_name      = $("#maker_name").val();
        var suplier_name    = $("#suplier_name").val();
        var aksi            = 'edit';

        // Fetch API to save the data
        fetch("{{ route('crud_maker') }}", { // Laravel Blade syntax to generate the route URL
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify({
                id: id,
                id_maker: id_maker,
                maker_name: maker_name,
                suplier_name: suplier_name,
                aksi: aksi
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data.status)
            // Append the new data to the table
            if(data.status == 'success'){
                swal.fire({
                    position:'center',
                    title: 'Success!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((resp) => {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modal_edit'));
                    modal.hide();

                    var table = document.getElementById('dataAllMaker');
                    table.innerHTML = data.arr
                });
            }else {
                swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: data.message,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
            swal.fire({
                position:'center',
                title: 'Failed!',
                text: data.message,
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            });
        });
    });
</script>
{{-- End JS Edit --}}

{{-- JS Delete --}}
<script>
    $(document).on("click", "[data-name='delete']", function (e) {
        let id          = $(this).data('item');
        let maker_name  = $(this).data('arr');

        Swal.fire({
            title: 'Anda yakin?',
            text: 'Delete Maker :' + maker_name + ' ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Fetch API to delete the data
                fetch("{{ route('crud_maker') }}", { // Laravel Blade syntax to generate the route URL
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
                    console.log(data.status)
                    // Append the new data to the table
                    if(data.status == 'success'){
                        swal.fire({
                            position:'center',
                            title: 'Success!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((resp) => {
                            var table = document.getElementById('dataAllMaker');
                            table.innerHTML = data.arr
                        });
                    }else {
                        swal.fire({
                            position:'center',
                            title: 'Failed!',
                            text: data.message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
                .catch((error) => {
                    // Handle errors here
                    console.error('Error:', error);
                    swal.fire({
                        position:'center',
                        title: 'Failed!',
                        text: data.message,
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
{{-- JS search --}}
<script>
    $(document).ready(function(){
        $("#searchMaker").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#dataAllMaker tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>


@stop