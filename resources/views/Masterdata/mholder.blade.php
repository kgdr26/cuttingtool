@extends('main')
@section('content')

<section>
    <div class="card-header">
        @include('Masterdata.card_header')
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-6">
                <p class="judul-menu"><i></i>Holder Type</p>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end align-items-center w-100">
                    <div class="input-group style-search mx-4">
                        <input id="searchHolder" type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                        <button type="button" class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></button>
                    </div>
                    <button type="button" class="btn btn-add" data-name="add"><i class="bi bi-plus-circle"></i> Add Holder</button>
                </div>
            </div>
        </div>
        <div class="gridtable">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Holder ID</th>
                        <th>Holder Type</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="dataAllHolder">
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
                <h5 class="modal-title">Add Holder</h5>
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Holder ID</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="id_holder" >
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="text-label col-4">Holder Type</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="holder_type" >
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
                <h5 class="modal-title">Edit Holder</h5>
                <input type="hidden" id="id_edit">
            </div>
            <div class="modal-body">
                <div class="card-auto">
                    <div class="row mb-3">
                        <label for="" class="text-label col-4">Holder ID</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="id_holder" id="id_holder">
                        </div>
                    </div>

                    <div class="row">
                        <label for="" class="text-label col-4">Holder Type</label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="holder_type" id="holder_type">
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
        fetch("{{ route('get_all_holder') }}", { // Laravel Blade syntax to generate the route URL
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
            var table = document.getElementById('dataAllHolder');
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
        // var idPlant     = document.querySelector('option[name="id_plant"]').value;
        var idHolder   = document.querySelector('input[name="id_holder"]').value;
        var holderType = document.querySelector('input[name="holder_type"]').value;

        var data = {
            id_holder: idHolder,
            holder_type: holderType        };
        // Fetch API to send the data
        fetch("{{ route('add_holder') }}", { // Laravel Blade syntax to generate the route URL
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
                    document.querySelector('input[name="id_holder"]').value = '';
                    document.querySelector('input[name="holder_type"]').value = '';
                    // Append the new data to the table
                    var table = document.getElementById('dataAllHolder');
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

        // Fetch API to get the data
        fetch("{{ route('get_all_holder') }}", { // Laravel Blade syntax to generate the route URL
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
            var id_holder    = data.arr[0].id_holder;
            var holder_type  = data.arr[0].holder_type;
            // select2 option set id plant
            document.getElementById('id_holder').value   = id_holder;
            document.getElementById('holder_type').value = holder_type;

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
        var idHolder   = document.querySelector('input[id="id_holder"]').value;
        var holderType = document.querySelector('input[id="holder_type"]').value;

        var data = {
            id_edit: idEdit,
            id_holder: idHolder,
            holder_type: holderType
        };
        // Fetch API to send the data
        fetch("{{ route('edit_holder') }}", { // Laravel Blade syntax to generate the route URL
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
                    // Clear the form
                    document.querySelector('input[name="id_holder"]').value = '';
                    document.querySelector('input[name="holder_type"]').value = '';
                    // Append the new data to the table
                    var table = document.getElementById('dataAllHolder');
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
        var id        = $(this).attr('data-item');
        var id_holder = $(this).attr('data-arr');

        Swal.fire({
            title: 'Anda yakin?',
            text: 'Delete ID HOLDER : ' + id_holder + ' ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Fetch API to get the data
                fetch("{{ route('delete_holder') }}", { // Laravel Blade syntax to generate the route URL
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel
                    },
                    body: JSON.stringify({id: id, id_holder: id_holder})
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
                            var table = document.getElementById('dataAllHolder');
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
{{-- JS search --}}
<script>
    $(document).ready(function(){
        $("#searchHolder").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#dataAllHolder tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>


@stop