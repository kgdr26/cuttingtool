@extends('main')
@section('content')

<section>
    <div class="card-header">
        @include('Masterdata.card_header')
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-6">
                <p class="judul-menu"><i></i>Accesories Type</p>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end align-items-center w-100">
                    <div class="input-group style-search mx-4">
                        <input id="searchAcc" type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                        <button type="button" class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></button>
                    </div>
                    <button type="button" class="btn btn-add" data-name="add"><i class="bi bi-plus-circle"></i> Add Accesories</button>
                </div>
            </div>
        </div>
        <div class="gridtable">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Accesories ID</th>
                        <th>Accesories Type</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="dataAllAcc">
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
                <h5 class="modal-title">Add Accesories</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Accesories ID</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="id_acc">
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="textarea-label col-4">Accesories Type</label>
                        <div class="col-8">
                            <textarea name="acc_type" cols="30" rows="10" class="form-control"></textarea>
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
                <h5 class="modal-title">Edit Accesories</h5>
                <input type="hidden" id="id_edit">
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Accesories ID</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="id_acc" id="id_acc">
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="textarea-label col-4">Accesories Type</label>
                        <div class="col-8">
                            <textarea name="acc_name" id="acc_type" cols="30" rows="10" class="form-control"></textarea>
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
        fetch("{{ route('get_all_acc') }}", { // Laravel Blade syntax to generate the route URL
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
            var table = document.getElementById('dataAllAcc');
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
        $("#modal_add").modal('show');
    });

    // Save Add
    document.getElementById('save_add').addEventListener('click', function() {
        // Prepare data to send
        var idAcc      = document.querySelector('input[name="id_acc"]').value;
        var acc_type   = document.querySelector('textarea[name="acc_type"]').value;

        var data = {
            id_acc: idAcc,
            acc_type: acc_type        };
        // Fetch API to send the data
        fetch("{{ route('add_acc') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if(data.status == 'success'){
                swal.fire({
                    position:'center',
                    title: 'Success!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((resp) => {
                    console.log(data)
                    // Hide the modal
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modal_add'));
                    modal.hide();
                    // Clear the form
                    document.querySelector('input[name="id_acc"]').value = '';
                    document.querySelector('textarea[name="acc_type"]').value = '';
                    // Append the new data to the table
                    var table = document.getElementById('dataAllAcc');
                    table.innerHTML = data.arr
                });            
            }else{
                swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: data.message,
                    icon: 'error',
                    showConfirmButton: true,
                })
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
                showConfirmButton: true,
            })
        });
    });
</script>
{{-- End JS Add --}}

{{-- JS Edit --}}
<script>
    $(document).on("click", "[data-name='edit']", function (e) {
        var modal    = new bootstrap.Modal(document.getElementById('modal_edit'));
        modal.show();
        var id  = $(this).attr('data-item');
        document.getElementById('id_edit').value = id;
        // alert(id);

        // Fetch API to get the data
        fetch("{{ route('get_all_acc') }}", { // Laravel Blade syntax to generate the route URL
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
            var id_acc     = data.arr[0].id_accesories;
            var acc_type   = data.arr[0].accesories_type;
            // select2 option set id plant
            document.getElementById('id_acc').value   = id_acc;
            document.getElementById('acc_type').value = acc_type;

        })
        .catch((error) => {
            // Handle errors here
            console.error('Error:', error);
        });
    });

    // Save Edit
    document.getElementById('save_edit').addEventListener('click', function() {
        // Prepare data to send
        var idEdit     = document.querySelector('input[id="id_edit"]').value;
        var idAcc      = document.querySelector('input[id="id_acc"]').value;
        var acc_type   = document.querySelector('textarea[id="acc_type"]').value;

        var data = {
            id_edit: idEdit,
            id_acc: idAcc,
            acc_type: acc_type        
        };
        // Fetch API to send the data
        fetch("{{ route('edit_acc') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if(data.status == 'success'){
                swal.fire({
                    position:'center',
                    title: 'Success!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((resp) => {
                    console.log(data)
                    // Hide the modal
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modal_edit'));
                    modal.hide();
                    // Append the new data to the table
                    var table = document.getElementById('dataAllAcc');
                    table.innerHTML = data.arr
                });            
            }else{
                swal.fire({
                    position:'center',
                    title: 'Failed!',
                    text: data.message,
                    icon: 'error',
                    showConfirmButton: true,
                })
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
                showConfirmButton: true,
            })
        });
    });
</script>
{{-- End JS Edit --}}

{{-- JS Delete --}}
<script>
    $(document).on("click", "[data-name='delete']", function (e) {
        var id      = $(this).attr('data-item');
        var id_acc  = $(this).attr('data-arr');

        Swal.fire({
            title: 'Anda yakin?',
            text: 'Aksi ID Accessories '+id_acc+' akan dihapus permanen',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Fetch API to get the data
                fetch("{{ route('delete_acc') }}", { // Laravel Blade syntax to generate the route URL
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                    },
                    body: JSON.stringify({id: id, id_acc: id_acc})
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if(data.status == 'success'){
                        swal.fire({
                            position:'center',
                            title: 'Success!',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000
                        }).then((resp) => {
                            console.log(data)
                            // Append the new data to the table
                            var table = document.getElementById('dataAllAcc');
                            table.innerHTML = data.arr
                        });            
                    }else{
                        swal.fire({
                            position:'center',
                            title: 'Failed!',
                            text: data.message,
                            icon: 'error',
                            showConfirmButton: true,
                        })
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
                        showConfirmButton: true,
                    })
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